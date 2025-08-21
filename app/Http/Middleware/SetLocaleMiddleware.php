<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        // If no locale stored yet, detect from browser
        if (!Session::has('locale')) {
            // Get all browser languages (e.g. ['uk-UA','uk','en-US','en'])
            $browserLocales = array_map('strtolower', $request->getLanguages());

            $locale = 'en'; // default
            foreach ($browserLocales as $lang) {
                if (str_starts_with($lang, 'uk')) {
                    $locale = 'uk';
                    break;
                }
            }
            Session::put('locale', $locale);
        }

        $locale = Session::get('locale', config('app.locale'));
        App::setLocale($locale);
        return $next($request);
    }
}

