<?php 
	require_once 'init.php';
?>
<div class="app-pane">
	<div class="app-pane-header">
		<div class="col-6 pull-left">
			<div id="btn_group_options" class="btn-group">
				<a class="btn btn-primary" onclick="boss.ajax.load('/app/project/view_list/', '#app_conteiner');">Projeto</a>
				<a class="btn" onclick="boss.ajax.load('/app/task/view_mytask/', '#app_conteiner');">Minhas tarefas</a>
				<a class="btn" onclick="boss.ajax.load('/app/team/view_team/', '#app_conteiner');">Equipe</a>
			</div>
		</div>
		<div class="col-6 pull-left text-right">
			<div id="btn_group_icons" class="btn-group">
				<button class="btn" onclick="boss.ajax.load('/app/task/view_task/', '#app_conteiner');"><img src="/static/img/icons/graphic.png" width="32px"></button>
				<button class="btn btn-primary" onclick="boss.ajax.load('/app/graph/view_graph/', '#app_conteiner');"><img src="/static/img/icons/share.png" width="16px"></button>
				<button class="btn" onclick="boss.ajax.load('/app/project/form_config/', '#app_conteiner');"><img src="/static/img/icons/tools.png" width="20px"></button>
			</div>
		</div>
	</div>
	<div id="app_pane_body" class="app-pane-body" style="background-color:#F9F9F9;">
		<div class="col-12 pull-left">
			<div class="card">
				<div class="card-content">
					<canvas id="viewport" width="1135px" height="300px">
					</canvas>
				</div>
				<div class="card-action">
					<h4 class="font-open-sans text-black">Visualizção em Grafo</h4>
				</div>
			</div>
		</div>

	</div>
</div>
<script type="text/javascript" src="/static/js/lib/arbor.js" async></script>
<script type="text/javascript" src="/static/js/lib/arbor-tween.js" async></script>
<script type="text/javascript" src="/static/js/lib/arbor-graphics.js" async></script>		
<script type="text/javascript" src="/static/js/lib/renderer.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var data = {
			nodes: {
				"projeto": {color:"red", shape:"dot", alpha:1},

				"Design": {color:"blue", shape:"dot", alpha:1},
					"tarefa1": {color:"skyblue", shape:"dot", alpha:1},
						"item1": {color:"slategrey", alpha:0, link:''},
						"item2": {color:"slategrey", alpha:0, link:''},


					"tarefa3": {color:"skyblue", shape:"dot", alpha:1},
						"item5": {color:"slategrey", alpha:0, link:''},
						"item6": {color:"slategrey", alpha:0, link:''},
							
				"Programacao": {color:"blue", shape:"dot", alpha:1},
					"tarefa2": {color:"skyblue", shape:"dot", alpha:1},
						"item3": {color:"slategrey", alpha:0, link:''},
						"item4": {color:"slategrey", alpha:0, link:''},


					"tarefa3": {color:"skyblue", shape:"dot", alpha:1},
						"item5": {color:"slategrey", alpha:0, link:''},
						"item6": {color:"slategrey", alpha:0, link:''},
			},
			edges: {
				"projeto": {
					"Design": {length:.8},
					"Programacao": {length:.8}
				},
				"Design": {
					"tarefa1": {},
					"tarefa3": {}
				},
				"Programacao": {
					"tarefa2": {},
					"tarefa3": {}
				},
				"tarefa1": {
					"item1": {},
					"item2": {},
				},
				"tarefa2": {
					"item3": {},
					"item4": {},
				},
				"tarefa3": {
					"item5": {},
					"item6": {},
				},
			}
		}

		var sys = arbor.ParticleSystem();
		sys.parameters({gravity:true, dt:0.005});
		sys.renderer = Renderer("#viewport", ["tarefa1", "tarefa2", "tarefa3"]);
		sys.graft(data);
		
		if(boss.isMobile()){
			$('#btn_group_options').css({'width': '100%!important'});
			$('#btn_group_icons').addClass('mobile-hidden');
		}
	});
</script>