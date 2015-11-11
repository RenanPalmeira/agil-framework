<?php
	require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'autoload.php');

	require_once('layout/head.php');

	use Agil\Session\Session as Session;

	Session::start();
	if(Session::exist('logado')) {
		require_once('layout/online/base.php');
	}
	else{
		require_once('layout/menu.php');
		require_once('layout/offline/home.php');
		require_once('layout/footer.php');
	}

?>