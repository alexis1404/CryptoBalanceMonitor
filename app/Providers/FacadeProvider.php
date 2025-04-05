<?php

namespace App\Providers;

use App\Helpers\DecimalHelper;
use App\Helpers\JsonResponseService;
use App\Services\Common\AddressValidator;
use Illuminate\Support\ServiceProvider;

class FacadeProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('decimal', function () {
            return new DecimalHelper();
        });
        $this->app->singleton('address.validator', function () {
            return new AddressValidator();
        });
        $this->app->singleton('json.response', function () {
            return new JsonResponseService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
