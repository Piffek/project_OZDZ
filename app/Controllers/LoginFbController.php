<?php

namespace App\Controllers;

use Src\Controller;
use App\Helpers\ConnectToFb;

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
        $this->getService('FacebookService')->validator();
        $this->getService('FacebookService')->addCurrentUserDataToDb();
        header("Location: http://localhost:8000/");
    }
}