<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements Rule
{
    public function passes($attribute, $value)
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $value,
        ]);

        return $response->json('success') && $response->json('score') >= 0.5;
    }

    public function message()
    {
        return 'reCAPTCHA verification failed.';
    }
}
