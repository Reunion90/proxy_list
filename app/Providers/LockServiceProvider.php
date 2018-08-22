<?php

namespace App\Providers;

use App\Services\LockService;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Lock\Factory;
use Symfony\Component\Lock\Store\FlockStore;

class LockServiceProvider extends ServiceProvider
{
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
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LockService::class, function (){
            $store = new FlockStore(storage_path('lock'));
            $factory = new Factory($store);
            return new LockService($factory);
        });
    }
}
