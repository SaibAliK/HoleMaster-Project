<?php

namespace App\Http\Interfaces\Api;

use App\Http\Requests\Api\LoginRequest;

interface UserInterface{
    public function login(LoginRequest $request);
}