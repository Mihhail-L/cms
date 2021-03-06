<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('posts/show/{postid}', 'WelcomeController@show')->name('posts.guest.show');

Route::get('users/info/{userid}', 'UsersController@show')->name('user.show.info');

Route::get('category/{catid}', 'WelcomeController@categoryfilter')->name('category.filter.index');

Route::get('tag/{tagid}', 'WelcomeController@tagFilter')->name('tag.filter.index');

Auth::routes();


Route::middleware(['auth'])->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('categories', 'CategoriesController');

    Route::resource('posts', 'PostsController');

    Route::resource('tags', 'TagsController');

    Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts.index');

    Route::get('restore-post/{post}', 'PostsController@restore')->name('restore-posts');
    
    Route::get('users/profile', 'UsersController@edit')->name('users.edit-profile');

    Route::put('users/profile/update', 'UsersController@update')->name('users.update-profile');
});

Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('users', 'UsersController@index')->name('users.index');
    Route::put('users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
    Route::delete('users/{user}/delete', 'UsersController@destroy')->name('users.delete');
});