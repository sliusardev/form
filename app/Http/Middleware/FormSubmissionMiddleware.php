<?php

        namespace App\Http\Middleware;

        use App\Models\Form;
        use Closure;
        use Illuminate\Http\Request;
        use Symfony\Component\HttpFoundation\Response;

        class FormSubmissionMiddleware
        {
            public function handle(Request $request, Closure $next): Response
            {
                $hash        = $request->route('hash');
                $origin      = $request->headers->get('Origin');
                $referer     = $request->headers->get('Referer');
                $userAgent   = $request->userAgent();
                $hasReferer  = !empty($referer);

                if (!$hash) {
                    return $this->jsonError('error_invalid_hash', 'Invalid form request', 400);
                }

                $form = Form::with('company')
                    ->where('hash', $hash)
                    ->where('is_enabled', true)
                    ->first();

                if (!$form) {
                    return $this->formError(
                        $hasReferer,
                        'error_not_found',
                        'Form not found or disabled. Please check the link or contact support.',
                        404,
                        $referer
                    );
                }

                if ((int)$form->company->submission_limit === 0) {
                    return $this->formError(
                        $hasReferer,
                        'submission_limit_reached',
                        'Submission limit reached for this form. Please increase submissions count.',
                        403,
                        $referer
                    );
                }

                if ($this->isSuspiciousUserAgent($userAgent)) {
                    return $this->jsonError('error', 'Suspicious request detected', 403);
                }

                $request->attributes->add([
                    'origin'     => $origin,
                    'referer'    => $referer,
                    'user_agent' => $userAgent,
                    'form'       => $form,
                ]);

                return $next($request);
            }

            private function isSuspiciousUserAgent(?string $ua): bool
            {
                if (empty($ua)) {
                    return true;
                }

                $needles = ['bot', 'crawl', 'spider'];
                $lower   = strtolower($ua);

                foreach ($needles as $n) {
                    if (strpos($lower, $n) !== false) {
                        return true;
                    }
                }

                return false;
            }

            private function formError(
                bool $hasReferer,
                string $statusKey,
                string $message,
                int $httpCode,
                ?string $referer
            ): Response {
                if ($hasReferer) {
                    return response()
                        ->redirectToRoute('answer.error', [
                            'text'     => $message,
                            'redirect' => $referer,
                        ])
                        ->setStatusCode($httpCode);
                }

                return $this->jsonError($statusKey, $message, $httpCode);
            }

            private function jsonError(string $statusKey, string $message, int $code): Response
            {
                return response()->json([
                    'status' => $statusKey,
                    'text'   => $message,
                ], $code);
            }
        }
