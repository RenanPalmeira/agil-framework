<?php
require_once 'init.php';

use Agil\View\View as View;
use Agil\Config\Config as Config;
use Agil\Session\Session as Session;

$request = View::route($_POST);


if($request['METHOD']=='POST' 
&& !empty($request['pk'])
&& Session::exist('logado')
|| !empty($request['remove'])){
	$pk = $request['pk'];
	$comment = $request['comment'];
	$remove = $request['remove'];

	if($remove){
		$sql = array(
			'id_project_task_items_comments' => $pk,
			'status'    					 => 1
		);
		$model = new ProjectTaskItemsComments();
		$model->fields = array('status'=>0);
		$update = $model->update($sql);

		if($update){
			$sql = array(
				'id_project_task_items_comments' => $pk,
			);
			$model->fields = array('id_project_task_items');
			$rsComments = $model->get($sql);
			$rsComment = $rsComments[0];


			$query = array(
				"id_project_task_items" => $rsComment['id_project_task_items'],
				"status"				=> 1
			);

			$project = new ProjectTaskItems();
			$project->fields = array('id_project_task_items', 'id_project_task');
			$rsItem = $project->get($query);
			$rsItem = $rsItem[0];

			$sql = array(
				'id_project_task' => $rsItem['id_project_task'],
				'status'		  => 1
			);

			$project = new ProjectTask();
			$project->fields = array('id_project');
			$rs = $project->get($sql);
			$rs = $rs[0];
			?>
			<script>
				var timePopup = setTimeout(function(){
					window.parent.boss.removeClass('modal_dialog', 'active');
					window.parent.boss.ajax.load('/app/task/view_task/?pk=<?php echo $rs["id_project"];?>', '#app_pane_body');
				}, 100);
				window.parent.$('#modal_window').empty();
				window.parent.boss.ajax.load('/app/task/view_item/?pk=<?php echo $rsItem["id_project_task_items"];?>', '#modal_window', 'active');
			</script>
			<?php
		}
	}
}
else {
	?>
	<script>
		var timePopup = setTimeout(function(){
			window.parent.boss.removeClass('modal_dialog', 'active');
		}, 100);
		window.parent.boss.popup("Erro ao atualizar comentario.");
	</script>
	<?php
}
?>