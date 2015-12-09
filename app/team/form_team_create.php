<?php
	require_once 'init.php';

	use Agil\View\View as View;

	$request = View::route($_GET);
	$pk = $request['pk'];
?>
<div class="modal-content">
	<div class="modal-header">
		<button class="close" onclick="boss.removeClass('modal_dialog', 'active')">x</button>
		<h3 class="modal-title font-open-sans">Criar nova equipe</h3>
	</div>
	<form action="/app/team/create_team/" method="post" target="iframesubmit">
		<input type="hidden" id="pk" name="pk" value="<?php echo $pk;?>">
		<div class="modal-body">
			<div class="container">
				<div class="form-group">
					<label>Nome da Equipe</label>
					<input name="name" type="text" placeholder="Nome da equipe" class="form-control" style="95.5%">
				</div>
				<div class="form-group">
					<label>Site da equipe</label>
					<input name="website" type="text" placeholder="Nome do site da equipe" class="form-control" style="95.5%">
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-success" value="Criar equipe">
		</div>
	</form>
</div>