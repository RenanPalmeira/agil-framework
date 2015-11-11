<?php
	/**
	 *  Agil Framework
	 *
	 *  @author Renan & Wellington
	 *  @version 1.0
	 */
	function __autoload($class){
		$class = dirname(__FILE__) . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
		if(!file_exists($class))
			throw new Exception("Not found [$class]");
		require_once($class);
	}