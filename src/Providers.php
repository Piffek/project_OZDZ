<?php

namespace Src;

use App\Services\ErrorService;
use App\Services\FacebookService;
use App\Helpers\ConnectToFb;
use App\Services\GoolgePlusService;

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
        switch ($class) {
            case 'FacebookService':
                $this->class = new FacebookService();
                break;
            case 'ErrorService':
                $this->class = new ErrorService(include 'config.php');
                break;
            case 'GooglePlusService':
                $this->class = new GoolgePlusService(include 'config.php');
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
