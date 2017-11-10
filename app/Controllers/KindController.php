<?php

namespace App\Controllers;

use Src\Controller;
use App\Models\Category;
use App\Models\User;

class KindController extends Controller
{
    /**
     * Add category to database.
     */
    public function index()
    {
        $category = new Category();
        $category->insert('Category', ['user_email' => $_SESSION['user_email'], 'name' => $_POST['kind']]);
    }

}