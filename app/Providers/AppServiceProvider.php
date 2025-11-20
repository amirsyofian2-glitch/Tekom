<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
         if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
