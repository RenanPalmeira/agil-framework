<?php
	require_once 'init.php';
?>
<div class="modal-content">
	<div class="modal-header">
		<button class="close" onclick="boss.removeClass('modal_dialog', 'active')">x</button>
		<h3 class="modal-title font-open-sans">Editar projeto</h3>
	</div>
	<form method="post">
		<div class="modal-body">
			<div class="container">
				<div class="form-group">
					<label>Título</label>
					<input name="name" type="text" placeholder="Nome do projeto" class="form-control">
				</div>
				<div class="form-group">
					<label>Alterar foto</label>
					<span class="form-control btn btn-primary btn-file">
						<input name="name" type="file" accept="image" placeholder="Adicionar foto" class="form-control">
						<span>Adicionar foto</span>
					</span>
				</div>
				<div class="form-group">
					<label>Status</label>
					<div class="form-group">
						<label class="checkbox-inline">
							<input type="checkbox" value="" checked="true">Publico
						</label>
						<label class="checkbox-inline">
							<input type="checkbox" value="">Privado
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<input name="name" type="submit" class="btn btn-success" value="Editar projeto">
		</div>
	</form>
</div>
<script type="text/javascript">
	$("[type=file]").on("change", function(){
		
		var file = this.files[0].name;
		var dflt = $(this).attr("placeholder");
		
		if($(this).val()!=""){
			$(this).next().text(file);
		}
		else{
			$(this).next().text(dflt);
		}
	});
</script>