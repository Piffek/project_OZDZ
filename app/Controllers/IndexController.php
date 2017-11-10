<?php

namespace App\Controllers;

use App\Models\User;
use Src\Controller;
use App\Helpers\SendingMail;

class IndexController extends Controller
{
    /**
     * Show start page with login to fb button.
     */
    public function index()
    {
        $user = new User();
        $session = isset($_SESSION['username']) ? $_SESSION['username'] : null;
        $loginUrl = $this->getService('FacebookService')->loginurl;
        
        $sending = new SendingMail();
        $sending->Send();
        
        echo $this->render(
            'index.html.twig', array(
            'user' => $user->getAll('user'),
            'loginToFb' => $loginUrl,
            'session' => $session,
            )
        );
    }
    
    
}