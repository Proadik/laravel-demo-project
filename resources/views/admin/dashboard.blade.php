@extends('layouts.app')

@section('content')

    <div class="container">
        <h2 class="mb-5">Админ панель</h2>

        <table class="table table-striped table-condensed">
            <thead>
            <tr>
                <th>Имя</th>
                <th>E-mail</th>
                <th>Дата регистрации</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <span style="pointer-events: none;" class="btn btn-{{ $user->getStatus()['status'] }} btn-sm">{{ $user->getStatus()['content'] }}</span>
                        </td>
                        <td>
                            @if($user->isBanned())
                                <a href="{{ route('users.blacklist', $user->id) }}" class="btn btn-success btn-sm">Разбанить</a>
                            @else
                                <a href="{{ route('users.blacklist', $user->id) }}" class="btn btn-danger btn-sm">Забанить</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Нет данных</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

@endsection
