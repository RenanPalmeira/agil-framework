<?php

namespace Agil\Form;

class Form {
	public $rules = array(
		'required',
		'max', 
		'min', 
		'email',
		'alpha',
		'int'
	);

	function __construct($valided, $request=null) {
		$this->valided = $valided;

		if(!empty($request) && gettype($request)=='array')
			$this->request = $request;
	}

	private function repl($rule, $value) {
		if(gettype($rule)=='array') {
			$rule_name = $rule[0];
			$rule_key = $rule[1];

			if($rule_key=='DESC') {
				
			}
		}
	}

	public function valid($valided = null, $request = null) { 
		if(!empty($this->valided))
			$valided = $this->valided;
		else if (!empty($valided))
			$valided = $valided;

		if(!empty($this->request))
			$request = $this->request;
		else if (!empty($request))
			$request = $request;

		foreach ($valided as $field => $rule) {
			if(array_key_exists($field, $request)){
				$rule = explode("|", $rule);
				foreach ($rule as $key => $value) {
					$value = explode(":", $value);
					
					if(in_array($value[0], $this->rules)) {
						echo "fafsdfds";
					}
				}
			}
		}
		return true;
	}

}