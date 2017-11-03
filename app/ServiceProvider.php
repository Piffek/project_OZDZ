<?php

namespace App;

use App\Providers;

abstract class ServiceProvider
{

    public function getProviders(string $nameOfService)
    {
        return (new Providers($nameOfService))->provider();
    }
}