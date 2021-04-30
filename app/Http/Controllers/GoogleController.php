<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        $ggUser = Socialite::driver('google')->stateless()->user();
        $exitsUser = User::where('google_id', $ggUser->id)->first();

        if($exitsUser){
            Auth::login($exitsUser);
        } else {
            $newUser = User::create([
                'name' => $ggUser->name,
                'email' => $ggUser->email,
                'google_id'=> $ggUser->id,
                'password' => encrypt('123456')
            ]);

            Auth::login($newUser);
        }

        return redirect()->route('dashboard');
    }
}
