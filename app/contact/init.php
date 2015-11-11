<?php
	require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'autoload.php');
	if(file_exists('controller.php'))
		require_once('controller.php');
	if(file_exists('model.php'))
		require_once('model.php');