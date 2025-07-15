<?php

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\Request;
    use Symfony\Component\HttpFoundation\Response;

    class AdminMiddleware
    {
        /**
         * Handle an incoming request.
         */
        public function handle(Request $request, Closure $next): Response
        {
            // Check if user is authenticated and has admin role/permission
            if (!auth()->check() || !auth()->user()->isAdmin()) {
                // Redirect to dashboard with error message if not admin
                return redirect()->route('dashboard')
                    ->with('error', 'You do not have permission to access this area.');
            }

            return $next($request);
        }
    }
