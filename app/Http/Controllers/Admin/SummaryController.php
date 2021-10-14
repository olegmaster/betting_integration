<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserKey;
use App\Models\UserTransaction;
use App\Services\SummaryService;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    private $summaryService;

    public function __construct(SummaryService $summaryService)
    {
        $this->summaryService = $summaryService;
    }

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
        $dateTo = ($request['to_date'] ?? date('Y-m-d'));
        $reset = '';

        $sumInDays = $this->summaryService->calculateSumInDays($dateFrom, $dateTo);

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

}
