<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        // Leave empty unless you want to exclude something like:
        // 'logout',
    ];

    protected function tokensMatch($request)
    {
        $sessionToken = $request->session()->token();
        $headerToken = $request->header('X-CSRF-TOKEN');
        $inputToken = $request->input('_token');

        Log::info('🔍 CSRF Debug', [
            'path' => $request->path(),
            'session_token' => $sessionToken,
            'header_token' => $headerToken,
            'input_token' => $inputToken,
            'method' => $request->method(),
        ]);

        return parent::tokensMatch($request);
    }

    protected function handleInvalidToken($request, $response)
    {
        Log::error('❌ Invalid CSRF token on path: ' . $request->path());
        return parent::handleInvalidToken($request, $response);
    }
}
