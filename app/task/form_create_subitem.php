<?php
	require_once 'init.php';

	use Agil\View\View as View;
	use Agil\Session\Session as Session;

	$logado = Session::get('logado');
	$request = View::route($_GET);
	$pk = $request['pk'];
?>
<div class="modal-content">
	<div class="modal-header">
		<button class="close" onclick="boss.removeClass('modal_dialog', 'active')">x</button>
		<h3 class="modal-title font-open-sans">Adicionar item a tarefa</h3>
	</div>
	<form action="/app/task/create_subitem/" method="post" target="iframesubmit">
		<input type="hidden" id="pk" name="pk" value="<?php echo $pk;?>">
		<div class="modal-body">
			<div class="container">
				<div class="form-group">
					<label>Título do item</label>
					<input name="title" type="text" placeholder="Título do item" class="form-control">
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-success" value="Adicionar">
		</div>
	</form>
</div>