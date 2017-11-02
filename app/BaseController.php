<?php

namespace App;

abstract class BaseController
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
}