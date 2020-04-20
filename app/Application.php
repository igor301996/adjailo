<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Application
 * @property string $subject
 * @property string $message
 * @property boolean $viewed
 * @property string $file
 * @property integer $status
 * @property User $user
 */
class Application extends Model
{
    /**
     * Statuses
     */
    public const WAITING = 0;
    public const OPEN = 1;
    public const CLOSED = 2;

    public const STATUSES = [
        0 => 'В ожидании',
        1 => 'Выполняется',
        2 => 'Закрыта'
    ];

    protected $fillable = [
        'subject',
        'message',
        'viewed',
        'status',
        'file',
        'user_id',
        'manager_id',
        'closed_user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function manager()
    {
        return $this->hasOne(User::class, 'id', 'manager_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userClosed()
    {
        return $this->hasOne(User::class, 'id', 'closed_user_id');
    }

    /**
     * @return string|null
     */
    public function getNameStatus(): ?string
    {
        return self::STATUSES[$this->status] ?? null;
    }
}
