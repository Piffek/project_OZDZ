<?php

namespace App\Controllers;

use App\Helpers\CURL;
use Src\Controller;

class ProductController extends Controller
{

    public function search()
    {
        $curl = new CURL();
        $curl->create('http://irollup.co.uk/project/getAllBySubject.php/?subject='.$this->request['search']);
        $apiResult = json_decode($curl->getResult());

        $search = function() use ($apiResult) {
            $content = '';
            foreach($apiResult as $res){
                foreach ($res as $result){
                    $content .= '<ul>
                        <li><img style="height:200px; width:200px"  src="'.$result->img.'">
                            <h3><a href="'.$result->link.'" alt="'.$result->title.'">'.$result->title.'</a></h3></li>
                        '.$result->description.'
                        <hr>
                    </ul>';
                }
                return $content;
                }

        };
        echo $search();

    }
}