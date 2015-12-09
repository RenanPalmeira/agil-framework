<?php
	require_once 'init.php';

	use Agil\Session\Session as Session;

	$logado = Session::get('logado');

	$image = new MemberImage();
	$i = $image->get(array('id_member'=>$logado['id_member']));
	$img = "/static/img/icons/user_black.png";
	if(count($i)>0) {
		if(array_key_exists('src', $i[0])) {
			$img = 'media/'.str_replace("\\", "/", $i[0]['src']);
		}
	}
?>
<div class="app-pane">
	<div class="app-pane-header">
		<h3 class="font-lato" style="margin-top: 0px; padding-top: 10px;">Configurações da conta</h3>
	</div>
	<div class="app-pane-body">
		<div class="container">
			<div class="row ">
				<div class="col-3 pull-left text-center">
					<div class="row bleed-top">
						<img src="<?php echo $img; ?>" class="img-circle img-border" width="150px">
					</div>
					<div class="row bleed-top">
						<button class="btn btn-primary btn-block" title="Alterar Senha">Alterar senha</button>
					</div>
				</div>
				<div class="col-9 pull-left text-center">
					<div class="container" style="border-left:1px solid #ddd;">
						<div class="row">
							<div class="panel" style="margin-top:-33px;">
								<div class="panel-heading panel-primary" style="border-top-left-radius: 0px;border-bottom-right-radius: 4px;">
									<h5 class="font-open-sans no-bold">Contas sincronizadas</h5>
								</div>
								<div class="col-12 pull-left" style="margin-top:-20px;">
									<div class="card card-effect img-effect" onclick="boss.oauth('https:\\www.facebook.com')">
										<div class="col-4 pull-left">
											<img src="/static/img/social/facebook_blue.png" width="50px" style="padding-top:1%; padding-bottom:1%;">
										</div>
										<div class="col-8 pull-left" style="padding-top:3%;">
											<h5 class="text-left">Facebook</h5>
										</div>
									</div>
									<div class="card card-effect img-effect" onclick="boss.oauth('https:\\www.twitter.com')">
										<div class="col-4 pull-left">
											<img src="/static/img/social/twitter_blue.png" width="50px" style="padding-top:1%; padding-bottom:1%;">
										</div>
										<div class="col-8 pull-left" style="padding-top:3%;">
											<h5 class="text-left">Twitter</h5>
										</div>
									</div>
									<div class="card card-effect img-effect" onclick="boss.oauth('https:\\www.plus.google.com')">
										<div class="col-4 pull-left">
											<img src="/static/img/social/g_plus_blue.png" width="50px" style="padding-top:1%; padding-bottom:1%;">
										</div>
										<div class="col-8 pull-left" style="padding-top:3%;">
											<h5 class="text-left">Google +</h5>
										</div>
									</div>
									<div class="card card-effect img-effect" onclick="boss.oauth('https:\\www.github.com')">
										<div class="col-4 pull-left">
											<img src="/static/img/social/github_blue.png" width="50px" style="padding-top:1%; padding-bottom:1%;">
										</div>
										<div class="col-8 pull-left" style="padding-top:3%;">
											<h5 class="text-left">GitHub</h5>
										</div>
									</div>
									<div class="card card-effect img-effect" onclick="boss.oauth('https:\\www.stackoverflow.com')">
										<div class="col-4 pull-left">
											<img src="/static/img/social/stackoverflow_blue.png" width="50px" style="padding-top:1%; padding-bottom:1%;">
										</div>
										<div class="col-8 pull-left" style="padding-top:3%;">
											<h5 class="text-left">StackOverflow</h5>
										</div>
									</div>
									<div class="card card-effect img-effect" onclick="boss.oauth('https:\\www.slack.com')">
										<div class="col-4 pull-left">
											<img src="/static/img/social/slack_blue.png" width="50px" style="padding-top:1%; padding-bottom:1%;">
										</div>
										<div class="col-8 pull-left" style="padding-top:3%;">
											<h5 class="text-left">Slack</h5>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>