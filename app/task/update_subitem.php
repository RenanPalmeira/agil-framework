<?php

require_once 'init.php';

use Agil\View\View as View;
use Agil\Config\Config as Config;
use Agil\Session\Session as Session;

$request = View::route($_POST);

if($request['METHOD']=='POST'
	&& !empty($request['pk'])
	&& Session::exist('logado')
	|| !empty($request['remove'])
	|| !empty($request['edit'])
	|| !empty($request['title'])){

	$remove = !empty($request['remove']) ? $request['remove'] : 0;
	$edit = !empty($request['edit']) ? $request['edit'] : 0;
	
	$logado = Session::get('logado');
	$pk = $request['pk'];
	
	$sql = array(
		"id_project_task_items_subitems" => $pk,
		"status"						 => 1
	);

	if($remove){
		$subItem = new ProjectTaskItemsSubitems();
		$subItem->fields = array('status'=>0);
		$update = $subItem->update($sql);

		if($update){
			$sql = array(
				"id_project_task_items_subitems" => $pk,
			);

			$fields = array("id_project_task_items");
			$subItem = new ProjectTaskItemsSubitems();
			$subItem->fields = $fields;
			$subItem = $subItem->get($sql);
			$subItem = $subItem[0];

			$query = array(
				'id_project_task_items'=> $subItem['id_project_task_items'],
				'status'=>'1'
			);

			$project = new ProjectTaskItems();
			$project->fields = array('id_project_task', 'title', 'comment');
			$rsItem = $project->get($query, 'id_project_task_items DESC');
			$rsItem = $rsItem[0];

			$sql = array(
				'id_project_task'=>$rsItem['id_project_task'],
				'status'=>'1'
			);

			$project = new ProjectTask();
			$project->fields = array('id_project');
			$rs = $project->get($sql);
			$rs = $rs[0];
			?>
			<script type="text/javascript">
				var timePopup = setTimeout(function(){
					window.parent.boss.ajax.load('/app/task/view_task/?pk=<?php echo $rs["id_project"];?>', '#app_pane_body');
					window.parent.boss.removeClass('modal_dialog', 'active');
				}, 100);
				window.parent.$('#modal_window').empty();
				window.parent.boss.ajax.load('/app/task/view_item/?pk=<?php echo $subItem["id_project_task_items"];?>', '#modal_window', 'active');
			</script>
			<?php
		}
		else{
			?>
			<script>
				var timePopup = setTimeout(function(){
					window.parent.boss.removeClass('modal_window', 'active');
				}, 100);
				window.parent.boss.popup("Erro ao remove item.");
			</script>
			<?php
		}
	}
	else if($edit){
		$title = $request['title'];

		$subItem = new ProjectTaskItemsSubitems();
		$subItem->fields = array('title'=>$title);
		$update = $subItem->update($sql);
		if($update){
			$sql = array(
				"id_project_task_items_subitems" => $pk,
			);

			$fields = array("id_project_task_items");
			$subItem = new ProjectTaskItemsSubitems();
			$subItem->fields = $fields;
			$subItem = $subItem->get($sql);
			$subItem = $subItem[0];

			$query = array(
				'id_project_task_items'=> $subItem['id_project_task_items'],
				'status'=>'1'
			);

			$project = new ProjectTaskItems();
			$project->fields = array('id_project_task', 'title', 'comment');
			$rsItem = $project->get($query, 'id_project_task_items DESC');
			$rsItem = $rsItem[0];

			$sql = array(
				'id_project_task'=>$rsItem['id_project_task'],
				'status'=>'1'
			);

			$project = new ProjectTask();
			$project->fields = array('id_project');
			$rs = $project->get($sql);
			$rs = $rs[0];
			?>
			<script type="text/javascript">
				var timePopup = setTimeout(function(){
					window.parent.boss.ajax.load('/app/task/view_task/?pk=<?php echo $rs["id_project"];?>', '#app_pane_body');
					window.parent.boss.removeClass('modal_dialog', 'active');
				}, 100);
				window.parent.$('#modal_window').empty();
				window.parent.boss.ajax.load('/app/task/view_item/?pk=<?php echo $subItem["id_project_task_items"];?>', '#modal_window', 'active');
			</script>
			<?php
		}
		else{
			?>
			<script>
				var timePopup = setTimeout(function(){
					window.parent.boss.removeClass('modal_window', 'active');
				}, 100);
				window.parent.boss.popup("Erro ao atualizar item.");
			</script>
			<?php
		}
	}
	else{
		$fields = array("id_project_task_items_subitems", "title", "checked");
		$subItem = new ProjectTaskItemsSubitems();
		$subItem->fields = $fields;
		$subItems = $subItem->get($sql);
		$subItems = $subItems[0];
			
		if($subItems['checked']){
			$subItem->fields = array('checked'=>0);
			$update = $subItem->update($sql);
		}
		else{
			$subItem->fields = array('checked'=>1);
			$update = $subItem->update($sql);
			return true;
		}
	}
}
else {
	?>
	<script>
		var timePopup = setTimeout(function(){
			window.parent.boss.removeClass('modal_window', 'active');
		}, 100);
		window.parent.boss.popup("Erro ao atualizar item.");
	</script>
	<?php
}