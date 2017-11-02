<?php
namespace App;
use Dotenv\Dotenv;

class Controller extends BaseController
{

    protected $request;
    protected $config;
    public $env;
    
    /**
     * Get param from URL and generate env.
     * 
     * @param unknown $request
     */
    public function __construct($request)
    {

        $this->request = $request;
        
        $this->env = __DIR__.'/..';
        $dotenv = new Dotenv($this->env);
        $dotenv->load();
    
    }
}
