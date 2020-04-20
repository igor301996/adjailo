@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('application.create') }}"
                   class="btn btn-outline-primary {{ $isSendApplication ? 'disabled' : '' }}">
                    @if (!$isSendApplication)
                        Новая заявка
                    @else
                        Заявка уже отправлена
                    @endif
                </a>

                <table class="table mt-2">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Тема</th>
                        <th scope="col">Логин</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($applications as $application)
                        <tr>
                            <th scope="row">{{ $application->id }}</th>
                            <td>{{ $application->subject }}</td>
                            <td>{{ $application->user->name }}</td>
                            <td>{{ $application->getNameStatus() }}</td>
                            <td>
                                <a href="{{ route('application.show', $application) }}"
                                   class="btn btn-outline-primary btn-sm">Просмотр</a>
                                <a href="{{ route('application.action', $application) }}"
                                   class="btn btn-outline-danger btn-sm {{ $application->status === \App\Application::CLOSED ? 'disabled' : '' }}">Закрыть</a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>{{ $applications->links() }}</div>
            </div>
        </div>
    </div>
@endsection
