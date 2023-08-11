<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProvideCallback($provider)
    {
        try {

            $user = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return redirect()->back();
        }
        // find or create user and send params user get from socialite and provider
        $findUser = User::query()->where($provider.'_auth', $user->id)->first();

        if ($findUser) {
            Auth()->login($findUser->id, true);
        } else {
            $newUser = User::query()->create([
                'name' => $user->name,
                'email' => $user->email,
                'google_auth'=> $provider === 'google' ? $user->id : null,
                'facebook_auth'=> $provider === 'facebook' ? $user->id : null,
                'is_content_creator' => false,
                'password' => encrypt('')
            ]);

            //login as the new user
            Auth()->login($newUser->id, true);
        }

        return redirect()->route('/');
    }
}
