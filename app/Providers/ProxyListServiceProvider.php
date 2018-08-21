<?php

namespace App\Providers;

use App\Services\ProxyListAdapter;
use App\Services\ProxyListService;
use Illuminate\Support\ServiceProvider;

class ProxyListServiceProvider extends ServiceProvider
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
        $this->app->singleton(ProxyListService::class, function (){
            $adapter = new ProxyListAdapter(config('services.proxy_list.fields'));
            return new ProxyListService($adapter);
        });
    }
}
