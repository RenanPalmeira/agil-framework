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

	$fields = array("id_team", "id_admin", "name", "website", "slug");
	$model = new Team();
	$model->fields = $fields;
	$teams = $model->get($sql);
	$team = $teams[0];
?>
<div class="modal-content">
	<div class="modal-header">
		<button class="close" onclick="boss.removeClass('modal_dialog', 'active')">x</button>
		<h3 class="modal-title font-open-sans">Editar equipe</h3>
	</div>
	<form action="/app/team/edit_team/" method="post" target="iframesubmit">
		<input type="hidden" id="pk" name="pk" value="<?php echo $pk;?>">
		<input type="hidden" id="delete" name="delete" value="0">
		<div class="modal-body">
			<div class="container">
				<div class="form-group">
					<label>Nome da Equipe</label>
					<input name="name" type="text" placeholder="Nome da equipe" value="<?php echo $team['name']; ?>" class="form-control" style="95.5%">
				</div>
				<div class="form-group">
					<label>Site da equipe</label>
					<input name="website" type="text" placeholder="Nome do site da equipe" value="<?php echo $team['website']; ?>" class="form-control" style="95.5%">
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-success" value="Editar equipe">
			<input type="submit" class="btn btn-danger" value="Deletar equipe" onclick="$('#delete').attr('value', '1');">
		</div>
	</form>
</div>