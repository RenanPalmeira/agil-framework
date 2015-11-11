<?php

namespace Agil\Route;

use Agil\Config\Config as Config;
use Agil\Core\FileSystem as FileSystem;

class Repl {

	public $regex = "/([a-zA-Z1-9\.\@\\\!\?\,\.\/ ]+)/";
	public function pre_post($post) {
		$return_post = array();
		if(gettype($post)=='array') {
			foreach ($post as $key => $value) {
				if(!empty($value) && (bool)preg_match($this->regex, $value)) {
					$return_post[$key] = htmlspecialchars($value);
				}
			}
			return $return_post;
		}
		return false;
	}

	public function http($content) {
		$headers = sprintf('Content-Type: text/html');
		
		header($headers);
		return $content;
	}

	public function prepare_regex($ex, $obj) {
		return (bool)preg_match($ex, $obj);
	}

	public function check_regex_route($path, $base){
		foreach ($base as $route => $http) {
			$route = preg_replace("/[\/\/ ]/", "", $route);
			if(preg_match("/(".$route.")/", $path))
				return true;
		}
		return false;
	}

	public function regex_render($path, $base) {
		foreach ($base as $route => $http) {
			$route = preg_replace("/[\/\/ ]/", "", $route);
			
			if (preg_match("/(".$route.")/", $path)) {
				$static_folder = Config::get('static')."\\..";
				$static_folder .= str_replace("/", "\\", $path);

				if(is_file($static_folder)){
					$content = new FileSystem();
					return $content->render($static_folder);
				}
			}
		}
		return "Not Found";
	}

	public function prepare_path($path) {
		if(gettype($path)=='string') {
			$ex = "/^\/[a-z0-9\.\/\\\?\-\&]+$/";
			if (preg_match($ex, $path)) {
				return $path;
			}	
		}
		else
			throw new \Exception("DIEE Mother F*ck");
	}
	public function prepare_controller($path) {
		if(gettype($path)=='string') {
			$ex = array(
				"/([a-zA-Z]+)\@([a-zA-Z]+)/",
				"/([a-zA-Z]+)/"
			);
			if (preg_match($ex[0], $path, $action)) {
				return array($action[1].'Controller', $action[2]);
			}	
			else if (preg_match($ex[1], $path, $action)){
				return array($action[1].'Controller', "index");
			}
		}
		else
			throw new \Exception("DIEE Mother F*ck");
	}
	public function getController($controlName, $response=null) {
		try {
			$response_method = array();
			if(!empty($response))
				$response_method[] = array('POST' => $response);
			else
				$response_method[] = array();
			
			$control_info = $this->prepare_controller($controlName);
			$controller = "App\\Controller\\".$control_info[0];
			$controller = new $controller();
			if(method_exists($controller, $control_info[1]))	
				return call_user_func_array(array($controller, $control_info[1]), $response_method);
			return 'Not Found';
		} 
		catch (\Exception $e) {
			echo $e;	
		}

	}
}