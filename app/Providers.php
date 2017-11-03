<?php

namespace App;

use Src\Services\FacebookService;

class Providers
{
    protected $class;
    public function __construct($class)
    {
        switch ($class){
            case 'FacebookService':
                $this->class = new FacebookService;
                break;
        }
    }
    
    public function provider(){
        return $this->class;
    }
}
