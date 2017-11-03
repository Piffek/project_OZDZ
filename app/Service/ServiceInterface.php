<?php

namespace App\Service;

/**
 * 
 * Interface to ServiceProvider.
 *
 */
Interface ServiceInterface
{
    protected function getProviders(string $nameOfService);
}