@extends('layouts.app')

@section('content')

    <div class="page-wrap d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <span class="display-1 d-block">403</span>
                    <div class="mb-4 lead">Доступ к данному ресурсу запрещен</div>
                    <a href="{{ url('/') }}" class="btn btn-link">На главную</a>

                    @if(auth()->check())
                        <div class="alert alert-danger mt-5" role="alert">
                            Вас забанил админ. <br>Причина: {{ auth()->user()->isBannedReason() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
