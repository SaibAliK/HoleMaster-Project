<?php

namespace App\Http\Controllers\Api;

use App\Enums\ConstantsEnums;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Interfaces\Api\UserInterface;
use App\Http\Requests\StoreClientRequest;
use App\Http\Services\Api\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

// class UserController extends ApiController implements UserInterface
class UserController extends ApiController
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request): JsonResponse
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email', 'exists:users'],
                'password' => 'required|string|min:6'
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->messages()->all(), 400, [], "LOGIN", FALSE);
            }

            if (Auth::attempt($request->only(['email', 'password']))) {
                $user = Auth()->user();
                $user['token']  = $user->createToken(ConstantsEnums::PassportAuthKey)->accessToken;
                return self::successResponse($user, "Login Successfully", "LOGIN", TRUE, 200);
            }
            return self::errorResponse('Email or password is incorrect', 400, [], "LOGIN", TRUE);
        } catch (Exception $ex) {
            return self::errorResponse($ex->getMessage(), 400, [], "LOGIN", FALSE);
        }
    }
}
