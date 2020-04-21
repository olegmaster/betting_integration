<?php

namespace App\Http\Controllers;

use App\service\TelegramBot;
use App\service\TelegramNotificationSender;
use App\User;
use App\UserKey;
use App\Help;
use App\UserTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
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
        $dateFrom = $request['from_date'] ?? date('m/d/Y', time() - UserKey::weekSecondsCount * 2) . " 00:00:00";
        $dateTo = $request['to_date'] ?? date('m/d/Y') . " 23:59:59";
        $reset = '';

        $sumInDays = $this->calculateSumInDays($dateFrom, $dateTo);

        $sumInPeriod = $this->calculateSumPeriod($dateFrom, $dateTo);


        return view('admin.summary',
            [
                'topUsers' => $topUsers,
                'totalUsers' => $totalUsers,
                'totalKeys' => $totalKeys,
                'sumInPeriod' => $sumInPeriod,
                'sumInDays' => $sumInDays,
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'reset' => $reset,
            ]
        );
    }

    public function users()
    {
        $users = User::client()->paginate(10);
        $totalUsers = User::client()->count();
        return view('admin.users', [
            'users' => $users,
            'totalUsers' => $totalUsers
        ]);
    }

    public function keys()
    {
        $keys = UserKey::paginate(10);
        $totalKeys = UserKey::all()->count();
        return view('admin.keys', [
            'keys' => $keys,
            'totalKeys' => $totalKeys
        ]);
    }

    public function transactions(Request $request)
    {

        //var_dump($request['reset']);die;
        if ($request['reset'] === '1') {
            unset($request['from_date']);
            unset($request['to_date']);
            $request['page'] = 1;
        }

        $dateFrom = $request['from_date'] ?? date('m/d/Y');
        $dateTo = $request['to_date'] ?? date('m/d/Y');

       // var_dump($dateFrom);die;

        $transactions = UserTransaction::whereDate('created_at', '>=', date('Y-m-d', strtotime($dateFrom)) . ' 00:00:00')
            ->whereDate('created_at', '<=', date('Y-m-d', strtotime($dateTo)) . ' 23:59:00')
            ->paginate(10);


        //http://osminogbet.local/admin/transaction-history?from_date=04%2F01%2F2020&to_date=04%2F25%2F2020&page=2
        $transactions->appends([
            'from_date' => str_replace('%2F', '/', $dateFrom),
            'to_date' => str_replace('%2F', '/', $dateTo)
        ]);

        // $transactions = UserTransaction::paginate(10);
        $totalTransactions = UserTransaction::all()->count();
        // calculate $sumInPeriod

        $sumInPeriod = $this->calculateSumPeriod($dateFrom, $dateTo);

        return view('admin.transactions', [
            'transactions' => $transactions,
            'totalTransactions' => $totalTransactions,
            'sumInPeriod' => $sumInPeriod,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo
        ]);
    }

    public function bot()
    {
        return view('admin.bot');
    }

    public function botSave(Request $request)
    {
        $validatedData = $request->validate([
            'bot' => 'file|min:1'
        ]);

        $cover = $request->file('bot');

        if (empty($cover)) {
            return redirect('admin/bot-download');
        }

        $botName = 'bot.exe';
        Storage::disk('bot')->put($botName, File::get($cover));

        Session::flash('bot-saved', 'Изменения сохранены');

        return redirect('admin/bot-download');
    }

    public function help()
    {
        $helpModel = Help::where('id', 1)->first();
        return view('admin.help', [
            'helpText' => html_entity_decode($helpModel->text ?? "")
        ]);
    }

    public function helpStore(Request $request)
    {
        $request->validate([
            'help-text' => 'required',
        ]);

        $helpModel = Help::where('id', 1)->first();

        if (!$helpModel) {
            $helpModel = new Help();
        }

        $cleaned = rtrim(substr($request['help-text'], 1), '"');

        // for adding images
        $cleaned = str_replace('\"', '', $cleaned);

        // echo rtrim(substr($request['help-text'], 1), '"');die;

        $helpModel->text = htmlentities($cleaned);

        //echo trim($helpModel->text);die;
//echo $helpModel->text;


        //echo html_entity_decode($helpModel->text);die;

        if ($helpModel->save()) {
            Session::flash('help_text_saved', 'Изменения сохранены');
        }

        return redirect('admin/help');
    }

    public function profile()
    {
        $userData['name'] = Auth::user()->name;
        $userData['surname'] = Auth::user()->surname;
        $userData['email'] = Auth::user()->email;

        return view('admin.profile', [
            'userData' => $userData
        ]);
    }

    public function profileStoreData(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'min:3',
            'surname' => 'min:3',
            'email' => 'min:6'
        ]);

        Auth::user()->name = $request['name'];
        Auth::user()->surname = $request['surname'];
        Auth::user()->email = $request['email'];

        if (Auth::user()->save()) {
            Session::flash('saved', 'Изменения сохранены');
        }

        return redirect('admin/profile');
    }

    public function updateAdminAvatar(Request $request)
    {
        $validatedData = $request->validate([
            'admin-avatar' => 'image|min:1'
        ]);

        $cover = $request->file('admin-avatar');

        if (empty($cover)) {
            return redirect('admin/profile');
        }

        $extension = $cover->getClientOriginalExtension();
        $avatarName = Str::random(25) . '.' . $extension;
        Storage::disk('public')->put($avatarName, File::get($cover));

        Auth::user()->avatar = $avatarName;

        if (Auth::user()->save()) {
            Session::flash('admin_image_saved', 'Изменения сохранены');
        }

        return redirect('admin/profile');
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

        return redirect('admin/profile');
    }


    public function userCard(Request $request)
    {

        if ($request['reset'] != '0') {
            unset($request['from_date']);
            unset($request['to_date']);
        }

        $id = $request['id'];
        $user = User::find($id);
        //print_r($user->keys()->toSql());die;
        $keys = $user->keys()->paginate(10);

        $dateFrom = $request['from_date'] ?? '01/01/' . date('Y');
        $dateTo = $request['to_date'] ?? date('m/d/Y');


        $transactions = $user->transactions();
        if ($dateFrom) {
            $transactions = $transactions->where('created_at', '>=', date('Y-m-d h:i:s', strtotime($dateFrom)));
        }

        if ($dateTo) {
            $transactions = $transactions->where('created_at', '<=', date('Y-m-d h:i:s', strtotime($dateTo)));
        }

        //print_r($transactions->toSql());die;
        $transactions = $transactions->paginate(10);
        return view('admin.user_card',
            [
                'user' => $user,
                'keys' => $keys,
                'transactions' => $transactions,
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo
            ]
        );
    }

    public function updateUserProfile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'min:3',
            'surname' => 'min:3',
            'email' => 'min:6|email|unique:users',
            'phone' => 'min:3|unique:users',
            'telegram' => 'min:3'
        ]);

        $user = User::find($request['id']);

        $user->name = $request['name'];
        $user->surname = $request['surname'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->telegram = $request['telegram'];

        if ($user->save()) {
            Session::flash('user_profile_updated', 'Изменения сохранены');
        }

        return redirect()->action('AdminController@userCard', [
            'id' => $request['id']
        ]);
    }

    public function updateUserPassword(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|min:6',
            'repeat-password' => 'required|min:6|same:password',
        ]);

        $user = User::find($request['id']);

        $user->password = Hash::make($request['password']);
        if ($user->save()) {
            Session::flash('user_password_updated', 'Изменения сохранены');
        }

        return redirect()->action('AdminController@userCard', $user['id']);
    }

    public function loginAs($id)
    {
        $user = User::find($id);
        Auth::logout();
        Auth::login($user);
        return redirect('/cabinet/keys');
    }

    public function changeUserStatusActivate($id)
    {
        $user = User::find($id);

        $user->account_status = 1;


        $user->save();

        return redirect()->back();
    }

    public function changeUserStatusDeactivate($id)
    {
        $user = User::find($id);

        $user->account_status = 0;


        $user->save();

        return redirect()->back();
    }

    private function calculateSumPeriod($from, $to)
    {
        $dateFromUnixTime = 0;
        $dateToUnixTime = 1945346334;

        if ($from) {
            $dateFromUnixTime = strtotime($from);
        }

        if ($to) {
            $dateToUnixTime = strtotime($to);
        }

        return UserTransaction::getSumInPeriod($dateFromUnixTime, $dateToUnixTime);
    }

    private function calculateSumInDays($from, $to)
    {
        //echo $to;
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
//
//        echo $dateFromUnixTime;
//        echo "<br/>";
//        echo $dateToUnixTime;die;

        for ($i = $dateFromUnixTime; $i < $dateToUnixTime; $i += UserTransaction::daySecondsCount) {
            //echo $i;die;
//            echo date('Y-m-d H:s:i', $i);
//            echo "<br/>";
//            echo date('Y-m-d H:s:i', $i + UserTransaction::daySecondsCount );
//
//            die;
            $sum = $this->calculateSumPeriod(date('Y-m-d H:s:i', $i), date('Y-m-d H:s:i', $i + UserTransaction::daySecondsCount ));
            $day = date('d-m', $i + UserTransaction::daySecondsCount + 4000);
            $result[$day] = $sum;
        }
        //   ddd($result);

        return $result;


    }

    public function freezeKey(int $keyId)
    {
        UserKey::freezeA($keyId);
        return redirect()->back();
    }

    public function unFreezeKey(int $keyId)
    {
        UserKey::unFreezeA($keyId);
        return redirect()->back();
    }

    public function deleteKey(int $keyId)
    {
        UserKey::deleteKey($keyId);
        return redirect()->back();
    }

    public function activateKey(int $keyId)
    {
        UserKey::activateKey($keyId);
        return redirect()->back();
    }

    public function deActivateKey(int $keyId)
    {
        UserKey::deactivateKey($keyId);
        return redirect()->back();
    }

    public function longKey(int $keyId)
    {
        UserKey::longKey($keyId);
        return redirect()->back();
    }
}
