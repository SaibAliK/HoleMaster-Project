<?php

namespace App\Http\Repositeries\Api;

use App\Enums\ConstantsEnums;
use App\Http\Controllers\ApiController;
use App\Http\Interfaces\Api;
use App\Http\Interfaces\Api\UserInterface;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

Class UserRepository extends ApiController implements UserInterface
{
    protected User $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function login(LoginRequest $request){
        try{
            if(Auth::attempt($request->only(['email','password']))){
                $user = User::where('email', $request->get('email'))->where('type','operative')->first();
                if($user){
                 $user['token']  =$user->createToken(ConstantsEnums::PassportAuthKey)->accessToken;
                 return self::successResponse($user);
                }
            }
            return self::errorResponse('Email or password is incorrect');

        }catch(Exception $ex){
            return self::errorResponse($ex->getMessage());
        }
    }
}