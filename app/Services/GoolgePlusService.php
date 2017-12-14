<?php

namespace App\Services;

use App\Models\User;

class GoolgePlusService
{
    protected $config;

    private $authService;

    public $authUrl;

    public $client;

    public $userData;

    public function __construct($config)
    {
        $this->config = $config['google_plus'];
        $this->authUrl = $this->connect()->createAuthUrl();
        $this->client = $this->connect();
        $this->authService = new \Google_Service_Oauth2($this->client);
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

    public function afterRedirect($get)
    {
        if (isset($get['code'])) {
            $this->client->authenticate($get['code']);
            header("Location:".$this->config['redirect_url']);
        }

        $_SESSION['access_token'] = $this->client->getAccessToken();

        if ($_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
        }

        if ($this->client->getAccessToken()) {
            $this->addUserDataToDb($this->authService->userinfo_v2_me->get());
        }
    }

    public function addUserDataToDb($g_plus_user_info)
    {
        $userName = $g_plus_user_info->name ? $g_plus_user_info->name : $g_plus_user_info->email;

        $_SESSION['username'] = $userName;

        $user = new User();

        $ifIsset = $user->get('email', 'User', 'email', $g_plus_user_info->email);

        if(!isset($ifIsset['email'])){
            $user->insert('User', [
                'idUser' => $g_plus_user_info->id,
                'nameUser' => $userName,
                'email' => $g_plus_user_info->email,
                'picture' => $g_plus_user_info->picture,
            ]);
        }

    }
}