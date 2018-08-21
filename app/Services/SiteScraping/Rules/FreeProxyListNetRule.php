<?php
/**
 * Created by PhpStorm.
 * User: uman
 * Date: 20.08.18
 * Time: 20:21
 */

namespace App\Services\SiteScraping\Rules;


use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class FreeProxyListNetRule implements RuleInterface
{
    const SITE_NAME = 'free-proxy-list.net';
    const SITE_URL = 'https://free-proxy-list.net';

    /**
     * @var array
     * 0 - ip
     * 1 - port
     * 3 - country
     * 4 - anonym
     */
    protected $allowedKeys = [0,1,3,4];
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function parse()
    {
        $crawler = $this->client->request('GET', self::SITE_URL);
        $crawlerRows = $crawler->filter('#proxylisttable > tbody > tr');


        /**
         * @var array $rowsData
         *    0 => array:8 [
         *      0 => "185.51.171.170"
         *      1 => "41258"
         *      2 => "IT"
         *      3 => "Italy"
         *      4 => "elite proxy"
         *      5 => "no"
         *      6 => "yes"
         *      7 => "9 seconds ago"
         *  ]
         */
        $rowsData = $crawlerRows->each(function(Crawler $trCrawler){
            $tdsCrawler = $trCrawler->filter('td')->each(function(Crawler $tdCrawler){
                return $tdCrawler->text();
            });

            return array_filter($tdsCrawler, function($key){
                return in_array($key, $this->allowedKeys);
            }, ARRAY_FILTER_USE_KEY);
        });

        return $rowsData;
    }
}