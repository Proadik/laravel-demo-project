<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', 'PagesController@index_page')->name('pages.index');
Route::resource('posts', 'PostsController');
Route::resource('comments', 'CommentsController');


Route::middleware('can:isAdmin')->prefix('admin')->group(function() {
    Route::get('/', 'Admin\AdminController@index_page')->name('admin.index');
    Route::get('users/{user}/blacklist', 'Admin\UsersController@ban_user')->name('users.blacklist');
    Route::resource('users', 'Admin\UsersController');
});
