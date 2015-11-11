<?php
	require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'autoload.php');
	if(file_exists('model.php'))
		require_once('model.php');

	use Agil\Session\Session as Session;
	
	Session::start();

	if(!Session::exist('logado') || (bool)Session::exist('logado')==false) {
		echo Session::escape();
		die();
	}