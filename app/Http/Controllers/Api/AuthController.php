<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\SignUpTrait;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    use SignUpTrait;

    public function signup(Request $request){
   
        $user = $this->addUser($request);
        return $user;
    }

    public function login(Request $request){
        
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('API Token')->accessToken;
            return response(['user' => $user, 'token' => $token]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

   
}
