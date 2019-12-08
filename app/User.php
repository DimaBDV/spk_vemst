<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'fathers_name', 'unit', 'email', 'password', 'group'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Переопределение метода для отправки E-mail уведомления о подтверждении пароля
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new Notifications\CustomVerifyEmailNotification);
    }

    public function isAdmin(){
        return $this->group == 'A';
    }

    public function isActive(){
        return $this->group != 'B';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offer(){
        return $this->hasMany(Offer::class);
    }
}
