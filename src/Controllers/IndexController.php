<?php
namespace Src\Controllers;
use Src\Models\User;
use App\Controller;
use Src\Helpers\ConnectToFb;

class IndexController extends Controller
{
    public function index()
    {
        /**
         * Show start page with login to fb button.
         */
        $config = new ConnectToFb();
        $fb = $config->connect();
        
        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl('http://localhost/facebookLogin', $permissions);

        $user = new User();
        
        $session = isset($_SESSION['username']) ? $_SESSION['username'] : null;
        
        echo $this->render(
            'index.html.twig', array(
            'user' => $user->getAll('user'),
            'loginToFb' => $loginUrl,
            'session' => $session,
            )
        );
        
    }

}
