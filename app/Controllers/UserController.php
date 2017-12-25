<?php

namespace App\Controllers;

use App\Models\User;
use Src\Controller;

class UserController extends Controller
{
    public function blocked()
    {
        $user = new User;
        $user->updateOne('user', 'blocked', '1', (int) $this->request['id']);
        header('Location: http://localhost:8000/?message=dodano już tę kategorie');
    }

    public function unlocked()
    {
        $user = new User;
        $user->updateOne('user', 'blocked', '0', (int) $this->request['id']);
        header('Location: http://localhost:8000/?message=dodano już tę kategorie');
    }
}