<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = new Category;
        $category->name = $request->input('name');

        $category->save();

        return redirect(route('categories.index'))->with('success', 'Category '.$category->name.' Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        return redirect(route('categories.show'), compact($category));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.create')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCategoryRequest $request, $id)
    {
        //find category else show 404
        $category = Category::findOrFail($id);
        //save old and new name in a variable for later use
        $old_name = $category->name;
        $new_name = $request->input('name');
        //set name field to input value
        $category->name = $request->input('name');
        //save category in the database
        $category->save();
        //redirect to index with a flash message
        return redirect(route('categories.index'))->with('success', 'Category '.$old_name.' has been updated to '.$new_name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $deleted_name = $category->name;
        if($category->posts->count() > 0 ){
            session()->flash('error', 'Category "'.$deleted_name.'" belongs to post(s), can\'t be deleted');

            return redirect()->back();
        }
        $category->delete();

        return redirect(route('categories.index'))->with('success', 'Category "'.$deleted_name.'" Deleted Successfully');
    }
}
