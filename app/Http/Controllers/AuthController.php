<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function redirect(Request $request)
    {
        $redirectPath = $request->query('redirect', '/b/dashboard'); // default
        session(['redirect_after_login' => $redirectPath]);
        return Socialite::driver('google')->redirect();
    }
    public function authenticate(Request $request)
    {
        $user = Socialite::driver('google')->user();
        $volunteer = User::first();
        $volunteer->name = $user->name;
        $volunteer->email = $user->email;
        $volunteer->avatar = $user->avatar;
        $volunteer->save();
        $token = auth('api')->claims($volunteer->except('id','created_at','updated_at'))->login($volunteer);
        $redirectPath = session()->pull('redirect_after_login', '/b/dashboard');        
        return response()
            ->redirectTo(env('FRONTEND_URL') . '/auth/callback?next=' . $redirectPath . '&token=' . $token);
    }
}
