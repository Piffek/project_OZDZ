<?php 

$router->get('',  'IndexController', 'index');

$router->get('facebookLogin',  'LoginController', 'facebook');

$router->post('rodzaj', 'KindController', 'index');

$router->get('wyslij_maile', 'MailController', 'sendToAllUsers');
