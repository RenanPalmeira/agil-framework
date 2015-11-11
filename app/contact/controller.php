<?php

require_once 'init.php';

use Agil\ReCaptcha\ReCaptcha as ReCaptcha;

class ContactController {
	public function create(array $inputs) {
		if(gettype($inputs)=='array') {
			$recaptcha = new ReCaptcha('6LePpQwTAAAAAJhIitO57S9A835wjJT2iG6AC7q1');
			$resp = $recaptcha->verify($inputs['g_recaptcha_response'], $inputs['REMOTE_ADDR']);
			$resp->isSuccess();
			
			unset($inputs['g_recaptcha_response']);
			unset($inputs['REMOTE_ADDR']);
			$model = new Contact($inputs);
			$response = $model->prepare;
			
			if($model->save()){
				die();	
			}
			return true;
		}
		return false;
	}
}