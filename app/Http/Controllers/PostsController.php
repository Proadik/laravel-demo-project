<?php

namespace App\Http\Controllers;

use App\Helpers\FileUploader;
use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    public function show(Post $post)
    {
        $comments = $post->comments()->paginate(10);
        return view('pages.user.post.show', compact('post', 'comments'));
    }

    public function create()
    {
        $this->authorize('userIsNotBanned');
        return view('pages.user.post.create');
    }

    public function store(CreatePostRequest $request)
    {
        $data = $request->validated();
        $data['image'] = FileUploader::uploadImage($data['image'], 'posts-images');
        $post = auth()->user()->posts()->create($data);
        return redirect()->route('posts.edit', $post->id)->with('status', 'Пост успешно создан');
    }

    public function edit(Post $post)
    {
        $this->authorize('edit', $post);
        return view('pages.user.post.edit', compact('post'));
    }

    public function update(CreatePostRequest $request, Post $post)
    {
        $data = $request->validated();

        if($request->has('image')) {
            FileUploader::deleteImage($post->image);
            $data['image'] = FileUploader::uploadImage($data['image'], 'posts-images');
        }

        $post->update($data);
        return back()->with('status', 'Пост успешно обновлен');
    }

    public function destroy(Post $post)
    {
        FileUploader::deleteImage($post->image);
        $post->delete();
        return redirect('/');
    }
}
