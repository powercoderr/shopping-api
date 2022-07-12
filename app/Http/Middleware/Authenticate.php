<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Traits\RespondsWithHttpStatus;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    use RespondsWithHttpStatus;
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        abort($this->failure("Unauthorized", "Token tidak valid atau kadaluwarsa", 401));

    }
}
