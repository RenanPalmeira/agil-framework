<?php

namespace Agil\Database;

use PDO;
use PDOException;
use Agil\Config\Config as Config;

class Database {
	
	protected $pdo;
	protected $database;
	protected $driver;

	function __construct(){
		$this->Connect();
	}

	function __destruct(){
		$this->close();
	}

	public function Connect() {
		$env = Config::get(array('DB_TYPE'=>'MYSQL'));
		
		$this->database = $env['DATABASE'];
		$this->driver = $env['DRIVER'];

		if ($env['DRIVER'] == 'mysql') {
			try {
				$this->pdo = new PDO($env['DRIVER'] . ':host=' . $env['HOST'] . ';dbname=' . $env['DATABASE'], $env['USER'], $env['PASS'], array(PDO::ATTR_PERSISTENT => true));
			}
			catch (PDOException $e) {
				echo $e->getMessage();
				die();
			}
		}
		
		if ($env['DRIVER'] == 'pgsql') {
			try {
				$this->pdo = new PDO($env['DRIVER'] . ':dbname=' . $env['DATABASE'] . ';host=' . $env['HOST'], $env['USER'], $env['PASS']);
			}
			catch (PDOException $e) {
				echo $e->getMessage();
				die();
			}
		}
		
		if ($env['DRIVER'] == 'sqlite') {
			try {
				if(!empty($env['DATABASE'])){
					$this->pdo = new PDO($env['DRIVER'] . ':' . $env['DATABASE']);
				}
				else{
					$this->pdo = new PDO($env['DRIVER'] . '::memory');
				}
			}
			catch (PDOException $e) {
				echo $e->getMessage();
				die();
			}
		}

		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		
		return $this->pdo;
	}
	
	public function close(){
		$this->pdo = null;
	}
}