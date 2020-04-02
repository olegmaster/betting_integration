<?php

namespace App\Http\Controllers;

use App\Scopes\PaidTransactionScope;
use App\UserTransaction;
use Illuminate\Http\Request;


class PaymentController extends Controller
{

    public function confirmPayment(Request $request)
    {
        $data = $request->json()->all();
        //print_r($data['bill']);
        if (isset($data['bill']['status']) && $data['bill']['status']['value'] == "PAID" && isset($data['bill']['billId'])) {

            $billId = $data['bill']['billId'];
            echo $billId;
            $transaction = UserTransaction::withoutGlobalScope(PaidTransactionScope::class)
                ->where('bill_id', $billId)
                ->where('status', 0)
                ->first();
            // print_r($transaction);
            if ($transaction) {
                $transaction->status = 1;
                $transaction->save();
                var_dump($transaction->save());
                $keysCount = $transaction->keys_count;
            }
        }

    }
}
