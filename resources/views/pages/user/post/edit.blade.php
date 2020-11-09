@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>Изменить пост #{{ $post->id }}</h2>

        @if(session()->has('status'))
            <div class="alert alert-success mb-0" role="alert">
                {{ session()->get('status') }}
            </div>
        @endif

        <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data" class="pt-4">
            @csrf
            @method('put')
            @include('pages.user.post.form', ['type' => 'edit'])
        </form>
    </div>

@endsection
