<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Http\Traits\HttpResponses;
use App\Traits\HttpResponses as TraitsHttpResponses;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use TraitsHttpResponses;

    public function login(LoginUserRequest $request){

        $request->validated($request->only(['email', 'password']));

        //If login failed
        if(!Auth::attempt($request->only(['email', 'password']))){
            return $this->fail('', 'Credentials Provided are incorrect', 401);
        }

        //Grab the staff details where email = request email 
        $staff = User::where('email', $request->email)->first();
        //If successful login
        return $this->success([
            'staff'=>$staff,
            'staffToken'=>$staff->createToken('API Token for '.$staff->name)->plainTextToken
        ]);
        
    }

    public function register(StoreUserRequest $request){
        $request->validated($request->all());
        $newstaff = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        return $this->success([
            'message'=>'Successfully Registered. Please log in to use API',
            'staff'=>$newstaff,
        ]);

    }

    public function logout(){
       Auth::user()->currentAccessToken()->delete();
       return $this->success([
        'message'=>'Successfully logged out and tokens removed'
       ]);
    }
}
