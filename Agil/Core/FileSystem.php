<?php

namespace Agil\Core;

use Agil\Route\Repl as Repl;

class FileSystem {
	protected $type_verb = array('css', 'js', 'html', 'json', 'xml', 'xhtml', 'jpeg', 'png', 'jpg', 'svg', );
	
	function __construct($path=null){
		if(is_file($path))
			$this->path = $path;
	}
	
	public function isFile($file) {
        return is_file($file);
    }

	public function extensionFile($path) {
		$mime_type = preg_match("/.*\.([a-z]+)/", $path,  $matches);
		
		try {
			$mime_type = $matches[1];
			if(in_array($mime_type, $this->type_verb))
				return $mime_type;
			return 'html';
		} 
		catch (Exception $e) {
			return 'html';
		}
		
		return 'html';
	}

	public function render($path=null) {
		
		if ($path==null) 
			$path = $this->path;

		$type = $this->extensionFile($path);
		$headers = sprintf('Content-Type: text/%s', $type);
		
		header($headers);
		
		return $this->get($path);
	}

	public function get($path) {

		if ($this->isFile($path)) {
			return file_get_contents($path);
        }

		throw new \Exception("File does not exist at path {$path}");
	}
}
