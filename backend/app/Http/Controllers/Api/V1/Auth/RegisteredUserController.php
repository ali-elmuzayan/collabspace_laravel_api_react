<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Actions\Auth\RegisterAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Traits\ApiResponse;

class RegisteredUserController extends Controller
{
    use ApiResponse;

    public function __construct(private RegisterAction $registerAction) {}

    /**
     * Register a new user
     */
    public function store(RegisterRequest $request)
    {
        $result = $this->registerAction->handle($request->toDTO());

        return $this->successResponse($result, 'User registered successfully');
    }
}
