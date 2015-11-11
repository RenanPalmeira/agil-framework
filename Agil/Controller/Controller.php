<?php

namespace Agil\Controller;

class Controller {
	public $model = null;
	public $inputs = null;
	
	public function valid($inputs = null, $model =  null){
		if($inputs==null)
			$inputs = $this->$inputs;
		if($model==null)
			$model = $this->$model;
	}
}