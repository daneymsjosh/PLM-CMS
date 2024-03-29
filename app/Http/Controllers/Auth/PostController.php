<?php

namespace App\Http\Controllers\Auth;

use App\Models\Post;
use App\Models\Content;
use App\Models\PostStatus;
use App\Models\MediaUpload;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\Post\CreateRequest;
use App\Models\Tag;

class PostController extends Controller
{
   
    public function index()
    {
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            $posts = Post::with(['category', 'status', 'content.mediaUploads'])->get();
        } else {
            $posts = Post::with(['category', 'status', 'content.mediaUploads'])
                ->where('created_by_id', $user->id)
                ->get();
        }

        return view('auth.posts.index', ['posts' => $posts]);
    }

    
    public function create()
    {
        $categories = PostCategory::all();
        $statuses = PostStatus::all();
        $tags = Tag::all();
        return view('auth/posts/create', ['categories' => $categories, 'statuses' => $statuses, 'tags' => $tags]);
    }

    // public function create()
    // {
    //     $categories = PostCategory::all();
    //     $statuses = PostStatus::all();
    //     $tags = Tag::all();
    //     return response()->json(['categories' => $categories, 'statuses' => $statuses, 'tags' => $tags]);
    // }

   
    public function store(CreateRequest $request)
    {
        try {
            DB::beginTransaction();

            // Create Content
            $content = Content::create([
                'content_body' => $request->description,
            ]);

            // Associate Media Uploads with Content
            $mediaUploads = [];
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $fileName = time() . $file->getClientOriginalName();
                    $imagePath = public_path('/medias/posts/');
                    $file->move($imagePath, $fileName);

                    $mediaUpload = MediaUpload::create([
                        'media_name' => $fileName,
                        'media_type_id' => $this->getMediaTypeFromExtension($file->getClientOriginalExtension()),
                    ]);

                    $mediaUploads[] = $mediaUpload;
                }
                $content->mediaUploads()->saveMany($mediaUploads);
            }

            // Create Post and associate with Content
            $user = Auth::user();
            $post = Post::create([
                'post_category_id' => $request->category,
                // 'post_status_id' => $request->status,
                'post_status_id' => $request->input('status', PostStatus::ForApproval),
                'content_id' => $content->id,
                'post_title' => $request->title,
                'schedule_posting' => $request->schedule,
                'created_by_id' => $user->id,
                'modified_by_id' => $user->id,
            ]);

            // Attach Tags to Post
            $post->tags()->attach($request->input('tags', []));

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            dd($ex->getMessage());
        }

        $request->session()->flash('alert-success', 'Post Created Successfully');

        return redirect()->route('posts.index');
    }

    private function getMediaTypeFromExtension($extension)
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
        $videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'mkv'];

        if (in_array(strtolower($extension), $imageExtensions)) {
            return 1;
        } elseif (in_array(strtolower($extension), $videoExtensions)) {
            return 2;
        } else {
            return 3;
        }
    }
    
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $categories = PostCategory::all();
        $statuses = PostStatus::all();
        $tags = Tag::all();

        return view('auth.posts.edit', compact('post', 'categories', 'statuses', 'tags'));
    }

  
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|exists:post_categories,id',
            'description' => 'required|string',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:5000',
            'schedule' => 'required|date',
        ]);

        try {
            DB::beginTransaction();

            $post->content->update([
                'content_body' => $request->description,
            ]);

            $statusId = $request->status;

            
            if (auth()->user()->isSuperAdmin()) {
                $post->update([
                    'post_category_id' => $request->category,
                    'post_title' => $request->title,
                    'schedule_posting' => $request->schedule,
                    'modified_by_id' => Auth::id(),
                    'post_status_id' => $statusId,
                ]);
            } else {
            
                $post->update([
                    'post_category_id' => $request->category,
                    'post_title' => $request->title,
                    'schedule_posting' => $request->schedule,
                    'modified_by_id' => Auth::id(),
                ]);
            }

            $post->tags()->sync($request->input('tags', []));

          
        if ($request->hasFile('file')) {
       
            if ($post->content->mediaUploads) {
                foreach ($post->content->mediaUploads as $mediaUpload) {
                    $mediaUpload->delete();
                }
            }

   
            $mediaUploads = [];
            foreach ($request->file('file') as $file) {
                $fileName = time() . $file->getClientOriginalName();
                $imagePath = public_path('/images/posts/');
                $file->move($imagePath, $fileName);

                $mediaUpload = MediaUpload::create([
                    'media_name' => $fileName,
                    'media_type_id' => $this->getMediaTypeFromExtension($file->getClientOriginalExtension()),
                ]);

                $mediaUploads[] = $mediaUpload;
            }

            $post->content->mediaUploads()->saveMany($mediaUploads);
        }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            dd($ex->getMessage());
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    public function destroy(string $id)
    {
        //
    }
}
