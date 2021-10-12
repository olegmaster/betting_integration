<?php

namespace App\Http\Controllers;

use App\Models\Help;
use App\Services\OsminogBot;
use App\Setting;
use App\TelegramNotification;
use App\Models\UserKey;
use App\Models\UserTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Qiwi\Api\BillPayments;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function keys()
    {

        if(Auth::user()->id == 1){
            return redirect('/admin');
        }
        $keys = Auth::user()->keys()->paginate(10);

        $keysActiveCount = Auth::user()->keys()->active()->count();
        $keysTotalCount = Auth::user()->keys()->count();
        $keysFrozenCount = Auth::user()->keys()->frozen()->count();

        return view('user.keys', [
            'keys' => $keys,
            'totalKeys' => $keysTotalCount,
            'activeKeys' => $keysActiveCount,
            'frozenKeys' => $keysFrozenCount
        ]);
    }

    public function buyKey()
    {
        return view('user.buy_key');
    }

    public function buyKeyHandle(Request $request)
    {
        $validatedData = $request->validate([
            'count' => 'required|min:1',
        ]);

        if ($request['count'] < 10) {
            $keyPrice = UserKey::priceOne;
        } else if ($request['count'] > 9 && $request['count'] < 30) {
            $keyPrice = UserKey::priceTwo;
        } else {
            $keyPrice = UserKey::priceThree;
        }

        $totalSum = $keyPrice * $request['count'];

        $billId = rand(100000, 999999) . rand(100000, 999999);

        $transaction = new UserTransaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->keys_count = $request['count'];
        $transaction->sum = $totalSum;
        $transaction->bill_id = $billId;


        if ($transaction->save()) {
            $billPayments = new BillPayments(config('app.qiwi_secret_key'));
            $publicKey = config('app.qiwi_public_key');
            $params = [
                'publicKey' => $publicKey,
                'amount' => $totalSum,
                'billId' => $billId,
                'successUrl' => url('/cabinet/keys'),
            ];


            $link = $billPayments->createPaymentForm($params);

            return redirect($link);
        }

        return redirect()->back();
    }


    public function downloadBot()
    {
        return view('user.download_bot');
    }

    public function setup()
    {
        $setting = Setting::where('user_id', Auth::user()->id)->first();
        $telegram_id = empty($setting) ? '' : $setting->telegram_id;

        $h24 = TelegramNotification::checkHours($setting->id ?? null, 24);
        $h12 = TelegramNotification::checkHours($setting->id ?? null, 12);
        $h6 = TelegramNotification::checkHours($setting->id ?? null, 6);
        $h3 = TelegramNotification::checkHours($setting->id ?? null, 3);
        $h1 = TelegramNotification::checkHours($setting->id ?? null, 1);


        return view('user.setup', [
            'telegram_id' => $telegram_id,
            'h24' => $h24,
            'h12' => $h12,
            'h6' => $h6,
            'h3' => $h3,
            'h1' => $h1,
        ]);
    }

    public function setupUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'telegram-id' => 'min:5',
        ]);

        $setting = Setting::where('user_id', Auth::user()->id)
            ->first();

        if (!$setting) {
            $setting = Setting::firstOrCreate([
                'telegram_id' => $request['telegram-id'],
                'user_id' => Auth::user()->id
            ]);
        } else {
            $setting->telegram_id = $request['telegram-id'];
            $setting->save();
        }


        TelegramNotification::updateHours($setting->id, $request['h24'], 24);
        TelegramNotification::updateHours($setting->id, $request['h12'], 12);
        TelegramNotification::updateHours($setting->id, $request['h6'], 6);
        TelegramNotification::updateHours($setting->id, $request['h3'], 3);
        TelegramNotification::updateHours($setting->id, $request['h1'], 1);

        Session::flash('telegram_id_saved', 'Изменения сохранены');
        return redirect('/cabinet/setup');
    }

    public function help()
    {
        $helpModel = Help::where('id', 1)->first();

        return view('user.help', [
            'helpText' => html_entity_decode($helpModel->text ?? "")
        ]);
    }

    public function profile()
    {
        $userData['name'] = Auth::user()->name;
        $userData['surname'] = Auth::user()->surname;
        $userData['email'] = Auth::user()->email;
        $userData['phone'] = Auth::user()->phone;
        $userData['telegram'] = Auth::user()->telegram;

        return view('user.profile', [
            'userData' => $userData
        ]);
    }

    public function profileUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'min:3|required',
            'surname' => 'min:3|required',
            'email' => 'email|min:6|required',
            'phone' => 'required',
            'telegram' => 'required'
        ]);

        Auth::user()->name = $request['name'];
        Auth::user()->surname = $request['surname'];
        Auth::user()->email = $request['email'];
        Auth::user()->phone = $request['phone'];
        Auth::user()->telegram = $request['telegram'];

        if (Auth::user()->save()) {
            Session::flash('user_profile_saved', 'Изменения сохранены');
        }

        return redirect('/cabinet/profile');
    }

    public function updateUserAvatar(Request $request)
    {
        $validatedData = $request->validate([
            'user-avatar' => 'image|min:1'
        ]);

        $cover = $request->file('user-avatar');

        if (empty($cover)) {
            return redirect('/cabinet/profile');
        }

        $extension = $cover->getClientOriginalExtension();
        $avatarName = Str::random(25) . '.' . $extension;
        Storage::disk('public')->put($avatarName, File::get($cover));

        Auth::user()->avatar = $avatarName;

        if (Auth::user()->save()) {
            Session::flash('user_image_saved', 'Изменения сохранены');
        }

        return redirect('/cabinet/profile');
    }

    public function updatePassword(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|min:6',
            'repeat-password' => 'required|min:6|same:password',
        ]);

        Auth::user()->password = Hash::make($request['password']);
        if (Auth::user()->save()) {
            Session::flash('password_saved', 'Изменения сохранены');
        }

        return redirect('/cabinet/profile');
    }

    public function freezeKey(int $keyId)
    {
        UserKey::freeze($keyId);
        return redirect()->back();
    }

    public function unFreezeKey(int $keyId)
    {
        UserKey::unFreeze($keyId);
        return redirect()->back();
    }

    public function longKey(int $keyId)
    {
        $billId = rand(100000, 999999) . rand(100000, 999999);

        $transaction = new UserTransaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->keys_count = 0;
        $transaction->sum = UserKey::priceOne;
        $transaction->bill_id = $billId;
        $transaction->key_id = $keyId;

        $transaction->save();

        $billPayments = new BillPayments(config('app.qiwi_secret_key'));
        $publicKey = config('app.qiwi_public_key');
        $params = [
            'publicKey' => $publicKey,
            'amount' => UserKey::priceOne,
            'billId' => $billId,
            'successUrl' => url('/cabinet/keys'),
        ];

        $link = $billPayments->createPaymentForm($params);

        return redirect($link);

    }

    public function editKeyDescription(Request $request)
    {
        $key = UserKey::find($request['key_id']);
        $key->description = $request['description'] ?? '';
        $key->save();
        return redirect()->back();
    }
}
