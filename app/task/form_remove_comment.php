<?php
	require_once 'init.php';

	use Agil\View\View as View;
	
	$request = View::route($_GET);
	$pk = $request['pk'];

	$sql = array(
		"id_project_task_items_comments" => $pk,
		"status"						 => 1
	);

	$fields = array("id_project_task_items_comments", "id_project_task_items", "id_member", "body");
	$comments = new ProjectTaskItemsComments();
	$comments->fields = $fields;
	$rsComments = $comments->get($sql);
	$rsComments = $rsComments[0];

?>
<div class="modal-content">
	<div class="modal-header">
		<button class="close" onclick="boss.removeClass('modal_dialog', 'active');boss.ajax.load('/app/task/view_item/?pk=<?php echo $rsComments['id_project_task_items']; ?>', '#modal_window', 'active');">x</button>
		<h3 class="modal-title font-open-sans">Excluir item</h3>
	</div>
	<form action="/app/task/edit_item_comment/" method="POST" target="iframesubmit">
		<input type="hidden" id="pk" name="pk" value="<?php echo $pk;?>"/>
		<input type="hidden" id="remove" name="remove" value="1"/>
		<div class="modal-body">
			<div class="container">
				<p>
					Tem certeza de que deseja excluir isso?
				</p>
			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-danger" value="Remove">
		</div>
	</form>
</div>