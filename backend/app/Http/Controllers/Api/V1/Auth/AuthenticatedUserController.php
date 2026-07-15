<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Actions\Auth\LoginUser;
use App\Actions\Auth\LogoutUser;
use Illuminate\Http\Request;


class AuthenticatedUserController extends Controller
{
    public function __construct(private LoginUser $loginUser, private LogoutUser $logoutUser)
    {
    }

    /**
     * Login the user
     */
    public function store(LoginRequest $request) 
    {
        return $this->loginUser->handle($request);
    }

    /**
     * Get the authenticated user
     */
    public function show(Request $request) 
    {
        return $request->user();
    }


    /**
     * Logout the user
     */
    public function destroy(Request $request) 
    {   
        return $this->logoutUser->handle($request);
    }
}
