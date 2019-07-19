<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function __construct() {
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }
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
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        //dd($request->all());
        //$post = new Post;
        $imagePath = request('image')->store('/posts', 'public');
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'published_at' => $request->published_at,
            'category_id' => $request->category,
            'image' => $imagePath
        ]);

        if($request->tags) {
            $post->tags()->attach($request->tags);
        }

        //$this->debug == 1 dd image path else just fucking save it and redirect...
        if($this->debug == 1) {
            dd($imagePath);
        } else {
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
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $old_title = $post->title;
        $data = $request->only(['title', 'description', 'published_at', 'content', 'category']);
        //check if new image
        if ($request->hasFile('image')){
            //upload it
            $image = request('image')->store('/posts', 'public');
            //delete old one
            $post->deleteImage();

            $data['image'] = $image;
        }

        if($request->tags) {
            $post->tags()->sync($request->tags);
        }

        //update attributes
        $post->update($data);

        if($old_title != $data['title']) {
            $new_title = $data['title'];
        }

        return redirect(route('posts.index'))->with('success', 
        isset($new_title) ? 'Post "'.$old_title.'" Successfully Updated New title: "'.$new_title.'"' : 'Post "'.$old_title.'" Successfully Updated');
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
            $post->deleteImage();
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
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->withPosts($trashed);
    }

    public function restore($id) {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();

        return redirect()->back()->with('success', 'Post '.$post->title.' has been restored');
    }
}
