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
	<body>
		<iframe src="" name="iframesubmit" width="0" height="0" style="display: none;"></iframe>
		<div class="jumbotron page-header bg-azure-light bg-dots">
			{% include 'menu.php' %}
			<div class="container text-white">
				<div class="col-6 pull-left bleed-top">
					<h1 class="font-lato"><span class="font-open-sans">Tec</span>Falcon</h1>
					<p class="font-lato mobile-hidden paragraph">Um sistema que visa à organização do desenvolvimento de projetos utilizando métodos ágeis. Gerencie as etapas do seu trabalho, transmita segurança e compromisso com transparência aos seus clientes.</p>
					<div class="bleed-top">
						<a href="/create/" class="btn btn-lg btn-white" style="margin-right:1%;">Cadastre-se</a>
						<a href="/login/" class="btn btn-lg btn-default ">Login</a>
					</div>
				</div>
				<div class="col-6 pull-left mobile-hidden">
					<img src="/static/img/things/postits.png" width="300px" class="pull-right bleed-top">
				</div>
			</div>
		</div>
		{% block content %}
			
		{% endblock %}
		{% include 'footer.php' %}
		<script type="text/javascript" src="/static/js/home-page.js"></script>
	</body>
</html>