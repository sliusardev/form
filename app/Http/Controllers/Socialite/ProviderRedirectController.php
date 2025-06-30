<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;


class ProviderRedirectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $provider)
    {

        if (!in_array($provider, ['google', 'github'])) {
            return redirect(route('login'))->withErrors(['provider' => 'Invalid provider']);
        }

        try {
            Log::error($provider. ' redirect');

            return Socialite::driver($provider)->redirect();
        } catch (\Exception $e) {
            Log::error('Socialite redirect error: ' . $e->getMessage(), [
                'provider' => $provider,
                'exception' => $e
            ]);
            return redirect(route('login'))->withErrors(['provider' => 'Something went wrong']);
        }


    }
}
