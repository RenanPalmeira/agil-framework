<?php
	require_once 'init.php';

	use Agil\View\View as View;

	$request = View::route($_GET);
?>
<div class="modal-content">
	<div class="modal-header">
		<button class="close" onclick="boss.removeClass('modal_dialog', 'active')">x</button>
		<h3 class="modal-title font-open-sans">Alterar foto do perfil</h3>
	</div>
	<form id="form" action="/app/user/user_image/" method="POST"  enctype="multipart/form-data" target="iframesubmit">
		<div class="modal-body">
			<div class="container">
				<div class="form-group">
					<label>Imagem</label>
					<span class="form-control btn btn-primary btn-file">
						<input name="image" type="file" accept="image" placeholder="Adicionar foto" class="form-control">

						<span>Alterar foto</span>
					</span>
				</div>
				<div class="form-group" id="error"></div>
			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-success" value="Salvar">
		</div>
	</form>
</div>