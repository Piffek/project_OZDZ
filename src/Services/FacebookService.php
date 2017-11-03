<?php

namespace Src\Services;

use Facebook\Facebook;
use Src\Models\User;

class FacebookService
{
    /**
     * Validate params.
     *
     * @param Facebook    $helper
     * @param ConnectToFb $fb
     */
    public function validator($helper, $fb)
    {
        try {
            $accessToken = $helper->getAccessToken();
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        
        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }
        $this->tokenValidator($fb, $accessToken);
    }
    
    /**
     * Validator token and token to session.
     *
     * @param Facebook $fb
     * @param Facebook $accessToken
     */
    public function tokenValidator($fb, $accessToken)
    {
        $oAuth2Client = $fb->getOAuth2Client();
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        $tokenMetadata->validateAppId(getenv('FB_KEY'));
        $tokenMetadata->validateExpiration();
        
        if (! $accessToken->isLongLived()) {
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
                exit;
            }
            echo '<h3>Long-lived</h3>';
            var_dump($accessToken->getValue());
        }
        
        $_SESSION['fb_access_token'] = (string) $accessToken;
    }
    
    /**
     * Add email and id user to db and add username to session.
     */
    public function addCurrentUserDataToDb()
    {
        $data = 'https://graph.facebook.com/me?access_token='.$_SESSION['fb_access_token'];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $data);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        
        $array = json_decode($output, true);
        $userId = $array['id'];
        $username = $array['name'];
        $user = new User();
        $user->insert(
            'User',
            [
                'idUser' => $userId,
                'nameUser' => $username,
            ]
            );
        $_SESSION['username'] = $username;
        
        curl_close($ch);
    }
}