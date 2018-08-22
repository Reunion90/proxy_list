<?php
/**
 * Created by PhpStorm.
 * User: uman
 * Date: 22.08.18
 * Time: 14:01
 */

namespace App\Services;


use App\Services\NetworkResource\NetworkResourceInterface;

class ProxyChecker
{

    private $resource;

    public function __construct(NetworkResourceInterface $resource)
    {
        $this->resource = $resource;
    }

    public function check($ip, $port):bool
    {
        $this->resource->open($ip, $port);
        return $this->resource->check();
    }
}