@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="post mt-3">
            <div class="row">
                <div class="col-8">
                    <h2 class="mb-4">{{ $post->title }}</h2>
                    <p class="mb-0">{!! nl2br($post->content) !!}</p>
                    <hr class="mt-3">
                </div>
                <div class="col-4 text-right">
                    <img src="{{ url('images/'. $post->image) }}" class="mw-100 rounded mb-4" alt="">
                    <p class="mb-0"><strong>Автор:</strong> {{ $post->user->name }}</p>
                    <p class="mb-0"><strong>Дата добавления:</strong> {{ $post->created_at->format('d.m.Y H:i') }}</p>

                    @if(auth()->check() && auth()->user()->isOwner($post))
                        <hr>
                        <div class="user-actions">
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Изменить</a>
                            <a href="#" onclick="event.preventDefault(); let ok = confirm('Вы уверены?'); if(ok) { document.getElementById('post-delete').submit(); }" class="btn btn-danger">Удалить</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" id="post-delete" method="post">@csrf @method('delete')</form>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="comments mt-3">
            <div class="row">
                <div class="col-8">
                    <h4 class="mb-3">Комментарии <span class="badge badge-secondary">{{ $comments->count() }}</span></h4>

                    <div class="post-comments">
                        @forelse($comments as $comment)
                            <div class="card comment mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                            <img src="https://ui-avatars.com/api/?size=128&name={{ $comment->user->name }}" alt="{{ $comment->user->name }}" class="img rounded img-fluid mb-2"/>
                                            <p class="text-secondary text-center mb-0 date"><small>{{ $comment->created_at->diffForHumans() }}</small></p>
                                        </div>
                                        <div class="col-10">
                                            <p><strong>{{ $comment->user->name }}</strong></p>
                                            <p>{!! nl2br($comment->content) !!}</p>
                                            @auth
                                            <p class="mb-0">
                                                <a class="disabled float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Ответить</a>
                                            </p>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Нет комментариев</p>
                        @endforelse

                        <div class="pagination">
                            {{ $comments->links() }}
                        </div>
                    </div>

                    @if(auth()->check() && auth()->user()->can('userIsNotBanned'))
                        <h4 class="mt-5 mb-3">Добавьте комментарий</h4>
                        <form action="{{ route('comments.store') }}" method="post" class="add-comment">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="form-group">
                                <textarea placeholder="Введите ваш комментарии" name="content" id="content" cols="30" rows="5" class="form-control"></textarea>
                                @error('content') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </form>
                    @elseif(auth()->check() && auth()->user()->isBanned())
                        <div class="alert alert-danger" role="alert">
                            Вас забанил админ. <br>Причина: {{ auth()->user()->isBannedReason() }}
                        </div>
                    @endif

                    @guest
                        <div class="alert alert-primary" role="alert">
                            <a href="{{ route('register') }}">Зарегистрируйтесь</a>, чтобы оставить комментарий
                        </div>
                    @endguest

                </div>
            </div>
        </div>

    </div>

@endsection
