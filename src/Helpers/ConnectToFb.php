<?php

namespace Src\Helpers;

class ConnectToFb
{
    /**
     * Must have to login faceboo.
     *
     * @return \Facebook\Facebook
     */
    public function connect()
    {
        $fb = new \Facebook\Facebook(
            [
                'app_id' => getenv('FB_KEY'),
                'app_secret' => getenv('FB_SECRET'),
                'default_graph_version' => 'v2.9'
            ]
        );
        
        return $fb;
    }
}