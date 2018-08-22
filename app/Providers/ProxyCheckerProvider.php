<?php

namespace App\Providers;

use App\Services\NetworkResource\FsockOpenResource;
use App\Services\ProxyChecker;
use Illuminate\Support\ServiceProvider;

class ProxyCheckerProvider extends ServiceProvider
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
        $this->app->singleton(ProxyChecker::class, function () {
            $resource = new FsockOpenResource(config('services.proxy_checker.timeout'));
            return new ProxyChecker($resource);
        });
    }
}
