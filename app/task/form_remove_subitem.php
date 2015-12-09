<?php
	require_once 'init.php';

	use Agil\View\View as View;
	
	$request = View::route($_GET);
	$pk = $request['pk'];

	$sql = array(
		"id_project_task_items_subitems" => $pk,
		"status"						 => 1
	);

	$fields = array("title");
	$subItem = new ProjectTaskItemsSubitems();
	$subItem->fields = $fields;
	$subItem = $subItem->get($sql);
	$subItem = $subItem[0];
?>
<div class="modal-content">
	<div class="modal-header">
		<button class="close" onclick="boss.removeClass('modal_dialog', 'active');">x</button>
		<h3 class="modal-title font-open-sans">Remove item</h3>
	</div>
	<form action="/app/task/update_subitem/" method="POST" target="iframesubmit">
		<input type="hidden" id="pk" name="pk" value="<?php echo $pk;?>"/>
		<input type="hidden" id="remove" name="remove" value="1"/>
		<div class="modal-body">
			<div class="container">
				<div class="form-group">
					<label>Título do item</label>
					<input name="title" type="text" placeholder="Título do item" value="<?php echo $subItem['title'];?>" class="form-control" disabled>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-danger" value="Remove">
		</div>
	</form>
</div>