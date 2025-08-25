<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Route;

class LanguageController extends Controller
{
    public function switch(Request $request, $locale)
    {
        Session::put('locale', $locale);
        $referer = $request->headers->get('Referer');

        if (!str_contains($referer, 'dashboard')) {
            $path = parse_url($referer, PHP_URL_PATH);
            $routeName = Route::getRoutes()->match(Request::create($path))->getName();
            return Redirect::route($routeName, $locale);
        }

        return Redirect::back();
    }
}

