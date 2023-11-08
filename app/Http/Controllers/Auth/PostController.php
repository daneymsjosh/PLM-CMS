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
use App\Http\Requests\Auth\Post\CreateRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['category', 'status', 'content.mediaUpload'])->get();
        return view('auth.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = PostCategory::all();
        $statuses = PostStatus::all();
        return view('auth/posts/create', ['categories' => $categories, 'statuses' => $statuses]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        try {
            DB::beginTransaction();

            $mediaUpload = null;
            
            if ($request->file('file')) {
                $file = $request->file; 
                $fileName = time(). $file->getClientOriginalName();
                $imagePath = public_path('/images/posts/');
                $file->move($imagePath, $fileName);
                
                $mediaUpload = MediaUpload::create([
                    'media_name' => $fileName,
                    'media_type_id' => '1'
                ]);
            }
    
            $content = Content::create([
                'media_upload_id' => $mediaUpload ? $mediaUpload->id : null,
                'content_body' => $request->description
            ]);
    
            Post::create([
                'post_category_id' => $request->category,
                'post_status_id' => $request->status,
                'content_id' => $content->id,
                'post_title' => $request->title,
                'schedule_posting' => $request->schedule,
                'remarks' => 'testing'
            ]);

            DB::commit();
        }

        catch(\Exception $ex) {
            DB::rollBack();
            dd($ex->getMessage());
        }
        
        $request->session()->flash('alert-success', 'Post Created Successfully');

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
