<?php

namespace App\Http\Middleware;

use App\Models\Form;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FormSubmissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $hash = $request->route('hash');

        $form = Form::query()
            ->where('hash', $hash)
            ->where('is_enabled', true)
            ->with('company')
            ->first();

        if (!$form) {
            return response()->json([
                'status' => 'form_not_found',
                'data' => [],
            ], 404);
        }

        if ($form->company->submission_limit === 0) {
            return response()->json([
                'status' => 'submission_limit_reached',
                'data' => [],
            ], 403);
        }

        $request->merge(['form' => $form]);

        return $next($request);
    }
}
