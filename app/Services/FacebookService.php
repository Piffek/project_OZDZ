<?php

namespace App\Services;

use Facebook\Facebook;
use App\Models\User;
use App\Helpers\ConnectToFb;

class FacebookService
{
    protected $helper, $config, $connectToFb;
    public $loginurl;
    
    public function __construct(ConnectToFb $connectToFb)
    {
        $this->connectToFb = $connectToFb;
        $this->fb = $this->connectToFb->connect();
        $this->helpers = $this->fb->getRedirectLoginHelper();
        $this->loginurl = $this->helper();
    }
    
    public function helper(){
        return $this->helpers->getLoginUrl('http://localhost:8000/facebookLogin', ['email']);
    }
    /**
     * Validate params.
     *
     * @param Facebook    $helper
     * @param ConnectToFb $fb
     */
    public function validator()
    {
        try {
            $accessToken = $this->helpers->getAccessToken();
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        
        if (! isset($accessToken)) {
            if ($this->helpers->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $this->helpers->getError() . "\n";
                echo "Error Code: " . $this->helpers->getErrorCode() . "\n";
                echo "Error Reason: " . $this->helpers->getErrorReason() . "\n";
                echo "Error Description: " . $this->helpers->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }
        $this->tokenValidator($accessToken);
    }
    
    /**
     * Validator token and token to session.
     *
     * @param Facebook $fb
     * @param Facebook $accessToken
     */
    public function tokenValidator($accessToken)
    {
        $oAuth2Client = $this->fb->getOAuth2Client();
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
       $this->fb->setDefaultAccessToken($_SESSION['fb_access_token']);
       $response = $this->fb->get('/me?locale=pl_PL&fields=name,email');
       $userNode = $response->getGraphUser();
       
        $user = new User();
        $user->insert(
            'User',
            [
                'idUser' => $userNode['id'],
                'nameUser' => $userNode['name'],
                'email' => $userNode['email'],
            ]
            );
        $_SESSION['user_email'] = $userNode['email'];
        $_SESSION['username'] = $userNode['name'];
       
    }
}