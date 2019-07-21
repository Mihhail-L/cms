<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;

class UsersController extends Controller
{
    public function show($user_id) {
        //find or fail user, on fail laravel gives out 404
        $user = User::findOrFail($user_id);
        //get authenticated users id
        $id = Auth::id();
        //find all user posts
        $posts = Post::where('user_id', $user_id)->latest()->paginate(4);
        //return a view with user object
        return view('users.show')->with('user', $user)->with('posts', $posts)->with('authid', $id);
    }
    
    public function index() {
        //return a view for administrators with all users
        $users = User::paginate(10);
        return view('users.index')->with('users', $users);
    }

    public function edit() {
        //return edit view for authenticated user
        return view('users.edit')->with('user', auth()->user());
    }

    public function update(UpdateProfileRequest $request) {
        //find currently authenticated user
        $user = auth()->user();
        //update user information
        $user->update([
            'name' => $request->name,
            'about' => $request->about
        ]);
        //flash success message on success
        session()->flash('success', 'User "'.$user->email.'" has been updated');
        //redirect back to where user came from
        return redirect()->back();
    }

    public function makeAdmin(User $user) {

        //set user's role to admin
        $user->role = 'admin'; 

        //save user info in users table
        $user->save();
        
        //flash success message on success
        session()->flash('success', 'User "'.$user->email.'" has been made admin!');
        //redirect user back to where user came from
        return redirect()->back();
    }

    public function destroy(User $user) {

        $user_deleted_email = $user->email;

        $posts = Post::where('user_id', $user->id)->get();

        $post_count = $posts->count();

        foreach($posts as $post) {
            $post->forceDelete($post->id);
        }

        $user->destroy($user->id);

        session()->flash('success', 'User "'.$user_deleted_email.'" has been deleted! and a total of '.$post_count.' have been deleted!');

        return redirect()->back();
    }
}
