<?php
	require_once 'init.php';
?>
<div class="app-pane-body" style="background-color:#F9F9F9;">
	<div class="col-12 pull-center">
		<div class="col-11 pull-center">
			<div class="card-group">
				<div class="card">
					<div class="card-content">
						<div class="col-12">
							<div class="col-9 pull-left">
								<h2>Tarefas abertas</h2>
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
				<div class="card card-effect">
					<div class="card-content">
						<div class="col-12 pull-left">
							<div class="col-8 pull-left">
								<h3>Title</h3>
							</div>
							<div class="col-4 pull-left text-right bleed-bottom">
								<button class="btn btn-success">
									Concluir
								</button>
							</div>
						</div>
						<div class="col-12 pull-left" style="border-top:1px solid #ddd;padding:1%;">
							<div class="col-3 pull-left">
								<p class="font-lato bold">Data de entrga:</p>
							</div>
							<div class="col-3 pull-left">
								<p class="font-lato link bold">Membros:</p>
							</div>
							<div class="col-3 pull-left">
								<p class="font-lato link bold">Tags:</p>
							</div>
							<div class="col-3 pull-left">
								<p class="font-lato link bold"> Comentarios: </p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>