<?php

require_once 'init.php';

use Agil\View\View as View;
use Agil\Session\Session as Session;

Session::start();
$request = View::route($_POST);

if($request['METHOD']=='POST' 
	&& !empty($request['username'])
	&& !empty($request['password'])) {

	$username = $request['username'];
	$password = md5($request['password']);
	
	$sql = array(
		'username' => $username, 
		'password' => $password,
		'status'   => '1'
	);
	
	$login = new Login();
	$login->fields = array('username', 'id_member', 'status');
	$rs = $login->get($sql);
	$count = $login->rows();

	if($count==0) {
		?>
		<script>
			window.parent.boss.popup('Error', 'Usuário ou senha incorretos!');
		</script>
		<?php
	}
	else if ($count==1) {
		$sql = array(
			'id_member' => $rs[0]['id_member']
		);
		
		$member = new Member();
		$member->fields = array('name', 'email');
		$rsMember = $member->get($sql);
		$countMember = $member->rows();

		$rs = array_merge($rsMember[0], $rs[0]);

		Session::set('logado', $rs);
		?>
		<script>
			window.parent.location.href='/';
			window.parent.iframesubmit.src='';
		</script>
		<?php
	}
	else {
		echo "Fudeo muito!";
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