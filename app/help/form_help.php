<?php
	require_once 'init.php';

	use Agil\Session\Session as Session;

	$logado = Session::get('logado');
?>
<div class="app-pane">
	<div class="app-pane-header">
		<h3 class="font-lato" style="margin-top: 0px; padding-top: 10px;">Ajuda</h3>
	</div>
	<div class="app-pane-body" style="background-color:#F9F9F9;">
		<div class="container">
			<div class="col-8 pull-center">
				<div class="card-group">
					<div class="card">
						<div class="card-content">
							<h3 class="modal-title font-open-sans text-center">Mande um e-mail.</h3>
							<div class="container">
								<form action="" method="post" target="iframesubmit">
									<div class="form-group">
										<label>Nome</label>
										<input id="name" type="text" name="name" value="<?php echo $logado['name'];?>" placeholder="Seu Nome" class="form-control" disabled/>
									</div>
									<div class="form-group">
										<label>Assunto</label>
										<input type="text" name="assunto" placeholder="Seu Nome" class="form-control"/>
									</div>
									<div class="form-group">
										<label>Descrição</label>
										<textarea id="comment" name="comment" class="form-control" style="resize: vertical; max-height:150px;"></textarea>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-success" onclick="OnSubmitForm()">Enviar</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function OnSubmitForm(){
	var els = document.getElementsByTagName("input");
	var arr = [].slice.call(els);

	arr.forEach(function (el){
		if(el.value!="" && document.getElementById("comment").value!=""){
			el.value="";
			isError = false;
		}
		else{
			isError = true;
		}
	});

	if(isError){
		document.getElementById("name").value="<?php echo $logado['name']; ?>";
		boss.popup('Error', 'Por favor, preencha corretamente todos os campo!');
	}
	else{
		document.getElementById("name").value="<?php echo $logado['name']; ?>";
		boss.popup('Sucesso', 'Sua mensagem foi enviada com sucesso!');
	}
	document.getElementById("comment").value="";
}
</script>