<?php
	require_once 'init.php';

	use Agil\View\View as View;
	use Agil\Session\Session as Session;

	$logado = Session::get('logado');
	$request = View::route($_GET);
	$pk = $request['pk'];

	$id_admin = null;
	if(array_key_exists('admin', $request)) {
		$id_admin = $request['admin'];
	}
	$sql = array(
		"id_project_task_items" => $pk,
		"status"				=> 1
	);

	$fields = array("id_project_task_items_comments", "id_member", "body");
	$comments = new ProjectTaskItemsComments();
	$comments->fields = $fields;
	$rsComments = $comments->get($sql, 'id_project_task_items_comments DESC');

	foreach ($rsComments as $rsComment) {
		$query = array(
			"id_member" => $rsComment['id_member'],
			"status"	=> 1
		);

		$fields = array("name");
		$model = new Member();
		$model->fields = $fields;
		$rsMembers = $model->get($query);
		$rsMembers = $rsMembers[0];

		?>
		<div class="comment">
			<div class="comment-left">
				<img src="/static/img/icons/user_black.png" width="50px">
			</div>
			<div class="comment-body">
				<div class="comment-heading">
					<b class="title">
						<?php 
							$name = explode(" ", $rsMembers['name']);
							$name = $name[0];
							echo $name; 
						?>
					</b>


					<?php
					 	if($logado['id_member']==$rsComment['id_member'] || $id_admin==$logado['id_member']){
					 ?>
						<img src="/static/img/icons/excluir_black.png" onclick="boss.removeClass('modal_window', 'active');boss.ajax.load('/app/task/form_remove_comment/?pk=<?php echo $rsComment['id_project_task_items_comments']; ?>', '#modal_dialog', 'active');" width="20px" class="pull-right" style="cursor:pointer;">
					<?php
						}
					?>
				</div>
				<div class="col-12 pull-left">
					<p><?php echo $rsComment['body']; ?></p>
				</div>
			</div>
		</div>
		<?php 
	}			
?>