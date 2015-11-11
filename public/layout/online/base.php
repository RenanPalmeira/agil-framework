<?php
	if(!empty($_SESSION['logado'])) {
		$logado = $_SESSION['logado'];
		$name = explode(" ", $logado['name']);
		$name = $name[0];
		?>
		<body class="app-body">
			<div id="popup" class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button class="close" onclick="boss.removeClass('popup', 'active')">x</button>
						<h3 id="popup-title" class="modal-title font-open-sans"></h3>
					</div>
					<div id="popup-content" style="padding: 10px;"></div>
				</div>
			</div>
			<div id="modal_dialog" class="modal-dialog"></div>
			<<div id="modal_window" class="modal-window">
				<div class="window">
					<button class="icon-close-window" onclick="boss.removeClass('modal_window', 'active')"></button>
					<div class="window-header">
						<h2 id="window_title"></h2>
					</div>
					<div class="window-content">
						<div class="container">
							<div class="col-8 pull-left">
								<div id="window_content" class="col-12 pull-left" style="padding-bottom: 8px; margin-bottom:10px; border-bottom:1px solid #D6DADC;">
								</div>
								<div id="window_members" class="col-12 pull-left">
								</div>
							</div>
							<div class="col-3 pull-right text-center">
								<input type="hidden" id="window_pk" value="0">
								<ul class="list-group">
									<li class="list-group-title bg-blue-light text-white title">
										Opções												
									</li>
									<li id="window_check" class="list-group-item list-group-hover">
										<img src="/static/img/icons/check_black.png" width="25px" style="position:absolute; left:30px;">&nbsp;&nbsp;&nbsp;&nbsp;Concluido
									</li>
									<li id="window_move" class="list-group-item list-group-hover">
										<img src="/static/img/icons/arrow_black.png" width="20px" style="position:absolute; left:30px;">Mover
									</li>
									<li id="window_edit" class="list-group-item list-group-hover"	>
										<img src="/static/img/icons/edit_black.png" width="20px" style="position:absolute; left:30px;">Ediar
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="app-wrapper">
				<div id="navbar" class="navbar navbar-vertical navbar-dark fixed-left font-white">
					<div class="bleed-vertical">
						<div class="brand italic current">
							<img id="logo" src="/static/img/logo/falcon.png" width="40px" onclick="location.href='/'">
						</div>
						<div id="nav_toggle" class="nav nav-app">
							<ul>
								<li class="link" onclick="lambda();">
									<img src="/static/img/icons/coffe.png" width="40px" style="margin-left:10px; margin-top:10px;">
									<span>Área de trabalho</span>
								</li>
								<li class="link" onclick="boss.title('Perfil');boss.ajax.load('/app/user/view_profile/', '#app_conteiner');">
									<img src="/static/img/icons/profile.png" width="40px" style="margin-left:10px; margin-top:10px;">
									<span>Perfil</span>
								</li>
								<li class="link" onclick="boss.title('Notificações'); boss.ajax.load('app/notification/view_notification/', '#app_conteiner');">
									<img src="/static/img/icons/message.png" width="40px" style="margin-left:10px; margin-top:10px;">
									<span>Notificações</span>
								</li>
								<li class="link"  onclick="boss.title('Configurações');boss.ajax.load('/app/configuration/view_configuration/', '#app_conteiner');">
									<img src="/static/img/icons/gear.png" width="35px" style="margin-left:14px; margin-top:10px;">
									<span>Configurações</span>
								</li>
								<li class="link" onclick="boss.ajax.load('app/account/logout/', '#app_conteiner');">
									<img src="/static/img/icons/out.png" width="40px" style="margin-left:10px; margin-top:10px;">
									<span>Sair</span>
								</li>
								<li class="link" onclick="">
									<img src="/static/img/icons/help.png" width="40px" style="margin-left:10px; margin-top:10px;">
									<span>Ajuda</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="app-navigation">
					<button class="navbar-toggle app-mobile-show pull-left">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="col-6 pull-left mobile-hidden">
						<h2 class="font-lato font-white" style="margin-top:60px;"><span class="font-open-sans">Tec</span>Falcon<span class="title-project title"> - Área de trabalho </span></h2>
					</div>
					<div class="nav">
						<div class="pull-left" onclick="boss.title('Perfil');boss.ajax.load('/app/user/view_profile/', '#app_conteiner');" style="height:40px;">
							<img src="/static/img/icons/user.png" class="pull-left" style="width:30px; margin:4px 2px;">
							<p title="Seu Nome" class="font-lato font-white pull-left title" style="margin-top:10px;">
								<?php echo $name; ?>
							</p>
						</div>
						<div id="notify" class="notify" onclick="boss.ajax.load('/app/notification/view_box_notification/', '#notify_box_body');" class="pull-left text-center" style="width:40px;height:40px;">
							<img class="notify-img" src="/static/img/icons/notify.png" class="pull-left">
							<div id="notify-num" class="notify-num">12</div>
						</div>
					</div>
					<div id="notify-box" class="notify-box hidden" style="width: 360px;">
						<div class="notify-header">
							<p class="font-lato bold">Notificações</p>
						</div>
						<div id="notify_box_body" class="notify-body fancy-scrollbar" style="max-width: 400px;"></div>
					</div>
				</div>
				<div id="app_conteiner" class="app no-bleed-top">
					
				</div>
			</div>
		</body>
		<script type="text/javascript" src="/static/js/main.js"></script>
		<script type="text/javascript">
			function lambda(){
				boss.title('Área de trabalho');
				if(boss.bookmark.get('tab'))
					boss.ajax.load(boss.bookmark.get('tab'), '#app_conteiner');
				else
					boss.ajax.load('/app/user/view_overview/', '#app_conteiner');
			}
			window.addEventListener('load', function(){
				boss.ajax.load("/app/user/view_overview/", "#app_conteiner");
			});
			boss.reload('/app/notification/reload_notify.php', function(data){
				if(parseInt(data) && parseInt(data)>0){
					$("#notify").addClass("active");
					$("#notify-num").html(data);
				}
				else{
					$("#notify").removeClass("active");
					$("#notify-num").html("");
				}
			});
	</script>
	</html>
		<?php
	}
?>