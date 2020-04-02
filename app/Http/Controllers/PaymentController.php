<?php

namespace App\Http\Controllers;

use App\Scopes\PaidTransactionScope;
use App\UserKey;
use App\UserTransaction;
use Illuminate\Http\Request;


class PaymentController extends Controller
{

    public function confirmPayment(Request $request)
    {
        $data = $request->json()->all();

        if (isset($data['bill']['status']) && $data['bill']['status']['value'] == "PAID" && isset($data['bill']['billId'])) {

            $billId = $data['bill']['billId'];

            $transaction = UserTransaction::withoutGlobalScope(PaidTransactionScope::class)
                ->where('bill_id', $billId)
                ->where('status', 0)
                ->first();

            if ($transaction) {
                $transaction->status = 1;
                if ($transaction->save()) {
                    UserKey::generateKeys($transaction->user_id, $transaction->keys_count);
                }
            }
        }
    }
}
