<?php

namespace App;

use Src\Services\FacebookService;
use Dotenv\Dotenv;

abstract class ServiceProvider
{
    /**
     * Render twig template.
     *
     * @param string $template
     * @param array  $parameters
     * @return string
     */
    public function render(string $template, array $parameters) : string
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ .'/../src/Views');
        $twig = new \Twig_Environment($loader);
        
        return $twig->render($template, $parameters);
    } 
    
    /**
     * Facebook service provider.
     * 
     * @return FacebookService
     */
    public function facebookProvider() : FacebookService
    {
        return new FacebookService();
    }
    
    /**
     * Dotenv load provider.
     * 
     * @return array
     */
    protected function dotenv() : array
    {
        $env = __DIR__.'/..';
        $dotenv = new Dotenv($env);
        
        return $dotenv->load();
    }

}