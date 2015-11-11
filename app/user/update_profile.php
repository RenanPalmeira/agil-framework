<?php

require_once 'init.php';

use Agil\View\View as View;
use Agil\Session\Session as Session;

$request = View::route($_POST);

if($request['METHOD']=='POST' 
	&& !empty($request['name'])
	&& !empty($request['username'])
	&& !empty($request['email'])) {
	
	$logado = Session::get('logado');
	$name = $request['name'];
	$username = $request['username'];
	$email = $request['email'];
	
	try {

		$sql = array(
			'id_member' => $logado['id_member'],
			'status'   => '1'
		);

		$login = new Login();
		$login->fields = array('username'=>$username);
		$login->update($sql);
		
		$member = new Member();
		$member->fields = array('name'=>$name, 'email'=>$email);
		$member->update($sql);
		
		$fields = array('name'=>$name, 'email'=>$email, 'username'=>$username);
		foreach ($logado as $key => $value) {
			if(array_key_exists($key, $logado) && array_key_exists($key, $fields))
				$logado[$key] = $fields[$key];
		}

		Session::update('logado', $logado);
		
		?>
		<script>
			window.parent.boss.ajax.load('/app/user/form_profile/', '#app_conteiner');
		</script>
		<?php
	} 
	catch (Exception $e) {
		echo $e;
	}
}
else {
	?>
	<script>
		window.parent.location.href='/';
	</script>
	<?php
}
?>