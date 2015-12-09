<!DOCTYPE html>
<html dir="ltr">
	<head lang="pt-br">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Tecfalcon - Organização com base no desenvolvimento ágil </title>
		<link rel="shortcut icon" href="/static/img/logo/falcon.png"/>
		<link rel="stylesheet" type="text/css" href="/static/css/font.min.css">
		<link rel="stylesheet" type="text/css" href="/static/css/style.min.css">
		<link rel="stylesheet" type="text/css" href="/static/css/mobile.min.css">
		<script type="text/javascript" src="/static/js/jquery.min.js"></script>
	</head>
	<body class="app-body">
		<div class="app-wrapper">
			<div id="navbar" class="navbar navbar-vertical navbar-dark fixed-left font-white">
				<div class="bleed-vertical">
					<div class="brand italic current">
						<img id="logo" src="/static/img/logo/falcon.png" width="40px" onclick="location.href='/'">
					</div>
					<div id="nav_toggle" class="nav nav-app">
						<ul>
							<li class="link" onclick="location.href='/'">
								<img src="/static/img/icons/coffe.png" width="60px">
								<span>Área de trabalho</span>
							</li>
							<li class="link" onclick="location.href='/tour/'">
								<img src="/static/img/icons/profile.png" width="60px">
								<span>Perfil</span>
							</li>
							<li class="link" onclick="location.href='/support/'">
								<img src="/static/img/icons/message.png" width="60px">
								<span>Mensagens</span>
							</li>
							<li class="link"  onclick="location.href='/blog/program/'">
								<img src="/static/img/icons/gear.png" width="60px">
								<span>Configurações</span>
							</li>
							<li class="link" onclick="location.href='/about/'">
								<img src="/static/img/icons/out.png" width="60px">
								<span>Sair</span>
							</li>
							<li class="link" onclick="location.href='/contact/'">
								<img src="/static/img/icons/help.png" width="60px">
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
				<h2 class="font-lato font-white" style="margin-top:60px;"><span class="font-open-sans">Tec</span>Falcon</h2>
				<div class="nav">
					<div class="pull-left">
						<img src="/static/img/icons/user.png" class="pull-left" width="40px">
						<p class="font-lato font-white pull-left">Wellington</p>
					</div>
					<div class="pull-left">
						<img id="notify" src="/static/img/icons/notify.png" class="pull-left" style="width:40px;">
					</div>
				</div>
				<div id="notify-box" class="notify-box hidden">
					<div class="notify-header">
						<p class="font-lato bold">Notificações</p>
					</div>
					<div class="notify-body">

					</div>
				</div>
			</div>
			<div class="app no-bleed-top">
				{% block content %}
		
				{% endblock %}
			</div>
		</div>
	</body>
	<script type="text/javascript" src="/static/js/main.js"></script>
</html>