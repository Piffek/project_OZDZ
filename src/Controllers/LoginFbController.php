<?php

namespace Src\Controllers;

use App\Controller;
use Src\Helpers\ConnectToFb;


/**
 * addCurrentUserDataToDb() - add data user to db.
 */
class LoginFbController extends Controller
{
    protected $provider;
    
    public function __construct(){
        $this->provider = $this->getProviders('FacebookService');
    }
    /**
     * Move by all method in this class.
     * config - load ConnectToFb.
     * helper and fb to validation and return error.
     * 
     * redirect to start page.
     */
    public function login()
    {
        $config = new ConnectToFb();
        $fb = $config->connect();
        $helper = $fb->getRedirectLoginHelper();
        $this->provider->validator($helper, $fb);
        $this->provider->addCurrentUserDataToDb();
        header("Location: http://localhost:8000/");
    }
}