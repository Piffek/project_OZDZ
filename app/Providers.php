<?php

namespace App;

use Src\Services\FacebookService;
use Src\Helpers\ConnectToFb;

/**
 * 
 * Provider service to controller.
 *
 */
class Providers
{
    protected $class;
    
    /**
     * Strategy constructor. Create instance of class if isset.
     * 
     * @param string $class name of class.
     */
    public function __construct(string $class)
    {
        switch ($class){
            case 'FacebookService':
                $this->class = new FacebookService(new ConnectToFb());
                break;
        }
    }
    
    /**
     * Return instance of class.
     * 
     * @return $class
     */
    public function provider()
    {
        return $this->class;
    }
}
