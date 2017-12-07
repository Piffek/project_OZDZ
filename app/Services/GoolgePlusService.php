<?php

namespace App\Services;

class GoolgePlusService
{
    protected $config;
    private $authService;
    public $authUrl;
    public $client;
    public $userData;

    public function __construct($config)
    {
        $this->authService = new \Google_Service_Oauth2($this->connect());
        $this->config = $config['google_plus'];
        $this->authUrl = $this->connect()->createAuthUrl();
        $this->client = $this->connect();
    }

    public function connect()
    {
        $client = new \Google_Client();
        $client->setApplicationName($this->config['application_name']);
        $client->setClientId($this->config['client_id']);
        $client->setClientSecret($this->config['client_secret']);
        $client->setRedirectUri($this->config['redirect_url']);
        $client->setDeveloperKey($this->config['api_key']);
        $client->setAccessType("offline");
        $client->addScope("https://www.googleapis.com/auth/userinfo.email");
        return $client;
    }

    public function afterRedirect($get){
        if(isset($get['code'])){
            $this->client->authenticate($get['code']);
            header("Location:" . $this->config['redirect_url']);
        }

        $_SESSION['access_token'] = $this->client->getAccessToken();


        if($_SESSION['access_token']){
            $this->client->setAccessToken($_SESSION['access_token']);
        }

        if($this->client->getAccessToken()){
            $this->userData = $this->authService->userinfo->get();
        }
    }

}