<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getLoggedUserActiveKeysCount(): int
    {
        $keysActiveCount = Auth::user()->keys()->active()->count();
        return $keysActiveCount ?? 0;
    }

    public function getLoggedUserTotalKeysCount(): int
    {
        $keysTotalCount = Auth::user()->keys()->count();
        return $keysTotalCount ?? 0;
    }

    public function getLoggedUserFrozenlKeysCount(): int
    {
        $keysFrozenCount = Auth::user()->keys()->frozen()->count();
        return $keysFrozenCount ?? 0;
    }
}
