<?php

require_once 'init.php';

use Agil\View\View as View;
use Agil\Config\Config as Config;
use Agil\ReCaptcha\ReCaptcha as ReCaptcha;
use Agil\Session\Session as Session;

$secret = Config::get('G_SECRET');
$request = View::route($_POST);

if($request['METHOD']=='POST' 
	&& !empty($request['name']) 
	&& !empty($request['email']) 
	&& !empty($request['login']) 
	&& !empty($request['password'])
	&& !empty($request['re_password'])
	// && !empty($request['g-recaptcha-response'])
	&& $request['password']==$request['re_password']
	&& filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {

	// $recaptcha = new ReCaptcha($secret);
	/* 
	 * $resp = $recaptcha->verify($request['g-recaptcha-response'], $request['REMOTE_ADDR']);
	 */

	$name = $request['name'];
	$email = $request['email'];
	$username = $request['login'];
	$password = $request['password'];
	
	$member = compact('name', 'email');
	$model = new Member($member);
	$member = $model->save();
	
	$id_member = $model->lastInsertId();
	$login = compact('username', 'password', 'id_member');
	$model = new Login($login);
	$login = $model->save();

	if($login && $member) {
		$password = md5($password);

		$sql = array(
			'username' => $username, 
			'password' => $password,
			'status'   => '1'
		);

		$model = new Login();
		$model->fields = array('username', 'id_member', 'status');
		$rs = $model->get($sql);

		$sql = array(
			'id_member' => $rs[0]['id_member']
		);
		
		$member = new Member();
		$member->fields = array('name', 'email');
		$rsMember = $member->get($sql);
		
		$rs = array_merge($rsMember[0], $rs[0]);

		Session::start();
		Session::set('logado', $rs);
		?>
		<script>
			window.parent.location.href='/';
		</script>
		<?php	
	}
}
else {
	?>
	<script>
		window.parent.location.href='/';
		window.parent.iframesubmit.src='';
		window.parent.boss.popup('Error', 'Preencha todos os campos!');
	</script>
	<?php
}
?>