<?php

namespace App\Controllers;

use App\Models\User;
use Src\Controller;

class IndexController extends Controller
{
    /**
     * Show start page with login to fb button.
     */
    public function index()
    {
        $session = isset($_SESSION['username']) ? $_SESSION['username'] : null;
        $loginUrl = $this->getService('FacebookService')->loginurl;
        $googleLogin = $this->getService('GooglePlusService')->authUrl;

        echo $this->render('index.html.twig', [
                'loginToFb' => $loginUrl,
                'loginToG_plus' => $googleLogin,
                'session' => $session,
                'get' => $_GET,
            ]);
    }
}