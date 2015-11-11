<?php
	require_once 'init.php';
?>
<div class="card">
	<div class="card-content">
		<div class="col-12">
			<div class="col-9 pull-left">
				<h2></h2>
			</div>
			<div class="col-3 pull-left text-right">
				<div class="btn-group">
					<button class="btn btn-primary" onclick="boss.ajax.load('/app/task/view_my_task/', '#app_conteiner');">Abertas</button>
					<button class="btn" onclick="boss.ajax.load('/app/task/view_my_close_task/', '#app_conteiner');">Entregues</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="app-pane">
	<div class="app-pane-body" style="background-color:#F9F9F9;">
		<div class="col-3 pull-left">
			<div class="card">
				<div class="card-image">
					<div class="container bleed-bottom">
						<img src="/static/img/icons/user_black.png">
					</div>
				</div>
				<div class="card-action">
					<h4 class="font-open-sans text-black">Wellington</h4>
				</div>
			</div>
		</div>
		<div class="col-3 pull-left">
			<div class="card">
				<div class="card-image">
					<div class="container bleed-bottom">
						<img src="/static/img/icons/user_black.png">
					</div>
				</div>
				<div class="card-action">
					<h4 class="font-open-sans text-black">Wellington</h4>
				</div>
			</div>
		</div>
		<div class="col-3 pull-left">
			<div class="card">
				<div class="card-image">
					<div class="container bleed-bottom">
						<img src="/static/img/icons/user_black.png">
					</div>
				</div>
				<div class="card-action">
					<h4 class="font-open-sans text-black">Wellington</h4>
				</div>
			</div>
		</div>
		<div class="col-3 pull-left">
			<div class="card">
				<div class="card-image">
					<div class="container bleed-bottom">
						<img src="/static/img/icons/user_black.png">
					</div>
				</div>
				<div class="card-action">
					<h4 class="font-open-sans text-black">Wellington</h4>
				</div>
			</div>
		</div>
	</div>
</div>