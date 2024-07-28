<?php

namespace App\Providers;

use App\Application\Services\Rosreestr\Interface\RosreestrGetDataInterface;
use App\Application\Services\Rosreestr\RosreestrRuNet\RosreestrRuNetImpl;
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
        //
        $this->app->bind(RosreestrGetDataInterface::class, function () {
            return new RosreestrRuNetImpl();
        });
    }
}
