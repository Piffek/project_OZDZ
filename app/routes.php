<?php 

$router->get('',  'IndexController', 'index');

$router->get('facebookLogin',  'LoginFbController', 'login');

$router->post('rodzaj', 'KindController', 'index');

$router->get('wyslij_maile', 'KindController', 'sendToAllUsers');
