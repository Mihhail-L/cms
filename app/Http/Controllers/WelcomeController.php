<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Tag;
use App\Post;

class WelcomeController extends Controller
{
    public function index() {
        $posts = Post::orderBy('published_at', 'ASC')->paginate(6);
        return view('welcome')
        ->with('categories', Category::all())
        ->with('tags', Tag::all())
        ->with('posts', $posts);
    }

    public function show($postid) {
        $post = Post::findOrFail($postid);
        
        return view('posts.show')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }
}
