<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserKey;
use App\Models\UserTransaction;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function summary(Request $request)
    {
        $totalUsers = User::client()->count();
        $totalKeys = UserKey::all()->count();
        $topUsers = User::topUsers(5);

        if ($request['reset'] != '0') {
            unset($request['from_date']);
            unset($request['to_date']);
        }

        // calculate $sumInPeriod
        $dateFrom = ($request['from_date'] ?? date('Y-m-d', time() - UserKey::weekSecondsCount * 2));
        $dateTo = ($request['to_date'] ?? date('Y-m-d')) ;
        $reset = '';

        $sumInDays = $this->calculateSumInDays($dateFrom, $dateTo);

        $sumInPeriod = UserTransaction::calculateSumPeriod($dateFrom . ' 00:00:00', $dateTo . ' 23:59:59');
        $totalSum = UserTransaction::getSumInPeriod(0, 1945346334);

        return view('admin.summary',
            [
                'topUsers' => $topUsers,
                'totalUsers' => $totalUsers,
                'totalKeys' => $totalKeys,
                'sumInPeriod' => $sumInPeriod,
                'totalSum' => $totalSum,
                'sumInDays' => $sumInDays,
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'reset' => $reset,
            ]
        );
    }

    private function calculateSumInDays($from, $to)
    {
        $result = [];
        $firstTransaction = UserTransaction::find(1);
        if (!$firstTransaction) {
            return [];
        }
        if ($from != '') {
            $dateFromUnixTime = strtotime($from . ' 00:00:00');
        } else {
            $dateFromUnixTime = UserTransaction::firstDayStart($firstTransaction->created_at);
        }

        if ($to != '') {
            $dateToUnixTime = strtotime($to . " 23:59:59");
        } else {
            $dateToUnixTime = time();
        }

        for ($i = $dateFromUnixTime; $i < $dateToUnixTime; $i += UserTransaction::daySecondsCount) {
            $sum = UserTransaction::calculateSumPeriod(date('Y-m-d H:s:i', $i), date('Y-m-d H:s:i', $i + UserTransaction::daySecondsCount ));
            $day = date('d-m', $i);
            $result[$day] = $sum;
        }

        return $result;


    }
}
