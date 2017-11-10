<?php

namespace App\Helpers;

use App\Models\Category;
use Src\PHPMailer\Mailer;

class SendMailToAllUser
{
    
    public function send(Category $category)
    {
        
        $name = $category->getAll('category');
        
        foreach($name as $row){
            $mailer = new Mailer(
                [$row->user_email, 'Patryk'],
                [$row->user_email, $row->user_email],
                $this->createBody($row->name),
                'cossubject');
                $mailer->mail();
        }
    }
    
    public function createBody($category)
    {
        if($category === 'sport'){
            $news = file_get_contents('http://irollup.co.uk/project/getApiSport.php/?pass=415d7fe0d9f4fff5977c50d786ca5b9871a7e778');
        }else if($category === 'politic'){
            $news = file_get_contents('http://irollup.co.uk/project/getApi.php/?pass=415d7fe0d9f4fff5977c50d786ca5b9871a7e778');
        }else if($category === 'music'){
            $news = file_get_contents('http://irollup.co.uk/project/getApiMusic.php/?pass=415d7fe0d9f4fff5977c50d786ca5b9871a7e778');
        }else if($category === 'anything'){
            $news = file_get_contents('http://irollup.co.uk/project/getApiWeather.php/?pass=415d7fe0d9f4fff5977c50d786ca5b9871a7e778');
        }
        
        $dec = json_decode($news);
        $t = "";
        
        foreach($dec as $d){
            $t .= $d->title;
        }
        
        return '  <!DOCTYPE html>
                    <html>
                    <body>
            
                    <h1>'.$t.'</h1>
                        
                    <p><b>My first paragraph.</b></p>
                        
                    </body>
                    </html>
            ';
        
    }
}