<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //  if(config('app.env') === 'local')
        // {
        //     URL::forceScheme('https');
            
        //     // Handle ngrok URLs dynamically
        //     if (request()->hasHeader('x-forwarded-host')) {
        //         $host = request()->header('x-forwarded-host');
        //         URL::forceRootUrl('https://' . $host);
        //     }
        // }

       
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Super admin bypass all gates - untuk testing dan admin role
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('admin')) {
                return true;
            }
        });

        if($this->app->environment('local')) {
            URL::forceScheme('https');
        }
    }
}
