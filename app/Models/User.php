<?php

namespace App\Models;

use Src\Model;

class User extends Model
{
    private $id;

    private $email;

    private $nameUser;

    private $idUser;

    public function ifIsset($email)
    {
        $ifIsset = $this->get('email', 'User', 'email', $email);

        if (isset($ifIsset['email'])) {
            return true;
        }

        return false;
    }
}