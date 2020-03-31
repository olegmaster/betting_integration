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

        // calculate $sumInPeriod
        $dateFrom = $request['from_date'] ?? '';
        $dateTo = $request['to_date'] ?? '';
        $dateFromUnixTime = 0;
        $dateToUnixTime = 1945346334;

        if ($dateFrom) {
            $dateFromUnixTime = strtotime($dateFrom);
        }

        if ($dateTo) {
            $dateToUnixTime = strtotime($dateTo);
        }

        $sumInPeriod = UserTransaction::getSumInPeriod($dateFromUnixTime, $dateToUnixTime);


        return view('admin.summary',
            [
                'topUsers' => $topUsers,
                'totalUsers' => $totalUsers,
                'totalKeys' => $totalKeys,
                'sumInPeriod' => $sumInPeriod
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

    public function transactions()
    {
        $transactions = UserTransaction::paginate(10);
        $totalTransactions = UserTransaction::all()->count();
        return view('admin.transactions', [
            'transactions' => $transactions,
            'totalTransactions' => $totalTransactions
        ]);
    }

    public function bot()
    {
        return view('admin.summary');
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


    public function userCard($id)
    {
        $user = User::find($id);
        //print_r($user->keys()->toSql());die;
        $keys = $user->keys()->paginate(10);
        //print_r($keys);die;
        $transactions = $user->transactions()->paginate(10);
        return view('admin.user_card',
            [
                'user' => $user,
                'keys' => $keys,
                'transactions' => $transactions
            ]
        );
    }

    public function updateUserProfile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'min:3',
            'surname' => 'min:3',
            'email' => 'min:6'
        ]);

        $user = User::find($request['id']);

        $user->name = $request['name'];
        $user->surname = $request['surname'];
        $user->email = $request['email'];

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
}
