<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    function callbackFacebook()
    {
        try {
            $facebook_user = Socialite::driver('facebook')->user();
            //dd($facebook_user);
            $user = User::where('facebook_id', $facebook_user->id)->first();

            if (!$user) {
                $new_user = User::create([
                    'name' => $facebook_user->name,
                    'email' => $facebook_user->email,
                    'facebook_id' => $facebook_user->id,
                ]);
                Auth::login($new_user);
                return redirect()->route('home');
            } else {
                Auth::login($user);

                return redirect()->route('home');
            }
        } catch (\Throwable $th) {
            return redirect()->route('home');

            dd('something went wrong!  ' . $th->getMessage());
        }
    }
}
