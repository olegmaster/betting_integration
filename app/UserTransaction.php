<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    const daySecondsCount = 86400;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function getSumInPeriod($startInUnixTime, $endInUnixTime, $userId = null)
    {
        $sum = 0;
       // echo date('Y-m-d H:i:s', $startInUnixTime);
        $transactions = static::where('created_at', '>=', date('Y-m-d H:i:s', $startInUnixTime))
            ->where('created_at', '<=', date('Y-m-d H:i:s', $endInUnixTime));

        if ($userId) {
            $transactions = $transactions->where('user_id', $userId);
        }

        $transactions = $transactions->get();

        if (is_iterable($transactions)) {
            foreach ($transactions as $transaction) {
                $sum += $transaction->sum;
            }
        }
        return $sum;
    }

    public static function firstDayStart($created_at)
    {
        $startTime = strtotime($created_at);
        $dayFomat = date('Y-m-d', $startTime);
        $dayStartUnixTime = strtotime($dayFomat . ' 00:00:00');
        return $dayStartUnixTime;
    }
}
