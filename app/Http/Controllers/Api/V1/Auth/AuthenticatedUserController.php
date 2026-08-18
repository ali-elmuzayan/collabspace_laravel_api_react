<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Actions\Auth\LoginUser;
use App\Actions\Auth\LogoutUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AuthenticatedUserController extends Controller
{
    use ApiResponse;

    public function __construct(private LoginUser $loginUser, private LogoutUser $logoutUser) {}

    /**
     * Login the user
     */
    public function store(LoginRequest $request)
    {
        $result = $this->loginUser->handle($request->toDTO());

        return $this->successResponse($result, 'Login successfuly');
    }

    /**
     * Get the authenticated user
     */
    public function show(Request $request)
    {
        return $this->successResponse($request->user(), 'User fetched successfully');
    }

    /**
     * Logout the user
     */
    public function destroy(Request $request)
    {
        $this->logoutUser->handle($request->user());

        return $this->successResponse(null, 'Logout successful');
    }
}
