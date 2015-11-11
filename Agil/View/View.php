<?php

namespace Agil\View;

use Agil\Config\Config as Config;
use Agil\Element\Element as Element;
use Agil\Element\Data\Data as Data;

class View {

	public static function route($get) {
		if(gettype($get)=='array' && !empty($get)) {
			$get = array_combine(
			    array_map("strtolower", array_keys($get)),
			    array_map("htmlspecialchars", array_values($get))
			);

			$values = array_map(function($item) {
				return htmlspecialchars(addslashes($item));
			}, array_values($_POST));

			$post = array();
			if(!empty($_POST)) {
				$post = array_combine(
			    	array_map("strtolower", array_keys($_POST)),
			    	$values
				);	
			}
			
			$request = array_merge($_GET, $_SERVER, $post);
			$request['METHOD'] = $request['REQUEST_METHOD'];
			unset($request['REQUEST_METHOD']);

			
			return $request;
		}
	}

	public static function NotFound() {
		die();
	}

	public static function HttpResponse($response) {
		return $response;
	}

	public static function Ajax($response) {
		return '<script>'.$response.'</script>';
	}

	public static function render($page, $not_ignored_repl = true) {
		$page = strtolower($page);
		
		$ds = Config::get('DS');
		$folder = Config::get('APP');
		
		$page = str_replace(".", $ds, $page);
		$page .= ".php";
		
		$page = $folder.$ds.'public'.$ds.'pages'.$ds.$page;
		$content = file_get_contents($page);

		$element = new Element();

		$element = $element->make($content, $not_ignored_repl);
		
		return $element;
	}
}