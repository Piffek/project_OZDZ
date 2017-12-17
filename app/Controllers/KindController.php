<?php

namespace App\Controllers;

use App\Helpers\API;
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
        $api = new API('http://irollup.co.uk/project/',
            [
                'anything' => 'getApi.php?',
                'sport' => 'getApiSport.php?',
                'weather' => 'getApiWeather.php?',
                'music' => 'getApiMusic.php?',
            ]);
        $api->get($_GET, 'kind');

        $apiResult = json_encode($api->getResult());

        echo $this->render(
            'kind.html.twig', array(
                'apiResult' => $apiResult,
            )
        );
    }
}