@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Свежие новости</h2>
            @auth <a href="{{ route('posts.create') }}" class="btn btn-primary">Добавить пост</a> @endauth
        </div>

        <form action="{{ route('pages.index') }}" class="card card-sm mt-5" method="get">
            <div class="card-body row no-gutters align-items-center">
                <div class="col">
                    <input class="form-control form-control-borderless" type="search" name="q" placeholder="Введите название или ключевое слово" value="{{ request()->get('q') }}">
                </div>
                <div class="col-auto">
                    <button class="btn btn-success ml-2" type="submit">Поиск</button>
                </div>
            </div>
        </form>

        <div class="posts latest mt-5">
            <div class="row">
                @forelse($posts as $post)
                    <div class="col-3">
                        <div class="post card">
                            <a href="{{ $post->urlShow() }}"><img src="{{ url('images/'. $post->image) }}" class="card-img-top" alt="{{ $post->title }}"></a>
                            <div class="card-body">
                                <h5 class="card-title"><a href="{{ $post->urlShow() }}">{{ $post->title }}</a></h5>
                                <p class="card-text">{{ $post->contentShorten(100) }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12"><p>Нет новостей</p></div>
                @endforelse
            </div>

            <div class="pagination">
                {{ $posts->appends(['q' => request()->get('q')])->links() }}
            </div>
        </div>

    </div>

@endsection
