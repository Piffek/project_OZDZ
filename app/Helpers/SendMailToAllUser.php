<?php

namespace App\Helpers;

use App\Models\Category;
use Src\PHPMailer\Mailer;

class SendMailToAllUser
{

    public function send(Category $category)
    {

        $name = $category->getAll('category');

        foreach ($name as $row) {
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
        if ($category === 'sport') {
            $news = file_get_contents('http://irollup.co.uk/project/getApiSport.php/?pass=415d7fe0d9f4fff5977c50d786ca5b9871a7e778');
        } else if ($category === 'politic') {
            $news = file_get_contents('http://irollup.co.uk/project/getApi.php/?pass=415d7fe0d9f4fff5977c50d786ca5b9871a7e778');
        } else if ($category === 'music') {
            $news = file_get_contents('http://irollup.co.uk/project/getApiMusic.php/?pass=415d7fe0d9f4fff5977c50d786ca5b9871a7e778');
        } else if ($category === 'anything') {
            $news = file_get_contents('http://irollup.co.uk/project/getApiWeather.php/?pass=415d7fe0d9f4fff5977c50d786ca5b9871a7e778');
        }

        $dec = json_decode($news);
        $tresc = "";

        foreach ($dec as $d) {
            $tresc .= '</br><a target="_blank" href="' . $d->link . '">' .
                '<div class="tile">' .
                '<table>' .
                '<col class="imgCol">' .
                '<col class="contentCol">' .
                '<tr><td rowspan="5"><div class="img"><img src="' . $d->img . '"/></div></td></tr>' .
                '<tr><td><div class="title">' . $d->title . '</div></td></tr>' .
                '<tr><td><div class="description">' . $d->description . '</div></td></tr>' .
                '<tr><td><div class="link">' . $d->link . '</div></td></tr>' .
                '<tr><td><div class="date">' . $d->date . '</div></td></tr>' .
                '</table></div></a>';

            $tresc .= $d->title;
        }

        return '  <!DOCTYPE html>
                    <html>
                    <body>
            
                    <h3>Twoje nowe wiadomości:</h3>
                       ' . $tresc . ' 
                    <p><b>Jeśli chcesz przerwać subskrypcję, skontaktuj się z administratorem strony.</b></p>
                        
                    </body>
                    </html>
            ';

    }
}