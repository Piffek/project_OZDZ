<?php

namespace App\Controllers;

use Src\Controller;
use App\Helpers\ConnectToFb;

/**
 * addCurrentUserDataToDb() - add data user to db.
 */
class LoginController extends Controller
{
    /**
     * Move by all method in this class.
     * config - load ConnectToFb.
     * helper and fb to validation and return error.
     *
     * redirect to start page.
     */
    public function facebook()
    {
        $this->getService('FacebookService')->validator();
        $this->getService('FacebookService')->addCurrentUserDataToDb();
        header("Location: http://localhost:8000");
    }

    /**
     * login by google plus
     */
    public function googlePlus()
    {
        $this->getService('GooglePlusService')->afterRedirect($this->request);
        header("Location: http://localhost:8000");
    }
}