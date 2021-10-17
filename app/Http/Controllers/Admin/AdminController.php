<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\LoginAsRequest;
use App\Http\Requests\Admin\Admin\UpdateAdminAvatarRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function loginAs(LoginAsRequest $request)
    {
        $id = $request->input('id');
        $user = User::find($id);
        Auth::logout();
        Auth::login($user);
        return redirect('/cabinet/keys');
    }

    public function updateAdminAvatar(UpdateAdminAvatarRequest $request)
    {
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
}
