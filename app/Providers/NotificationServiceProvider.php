<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register the notification helper
        $this->app->singleton('notification', function ($app) {
            return new \App\Helpers\NotificationHelper();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Load the helper file
        require_once app_path('Helpers/NotificationHelper.php');
    }
}
