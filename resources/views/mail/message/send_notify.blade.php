<div>
    <h2>
        {{ $userFrom->is_manager ? 'Менджер' : 'Клиент' }} оставил сообщение в заявке #{{ $application->id }}
    </h2>
    <div>
        <h3>Сообщение:</h3>
        {{ $applicationMessage->message }}
    </div>
</div>
