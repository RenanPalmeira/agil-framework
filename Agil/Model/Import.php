<?php

namespace Agil\Model;

class Import {
	public static function get($app, $src = __FILE__) {
		$src = dirname($src);
		$src .= DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR;
		$src .= $app.DIRECTORY_SEPARATOR.'model.php';
		return require_once($src);
	}
}