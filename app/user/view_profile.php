<?php
	require_once 'init.php';

	use Agil\Session\Session as Session;

	$logado = Session::get('logado');
	$name = explode(" ", $logado['name']);
	$name = $name[0];
?>
<div class="app-pane">
	<div class="app-pane-header">
		<h3 class="font-lato" style="margin-top: 0px; padding-top: 10px;">Perfil</h3>
	</div>
	<div class="app-pane-body">
		<div class="col-4 pull-left text-center">
			<div class="col-12" style="margin-top: 15%;">
				<div class="col-12 bleed-top">
					<img src="/static/img/icons/user_black.png" width="100px" class="img-circle">
				</div>
				<div class="col-12">
					<h4 class="font-lato font-black title">
						<?php echo mb_strimwidth($logado['name'],0,20,"...");?>
					</h4>
					<p class="font-lato font-green">
						<?php echo $logado['email'];?>
					</p>
				</div>
				<div class="col-11 bleed-top bleed-bottom">
					<button  onclick="boss.ajax.load('/app/user/form_profile/', '#app_conteiner');" class="btn btn-primary btn-block-lg  pull-center bold">
						Editar Perfil
					</button>
				</div>
			</div>
		</div>
		<div class="col-8 pull-left">
			<div class="col-12">
				<div class="container">
					<h3 class="font-open-sans"><img src="/static/img/icons/web_black.png" height="30px" style="position: absolute; left: 20px;">Atividades</h3>
				</div>
				<div class="col-12 bleed-bottom">
					<table class="table">
						<tbody>
							<tr>
								<td>
									<p>Você adicionou Pedro Gabriel a Atualizar Post it's</p>
								</td>
							</tr>
							<tr>
								<td>
									<p>Você adicionou Wallace a Atualizar Post it's</p>
								</td>
							</tr>
							<tr>
								<td>
									<p>Você entrou em Atualizar Post it's</p>
								</td>
							</tr>
							<tr>
								<td>
									<p>Você criou cartão Atualizar Post it's</p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>