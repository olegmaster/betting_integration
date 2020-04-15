<?php

namespace App;

use App\service\OsminogBot;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserKey extends Model
{
    const weekSecondsCount = 604800;
    const maxFreezeUserCount = 1;
    const priceOne = 1;
    const priceTwo = 2;
    const priceThree = 3;

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function getKeyValidityTimeAttribute()
    {
        $to = Carbon::createFromTimestamp($this->end_date);
        $from = Carbon::createFromTimestamp(time());
        $diff = $to->diff($from);
        if (($this->end_date - time()) < 0) {
            if ($this->status != 0) {
                $this->status = 0;
                $this->save();
            }

            return "просрочен";
        }
        $hour = ($diff->h) < 10 ? "0" . $diff->h : $diff->h;
        $minute = ($diff->i) < 10 ? "0" . $diff->i : $diff->i;
        $month = $diff->m > 0 ? $diff->m . " мес. " : "";
        return $month . $diff->d . " дн., " . $hour . ":" . $minute;
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
        return $query->where('is_frozen', 1);
    }

    public static function generateKeys($userId, $keysCount)
    {
        if($keysCount == 0)
            return;

        $bot = new OsminogBot();
        for ($i = 0; $i < $keysCount; $i++) {
            $userKey = new UserKey();
            $userKey->user_id = $userId;
            $userKey->login = Str::random(9);
            $userKey->password = Str::random(32);
            $userKey->status = 1;
            $userKey->end_date = time() + self::weekSecondsCount;
            $userKey->save();
            $bot->addKey($userKey->login, $userKey->password);
        }
    }

    public static function freezeA(int $keyId)
    {
        $key = UserKey::find($keyId);
        $key->freeze_time = time();
        $key->is_frozen = 1;
        $key->save();
        $bot = new OsminogBot();
        $bot->updateKey($key->login, $key->password, 2);
    }

    public static function freeze(int $keyId)
    {
        $key = UserKey::find($keyId);
        if ($key->freeze_times < self::maxFreezeUserCount) {
            $key->freeze_times = $key->freeze_times + 1;
            $key->freeze_time = time();
            $key->is_frozen = 1;
            $key->save();
            $bot = new OsminogBot();
            $bot->updateKey($key->login, $key->password, 2);
        }
    }

    public static function unFreezeA(int $keyId)
    {
        self::unFreeze($keyId);
    }

    public static function unFreeze(int $keyId)
    {
        $key = UserKey::find($keyId);
        $timeDeltaSec = time() - $key->freeze_time;
        $bot = new OsminogBot();
        $bot->updateKey($key->login, $key->password, 3);
        $bot->updateKey($key->login, $key->password, 5, ceil($timeDeltaSec / 60));



        $key->end_date = $timeDeltaSec + $key->end_date;
        $key->is_frozen = 0;
        $key->save();
    }

    public static function activateKey(int $keyId)
    {
        $key = UserKey::find($keyId);
        $key->status = 1;
        $key->save();
        $bot = new OsminogBot();
        $bot->updateKey($key->login, $key->password, 1);
    }

    public static function deactivateKey(int $keyId)
    {
        $key = UserKey::find($keyId);
        $key->status = 0;
        $key->save();
        $bot = new OsminogBot();
        $bot->updateKey($key->login, $key->password, 0);
    }

    public static function deleteKey($keyId)
    {
        $key = UserKey::find($keyId);
        $bot = new OsminogBot();
        $bot->updateKey($key->login, $key->password, 4);
        UserKey::destroy($keyId);
    }

    public static function longKey(int $keyId)
    {
        $key = UserKey::find($keyId);
        $key->status = 1;
        $key->freeze_time = 0;

        $endDate = $key->end_date;
        if ($endDate < time()) {
            $endDate = time();
        }

        $key->end_date = $endDate + self::weekSecondsCount;

        if (!$key->save()) {
            $bot = new OsminogBot();
            $bot->updateKey($key->login, $key->password, 5, ceil(self::weekSecondsCount / 60));
        }

    }

}
