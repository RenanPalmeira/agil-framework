<?php

require_once 'init.php';

use Agil\View\View as View;
use Agil\Config\Config as Config;
use Agil\Session\Session as Session;

$request = View::route($_POST);

if($request['METHOD']=='POST'
	&& !empty($request['pk_member'])
	&& Session::exist('logado')) {
	
	$logado = Session::get('logado');
	$id_admin = $logado['id_member'];
	$pk = $request['pk'];
	$pk_members = explode("|", $request['pk_member']);
	unset($pk_members[0]);
	$remove = $request['remove'];

	if($remove){
		if(count($pk_members)>0){
			foreach ($pk_members as $index => $pk_member) {
				$model = new ProjectTaskItemsMemberSet();
				$sql = array(
					'id_member' => $pk_member,
					'status'    => '1'
				);
				$rs = $model->get($sql);
				$rs = $rs[0];

				$model->fields = array('status'=>'0');
				$update = $model->update($sql);

				if($update){
					$query = array(
						'id_project_task_items'=> $pk,
						'status'=>'1'
					);

					$project_task_items = new ProjectTaskItems();
					$project_task_items->fields = array('id_project_task', 'id_project_task_items', 'title', 'comment');
					$rsItem = $project_task_items->get($query, 'id_project_task_items DESC');
					$rsItem = $rsItem[0];

					$sql = array(
						'id_project_task'=>$rsItem['id_project_task'],
						'status'=>'1'
					);

					$projectTask = new ProjectTask();
					$projectTask->fields = array('id_project');
					$rsprojectTask = $projectTask->get($sql);
					$rsprojectTask = $rsprojectTask[0];
					?>
					<script>
						var timePopup = setTimeout(function(){
							window.parent.boss.removeClass('modal_dialog', 'active');
						}, 100);
						window.parent.boss.ajax.load('/app/task/view_task/?pk=<?php echo $rsprojectTask["id_project"];?>', '#app_pane_body');
						window.parent.boss.popup("Membro(s) removido com sucesso.");
					</script>
					<?php
				}
			}
		}
	}
	else{
		if(count($pk_members)>0){
			foreach ($pk_members as $index => $pk_member) {
				$model = new ProjectTaskItemsMemberSet();
				$sql = array(
					'id_project_task_items' => $pk,
					'id_member'      		=> $pk_member,
					'id_admin' 				=> $id_admin,
					'status'				=> 1
				);
			}

			$count = $model->count($sql);
			if($count!=0){
				?>
				<script>
					var timePopup = setTimeout(function(){
						window.parent.boss.removeClass('modal_dialog', 'active');
					}, 100);
					window.parent.boss.popup("Esse(s) membro(s) já estão participando desta tarefa.");
				</script>
				<?php
				die();
			}
			foreach ($pk_members as $index => $pk_member) {
				$fields = array(
					'id_project_task_items' => $pk,
					'id_member'      		=> $pk_member,
					'id_admin' 				=> $id_admin,
				);
				$query = array(
					'id_project_task_items' => $pk,
					'id_member'      		=> $pk_member,
					'id_admin' 				=> $id_admin,
					'status'				=> 1
				);
				$count = $model->count($query);
				if($count==0){
					$model = new ProjectTaskItemsMemberSet($fields);
					$project_task_items_member_set = $model->save();
				}
				else{
					?>
					<script>
						var timePopup = setTimeout(function(){
							window.parent.boss.removeClass('modal_dialog', 'active');
						}, 100);
						window.parent.boss.popup("Esse(s) membro(s) já estão participando desta tarefa.");
					</script>
					<?php
					die();
				}
			}

			if($project_task_items_member_set){
				$query = array(
					'id_project_task_items'=> $pk,
					'status'=>'1'
				);

				$project_task_items = new ProjectTaskItems();
				$project_task_items->fields = array('id_project_task', 'id_project_task_items', 'title', 'comment');
				$rsItem = $project_task_items->get($query, 'id_project_task_items DESC');
				$rsItem = $rsItem[0];

				$sql = array(
					'id_project_task'=>$rsItem['id_project_task'],
					'status'=>'1'
				);

				$projectTask = new ProjectTask();
				$projectTask->fields = array('id_project');
				$rsprojectTask = $projectTask->get($sql);
				$rsprojectTask = $rsprojectTask[0];
				?>
				<script>
					var timePopup = setTimeout(function(){
						window.parent.boss.removeClass('modal_dialog', 'active');
					}, 100);
					window.parent.boss.ajax.load('/app/task/view_task/?pk=<?php echo $rsprojectTask["id_project"];?>', '#app_pane_body');
					window.parent.boss.popup("Membro(s) adicionados com sucesso.");
				</script>
				<?php
			}
		}
	}
}
else {
	?>
	<script>
		var timePopup = setTimeout(function(){
			window.parent.boss.removeClass('modal_dialog', 'active');
		}, 100);
		window.parent.boss.popup("Erro ao adicionar membro(s).");
	</script>
	<?php
}