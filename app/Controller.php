<?php

namespace App;

use App\Service\ServiceProvider;
use Dotenv\Dotenv;

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