<?php

namespace Src\Service;

/**
 * 
 * Interface to ServiceProvider.
 *
 */
Interface ServiceInterface
{
    public function getService(string $nameOfService);
}