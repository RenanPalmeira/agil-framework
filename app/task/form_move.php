<?php
	require_once 'init.php';

	use Agil\View\View as View;
	
	$request = View::route($_GET);
	$pk = $request['pk'];
	$pk2 = $request['pk2'];

	$model = new ProjectTaskItems();
	$sql = array(
		'id_project_task_items' => $pk,
		'status'    => '1'
	);

	$fields = array("title", "id_project_task");
	$model->fields = $fields;
	$rs = $model->get($sql);
	$rs = $rs[0];

	$model = new ProjectTask();
	$sql = array(
		'id_project' => $pk2,
		'status'    => '1'
	);

	$fields = array("title", "id_project_task");
	$model->fields = $fields;
	$rsTask = $model->get($sql);
	
?>
<div class="modal-content">
	<div class="modal-header">
		<button class="close" onclick="boss.removeClass('modal_dialog', 'active')">x</button>
		<h3 class="modal-title font-open-sans">Editar cartão</h3>
	</div>
	<form action="/app/task/move_item/" method="post" target="compiler">
		<input type="hidden" id="pk" name="pk" value="<?php echo $pk;?>">
		<div class="modal-body">
			<div class="container">
				<div class="form-group">
					<label>Título da tarefa</label>
					<input name="title" type="button" value="<?php echo $rs['title'];?>" placeholder="<?php echo $rs['title'];?>" class="btn btn-block text-left btn-disabled" style="width:106%;">
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
			<input type="submit" class="btn btn-success" value="Editar cartão">
		</div>
	</form>
</div>