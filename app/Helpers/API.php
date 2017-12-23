<?php

namespace App\Helpers;

use App\Helpers\CURL;

class API extends CURL
{
    private $basicURL;

    private $fileOnServerFromBasicUrl = [];

    public function setBasicUrl(string $url)
    {
        $this->basicURL = $url;
    }

    public function setFileInBasicUrl(array $fileOnServerFromBasicUrl)
    {
        $this->fileOnServerFromBasicUrl = $fileOnServerFromBasicUrl;
    }

    /**
     * @param array $Magic method GET
     * @param string $paramToCheckDataFromSwitch
     */
    public function get(array $get, string $paramToCheckDataFromSwitch)
    {
        foreach ($this->fileOnServerFromBasicUrl as $param => $file) {
            switch ($get[$paramToCheckDataFromSwitch]) {
                case $param:
                    $url = $this->generateUrl($get, $file);
                    $this->create($url);
                    break;
            }
        }
    }

    private function generateUrl(array $get, string $file)
    {
        if ($get['what'] !== 'all') {
            return $this->basicURL.$file.$get['what'].'='.$get['number'];
        } else {
            return $this->basicURL.$file.$get['what'].'&'.'year='.$get['year'].'&'.'month='.$get['month'].'&'.'day='.$_GET['day'];
        }
    }
}