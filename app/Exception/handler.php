<?php

namespace App\Exceptions;  // Fixed: Plural "Exceptions" to match Laravel default

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;  // Added import
use Throwable;  // Added import for Throwable

class Handler extends ExceptionHandler  // Added: Full class declaration
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $e)  // Now inside the class
    {
        // Custom handling for MethodNotAllowedHttpException
        if ($e instanceof MethodNotAllowedHttpException) {
            // For API requests (check Accept header or route prefix)
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'error' => 'Method not allowed. Use GET for this route.',
                    'supported_methods' => $e->getAllowedMethods(),
                ], 405);
            }

            // For web requests, redirect with flash message (uncomment/adjust as needed)
            // return redirect('/')->with('error', 'Invalid request method. Please use GET.');

            // Or return a simple response
            return response()->view('errors.405', ['message' => 'Method not allowed.'], 405);
        }

        return parent::render($request, $e);  // Fallback to default handling
    }
}