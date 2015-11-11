<?php

require_once 'init.php';

use Agil\View\View as View;
use Agil\Session\Session as Session;

$request = View::route($_POST);

if($request['METHOD']=='POST' 
	&& !empty($request['pk'])
	&& !empty($request['email'])) {
	
	$logado = Session::get('logado');
	$pk = $request['pk'];
	$email = $request['email'];
	
	if($logado['email']==$email){
		?>
		<script>
			html = "<div style=\"padding:20px;text-align:center;\"><kbd><?php echo $email; ?></kbd>&nbsp; já é colaborador.</div>";
			window.parent.boss.popup('Erro 42', html);
		</script>
		<?php
		die();
	}

	try {

		$sql = array(
			'id_project' => $pk,
			'id_admin'   => $logado['id_member'],
			'status'     => '1'
		);

		$project = new Project();
		$count = $project->count($sql);

		if($count==1) {
			$project = $project->get($sql);
			$project = $project[0];

			$sql = array(
				'email' => $email
			);

			$member = new Member();
			$member->fields = array('id_member', 'name', 'email');
			$count = $member->count($sql);

			if($count==1) {
				$rs = $member->get($sql);
				$rs = $rs[0];
				$id_project = $pk;
				$id_member = $rs['id_member'];

				$sql = array(
					'id_project' => $id_project,
					'id_member'  => $id_member, 
					'status'     => 1
				);

				$member_set = new ProjectMemberSet($sql);
				$countMemberSetSend = $member_set->count($sql);
				
				$sql = array(
					'id_project' => $id_project,
					'id_member'  => $id_member, 
					'status'     => 2
				);

				$countMemberSetRevoke = $member_set->count($sql);

				if($countMemberSetSend==0 && $countMemberSetRevoke==0) {
					$member_set->save();

					$name = explode(" ", $logado['name']);
					$name = $name[0];
					$title = '<b>'.ucfirst($name).'</b> convidou você para o projeto <b>'.$project['title'].'</b>';
					
					$sql = array(
						'typing'      => 1,
						'title'       => $title,
						'id_sender'   => $id_project,
						'id_receiver' => $id_member
					);
					$notification = new NotificationGranttype($sql);
					$notification->save()

					?>
					<script>
						html = "<div style=\"padding:20px;text-align:center;\" title=\"<?php echo $rs['email'];?>\"><kbd class=\"bg-blue-light\" style=\"text-transform: capitalize;\"><?php echo $rs['name']; ?></kbd> foi convidado a colaborar.</div>";
						window.parent.boss.popup('Sucesso', html);
						window.parent.boss.ajax.load('/app/team/view_task_member/?pk=<?php echo $pk;?>', '#app_pane_body');
					</script>
					<?php
					die();
				}
				else {
					?>
					<script>
						html = "<div style=\"padding:20px;text-align:center;\"><kbd><?php echo $rs['email']; ?></kbd>&nbsp; já é colaborador.</div>";
						window.parent.boss.popup('Erro de duplicata', html);
					</script>
					<?php
					die();
				}
			}
			?>
			<script>
				html = "<div style=\"padding:20px;text-align:center;\"><kbd style=\"background-color: #DA4453;\"><?php echo $email; ?></kbd>&nbsp; não encontrado.</div>";
				window.parent.boss.popup('Usuário não encontrado', html);
			</script>
			<?php
		}
		else {
			?>
			<script>
				html = "<div style=\"padding:20px;text-align:center;\"><kbd><?php echo $email; ?></kbd>&nbsp; não encontrado.</div>";
				window.parent.boss.popup('Usuário não encontrado', html);
			</script>
			<?php
		}
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