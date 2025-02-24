<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback() : RedirectResponse {
        $user = Socialite::driver('google')->stateless()->user();

        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
            $newUser = new User();
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->google_id = $user->id;
            $newUser->password = bcrypt(request(Str::random()));
            $newUser->save();

            // logar com novo usuario
            auth()->login($newUser, true);
        }

        return redirect()->route('home');
    }
}
