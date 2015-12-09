<?php
	require_once 'init.php';

	use Agil\View\View as View;
	use Agil\Session\Session as Session;
	
	$request = View::route($_GET);
	$pk = $request['pk'];

	$sql = array(
		"id_team" => $pk, 
		"status"	 => 1
	);

	$fields = array("id_team", "id_project");
	$model = new Team();
	$model->fields = $fields;
	$teams = $model->get($sql);
	$team = $teams[0];

	$sql = array(
		"id_team" => $team['id_team'], 
		"status"	 => 1
	);

	$fields = array('id_member');
	$model = new TeamMemberSet();
	$model->fields = $fields;
	$rsTeamMembers = $model->get($sql);

	$sql = array(
		'id_project' => $team['id_project'],
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
	<form action="/app/team/create_team_member/" method="post" target="iframesubmit">
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
		if(count($rsTeamMembers) > 0){
			foreach ($rsTeamMembers as $rsTeamMember) {
				?>
				$("#check_<?php echo $rsTeamMember['id_member']; ?>").prop('checked', true);
				$("#pk_member").val($("#pk_member").val() +"|"+<?php echo $rsTeamMember['id_member'] ?>);
				<?php
			}
		}
	?>
</script>