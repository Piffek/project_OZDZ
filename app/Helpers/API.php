<?php

namespace App\Helpers;

use App\Helpers\CURL;

class API extends CURL
{
    private $basicURL;

    private $paramInGet_file = [];

    /**
     * API constructor.
     *
     * @param string $basicUrl
     * @param array $paramInGet_file Param from get and file from api.
     */
    public function __construct(string $basicUrl, array $paramInGet_file)
    {
        $this->basicURL = $basicUrl;
        $this->paramInGet_file = $paramInGet_file;
    }

    public function get(array $get, string $paramToCheckDataFromSwitch)
    {
        foreach ($this->paramInGet_file as $param => $file) {
            switch ($get[$paramToCheckDataFromSwitch]) {
                case $param:
                    $url = $this->basicURL.$file.$_GET['what'].'='.$_GET['number'];
                    $this->create($url);
                    break;
            }
        }
    }
}