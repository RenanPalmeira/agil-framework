<?php
	require_once 'init.php';

	use Agil\View\View as View;
	
	$request = View::route($_GET);
	$pk = $request['pk'];

	$sql = array(
		"id_project" => $pk, 
		"status"     => 1
	);


	$fields = array("id_project_task", "title", "color");
	$model = new ProjectTask();
	$model->fields = $fields;
	$rs = $model->get($sql);
?>
<div id="app_pane_body" class="app-pane-body" style="background-color:#F9F9F9;">
	<div class="board-wrapper">
		<div class="board-surface fancy-scrollbar">
			<?php
				if(count($rs)>0) {
					foreach ($rs as $index => $task) {
					?>
					<div class="board-list">
						<div class="board-list-content fancy-scrollbar btn-<?php echo $task['color'];?>">
							<div class="board-list-title">
								<div class="col-9 pull-left text-left"><?php echo $task['title'];?></div>
								<div class="col-3 pull-left text-right">
									<img src="/static/img/icons/gear_black.png" onclick="boss.ajax.load('/app/task/form_edit/?pk=<?php echo $task['id_project_task'];?>', '#modal_dialog', 'active');" onmouseover="boss.addClass('info_task_1', 'active');" onmouseout="boss.removeClass('info_task_1', 'active');" width="20px" class="img-effect">
								</div>
								<div id="info_task_1" class="popover left fade-popover" style="left:78px; width:50%;">
									<div class="arrow"></div>
									<p class="text-white no-bold">Configurações do cartão</p>
								</div>
							</div>
							<div class="card-group culmun">
								<div class="card" onclick="boss.modalWindow({'title':'Renan', 'content': 'programação', 'members': ['Wallace', 'Biatriz', 'Pedro']});">
									<div class="card-content">
										<div class="card-title">
											title
										</div>
									</div>
								</div>
							</div>
							<div class="board-list-add text-center" onclick="boss.ajax.load('/app/task/form_create/?pk=<?php echo $pk;?>', '#modal_dialog', 'active');">
								<h6 class="font-white bold">Adicionar um cartão</h6>
							</div>
						</div>
					</div>
					<?php
					}
				}
			?>
			<div class="no-board-list board-list-add text-center" onclick="boss.ajax.load('/app/task/form_create/?pk=<?php echo $pk;?>', '#modal_dialog', 'active');">
				<h6 class="font-white bold">Adicionar um cartão</h6>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$(".board-surface").sortable({
			axis: "x",
			revert: true,
			start: function(event, ui){
				ui.item.css({"transform": "rotateZ(-3deg)"});	
			},
			stop: function(event, ui){
				ui.item.css({"transform": "rotateZ(0deg)"});
			}
		});
		$(".board-list").disableSelection();

		if(boss.isMobile()){
			$('#btn_group_options').css({'width': '100%!important'});
			$('#btn_group_icons').addClass('mobile-hidden');
		}
	});
</script>
<!--<?php
	//require_once 'init.php';

	//use Agil\View\View as View;
	
	//$request = View::route($_GET);
?>
<div class="app-pane">
	<div class="app-pane-header">
		<div class="col-6 pull-left">
			<div class="btn-group">
				<a class="btn btn-primary" onclick="boss.ajax.load('/app/task/view_task/?pk=<?php echo $request['pk'];?>', '#app_conteiner');">Projeto</a>
				<a class="btn" onclick="boss.ajax.load('/app/task/view_my_task/', '#app_pane_body');">Minhas tarefas</a>
				<a class="btn" onclick="boss.ajax.load('/app/team/view_team/', '#app_pane_body');">Equipes</a>
				<a class="btn" onclick="boss.ajax.load('/app/team/view_task_member/', '#app_pane_body');">Colaboradores</a>
			</div>
		</div>
		<div class="col-6 pull-left text-right">
			<div class="btn-group">
				<button class="btn btn-primary" onclick="boss.ajax.load('/app/task/view_task/?pk=<?php echo $request['pk'];?>', '#app_conteiner');"><img src="/static/img/icons/graphic.png" width="32px"></button>
				<button class="btn" onclick="boss.ajax.load('/app/graph/view_graph/', '#app_conteiner');"><img src="/static/img/icons/share.png" width="16px"></button>
				<button class="btn" onclick="boss.ajax.load('/app/project/form_config/?pk=<?php echo $request['pk'];?>', '#app_pane_body');"><img src="/static/img/icons/tools.png" width="20px"></button>
			</div>
		</div>
	</div>
	<div id="app_pane_body" class="app-pane-body">
		<div class="board-wrapper">
			<div class="board-surface fancy-scrollbar">
				<div class="board-list">
						<div class="board-list-content fancy-scrollbar">
						<div class="board-list-title">
							<div class="col-9 pull-left text-left">A Fazer</div>
							<div class="col-3 pull-left text-right">
								<img src="/static/img/icons/plus_black.png" onclick="boss.ajax.load('/app/project/form_create/', '#modal_dialog', 'active');" onmouseover="boss.addClass('info_task_1', 'active');" onmouseout="boss.removeClass('info_task_1', 'active');" width="20px" class="img-effect">
							</div>
							<div id="info_task_1" class="popover left fade-popover" style="left:78px; width:50%;">
								<div class="arrow"></div>
								<p class="text-white no-bold">Adicionar Tarefa</p>
							</div>
						</div>
						<div class="card-group culmun">
							<div class="card">
								<div class="card-content">
									<div class="card-title">
										title
									</div>
									<div class="card-badges-left">
										<div class="col-3 pull-left text-right">
											<img src="/static/img/icons/arrow_black.png" onclick="boss.ajax.load('/app/project/form_create/', '#modal_dialog', 'active');" onmouseover="boss.addClass('info_move_1', 'active');" onmouseout="boss.removeClass('info_move_1', 'active');" width="20px" class="img-effect">
										</div>
										<div id="info_move_1" class="popover right fade-popover text-center" style="left:40px; top:50px; width:50%;">
											<div class="arrow"></div>
											<p class="text-white no-bold">Mover cartão</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="no-board-list board-list-add text-center" onclick="boss.ajax.load('/app/project/form_create/', '#modal_dialog', 'active');">
					<h6 class="font-white bold">Adicionar uma lista</h6>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$(".btn-group .btn").on('click', function(){
			$(".btn-group .btn").removeClass('btn-primary');
			$(this).addClass("btn-primary");
		});
		$(".culmun").sortable({
			axis: "y",
			start: function(event, ui){
				ui.item.css({"transform": "rotateZ(-3deg)"});
			},
			stop: function(event, ui){
				ui.item.css({"transform": "rotateZ(0deg)"});
			}
		});
		$(".card").disableSelection();

		$(".board-surface").sortable({
			axis: "x",
			revert: true,
			start: function(event, ui){
				ui.item.css({"transform": "rotateZ(-3deg)"});	
			},
			stop: function(event, ui){
				ui.item.css({"transform": "rotateZ(0deg)"});
			}
		});
		$(".board-list").disableSelection();

		if(boss.isMobile()){
			$('#btn_group_options').css({'width': '100%!important'});
			$('#btn_group_icons').addClass('mobile-hidden');
		}
	});
</script>//-->