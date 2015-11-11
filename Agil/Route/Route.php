<?php

namespace Agil\Route;

use Agil\Core\FileSystem as FileSystem;
use Agil\Route\Repl as Repl;

class Route extends Repl {
	public $number = 0;
	public $apt_control = array('index', 'create', 'edit', 'delete', 'list');
	public $verbs = array('GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS');
	private $base =  array();

	function __construct(){
		$this->base['/static/'] = array('regex'=>'[a-z]\.css');
	}

	public function __call($method, $args)
   	{	
   		if(!in_array(strtoupper($method), $this->verbs))
			throw new \Exception("unknown method [$method]");
		if(count($args)!=2)
			throw new \Exception("error in args [$method][$args]");
		try {
			$path = $args[0];
			$response = $args[1];
			$method = $method;
			if(gettype($response)=='string') 
				$this->composer($path, $response, $method);
			else
				$this->composer($path, $response, $method);	
		} 
		catch (Exception $e) {
			throw new \Exception($e);
		}
    }

    public function templated($callback){
    	return $callback;
    }

	public function composer($path, $response, $method='GET') {
		if (gettype($response)=='object') {
			$this->base[$path] = $response;
		}
		else if (gettype($response)=='string') {

			if(strpos($response,'@') !== false){
				$this->base[$path] = $response;
			}
			else {

				foreach ($this->apt_control as $key => $value) {
					if ($value=='index')
						$this->base[$path.'/'] = $response."@".$value;
					else
						$this->base[$path.'/'.$value] = $response."@".$value;
				}
			}
		}
	}
	public function render($response, $method) {
		if (gettype($response)=="object")
			return $response();
		else if (gettype($response)=="string")
			return $this->getController($response, $method);
	}

	public function getPathResponse($path=null) {
		$post = array();

		if(!empty($_POST)) {
			$post = $this->pre_post($_POST);
		}


		if(array_key_exists($path, $this->base)){
			return $this->render($this->base[$path], $post);
		}
		else if($this->check_regex_route($path, $this->base)){
			return $this->regex_render($path, $this->base);
		}
		echo 'NotFound';
	}
}