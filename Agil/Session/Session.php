<?php

namespace Agil\Session;

class Session {
	private static $key;
	public static function start(){
		session_start();
	}

	public static function escape($key = null){
		$key = $key!=null ? $key : self::$key;
		if(empty($_SESSION[$key])) {
			self::clear();
			self::destroy();
			return "<script type=\"text/javascript\">window.parent.location.href='/';</script><noscript>Clique aqui</a></noscript>";
		}
		return '';
	}

	public static function update($key, $value){
		if(!empty($_SESSION[$key])){
			$_SESSION[$key]=$value;
		}
		return true;
	}

	public static function set($key, $value){
		if(empty($_SESSION[$key])){
			if(isset($value))
				$_SESSION[$key]=$value;
		}
		return true;
	}
	
	public static function get($key){
		if(!empty($_SESSION[$key])){
			self::$key = $key;
			return $_SESSION[$key];
		}
		else
			return false;
	}
	
	public static function exist($key){
		if(!empty($_SESSION[$key])) {
			self::$key = $key;
			return true;
		}
		else
			return false;
	}
	
	public static function clear($key = null){
		$key = $key ? $key : self::$key;
		if(isset($_SESSION[$key]))
			unset($_SESSION[$key]);
		
		return true;
	}
	
	public static function destroy(){
		session_destroy();
	}
}