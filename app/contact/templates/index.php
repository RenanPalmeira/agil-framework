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
						<input id="enviar" type="submit" class="btn btn-block btn-success" value="Enviar"/>
					</div>
				</form>
				<div id="alert" class="alert alert-dismissable hidden" style="width: 96%!important;">
					<button class="close">X</button>
					<h4 id="alert_message"></h4>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$(".alert .close").on('click', function(e){
			e.preventDefault();
			$(".alert").each(function(index, el){
				if(el.className.indexOf('hidden'))
					el.classList.add('hidden')
			});
		});
	});
</script>