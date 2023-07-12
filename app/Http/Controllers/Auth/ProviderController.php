<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $SocialUser = Socialite::driver($provider)->user();
        $user = User::where('email', $SocialUser->getEmail())->first();
        if ($user) {
            if ($user->provider !== $provider) {
                return redirect('/login')->withErrors(['email' => 'Ця електронна адреса вже використовується іншим сервісом']);
            }
        } else {
            $user = User::create([
                'name' => $SocialUser->getName(),
                'email' => $SocialUser->getEmail(),
                'avatar' => $SocialUser->getAvatar(),
                'provider' => $provider,
                'provider_id' => $SocialUser->getId(),
                'provider_token' => $SocialUser->token,
            ]);
        }
        Auth::login($user);
        return redirect('/calendar/index');
    }
}
