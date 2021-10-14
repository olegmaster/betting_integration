<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserKey;
use Illuminate\Http\Request;

class KeyController extends Controller
{
    public function keys()
    {
        $keys = UserKey::paginate(10);
        $totalKeys = UserKey::all()->count();
        return view('admin.keys', [
            'keys' => $keys,
            'totalKeys' => $totalKeys
        ]);
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
