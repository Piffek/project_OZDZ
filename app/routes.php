<?php 

$router->get('',  'IndexController', 'index');

$router->get('facebookLogin',  'LoginController', 'facebook');

$router->get('gplusLogin',  'LoginController', 'googlePlus');

$router->post('rodzaj', 'KindController', 'index');

$router->get('wyslij_maile', 'MailController', 'sendToAllUsers');

$router->get('dane', 'KindController', 'getByData');

$router->get('userBan', 'UserController', 'blocked');

$router->get('userUnBan', 'UserController', 'unlocked');

//search
$router->get('product', 'ProductController', 'search');
