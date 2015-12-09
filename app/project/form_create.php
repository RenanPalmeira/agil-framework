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
						<select id="agil_method" name="agil_method" class="form-control pull-left" style="height: 36px; width:90%;">
								<option default></option>
								<option value="person">Personalizado</option>
								<option value="scrum">Scrum</option>
								<option value="xp">Extreme Programming</option>
								<option value="kaban">Kaban</option>
						</select>
						<span onclick="boss.ajax.load('/app/project/view_project_methodology/', '#modal_dialog', 'active');" class="pull-right" width="20%"><img src="/static/img/icons/help_black.png" class="img-effect" width="20px" style="margin-top:35%;"></span>
					</div>
				</div>
				<div class="form-group">
					<div id="decription" class="col-12 pull-left">
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