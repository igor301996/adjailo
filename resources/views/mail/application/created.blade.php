<div>
    <h2>Пользователь {{ $user->name }} создал заявку</h2>

    <div>
        <h3>Контактые данные пользователя:</h3>
        <ul>
            <li>
                <b>Имя: </b>{{ $user->name }}
            </li>
            <li>
                <b>Email: </b>{{ $user->email }}
            </li>
        </ul>
    </div>

    <div>
        <h3>Данные о заявке:</h3>
        <ul>
            <li>
                <b>Тема: </b> {{ $application->subject }}
            </li>
            <li>
                <b>Сообщение: </b> {{ $application->message }}
            </li>
        </ul>
    </div>
</div>
