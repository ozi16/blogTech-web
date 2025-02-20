<?php

namespace App\Providers;

use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Redirect an Authenticated User to dashboard
        // RedirectIfAuthenticated::redirectUsing(function () {
        //     return route('admin.dashboard');
        // });

        //Redirect No Authenticated User to Admin Login Page
        // Authenticate::redirectUsing(function () {
        //     Session::flash('fail', 'you must be logged in to access admin area. please login to continue.');
        //     return route('admin.login');
        // });
        require_once app_path('Helpers/common.php');
    }
}
