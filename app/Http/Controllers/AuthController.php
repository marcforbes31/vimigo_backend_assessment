<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\HttpResponses;
use App\Traits\HttpResponses as TraitsHttpResponses;

class AuthController extends Controller
{
    use TraitsHttpResponses;

    public function login(){
        return "This is the login method";
    }

    public function register(){
        return "This is the register method";
    }

    public function logout(){
       
    }
}
