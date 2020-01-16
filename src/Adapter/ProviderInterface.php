<?php

namespace App\Adapter;


interface ProviderInterface
{
    /**
     * @param string $key
     * @return mixed
     */
    public function findBy(string $key);
}