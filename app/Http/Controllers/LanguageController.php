<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        Session::put('locale', $locale);
        return Redirect::back()->with('success', __('Language switched successfully.'));
    }
}

