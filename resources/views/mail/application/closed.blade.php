<div>
    <h2>
        {{ $application->userClosed->is_manager ? 'Менеджер' : 'Клиент' }} {{ $application->userClosed->name }} закрыл заявку
    </h2>

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
