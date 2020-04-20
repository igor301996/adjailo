@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <select class="form-control w-25" onchange="window.location = $(this).val()">
                    <option value="{{ route('manager.application.filter', ['viewed', 1]) }}">
                        Просмотренные
                    </option>
                    <option value="{{ route('manager.application.filter', ['viewed', 0]) }}">
                        Не просмотренные
                    </option>
                    <option value="{{ route('manager.application.filter', ['status', \App\Application::OPEN]) }}">
                        Открытые
                    </option>
                    <option value="{{ route('manager.application.filter', ['status', \App\Application::CLOSED]) }}">
                        Закрытые
                    </option>
                    <option value="{{ route('manager.application.filter', ['messages', 1]) }}">
                        С сообщениями
                    </option>
                    <option value="{{ route('manager.application.filter', ['messages', 0]) }}">
                        Без сообщений
                    </option>
                </select>

                <table class="table mt-2">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Тема</th>
                        <th scope="col">Логин</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Действия</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($applications as $application)
                        <tr>
                            <th scope="row">{{ $application->id }}</th>
                            <td>{{ $application->subject }}</td>
                            <td>{{ $application->user->name }}</td>
                            <td>{{ $application->getNameStatus() }}</td>
                            <td>
                                <a href="{{ route('manager.application.show', $application) }}"
                                   class="btn btn-outline-primary btn-sm">Просмотр</a>
                                @if(!$application->manager_id || auth()->user()->id === $application->manager_id)
                                    @if ($application->status === \App\Application::CLOSED || $application->status === \App\Application::WAITING)
                                        <a href="{{ route('manager.application.action', [$application, \App\Application::OPEN]) }}"
                                           class="btn btn-outline-success btn-sm">Открыть</a>
                                    @else
                                        <a href="{{ route('manager.application.action', [$application, \App\Application::CLOSED]) }}"
                                           class="btn btn-outline-danger btn-sm">Закрыть</a>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($application->viewed)
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-muted" colspan="5">
                                <h4>Список заявок пуст</h4>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div>{{ $applications->links() }}</div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const currentUrl = window.location.href;
            let options = document.querySelector('select').options;
            for (let option of options) {
                if (option.getAttribute('value') !== currentUrl) {
                    continue;
                }

                option.setAttribute('selected', true);
                break;
            }
        </script>
    @endpush
@endsection
