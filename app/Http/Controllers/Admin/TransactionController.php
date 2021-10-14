<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transactions(Request $request)
    {

        if ($request['reset'] === '1') {
            unset($request['from_date']);
            unset($request['to_date']);
            $request['page'] = 1;
        }

        $dateFrom = $request['from_date'] ?? date('Y-m-d');
        $dateTo = $request['to_date'] ?? date('Y-m-d');

        $transactions = UserTransaction::whereDate('created_at', '>=', date('Y-m-d', strtotime($dateFrom)) . ' 00:00:00')
            ->whereDate('created_at', '<=', date('Y-m-d', strtotime($dateTo)) . ' 23:59:00')
            ->paginate(10);

        $transactions->appends([
            'from_date' => str_replace('%2F', '/', $dateFrom),
            'to_date' => str_replace('%2F', '/', $dateTo)
        ]);

        $totalTransactions = UserTransaction::all()->count();

        $sumInPeriod = UserTransaction::calculateSumPeriod($dateFrom . ' 00:00:00', $dateTo . ' 23:59:59');

        return view('admin.transactions', [
            'transactions' => $transactions,
            'totalTransactions' => $totalTransactions,
            'sumInPeriod' => $sumInPeriod,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo
        ]);
    }
}
