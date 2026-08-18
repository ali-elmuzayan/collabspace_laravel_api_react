<?php

namespace App\Actions\Auth;

use App\DTOs\Auth\RegisterData;
use App\Mail\VerifyUserMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class RegisterAction
{
    public function handle(RegisterData $data)
    {
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password,
        ]);

        // send email verification
        Mail::to($user->email)->send(new VerifyUserMail($user));

        return $user;
    }
}
