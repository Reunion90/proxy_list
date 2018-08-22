<?php
/**
 * Created by PhpStorm.
 * User: uman
 * Date: 22.08.18
 * Time: 16:30
 */

namespace App\Services\NetworkResource;


interface NetworkResourceInterface
{
    public function open(string $ip, int $port): bool;

    public function check(): bool;

    public function close();
}