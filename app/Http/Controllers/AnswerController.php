<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnswerController extends Controller
{
    //
    public function success(Request $request)
    {
        return view('answers.success', [
            'text' => $request->input('text') ?? '',
            'redirect' => $request->input('redirect') ?? '',
        ]);
    }

    public function error(Request $request)
    {
        return view('answers.error', [
            'text' => $request->input('text') ?? '',
            'redirect' => $request->input('redirect') ?? '',
        ]);
    }
}
