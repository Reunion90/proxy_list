<?php

namespace App\Services;


use Symfony\Component\Lock\Factory;

class LockService
{
    private $factory;

    public function __construct(Factory $factory )
    {
        $this->factory = $factory;
    }

    public function create(string $name)
    {
        return $this->factory->createLock($name);
    }

}