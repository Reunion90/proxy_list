<?php

namespace App\Providers;

use App\Services\SiteScraping\RuleResolver;
use App\Services\SiteScraping\SiteScraping;
use Illuminate\Support\ServiceProvider;

class SiteScrapingProvider extends ServiceProvider
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
        $this->app->singleton(SiteScraping::class, function (){
            $rule = new RuleResolver();
            return new SiteScraping($rule);
        });
    }
}
