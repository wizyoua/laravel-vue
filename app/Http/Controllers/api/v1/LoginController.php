<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(Request $request) {
        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        

        if(!Auth::attempt($login)){
            return response(['message' => 'Invalid login credentials']);
        }

        $user = User::where('email',$request->email) -> first();
        //Log::info($user);
        
        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => Auth::user(), 'access_token' => $accessToken]);
    }
}
