<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function getSumInPeriod($startInUnixTime, $endInUnixTime)
    {
        $sum = 0;
        $transactions = static::where('created_at', '>=', date('Y-m-d H:i:s', $startInUnixTime))
            ->where('created_at', '<=', date('Y-m-d H:i:s', $endInUnixTime))->get();
        if(is_iterable($transactions)){
            foreach ($transactions as $transaction){
                $sum += $transaction->sum;
            }
        }
        return $sum;
    }
}
