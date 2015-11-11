<?php

namespace Agil\Element;

use Agil\Element\Data\Data as Data;
use Agil\Element\Collection\Collection as Collection;

class Element extends Data {
	public $var = array();
	public function make($content, $not_ignored_repl = true) {
		
		if(gettype($not_ignored_repl)=='array') {
			$content = $this->var_render($content, $not_ignored_repl);
		}

		$content = $this->render($content, $not_ignored_repl);

		$content = Collection::condition($content, $not_ignored_repl);
		
		return $content;
	}
}