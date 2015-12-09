<div class="modal-content">
	<div class="modal-header">
		<button class="close" onclick="boss.removeClass('modal_dialog', 'active')">x</button>
		<h3 class="modal-title font-open-sans">Editar projeto</h3>
	</div>
	<form method="post">
		<div class="modal-body">
			<div class="container">
				<label>Título</label>
				<input name="name" type="text" placeholder="Nome" class="form-control">
			</div>
		</div>
		<div class="modal-footer">
			<input name="name" type="submit" class="btn btn-success" value="Editar">
		</div>
	</form>
</div>