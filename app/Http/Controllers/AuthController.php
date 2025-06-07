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
        $redirectPath = $request->query('redirect', '/dashboard'); // default
        session(['redirect_after_login' => $redirectPath]);
        return Socialite::driver('google')->redirect();
    }
    public function authenticate(Request $request)
    {
        $user = Socialite::driver('google')->user();
        $volunteer = User::where('email', $user->email)->first();
        if (! $volunteer) {
            return response()->redirectTo(env('FRONTEND_URL'));
        }
        $token = JWTAuth::fromUser($volunteer);
        $redirectPath = session()->pull('redirect_after_login', '/dashboard');
        return response()
            ->redirectTo(env('FRONTEND_URL') . '/auth/callback?next=' . $redirectPath . '&token=' . $token);
    }
}
