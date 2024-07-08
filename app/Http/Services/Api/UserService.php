<?php 

namespace App\Http\Services\Api;

use App\Http\Interfaces\Api\UserInterface;
use App\Http\Repositeries\Api\UserRepository;
use App\Http\Requests\Api\LoginRequest;

class UserService implements UserInterface {

    protected UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function login(LoginRequest $request){
        return $this->userRepository->login($request);
    }
}