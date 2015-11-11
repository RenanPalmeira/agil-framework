<?php

namespace Agil\Config;

define('DS', DIRECTORY_SEPARATOR);
define('APP_ROOT', realpath(__DIR__ . DS . '..'));

define('ENVIRONMENT', 'development');
date_default_timezone_set('America/Sao_Paulo');

if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
	ini_set('display_errors', 1);
	error_reporting(E_ALL | E_STRICT);
}

return array(
	'DS'            => DIRECTORY_SEPARATOR,
	'G_SECRET'      => '6LePpQwTAAAAAJhIitO57S9A835wjJT2iG6AC7q1',
	'APP_ROOT'      => realpath(__DIR__ . DS . '..'),
	'APP'           => realpath(__DIR__ . DS . '..' . DS . '..'),
	'ENVIRONMENT'   => 'development',
	'LANGUAGE_CODE' => 'pt-br',
	'URL'           => 'http://localhost',
	'IMAGES'        => array("jpeg", "jpg", "png"),
	'STATIC'        => APP_ROOT.'\\..\\static',
	'MEDIA'         => APP_ROOT.'\\..\\media'.DIRECTORY_SEPARATOR,
	
	'DB_TYPE' => array(
		
		'SQLITE' => array(
			'DRIVER'   => 'sqlite',
			'DATABASE' => APP_ROOT . DS . '..' . DS . 'app' . DS . 'database'. DS .'agil.sqlite3',
		),
		
		'MYSQL' => array(
			'DRIVER'    => 'mysql',
			'HOST'      => 'localhost',
			'DATABASE'  => 'tecfalcon',
			'USER'      => 'root',
			'PASS'      => '',
			'CHARSET'   => 'utf8',
		),

		'PGSQL' => array(
            'DRIVER'   => 'pgsql',
            'HOST'     => 'localhost',
            'DATABASE' => 'agil',
            'USER' 	   => 'forge',
            'PASS'     => '',
			'CHARSET'   => 'utf8',
		),
	),
);