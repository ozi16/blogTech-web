<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */

    protected function redirectTo(Request $request): ?string
    {
        // Redirect unauthenticated users to login page
        if (!$request->expectsJson()) {
            session()->flash('fail', 'You must be logged in to access admin area. Please login to continue.');
            return route('admin.login');
        }
    }
}
