<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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
        'subscription_expires' => 'date:Y-m-d'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function isExpired()
    {
        return $this->subscription_expires->isBefore(today());
    }
    public function isSubscribed()
    {
        return !is_null($this->subscription_id) and !$this->isExpired();
    }
}
