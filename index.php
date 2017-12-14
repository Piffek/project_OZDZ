<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	

	
	use Src\Router;
	require 'bootstrap.php';

    session_start();
	Router::load(__DIR__ . '/app/routes.php');
