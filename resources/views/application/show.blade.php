@extends('layouts.app')
@section('content')
    <div class="container">
        @if(auth()->user()->is_manager)
            <a href="{{ route('manager.application.index') }}" class="btn btn-outline-primary btn-sm">Назад</a>
        @else
            <a href="{{ route('application.index') }}" class="btn btn-outline-primary btn-sm">Назад</a>
        @endif

        <div class="card mt-2">
            <div class="card-header">
                @if($application->status !== \App\Application::CLOSED)
                    <center>
                        <a href="{{ route('message.create', $application) }}" class="btn btn-outline-primary">
                            Новое сообщение
                        </a>
                    </center>
                @endif

                Номер заявки : {{ $application->id }}
            </div>
            <div class="card-body">
                <ul>
                    <li>
                        Тема : {{ $application->subject}}
                    </li>
                    <li>
                        Сообщение : {{ $application->message }}
                    </li>
                    <li>
                        Файл : <img src="{{\Illuminate\Support\Facades\Storage::url($application->file) }}">
                    </li>
                </ul>

                @foreach($messages as $message)
                    <div class="card-header">
                        <div class="card-body">
                            <ul>
                                <li>
                                    Логин : {{ $message->user->name }}
                                </li>
                                <li>
                                    Сообщение : {{ $message->message }}
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="mt-2">{{ $messages->links() }}</div>
    </div>
@endsection
