<?php 

$router->get('',  'IndexController', 'index22');

$router->get('facebookLogin',  'LoginFbController', 'login');

$router->post('rodzaj', 'KindController', 'index');

$router->get('wyslij_maile', 'MailController', 'sendToAllUsers');
