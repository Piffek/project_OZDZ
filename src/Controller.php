<?php

namespace Src;

use Src\Service\ServiceProvider;
use Dotenv\Dotenv;

class Controller extends ServiceProvider
{
    protected $request;

    public $provider;

    /**
     * Get param from URL and generate env.
     *
     * @param unknown $request
     */
    public function __construct($request)
    {
        $this->request = $request;
        $env = __DIR__.'/..';
        $dotenv = new Dotenv($env);

        $dotenv->load();
    }

    /**
     * Render twig template.
     *
     * @param string $template
     * @param array $parameters
     * @return string
     */
    public function render(string $template, array $parameters = array()): string
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../app/Views');
        $twig = new \Twig_Environment($loader);

        return $twig->render($template, $parameters);
    }
}