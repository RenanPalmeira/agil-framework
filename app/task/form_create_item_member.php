<?php
	require_once 'init.php';

	use Agil\View\View as View;
	
	$request = View::route($_GET);
	$pk = $request['pk'];

	$sql = array(
		'id_project_task_items' => $pk,
		'status'=>'1'
	);

	$fields = array('id_project_task_items', 'id_project_task');
	$model = new ProjectTaskItems();
	$model->fields = $fields;
	$rs = $model->get($sql);
	$rsItem = $rs[0];

	$sql = array(
		'id_project_task_items' => $rsItem['id_project_task_items'],
		'status'=>'1'
	);

	$fields = array('id_member');
	$model = new ProjectTaskItemsMemberSet();
	$model->fields = $fields;
	$rsItemMembers = $model->get($sql);

	$sql = array(
		'id_project_task' => $rsItem['id_project_task'],
		'status'=>'1'
	);

	$fields = array('id_project');
	$model = new ProjectTask();
	$model->fields = $fields;
	$rs = $model->get($sql);
	$rs = $rs[0];

	$sql = array(
		'id_project' => $rs['id_project'],
		'status'=>'2'
	);

	$fields = array('id_member');
	$model = new ProjectMemberSet();
	$model->fields = $fields;
	$rs = $model->get($sql);
?>
<div class="modal-content">
	<div class="modal-header">
		<button class="close" onclick="boss.removeClass('modal_dialog', 'active')">x</button>
		<h3 class="modal-title font-open-sans">Adicionar membro a tarefa</h3>
	</div>
	<form action="/app/task/create_item_member/" method="post" target="iframesubmit">
		<input type="hidden" id="pk" name="pk" value="<?php echo $pk;?>">
		<input type="hidden" id="pk_member" name="pk_member" value="">
		<input type="hidden" id="remove" name="remove" value="0">
		<div class="modal-body">
			<div class="container">
				<ul id="select_member" class="list-group">
					<?php
						if(count($rs)>0) {
							foreach ($rs as $index => $member) {
								$sql = array(
									'id_member' => $member['id_member'],
									'status'=>'1'
								);

								$fields = array('id_member', 'name', 'email');
								$model = new Member();
								$model->fields = $fields;
								$members = $model->get($sql);

								foreach ($members as $index => $member) {	
									?>
									<li class="list-group-item">
										<label><input id="check_<?php echo $member['id_member']; ?>" type="checkbox" value="<?php echo $member['id_member']; ?>">&nbsp;&nbsp;<?php echo $member['name']; ?></label>
									</li>
									<?php
								}
							}
						}
					?>
				</ul>
			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-success" value="Adicionar">
			<input type="submit" class="btn btn-danger" value="Remove" onclick="$('#remove').attr('value', '1');">
		</div>
	</form>
</div>
<script type="text/javascript">
	$("#select_member li").on("click", function(){
		if($(this).find("input").prop('checked')==false){

			if($("#pk_member").val().indexOf("|"+$(this).find("input").val()) == -1){
				$("#pk_member").val($("#pk_member").val() + "|" + $(this).find("input").val());
			}

			$(this).find("input").prop('checked', true);
			$(this).css({'background': '#f5f5f5'});
		}
		else{
			var value = "|"+$(this).find("input").attr("value");
			$("#pk_member").val($("#pk_member").val().replace(value, ""));
			
			$(this).find("input").prop('checked', false);
			$(this).css({'background': 'none'});
		}
	});

	<?php
		foreach ($rsItemMembers as $rsItemMember) {
			?>
			$("#check_<?php echo $rsItemMember['id_member']; ?>").prop('checked', true);
			$("#pk_member").val($("#pk_member").val() +"|"+<?php echo $rsItemMember['id_member'] ?>);
			<?php
		}
	?>
</script>