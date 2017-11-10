<?php

namespace App\Controllers;

use App\Models\User;
use Src\Controller;
use Src\PHPMailer\Mailer;

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
        //$mailer = new Mailer(['patrykpiwko123412@gmail.com', 'Patryk'], ['patryk123412@op.pl', 'Patryk2'], 'cos', 'cossubject');
        //$mailer->mail();
        echo $this->render(
            'index.html.twig', array(
            'user' => $user->getAll('user'),
            'loginToFb' => $loginUrl,
            'session' => $session,
            )
        );
    }
}