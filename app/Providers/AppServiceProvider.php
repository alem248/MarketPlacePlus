<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Fechas relativas en español en toda la app (ej: "hace 1 semana")
        Carbon::setLocale('es');
    }
}
