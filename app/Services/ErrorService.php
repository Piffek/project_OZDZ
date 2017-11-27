<?php

namespace App\Services;

class ErrorService
{
    private $config;

    public function __construct($config)
    {

        $this->config = $config;
    }

    public function log(string $message, int $message_type)
    {
        error_log($message, $message_type, $this->config['PATH']);
    }
}