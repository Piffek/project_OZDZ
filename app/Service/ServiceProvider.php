<?php

namespace App\Service;

use App\Providers;

class ServiceProvider implements ServiceInterface
{
    /**
     * 
     * return class of Providers if isset.
     * 
     * @see \App\Service\ServiceInterface::getProviders()
     * @param  string $nameOfService name of service.
     * @return class istance.
     * 
     */
    public function getService(string $nameOfService)
    {
        return (new Providers($nameOfService))->provider();
    }
}