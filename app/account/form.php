<div class="col-11 no-bleed-top pull-center">
	<div class="container bg-white rounded bleed-bottom">
		<h2 class="font-lato text-primary text-center">Cadastre-se</h2>
		<div class="col-6 pull-left mobile-hidden">
			<div class="container">
				<h3>Conta grátis</h3>
				<p class="font-lato text-dark">Acesse todos os nossos protudos, crie uma conta totalmente gratuita e começe a esperimentar os serviços oferecidos servicios.</p>
				<div class="bleed-top">
					<img id="image" src="/static/img/things/profile.png" class="img img-border" width="300px" height="300px">
				</div>
			</div>
		</div>
		<div class="col-6 pull-left">
			<div class="container">
				<div id="div_user">
					<form action="/app/account/create/" target="iframesubmit" method="POST">
						<div class="row">
							<div class="col-12">
								<input name="name" class="input-requered" placeholder="Nome" type="text" required>
								<input name="email" class="input-requered" placeholder="Email" type="email" required>
								<input name="login" class="input-requered" placeholder="Login" type="text" required>
								<input name="password" class="input-requered" placeholder="Senha" type="password" required>
								<input name="re_password" class="input-requered" placeholder="Confirmação de senha" type="password" required>
							</div>
						</div>
						<div class="row">
							<div class="col-11" style="margin-left: 30px;">
								<div class="g-recaptcha" data-sitekey="6LePpQwTAAAAANl2hrA8lftwm1zu00Xwi3DPqdP3"></div>
								&nbsp;
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<input type="submit" value="Cadastre conta" class="btn btn-primary btn-block">							
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$("#aba_user").on('click', function(event) {
			if($('#div_enterprise').hasClass("show") >= 0){
				$("#aba_enterprise").removeClass('btn-primary');
				$(this).addClass('btn-primary');

				$('#div_enterprise').addClass('hidden');
			}
			$('#div_user').removeClass('hidden');
		});
		$("#aba_enterprise").on('click', function(event) {
			if($('#div_user').hasClass("show") >= 0){
				$("#aba_user").removeClass('btn-primary');
				$(this).addClass('btn-primary');

				$('#div_user').addClass('hidden');
			}
			$('#div_enterprise').removeClass('hidden');
		});
	});
</script>
