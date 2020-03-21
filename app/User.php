<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function keys()
    {
        return $this->hasMany('App\UserKey');
    }


    public function transactions()
    {
        return $this->hasMany('App\UserTransaction');
    }


    public function getSumAttribute()
    {
        $sum = 0;
        $transactions = $this->transactions;

        if (!empty($transactions)) {
            foreach ($transactions as $transaction) {
                $sum += $transaction->sum;
            }
        }
        return $sum;
    }

    public function getKeysCountAttribute()
    {
        return is_countable($this->keys) ? count($this->keys) : 0;
    }

    public function getFullNameAttribute()
    {
        return $this->name . " " . $this->surname;
    }
}
