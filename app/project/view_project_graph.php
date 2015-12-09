<?php
	require_once 'init.php';

	use Agil\View\View as View;
	use Agil\Session\Session as Session;
	
	$logado = Session::get('logado');
	$request = View::route($_GET);
	$pk = $request['pk'];

	$model = new Project();
	$admin = $model->is_admin($request['pk'], $logado['id_member']);

	$sql = array(
		'id_project' => $pk,
		'status'	 => 1
	);

	$project = null;
	$fields = array('id_project', 'title');
	$model->fields = $fields;
	$projects = $model->get($sql);
	$count = $model->count($sql);
	$project = $projects[0];
?>
<div class="app-pane">
	<div class="app-pane-header">
		<div class="col-6 pull-left">
			<div id="btn_group_options" class="btn-group">
				<a class="btn btn-primary" onclick="boss.bookmark.remove('tab_project_<?php echo $request['pk'];?>');boss.ajax.load('/app/project/view_project_graph/?pk=<?php echo $request['pk'];?>', '#app_conteiner');">Projeto</a>
				<a class="btn" onclick="boss.bookmark.set('tab_project_<?php echo $request['pk'];?>', '/app/task/view_my_task/?pk=<?php echo $request['pk'];?>');boss.ajax.load('/app/task/view_my_task/?pk=<?php echo $request['pk'];?>', '#app_pane_body');">Minhas tarefas</a>
				<a class="btn" onclick="boss.bookmark.set('tab_project_<?php echo $request['pk'];?>', '/app/team/view_team/?pk=<?php echo $request['pk'];?>');boss.ajax.load('/app/team/view_team/?pk=<?php echo $request['pk'];?>', '#app_pane_body');">Equipe</a>
				<?php if($admin): ?>
					<a class="btn" onclick="boss.bookmark.set('tab_project_<?php echo $request['pk'];?>', '/app/team/view_task_member/?pk=<?php echo $request['pk'];?>');boss.ajax.load('/app/team/view_task_member/?pk=<?php echo $request['pk'];?>', '#app_pane_body');">Colaboradores</a>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-6 pull-left text-right">
			<div id="btn_group_icons" class="btn-group">
				<button class="btn" onclick="boss.bookmark.set('tab_project_<?php echo $request['pk'];?>', '/app/task/view_task/?pk=<?php echo $request['pk'];?>');boss.ajax.load('/app/task/view_task/?pk=<?php echo $request['pk'];?>', '#app_pane_body');"><img src="/static/img/icons/graphic.png" width="32px"></button>
				<button class="btn" onclick="boss.bookmark.set('tab_project_<?php echo $request['pk'];?>', '/app/graph/view_graph/');boss.ajax.load('/app/graph/view_graph/', '#app_pane_body');"><img src="/static/img/icons/share.png" width="16px"></button>
				<?php if($admin): ?>
					<button class="btn" onclick="boss.bookmark.set('tab_project_<?php echo $request['pk'];?>', '/app/project/form_config/?pk=<?php echo $request['pk'];?>');boss.ajax.load('/app/project/form_config/?pk=<?php echo $request['pk'];?>', '#app_pane_body');"><img src="/static/img/icons/tools.png" width="20px"></button>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div id="app_pane_body" class="app-pane-body" style="background-color:#F9F9F9;">
		<div class="col-12 pull-center">
			<div class="card">
				<div class="card-content">
					<div class="col-4 pull-left bleed-top bleed-bottom">
						<?php
							if($count>0) {
								$image = new ProjectImage();
								foreach ($projects as $project) {
									$i = $image->get(array('id_project'=>$project['id_project']));
									$img = "/static/img/icons/cubo_black.png";
									if(count($i)>0) {
										if(array_key_exists('src', $i[0])) {
											$img = 'media/'.str_replace("\\", "/", $i[0]['src']);
										}
									}
								}
							}
						?>
						<img src="<?php echo $img;?>"  width="200px" heigth="177px" style="border-radius:4px;">
					</div>
					<div class="col-8 pull-left bleed-top bleed-bottom">
						<h3 class="modal-title font-open-sans bleed-top">Olá <span class="title"><?php echo $logado['name'];?></span>, bem-vindo(a) ao <b class="title"><?php echo $project['title']?></b></h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(".btn-group .btn").on('click', function(){
		$(".btn-group .btn").removeClass('btn-primary');
		$(this).addClass("btn-primary");
	});
	if(boss.bookmark.get('tab_project_<?php echo $request['pk'];?>')){
		var url = boss.bookmark.get('tab_project_<?php echo $request['pk'];?>');
		boss.ajax.load(url, '#app_pane_body');
		
		var find_url = function(element, find) {
			if($(element).attr("onclick").indexOf(find)>-1) {
				$(".btn-group .btn").removeClass('btn-primary');
				$(element).addClass("btn-primary");
			}
		}
		$("#btn_group_icons button, #btn_group_options a").each(function(index, obj) { 
			find_url(obj, url);
		});
	}
</script>