<div class="col-7 no-bleed-top pull-center">
	<div class="container bg-white rounded bleed-bottom">
		<div class="col-12 pull-left">
			<div class="container">
				<h1 class="font-open-sans title-header text-primary">Entrar em <span class="font-lato">Contato</span></h1>
				<form id="form_contact" method="POST" action="/app/contact/view/create" target="iframesubmit">
					<div class="form-group">
						<input name="name" type="text" class="form-control" id="name" placeholder="Nome">
					</div>
					<div class="form-group">
						<input name="email" type="text" class="form-control" id="email" placeholder="Email">
					</div>
					<div class="form-group">
						<input name="subject" type="text" class="form-control" id="subject" placeholder="Assunto">
					</div>
					<div class="form-group">
						<label>Mensagem:</label>
						<textarea name="body" id="message" class="form-control" class="form-control" data-value="Mensagem"></textarea>
					</div>
					<div class="form-group">
						<div class="g-recaptcha" data-sitekey="6LePpQwTAAAAANl2hrA8lftwm1zu00Xwi3DPqdP3"></div>
					</div>
								
					<div class="form-group">
						<button type="submit" onclick="OnSubmitForm();" class="btn btn-block btn-success" value="Enviar" style="width:105%!important;">
							Enviar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function OnSubmitForm(){
	var els = document.getElementsByTagName("input");
	var arr = [].slice.call(els);

	arr.forEach(function (el){
		if(el.value!="" && document.getElementById("message").value!=""){
			el.value="";
			isError = false;
		}
		else{
			isError = true;
		}
	});

	if(isError){
		boss.popup('Error', 'Por favor, preencha corretamente todos os campo!');
	}
	else{
		boss.popup('Sucesso', 'Sua mensagem foi enviada com sucesso!');
	}
	document.getElementById("message").value="";
}
</script>