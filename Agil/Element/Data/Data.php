<?php

namespace Agil\Element\Data;

use Agil\Config\Config as Config;

class Data {
	private $rule = array(
		'block'   => '/\{\% block ([a-z]+) \%\}/',
		'include' => '/\{\% include \'([a-z]+)\' \%\}/'
	);

	public function render($content, $not_ignored_repl = true) {
		
		$base = "/\{\% ([a-z]+) ?(.*) \%\}/";
		
		$regex = preg_match_all($base, $content, $matches);
		if(count($matches)==3) {
			$page = $content;
			$regex = $matches[0];
			$rule = $matches[1];
			$values = $matches[2];
			if($not_ignored_repl==false) {
				$content = $this->blocked($content);
			}
			foreach ($rule as $key => $value) {
				if($value!='block' && $value!='endblock' && $value!='if' && $value!='endif') {
					$replace = $this->repl($value, $values[$key]);
					$content = str_replace($regex[$key], $replace, $content);	
				}	
			}
			if(in_array('extends', $rule)) {
				$extends = array_search('extends', $rule);
				$value = $values[$extends];

				$page = str_replace("'", "", $value);
				$ds = Config::get('DS');

				$folder = Config::get('APP');
				$page_src = $folder.$ds.'public'.$ds.'layout'.$ds.$page;

				$extends = $this->render(file_get_contents($page_src));

				$content = $this->blocked($content);
				
				$content = $this->blocked($extends, $content);
			}
		}
		return $content;
	}

	public function var_render($content, $compacted) {
		//$content = preg_replace("/({% block content %})|({% endblock %})/", $block_content, $content);	

		$regex = preg_match_all("/\{\{ ([a-z\.]+) \}\}/", $content, $matches);
		try {
			foreach ($matches[1] as $key => $value) {
				if(array_key_exists($value, $compacted))
					$content = preg_replace("/\{\{ (".$value.") \}\}/", $compacted[$value], $content);
				else 
					$content = preg_replace("/\{\{ (".$value.") \}\}/", "", $content);
			}
			
		} catch (Exception $e) {
			die();
		}
		return $content;
	}

	public function blocked($content, $block_content = '') {
		$content = preg_replace("/[\n\r\n\n\t]+/", "", $content);

		if($block_content=='') {
			$content = preg_replace("/({% block content %})|({% endblock %})/", $block_content, $content);	
			$content = preg_replace("/[\n\r\n\n\t]+/", "", $content);
		}
		else
			$content = preg_replace("/{% block content %}(.*){% endblock %}/", $block_content, $content);	
		
		
		return $content;
	}

	public function repl($rule, $value, $ignore_extends = false) {
		if($rule=='include') {
			$page = str_replace("'", "", $value);

			$ds = Config::get('DS');
			$folder = Config::get('APP');
			
			$page = $folder.$ds.'public'.$ds.'layout'.$ds.$page;
			$content = file_get_contents($page);

			return $content;
		}
	}
}