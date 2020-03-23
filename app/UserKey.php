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


    public function getKeyValidityTimeAttribute(){
        $to = Carbon::createFromTimestamp($this->end_date);
        $from = Carbon::createFromTimestamp(time());
        $diff = $to->diff($from);
        return $diff->d . " дн., " . $diff->h . ":" . $diff->i;
    }
}
