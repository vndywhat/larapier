<?php

namespace App\Providers;

use App\Services\BbCodeService;
use Illuminate\Support\ServiceProvider;

class BbCodeServiceProvider extends ServiceProvider
{
    /**
     * Задаём, отложена ли загрузка провайдера.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind('bbcode', function () {
            return new BbCodeService;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['bbcode'];
    }
}
