<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AuthenticationController extends Controller
{
    //show the register form

    public function registerForm(){

        return view('register');
    }

    // register new user
    public function register(Request $request){

        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $tokenResult = $user->createToken('wallet-token',['create','delete','edit']);
        $token = $tokenResult->accessToken;

        return response()->json(['token' => $token, 'success'=>'AUTHENTICATED'],200);
    }

    public function login(Request $request){

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials)){
            // create access tokens
            $tokenResult = Auth::user()->createToken('wallet-token',['create','delete','edit']);
            $token = $tokenResult->accessToken;

            // Carbon class is an API extension to be used to manipulate date and time
            return response()->json([
                'token' => $token,
                'token_type' => 'Bearer '.$token,
                'expire_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            ],200);
        }
        else{

            return response()->json(['error' => 'Access denied'], 401);
        }
    }
}
