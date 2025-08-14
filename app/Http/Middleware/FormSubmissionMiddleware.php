<?php

namespace App\Http\Middleware;

use App\Models\Form;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
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
        // Get the form hash from the route parameter
        $hash = $request->route('hash');

        $origin  = $request->headers->get('Origin');   // e.g. https://example.com
        $referer = $request->headers->get('Referer');

        // Detect Postman
        $userAgent = $request->userAgent() ?? '';
//        $isPostman = preg_match('/PostmanRuntime|Postman/i', $userAgent) === 1;

        if (!$hash) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid form request',
            ], 400);
        }

        // Check if the form exists and is enabled
        $form = Form::where('hash', $hash)
            ->where('is_enabled', true)
            ->with('company')
            ->first();

        if (!$form) {
            return response()->json([
                'status' => 'error',
                'message' => 'Form not found',
            ], 404);
        }

        if (!$form->company->is_enabled) {
            return response()->json([
                'status' => 'error',
                'message' => 'Company is disabled',
            ], 404);
        }

        if ($form->company->submission_limit === 0) {
            return response()->json([
                'status' => 'submission_limit_reached',
                'data' => [],
            ], 403);
        }

        // Rate limiting: Allow max 10 submissions per minute per IP address per form
//        $key = 'form_submissions:' . $hash . ':' . $request->ip();
//        $maxAttempts = 10;
//        $decayMinutes = 1;
//
//        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
//            $seconds = RateLimiter::availableIn($key);
//
//            return response()->json([
//                'status' => 'error',
//                'message' => 'Too many submissions. Please try again in ' . $seconds . ' seconds.',
//            ], 429);
//        }
//
//        RateLimiter::hit($key, $decayMinutes * 60);

        // Check for suspicious request headers that might indicate automated spam
        $userAgent = $request->header('User-Agent');
        if (empty($userAgent) ||
            stripos($userAgent, 'bot') !== false ||
            stripos($userAgent, 'crawl') !== false ||
            stripos($userAgent, 'spider') !== false) {

            return response()->json([
                'status' => 'error',
                'message' => 'Suspicious request detected',
            ], 403);
        }

        // Add the form to the request for use in the controller
        $request->attributes->set('origin', $origin);
        $request->attributes->set('referer', $referer);
        $request->attributes->set('user_agent', $userAgent);
        $request->attributes->set('form', $form);

        return $next($request);
    }
}
