<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class FacebookLoginController extends Controller
{
    /**
     * @return RedirectResponse
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToFacebook(): RedirectResponse
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * @return RedirectResponse
     */
    public function handleFacebookCallback(): RedirectResponse
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        $finduser = User::where('facebook_id', $user->id)->first();

        if ($finduser) {
            Auth::login($finduser);

            return redirect('/dashboard');
        } else {
            $surname = $user->surname ?? null;

            $newUser = User::create([
                'name' => $user->name,
                'surname' => $surname, 
                'email' => $user->email,
                'facebook_id' => $user->id,
                'password' => bcrypt(request(Str::random())),
            ]);

            Auth::login($newUser);

            return redirect('/dashboard');
        }
    }
}
