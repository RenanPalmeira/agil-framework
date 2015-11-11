<?php

require_once 'init.php';

use Agil\View\View as View;
use Agil\Config\Config as Config;
use Agil\Session\Session as Session;

$request = View::route($_POST);

if($request['METHOD']=='POST' 
	&& !empty($request['title']) 
	&& !empty($request['comment'])
	&& !empty($request['pk'])
	&& Session::exist('logado')) {

	$logado = Session::get('logado');
	$title = $request['title'];
	$comment = $request['comment'];
	$pk = $request['pk'];

	$fields = array(
   		'id_project_task' => $pk,
   		'title'           => $title,
   		'comment'         => $comment
   	);

   	$model = new ProjectTaskItems($fields);
	$item = $model->save();



	$query = array(
		'id_project_task'=>$pk,
		'status'=>'1'
	);

	$project = new ProjectTaskItems();
	$project->fields = array('id_project_task_items', 'title', 'comment');
	$rsItem = $project->get($query, 'id_project_task_items DESC');
	$rsItem = $rsItem[0];

	$sql = array(
		'id_project_task'=>$pk,
		'status'=>'1'
	);

	$project = new ProjectTask();
	$project->fields = array('id_project');
	$rs = $project->get($sql);
	$rs = $rs[0];

	if($item){
		?>
		<script>
			var timePopup = setTimeout(function(){
				window.parent.boss.removeClass('modal_dialog', 'active');
				window.parent.boss.ajax.load('/app/task/view_task/?pk=<?php echo $rs["id_project"];?>', '#app_pane_body');
				window.parent.boss.modalWindow({'pk':'<?php echo $rsItem["id_project_task_items"]; ?>','title':'<?php echo $rsItem["title"]; ?>', 'content': '<?php echo $rsItem["comment"]; ?>'});
			}, 100);

		</script>
		<?php
	}
}
else {
	?>
	<script>
		var timePopup = setTimeout(function(){
			window.parent.boss.removeClass('modal_dialog', 'active');
		}, 100);
		window.parent.boss.popup("Erro ao criar Tarefa.");
	</script>
	<?php
}