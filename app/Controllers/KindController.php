<?php

namespace App\Controllers;

use Src\Controller;
use App\Models\Category;
use App\Helpers\SendMailToAllUser;

class KindController extends Controller
{
    /**
     * Add category to database.
     */
    public function index()
    {
        $category = new Category();
        return $category->insert('Category', ['user_email' => $_SESSION['user_email'], 'name' => $_POST['kind']]);
    }
    
    public function sendToAllUsers()
    {
        $sendToAll = new SendMailToAllUser();
        return $sendToAll->send(new Category());
    }
}