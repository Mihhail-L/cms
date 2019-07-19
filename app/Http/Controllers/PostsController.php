<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //uploading files is KILLING ME GOD DAMN
    protected $debug = 0; // 1 = debug for image path.. 0 = no debug just fucking upload
 
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $post = new Post;

        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->content = $request->input('content');
        $post->published_at = $request->input('published_at');

        $imagePath = request('image')->store('/posts', 'public');
        //$this->debug == 1 dd image path else just fucking save it and redirect...
        if($this->debug == 1) {
            dd($imagePath);
        } else {
            $post->image = $imagePath;
            $post->save();
            return redirect(route('posts.index'))->with('success', 'Post '.$post->title.' Successfully Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //return view('posts.create')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        $title = $post->title;

        if($post->trashed()) {
            Storage::delete($post->image);
            $post->forceDelete();
            $a = true;
        } else {
            $post->delete();
            $a = false;
        }

        return redirect(route('posts.index'))->with('success', $a ? ' Post '.$title.' has been Deleted' : ' Post '.$title.' has been Trashed');
    }

    /**
     * Display trashed posts.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashed() {
        $trashed = Post::withTrashed()->get();

        return view('posts.index')->withPosts($trashed);
    }
}
