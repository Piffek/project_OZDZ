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

        $ifIsset = $category->getAll('Category');

        foreach ($ifIsset as $user){

            if($user->user_email === $_SESSION['user_email'] && $user->name === $_POST['kind']){
                header('Location: http://localhost:8000/?message=dodano już tę kategorie');
                return false;
            }
        }

        header('Location: http://localhost:8000/?message=dodano pomyślnie');
        return $category->insert('Category', ['user_email' => $_SESSION['user_email'], 'name' => $_POST['kind']]);

    }

    public function getByData()
    {
        $api = new API();
        $api->setBasicUrl('http://irollup.co.uk/project/');
        $api->setFileInBasicUrl([
            'politic' => 'getApi.php?',
            'sport' => 'getApiSport.php?',
            'anything' => 'getApiWeather.php?',
            'music' => 'getApiMusic.php?',
        ]);
        $api->get($_GET, 'kind');

        $apiResult = json_decode($api->getResult());

        echo $this->render(
            'kind.html.twig', array(
                'apiResult' => $apiResult,
            )
        );
    }
}