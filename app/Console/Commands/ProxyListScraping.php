<?php

namespace App\Console\Commands;

use App\Services\LoggerFactory;
use App\Services\ProxyListService;
use App\Services\SiteScraping\SiteScraping;
use Illuminate\Console\Command;

class ProxyListScraping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proxy:scrap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrapping proxy list';

    /**
     * @var \Monolog\Logger
     */
    private $log;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->log = LoggerFactory::get('proxy_scrap', 'Y-m-d', 20);
    }

    /**
     * Execute the console command.
     *
     * @param SiteScraping $siteScraping
     * @param ProxyListService $proxyListService
     * @return mixed
     */
    public function handle(SiteScraping $siteScraping, ProxyListService $proxyListService)
    {
        $this->log->info("Start");
        $site = getenv('PROXY_SITE');
        $parseData = $siteScraping->from($site);
        $proxyListService->save($parseData);
        $this->log->info("Result ", ['count' => count($parseData)]);
    }
}
