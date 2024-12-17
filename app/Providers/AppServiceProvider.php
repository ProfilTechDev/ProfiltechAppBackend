<?php

namespace App\Providers;

use App\Utils\CustomPaginator;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        ResetPassword::createUrlUsing(function ($user, string $token) {
            return env('FRONTEND_URL')."/auth/reset-password?token={$token}&email={$user->email}";
        });

        Paginator::currentPathResolver(function () {
            return request()->url();
        });
    
        Paginator::currentPageResolver(function ($pageName = 'page') {
            $page = request()->input($pageName);
            if (filter_var($page, FILTER_VALIDATE_INT) !== false && (int) $page >= 1) {
                return (int) $page;
            }
            return 1;
        });
    
        // Bind the default paginator to use your CustomPaginator
        $this->app->bind(LengthAwarePaginator::class, CustomPaginator::class);
    }
}
