<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Session;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // Session::flash('error', 'Please Login before you proceed!');
            return route('login');
        }
    }
}
