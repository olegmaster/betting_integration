<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserKey extends Model
{
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
        return $query->where('status', 2);
    }
}
