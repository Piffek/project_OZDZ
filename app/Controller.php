<?php

namespace App;

class Controller extends ServiceProvider
{
    protected $request;
    
    /**
     * Get param from URL and generate env.
     * 
     * @param unknown $request
     */
    public function __construct($request)
    {
        $this->request = $request;
        $this->dotenv();
    }
}