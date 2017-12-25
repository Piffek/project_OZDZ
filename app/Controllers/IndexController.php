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
        $user = new User;
        if(isset($_SESSION['username'])){
            $userData = $user->get('isAdmin, blocked', 'user', 'nameUser', $_SESSION['username']);
        }

        $allUser = $user->getAll('user');
        echo $this->render('index.html.twig', [
                'loginToFb' => $loginUrl,
                'loginToG_plus' => $googleLogin,
                'session' => $session,
                'get' => $_GET,
                'allUser' => $allUser,
                'userData' => isset($userData) ? $userData : '',
            ]);
    }
}