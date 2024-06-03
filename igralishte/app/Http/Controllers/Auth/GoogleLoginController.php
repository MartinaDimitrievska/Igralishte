<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\Access\Authorizable;

class GoogleLoginController extends Controller
{
    use Authorizable;

    public function __construct()

    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()

    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $finduser = User::where('google_id', $user->id)->first();

        if($finduser){
            Auth::login($finduser);

            return redirect('/dashboard');
        }else{
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id'=> $user->id,
                'password' => bcrypt(request(Str::random())),
            ]);

            Auth::login($newUser);

            return redirect('/dashboard');
        }
    }
}
