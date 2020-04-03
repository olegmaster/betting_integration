<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserKey extends Model
{
    const weekSecondsCount = 604800;
    const maxFreezeUserCount = 3;
    const priceOne = 2600;
    const priceTwo = 2300;
    const priceThree = 2000;

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function getKeyValidityTimeAttribute()
    {
        $to = Carbon::createFromTimestamp($this->end_date);
        $from = Carbon::createFromTimestamp(time());
        $diff = $to->diff($from);
        $hour = ($diff->h) < 10 ? "0" . $diff->h : $diff->h;
        $minute = ($diff->i) < 10 ? "0" . $diff->i : $diff->i;
        return $diff->d . " дн., " . $hour . ":" . $minute;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }

    public function scopeFrozen($query)
    {
        return $query->where('is_frozen', 1 );
    }

    public static function generateKeys($userId, $keysCount)
    {
        for ($i = 0; $i < $keysCount; $i++) {
            $userKey = new UserKey();
            $userKey->user_id = $userId;
            $userKey->login = Str::random(9);
            $userKey->password = Str::random(32);
            $userKey->status = 1;
            $userKey->end_date = time() + self::weekSecondsCount;
            $userKey->save();
        }
    }

    public static function freezeA(int $keyId)
    {
        $key = UserKey::find($keyId);
        $key->freeze_time = time();
        $key->is_frozen = 1;
        $key->save();
    }

    public static function freeze(int $keyId)
    {
        $key = UserKey::find($keyId);
        if($key->freeze_times < self::maxFreezeUserCount){
            $key->freeze_times = $key->freeze_times + 1;
            $key->freeze_time = time();
            $key->is_frozen = 1;
            $key->save();
        }
    }

    public static function unFreezeA(int $keyId)
    {
        $key = UserKey::find($keyId);
        $key->end_date = (time()-$key->freeze_time) + $key->end_date;
        $key->is_frozen = 0;
        $key->save();
    }

    public static function unFreeze(int $keyId)
    {
        $key = UserKey::find($keyId);
        $key->end_date = (time()-$key->freeze_time) + $key->end_date;
        $key->is_frozen = 0;
        $key->save();
    }

    public static function activateKey(int $keyId)
    {
        $key = UserKey::find($keyId);
        $key->status = 1;
        $key->save();
    }

    public static function deactivateKey(int $keyId)
    {
        $key = UserKey::find($keyId);
        $key->status = 0;
        $key->save();
    }

    public static function longKey(int $keyId)
    {
        $key = UserKey::find($keyId);
        $key->end_date = $key->end_date + self::weekSecondsCount;
        $key->save();
    }

}
