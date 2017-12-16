<?php
/**
 * Created by PhpStorm.
 * User: patrykpiwko
 * Date: 16.12.2017
 * Time: 23:49
 */

namespace App\Helpers;

class CURL
{
    private $result;

    const SSL_VER = false;

    const TRANSFER = true;

    public function create(string $url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, self::SSL_VER);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, self::TRANSFER);

        curl_setopt($ch, CURLOPT_URL, $url);

        $this->result = curl_exec($ch);

        curl_close($ch);

    }

    public function getResult()
    {
        return $this->result;
    }
}