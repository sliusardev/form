<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use App\Models\AuthProviders;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderCallbackController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $provider)
    {
        if (!in_array($provider, ['google', 'github'])) {
            return redirect(route('login'))->withErrors(['provider' => 'Invalid provider']);
        }

        $socialUser = Socialite::driver($provider)->user();

        $user = User::query()->where('email', $socialUser->email)->first();

        $providerUser = $this->updateOrCreateProvider($user, $provider, $socialUser);

        if (!$user) {
            $user = $this->createAndRegisterUser($socialUser, $providerUser);
        }

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function updateOrCreateProvider($user, $provider, $socialUser)
    {
        $this->verifyEmail($user);

        return AuthProviders::query()->updateOrCreate([
            'provider_id' => $socialUser->id,
            'provider_name' => $provider,
        ], [
            'user_id' => $user->id ?? null,
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'avatar' => $socialUser->avatar,
            'nickname' => $socialUser->nickname,
            'token' => $socialUser->token,
            'refresh_token' => $socialUser->refreshToken,
        ]);
    }

    public function createAndRegisterUser($socialUser, $providerUser)
    {
        $user = User::query()->create([
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'avatar' => $socialUser->avatar,
        ]);

        $this->verifyEmail($user);

        $providerUser->update(['user_id' => $user->id]);

        event(new Registered($user));

        return $user;
    }


    public function verifyEmail($user)
    {
        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }
    }
}
