<?php

namespace App;

use App\Scopes\ClientScope;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;


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

    /**
     * get top users by money spend
     * @param $count
     * @return $topUsers
     */
    public static function topUsers($count)
    {
        $topUsers = DB::table('users')
            ->leftJoin('user_transactions', 'users.id', '=', 'user_transactions.user_id')
            ->select(DB::raw('users.name as name, users.surname as surname, users.avatar as avatar, users.email, users.phone,  sum(user_transactions.sum) as tsum'))
            ->groupBy('users.id')
            ->orderBy('tsum', 'desc')
            ->limit($count)
            ->get();
        return $topUsers;
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

    public function settings()
    {
        return $this->hasOne('App\Setting');
    }

    public function scopeClient($query)
    {
        return $query->where('id', '<>', 1);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ClientScope);
    }

}
