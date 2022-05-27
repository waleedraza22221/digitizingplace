<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetPasswordRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function Callback($provider)
    {

        $userSocial =   Socialite::driver($provider)->stateless()->user();
        $users       =   User::where(['email' => $userSocial->getEmail()])->first();

        if ($users) {
            Auth::login($users);
            // dd($users);
            return redirect()->route('createpassword');
        } else {
            $user = User::create([
                'name'          => $userSocial->getName(),
                'email'         => $userSocial->getEmail(),
                'image'         => $userSocial->getAvatar(),
                'provider_id'   => $userSocial->getId(),
                'provider'      => $provider,
                'role_id' => 2
            ]);
            Auth::login($user);
            return redirect()->route('createpassword');
        }
    }



    public function createpassword()
    {
        return view('createpassword');
    }

    public function setpassword(SetPasswordRequest $setPasswordRequest)
    {

        $user = Auth::user();
        $user->password = Hash::make($setPasswordRequest->password);
        $user->save();
        return redirect()->route('home');
    }
}
