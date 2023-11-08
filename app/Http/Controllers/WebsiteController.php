<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function home() {
        $posts = Post::where('post_status_id', Post::Published)->get();
        return view('website.blog.index', ['posts' => $posts]);
    }

    public function show(Post $post) {
        return view('website.blog.single', ['post' => $post]);
    }
}
