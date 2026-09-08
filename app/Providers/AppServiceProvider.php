<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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
        // За Render TLS-терминируется прокси: заставляем Laravel генерировать
        // https-URL, иначе стили/ассеты получают http:// (mixed content).
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
