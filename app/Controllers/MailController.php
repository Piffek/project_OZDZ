<?php

namespace App\Controllers;

use App\Helpers\SendMailToAllUser;
use App\Models\Category;
use Src\Controller;

class MailController extends Controller
{
    public function sendToAllUsers()
    {
        $sendToAll = new SendMailToAllUser();
        $sendToAll->send(new Category());

        echo $this->render('mailing.html.twig');
    }
}