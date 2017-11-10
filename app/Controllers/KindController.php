<?php

namespace App\Controllers;

use Src\Controller;
use App\Models\Category;

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
}