<?php

namespace Agil\Config;

class Config {
	public static $config;

	public static function get($key){
		if(gettype($key) == 'string'){
			$key = strtoupper($key);
		}

		if (!self::$config) {
			self::$config = require_once('Bootstrap.php');
		}

		if (is_array($key)) {
			foreach ($key as $k => $v) {
				return self::$config[$k][$v];
			}
		}
		
		return self::$config[$key];
	}
}