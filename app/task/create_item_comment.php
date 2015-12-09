<?php

require_once 'init.php';

use Agil\View\View as View;
use Agil\Config\Config as Config;
use Agil\Session\Session as Session;

$request = View::route($_POST);

if($request['METHOD']=='POST' 
	&& !empty($request['comment'])
	&& !empty($request['pk'])
	&& Session::exist('logado')) {

	$logado = Session::get('logado');
	$comment = $request['comment'];
	$pk = $request['pk'];

	$fields = array(
		'id_project_task_items' => $pk,
		'id_member'				=> $logado['id_member'],
		'body'					=> $comment
	);

	$model = new ProjectTaskItemsComments($fields);
	$comment = $model->save();

	if($comment){
		$query = array(
			'id_project_task_items'=>$pk,
			'status'			   =>'1'
		);

		$project = new ProjectTaskItems();
		$project->fields = array('id_project_task');
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
		<script>
			var timePopup = setTimeout(function(){
				window.parent.boss.ajax.load('/app/task/view_task/?pk=<?php echo $rs["id_project"];?>', '#app_pane_body');
			}, 100);
			window.parent.$('#modal_window').empty();
			window.parent.boss.ajax.load('/app/task/view_item/?pk=<?php echo $pk;?>', '#modal_window', 'active');
		</script>
		<?php
	}
}
else {
	?>
	<script>
		var timePopup = setTimeout(function(){
			window.parent.boss.removeClass('modal_window', 'active');
		}, 100);
		window.parent.boss.popup("Erro ao criar comentario.");
	</script>
	<?php
}
?>