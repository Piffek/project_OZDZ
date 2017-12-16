<?php

namespace App\Controllers;

use App\Helpers\CURL;
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

    public function getByData()
    {
        $curl = new CURL();
        switch($_GET['kind']){
            case 'anything':
                $url = 'http://irollup.co.uk/project/getApi.php?'.$_GET['what'].'='.$_GET['number'];
                $curl->create($url);
                break;
            case 'sport':
                $url = 'http://irollup.co.uk/project/getApiSport.php?'.$_GET['what'].'='.$_GET['number'];
                $curl->create($url);
                break;
            case 'weather':
                $url = 'http://irollup.co.uk/project/getApiWeather.php?'.$_GET['what'].'='.$_GET['number'];
                $curl->create($url);
                break;
            case 'music':
                $url = 'http://irollup.co.uk/project/getApiMusic.php?'.$_GET['what'].'='.$_GET['number'];
                $curl->create($url);
                break;
        }
        var_dump(json_encode($curl->getResult()));
    }

}