<?php

namespace Src\Controllers;

use App\Controller;
use Src\Helpers\ConnectToFb;

/**
 * addCurrentUserDataToDb() - add data user to db.
 */
class LoginFbController extends Controller
{
    
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
        $this->getService('FacebookService')->validator($helper, $fb);
        $this->getService('FacebookService')->addCurrentUserDataToDb();
        header("Location: http://localhost:8000/");
    }
}