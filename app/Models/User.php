<?php

namespace App\Models;

use Src\Model;

class User extends Model
{
    public function ifIsset($email)
    {
        $ifIsset = $this->get('email', 'User', 'email', $email);

        if (isset($ifIsset['email'])) {
            return true;
        }

        return false;
    }
}