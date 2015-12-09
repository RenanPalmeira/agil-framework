<?php
	require_once 'init.php';

	use Agil\View\View as View;
	
	$request = View::route($_GET);
	$pk = $request['pk'];

	$sql = array(
		"id_project_task_items" => $pk, 
		"status"				=> 1
	);

	$fields = array("id_project_task", "title", "comment");
	$model = new ProjectTaskItems();
	$model->fields = $fields;
	$rs = $model->get($sql);
	$rs = $rs[0];

	$sql = array(
		'id_project_task' => $rs['id_project_task'],
		'status'		  => 1
	);
	$model = new ProjectTask();
	$fields = array("title", "id_project");
	$model->fields = $fields;
	$rsTask = $model->get($sql);
	$rsTask = $rsTask[0];

	$sql = array(
		'id_project' => $rsTask['id_project'],
		'status'		  => 1
	);
	$model = new ProjectTask();
	$fields = array("title", "id_project", "id_project_task");
	$model->fields = $fields;
	$rsTask = $model->get($sql);

?>
<div class="modal-content">
	<div class="modal-header">
		<button class="close" onclick="boss.removeClass('modal_dialog', 'active')">x</button>
		<h3 class="modal-title font-open-sans">Arquiva Tarefa</h3>
	</div>
	<form action="/app/task/move_item/" method="post" target="iframesubmit">
		<input type="hidden" id="pk" name="pk" value="<?php echo $pk;?>">
		<input type="hidden" id="arquiva" name="arquiva" value="0">
		<div class="modal-body">
			<p class="font-open-sans bleed-bottom">Para mover a tarefa para uma lista especifica onde deseja arquiva suas tarefas, escolha um cartão e clique em "Mover tarefa", se não clique em "Arquiva".</p>
			<div class="container">
				<div class="form-group">
					<label>Título da tarefa</label>
					<input name="title" type="text" value="<?php echo $rs['title'];?>" placeholder="<?php echo $rs['title'];?>" class="form-control" disabled>
				</div>
				<div class="form-group">
					<label>Título do cartão</label>
					<select name="card" class="form-control" style="height:35px; width:106%;">
						<?php 
							foreach ($rsTask as $index => $task) {
								$selected = ($rs['id_project_task']==$task['id_project_task']) ? "selected" : "";
						?>
						<option value="<?php echo $task['id_project_task']; ?>" <?php echo $selected; ?> ><?php echo $task['title']; ?></option>
						<?php 
							}
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-success" value="Mover tarefa">
			<input type="submit" class="btn btn-danger" value="Arquivar" onclick="$('#arquiva').attr('value', '1');">
		</div>
	</form>
</div>