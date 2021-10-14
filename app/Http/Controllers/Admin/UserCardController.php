<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserKey;
use App\Models\UserTransaction;
use Illuminate\Http\Request;

class UserCardController extends Controller
{
    public function userCard(Request $request)
    {

        if ($request['reset'] != '0') {
            unset($request['from_date']);
            unset($request['to_date']);
        }

        $id = $request['id'];
        $user = User::find($id);

        $keys = $user->keys()->paginate(10);

        $dateFrom = $request['from_date'] ?? date('Y') . '-01-01';
        $dateTo = $request['to_date'] ?? date('Y-m-d');


        $transactions = UserTransaction::where(['user_id' => $id]);

        if ($dateFrom) {
            $transactions = $transactions->where('created_at', '>=', $dateFrom . " 00:00:00");
        }

        if ($dateTo) {
            $transactions = $transactions->where('created_at', '<=', $dateTo . " 23:59:59");
        }

        $sumInPeriod = number_format(UserTransaction::getSumInPeriod(strtotime($dateFrom), strtotime($dateTo), $user['id']), 0," ", " ");
        $keysCount = UserKey::getKeysCountInPeriod(strtotime($dateFrom), strtotime($dateTo), $user['id']);

        $transactions = $transactions->paginate(10);
        return view('admin.user_card',
            [
                'user' => $user,
                'keys' => $keys,
                'transactions' => $transactions,
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'sumInPeriod' => $sumInPeriod,
                'keysCount' => $keysCount
            ]
        );
    }
}
