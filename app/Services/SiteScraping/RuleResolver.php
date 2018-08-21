<?php
/**
 * Created by PhpStorm.
 * User: uman
 * Date: 20.08.18
 * Time: 20:16
 */

namespace App\Services\SiteScraping;


use App\Services\SiteScraping\Rules\FreeProxyListNetRule;
use Goutte\Client;

class RuleResolver
{
    protected $sites = [
        'free-proxy-list.net' => FreeProxyListNetRule::class
    ];

    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function resolve($site)
    {
        if (empty($this->sites[$site])) {
            return null;
        }

        $classRule = $this->sites[$site];

        if ( !class_exists($classRule) ) {
            return null;
        }

        return new $classRule($this->client);
    }
}