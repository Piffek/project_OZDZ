<?php 

$router->get('',  'IndexController', 'index');

$router->get('facebookLogin',  'LoginFbController', 'login');
