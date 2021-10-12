<?php

namespace App\Models;

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

    const ADMIN_ID = 15;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'surname', 'phone', 'account_status', 'password', 'telegram',
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
        return $this->hasMany('App\Models\UserKey');
    }


    public function transactions()
    {
        return $this->hasMany('App\Models\UserTransaction');
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

    public function getAvatarPngAttribute()
    {
        if ($this->avatar == 'default.jpg') {
            return 'default.png';
        }
    }

    public static function getCurrentDayStart()
    {
        $dC2 = date('Y-m-d') . ' 00:00:00';
        return $dC2;
    }

    public static function getCurrentDayEnd()
    {
        $dC1 = date('Y-m-d') . ' 23:59:00';
        return $dC1;
    }

    public static function getCurrentYearStart()
    {
        $dA1 = date('Y') . '-01-01 00:00:00';
        return $dA1;
    }

    public static function getTwoWeaksBegoreDateStart()
    {
        $tW = date('Y-m-d', time() - UserTransaction::daySecondsCount * 14) . ' 00:00:00';
        return $tW;
    }

}
