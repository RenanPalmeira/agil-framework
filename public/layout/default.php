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
		<div class="jumbotron jumbotron-big bg-azure-light bg-dots">
			{% include 'menu.php' %}
			<div class="container text-white">
				<div class="col-6 pull-left">
					<h1 class="font-lato"><span class="font-open-sans">Tec</span>Falcon</h1>
				</div>
				<div class="col-6 pull-left">
					<img src="/static/img/things/{{ title }}.png" class="pull-right mobile-hidden" width="220px">
				</div>
			</div>
		</div>
		{% block content %}
			
		{% endblock %}
		{% include 'footer.php' %}
		<script type="text/javascript" src="/static/js/home-page.js"></script>
	</body>
</html>