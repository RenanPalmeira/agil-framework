<?php
	require_once 'init.php';
?>
<div class="modal-content">
	<div class="modal-header">
		<button class="close" onclick="boss.removeClass('modal_dialog', 'active')">x</button>
		<h3 class="modal-title font-open-sans">Criar novo projeto</h3>
	</div>
	<form action="/app/project/create/" method="post" target="iframesubmit">
		<div class="modal-body">
			<div class="container">
				<div class="form-group">
					<label>Título</label>
					<input name="title" type="text" placeholder="Nome do projeto" class="form-control">
				</div>
				<div class="form-group">
					<label>Método para desenvolvimento</label>
					<div class="form-group">
						<select name="agil_method" class="form-control" style="height: 36px;">
								<option default></option>
								<option value="person">Personalisado</option>
								<option value="scrum">Scrum</option>
								<option value="xp">eXtreme Programming</option>
								<option value="kaban">Kaban</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label>Tipo de privacidade</label>
					<div class="form-group">
						<label class="checkbox-inline">
							<input type="radio" name="type_license" value="1" checked="true">Público
						</label>
						<label class="checkbox-inline">
							<input type="radio" name="type_license" value="2">Privado
						</label>
					</div>
				</div>
				<div class="form-group">
					<label>Selecione uma foto</label>
					<span class="form-control btn btn-primary btn-file">
						<input name="name" type="file" accept="image" placeholder="Adicionar foto" class="form-control">
						<span>Adicionar foto</span>
					</span>
				</div>
				<div class="form-group" id="error"></div>
			</div>
		</div>
		<div class="modal-footer">
			<input name="name" type="submit" class="btn btn-success" value="Criar projeto">
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