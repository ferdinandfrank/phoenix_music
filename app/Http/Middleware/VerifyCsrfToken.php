<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

/**
 * VerifyCsrfToken
 * -----------------------
 * Middleware to verify csrf tokens.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Middleware
 */
class VerifyCsrfToken extends BaseVerifier {

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
