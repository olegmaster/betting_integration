<?php

namespace App\Http\Controllers;

use App\Scopes\PaidTransactionScope;
use App\Models\UserKey;
use App\Models\UserTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PaymentController extends Controller
{

    public function confirmPayment(Request $request)
    {
        $data = $request->json()->all();

        Log::emergency(json_encode($data));

        if (isset($data['bill']['status']) && $data['bill']['status']['value'] == "PAID" && isset($data['bill']['billId'])) {

            $billId = $data['bill']['billId'];

            $transaction = UserTransaction::withoutGlobalScope(PaidTransactionScope::class)
                ->where('bill_id', $billId)
                ->where('status', 0)
                ->first();

            if (!$transaction) {
                return "error";
            }

            $transaction->status = 1;
            $transaction->save();

            UserKey::generateKeys($transaction->user_id, $transaction->keys_count);

            if (!empty($transaction->key_id)) {
                UserKey::longKey($transaction->key_id);
            }

        }

    }
}
