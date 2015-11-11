<?php

require_once 'init.php';

use Agil\View\View as View;

function create($request) {
	if($request['METHOD']=='POST'
	&& !empty($request['name'])
	&& !empty($request['email'])
	&& filter_var($request['email'], FILTER_SANITIZE_EMAIL)
	&& !empty($request['subject'])
	&& !empty($request['body'])
	&& !empty($request['g-recaptcha-response'])) {

		$name = $request['name'];
		$email = $request['email'];
		$subject = $request['subject'];
		$body = $request['body'];
		$g_recaptcha_response = $request['g-recaptcha-response'];
		$REMOTE_ADDR = $request['REMOTE_ADDR'];

		$c = new ContactController();
		$resp = $c->create(compact('name', 'email', 'subject', 'body', 'g_recaptcha_response', 'REMOTE_ADDR'));

		return true;

	}
	return View::NotFound();
}

echo View::route($_GET);
?>