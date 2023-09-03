<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Pagination\Paginator as PaginationPaginator;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\Environment\Environment;

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
    // INIETTARE SINGLETON PATTERN DA UNA CLASSE SINGOLA ISTANZA E USABILE SU TUTTA L'APP
    public function boot(): void
    {
        PaginationPaginator::useBootstrap();
        $this->app->singleton(Gateway::class, function ($app) {
            return new Gateway([
                'environment' => 'sandbox',
                'merchantId' => '3gx8prydrbkm5tq4',
                'publicKey' => '3p6pnjxk2vpm64zs',
                'privateKey' => '008734a199fc08d297496af830900c74'
            ]);
        });
    }
}