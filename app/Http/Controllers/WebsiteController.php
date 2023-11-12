<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function home() {
        $currentDate = Carbon::now();

        $posts = Post::where('post_status_id', Post::Published)
            ->where(function ($query) use ($currentDate) {
                $query->whereNull('schedule_posting')
                    ->orWhere('schedule_posting', '<=', $currentDate);
            })
            ->get();
        return view('website.blog.index', ['posts' => $posts]);
    }

    public function show(Post $post) {
        return view('website.blog.single', ['post' => $post]);
    }
}
