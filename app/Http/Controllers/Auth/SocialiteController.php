<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
class SocialiteController extends Controller
{
    public function GoogleRedirect(){

        return Socialite::driver('google')->redirect();

    }

    public function GoogleCallback(){

         // dd($request);
                $googleUser = Socialite::driver('google')->user();


                $user = User::updateOrCreate([
                    'google_id'=>$googleUser->id    ],
                    ['name'=>$googleUser->name,
                            'email'=>$googleUser->email,
                            'password'=>Str::password(12),
                            'email_verified_at'=>now()
                    ]
            );
            Auth::login($user);
            return redirect()->route('home');

    }

     public function FacebookRedirect(){

        return Socialite::driver('facebook')->redirect();

    }

    public function facebookCallback(){

         // dd($request);
                $googleUser = Socialite::driver('facebook')->user();


                $user = User::updateOrCreate([
                    'facebook_id'=>$googleUser->id    ],
                    ['name'=>$googleUser->name,
                            'email'=>$googleUser->email,
                            'password'=>Str::password(12),
                            'email_verified_at'=>now()
                    ]
            );
            Auth::login($user);
            return redirect()->route('home');

    }
}
