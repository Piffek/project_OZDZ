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

    const SSL_VER = fasle;

    const TRANSFER = true;

    public function create(string $url)
    {
        $ch = curl_init();

        curl_setopt($ch, SSL_VER, self::SSL_VER);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, self::TRANSFER);

        curl_setopt($ch, CURLOPT_URL, $url);

        $this->result = curl_exec($ch);

        curl_close($ch);
    }

    public function getResult()
    {
        var_dump(json_decode($this->result, true));
    }
}