<div class="app-pane">
	<div class="app-pane-header">
		<div class="col-6 pull-left">
			<div id="btn_group" class="btn-group">
				<a class="btn" onclick="boss.ajax.load('/app/user/overview/', '#app_conteiner');">Visão Geral</a>
				<a class="btn btn-primary" onclick="boss.ajax.load('/app/user/project/', '#app_conteiner');">Projetos</a>
			</div>
		</div>
		<div class="col-6 pull-left">
			<div class="col-6 pull-left text-right">
				<buttom id="btn_new_project" onclick="boss.ajax.load('/app/project/form_create/', '#modal_dialog', 'active');" class="btn btn-success">
					<b>+</b> Novo Projeto
				</buttom>
			</div>
			<div class="col-6 pull-left mobile-hidden">
				<form action="" method="post">
					<input name="name" type="text" id="name" class="search form-control" placeholder="Pesquisar">
				</form>
			</div>
		</div>
	</div>
	<div class="app-pane-body bleed-bottom" style="background-color:#F9F9F9;">
		<div class="col-12">
			<div class="col-3 pull-left">
				<div class="card card-effect">
					<div class="card-image" onclick="boss.ajax.load('/app/project/profile/', '#app_conteiner');">
						<img src="/static/img/teste/core.png" width="200px">
					</div>
					<div class="card-action">
						<h3 class="font-open-sans link" onclick="boss.ajax.load('/app/project/profile/', '#app_conteiner');">Core Projetos</h3>
						<span class="card-icon icon" onclick="boss.addClass('card_hidden_1', 'active')">
							<i class="icon-dot"/>
							<i class="icon-dot"/>
							<i class="icon-dot"/>
						</span>
					</div>
					<div id="card_hidden_1" class="card-content-hidden">
						<i class="icon icon-close" onclick="boss.removeClass('card_hidden_1', 'active')"></i>
						<ul class="list-group">
							<li class="list-group-title bg-blue-light text-white">
								Core Projetos
							</li>
							<li class="list-group-item list-group-hover" onclick="boss.ajax.load('/app/project/form_edit/?teste=wellington', '#modal_dialog', 'active');">
								<img src="/static/img/icons/edit_black.png" width="20px" style="position:absolute; left:30px;">Editar
							</li>
							<li class="list-group-item list-group-hover" onclick="boss.ajax.load('/app/project/form_delete/?teste=wellington', '#modal_dialog', 'active');">
								<img src="/static/img/icons/excluir_black.png" width="20px" style="position:absolute; left:30px;">Excluir
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-3 pull-left">
				<div class="card card-effect">
					<div class="card-image" onclick="boss.ajax.load('/app/project/profile/', '#app_conteiner');">
						<img src="/static/img/teste/stor_music.png" width="200px">
					</div>
					<div class="card-action">
						<h3 class="font-open-sans link" onclick="boss.ajax.load('/app/project/profile/', '#app_conteiner');">Stor Music</h3>
						<span class="card-icon icon" onclick="boss.addClass('card_hidden_2', 'active')">
							<i class="icon-dot"/>
							<i class="icon-dot"/>
							<i class="icon-dot"/>
						</span>
					</div>
					<div id="card_hidden_2" class="card-content-hidden">
						<i class="icon icon-close" onclick="boss.removeClass('card_hidden_2', 'active')"></i>
						<ul class="list-group">
							<li class="list-group-title bg-blue-light text-white">
								Stor Music
							</li>
							<li class="list-group-item list-group-hover" onclick="boss.ajax.load('/app/project/form_edit/', '#modal_dialog', 'active');">
								<img src="/static/img/icons/edit_black.png" width="20px" style="position:absolute; left:30px;">Editar
							</li>
							<li class="list-group-item list-group-hover" onclick="boss.ajax.load('/app/project/form_delete/?teste=wellington', '#modal_dialog', 'active');">
								<img src="/static/img/icons/excluir_black.png" width="20px" style="position:absolute; left:30px;">Excluir
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	if(boss.isMobile()){
		$('#btn_new_project').html('<b>+<b/>');
		$('#btn_group').addClass('mobile-hidden');
	}
</script>