<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;

class tagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {
        $tag = new Tag;
        $tag->name = $request->input('name');

        $tag->save();

        return redirect(route('tags.index'))->with('success', 'tag '.$tag->name.' Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);

        return redirect(route('tags.show'), compact($tag));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tags.create')->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTagRequest $request, $id)
    {
        //find Tag else show 404
        $tag = Tag::findOrFail($id);
        //save old and new name in a variable for later use
        $old_name = $tag->name;
        $new_name = $request->input('name');
        //set name field to input value
        $tag->name = $request->input('name');
        //save Tag in the database
        $tag->save();
        //redirect to index with a flash message
        return redirect(route('tags.index'))->with('success', 'tag '.$old_name.' has been updated to '.$new_name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $deleted_name = $tag->name;
        $tag->delete();

        return redirect(route('tags.index'))->with('success', 'tag "'.$deleted_name.'" Deleted Successfully');
    }
}
