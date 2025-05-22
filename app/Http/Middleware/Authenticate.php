<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {

        if ($this->auth->guard('admin')->check()) {
            return route('panel.index');
        }

        if (Route::is('panel.*')) {
            return route('panel.showLogin');
        }

        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
