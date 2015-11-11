<?php
	require_once 'init.php';

	use Agil\View\View as View;
	
	$request = View::route($_GET);
	$pk = $request['pk'];

	$sql = array(
		"id_project_task_items" => $pk, 
		"status"     => 1
	);

	$fields = array("title", "comment");
	$model = new ProjectTaskItems();
	$model->fields = $fields;
	$rs = $model->get($sql);
	$rs = $rs[0];
?>
<div class="modal-content">
	<div class="modal-header">
		<button class="close" onclick="boss.removeClass('modal_dialog', 'active')">x</button>
		<h3 class="modal-title font-open-sans">Editar Tarefa</h3>
	</div>
	<form action="/app/task/edit_item/" method="post" target="compiler">
		<input type="hidden" id="pk" name="pk" value="<?php echo $pk;?>">
		<input type="hidden" id="delete" name="delete" value="0">
		<div class="modal-body">
			<div class="container">
				<div class="form-group">
					<label>Título da tarefa</label>
					<input name="title" type="text" value="<?php echo $rs['title'];?>" placeholder="<?php echo $rs['title'];?>" class="form-control">
				</div>
				<div class="form-group">
					<label>Descrição da tarefa</label>
					<textarea name="comment" type="text" value="<?php echo $rs['comment'];?>"class="form-control"><?php echo $rs['comment'];?></textarea>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-success" value="Editar tarefa">
			<input type="submit" class="btn btn-danger" value="Deletar" onclick="$('#delete').attr('value', '1');">
		</div>
	</form>
</div>