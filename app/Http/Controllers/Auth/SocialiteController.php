<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function authenticate()
    {
        $user = Socialite::driver('github')->user();

        $user = User::updateOrCreate([
            'github_id' => $user->id,
        ], [
            'github_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'github_token' => $user->token,
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }
}
