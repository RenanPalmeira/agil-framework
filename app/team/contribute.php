<?php

require_once 'init.php';

use Agil\View\View as View;
use Agil\Session\Session as Session;

$request = View::route($_POST);

if($request['METHOD']=='POST' 
   && !empty($request['pk'])
   && !empty($request['sender'])
   && (!empty($request['accept']) || !empty($request['recuse']))) {

	$logado = Session::get('logado');
	$pk = $request['pk'];
	$sender = $request['sender'];
	$reponse = !empty($request['accept']) ? 1 : 0;
	
	try {
		if($reponse==1) {
			$sql = array(
				"id_project"=>$sender,
				"id_member"=>$pk
			);
			$member = new ProjectMemberSet();
			$member->fields = array('status'=>2);
			$member->update($sql);

			$project = new Project();
			$project = $project->get(array("id_project"=>$sender, "status"=>1));
			$project = $project[0];

			$name = explode(" ", $logado['name']);
			$name = $name[0];
			$title = '<b>'.ucfirst($name).'</b> aceitou seu convite para <b>'.$project['title'].'</b>';
			
			$sql = array(
				'typing'      => 2,
				'title'       => $title,
				'id_sender'   => $logado['id_member'],
				'id_receiver' => $project['id_admin']
			);
			$notification = new NotificationGranttype($sql);
			$notification->save();
			echo "<script>window.parent.$('#modal_dialog').removeClass('active-lg')</script>";
			die();
		}
		else if($reponse==0) {
			$sql = array(
				"id_project_member_set"=>$pk
			);
			$member = new ProjectMemberSet();
			$member->fields = array('status'=>0);
			$member->update($sql);
			die();
		}
		throw new Exception('Error');
	} catch (Exception $e) {
		echo "fdsfsdfads";
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