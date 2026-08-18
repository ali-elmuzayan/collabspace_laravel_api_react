<?php

namespace App\Actions\Auth;

use App\Models\User;

class LogoutUser
{
    public function handle(User $user)
    {

        $user->tokens()->delete();
    }
}
