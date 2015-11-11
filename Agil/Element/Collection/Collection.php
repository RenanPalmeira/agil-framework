<?php

namespace Agil\Element\Collection;

class Collection {
	// MUDAR ESSA FUNÇÃO COLOCAR O COMANDO EM PARAMETRO
	public static function condition($content, $compact) {


		$content = preg_replace("/[\n\r\n\n\t]+/", "", $content);

		$base = "/\{\% ([a-z]+) ([a-z]+) \%\}/";
		$regex = preg_match_all($base, $content, $matches);
		$rule = $matches[1];
		$values = $matches[2];
		
		if(in_array('if', $rule)) {
			$condition = array_search('if', $rule);
			$value = $values[$condition];
		}
		foreach ($rule as $key => $value) {
			$title = $values[$key];
			if(in_array($key, $values) && gettype($compact)=='array' &&  array_key_exists($title, $compact)) {
				$base = "/\{\% ([a-z]+) ?([a-z]+) \%\}(.*)\{\% endif \%\}/";
				$regex = preg_match_all($base, $content, $matches);
				foreach ($matches[3] as $key => $value) {
					$replace = self::var_render($value, $compact);
				}
				$content = preg_replace($base, $replace, $content);
			}
			else {
				$base = "/\{\% (.*) \%\}/";
				$content = preg_replace($base, "", $content);
			}
		}
		return $content;
	}

	public static function var_render($content, $compacted) {
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
}