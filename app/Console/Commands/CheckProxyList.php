<?php

namespace App\Console\Commands;

use App\ProxyList;
use App\Services\LockService;
use App\Services\LoggerFactory;
use App\Services\ProxyChecker;
use App\Services\ProxyListService;
use Illuminate\Console\Command;

class CheckProxyList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proxy:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check proxy servers';

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
        $this->log = LoggerFactory::get('proxy_check', 'Y-m-d', 20);

    }

    /**
     * Execute the console command.
     *
     * @param ProxyListService $proxyListService
     * @param ProxyChecker $proxyChecker
     * @param LockService $lockService
     * @return mixed
     */
    public function handle(ProxyListService $proxyListService, ProxyChecker $proxyChecker, LockService $lockService)
    {
        $this->log->info("START");
        $lock = $lockService->create($this->signature);

        if(!$lock->acquire()){
            $this->log->warn("NOT STARTED! PROCESS ALREADY IS ACTIVE");
            $this->warn("NOT STARTED! PROCESS ALREADY IS ACTIVE");
            exit(1);
        }

        $list = $proxyListService->get();
        $this->log->info("Count to check " . $list->count());
        $list->each(function(ProxyList $item)use($proxyListService, $proxyChecker){
            $this->log->info("Check", ['ip' => $item->ip, 'port' => $item->port]);
            $checkResult = $proxyChecker->check($item->ip, $item->port);
            $this->log->info("Result", ['result' => $checkResult? 'ok':'bad']);
            $item->access = $checkResult? 1 : 0;
            $item->save();
            dump($checkResult);
        });
    }
}
