@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>Добавить пост</h2>

        @if(session()->has('status'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('status') }}
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data" class="pt-4">
            @csrf
            @include('pages.user.post.form', ['type' => 'create'])
        </form>
    </div>

@endsection
