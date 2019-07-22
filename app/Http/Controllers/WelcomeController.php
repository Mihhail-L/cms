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
    
    public function categoryfilter($catid) {

        $posts = Post::where('category_id', $catid)->paginate(6);
        $cat_name = Category::findOrFail($catid);
        //dd($post);

        return view('welcome')->with('posts', $posts)->with('categories', Category::all())->with('tags', Tag::all())->with('cat_name', $cat_name);
    }
    
    public function tagFilter($tagid) {

        $tag = Tag::findOrFail($tagid);

        $posts = $tag->posts()->where('tag_id', $tagid)->paginate(6);

        $tag_name = Tag::findOrFail($tagid);
        //dd($post);

        return view('welcome')->with('posts', $posts)->with('categories', Category::all())->with('tags', Tag::all())->with('tag_name', $tag->name);
    }
}
