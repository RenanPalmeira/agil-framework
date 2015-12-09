<?php
	require_once 'init.php';

	use Agil\Session\Session as Session;

	$logado = Session::get('logado');

	$model = new Project();
	$sql = array(
		'id_admin' => $logado['id_member'],
		'status'	=> 1
	);
	$count = $model->count($sql);

	if($count>0){
		$fields = array("id_project");
		$model->fields = $fields;
		$projects = $model->get($sql);
		$project = $projects[0];
	}
	else{
		$model = new ProjectMemberSet();
		$sql = array(
			'id_member' => $logado['id_member'],
			'status'	=> 2
		);
		$count = $model->count($sql);
		if($count>0){
			$fields = array("id_project");
			$model->fields = $fields;
			$projects = $model->get($sql);
		
		}
	}
?>
<div class="app-pane">
	<div class="app-pane-header">
		<div class="btn-group">
			<a href="javascript: void(0);" class="btn btn-primary" onclick="boss.bookmark.set('tab', '/app/user/view_overview/');boss.ajax.load('/app/user/view_overview/', '#app_conteiner');">Visão Geral</a>
			<a href="javascript: void(0);" class="btn" onclick="boss.bookmark.set('tab', '/app/project/view_project/');boss.ajax.load('/app/project/view_project/', '#app_conteiner');">Projetos</a>
		</div>
	</div>
	<div class="app-pane-body" style="background-color:#F9F9F9;">
		<div class="col-12">
			<div class="col-4 pull-left">
				<div class="card bleed-top bleed-bottom">
					<div class="card-content text-center">
						<?php
							$image = new MemberImage();
							$i = $image->get(array('id_member'=>$logado['id_member']));
							$img = "/static/img/icons/user_black.png";
							if(count($i)>0) {
								if(array_key_exists('src', $i[0])) {
									$img = 'media/'.str_replace("\\", "/", $i[0]['src']);
								}
							}
						?>
						<img src="<?php echo $img;?>" width="150px" class="img-circle img-border">
					</div>
					<div class="card-action text-center">
						<h4 class="title"><?php echo $logado['name'] ?></h4>
					</div>
				</div>
			</div>
			<div class="col-8 pull-left">
				<div class="card">
					<div class="card-content">
						<h3 class="font-open-sans">Últimas tarefas</h3>
					</div>
				</div>
				<?php
					if($count){
						foreach ($projects as $project) {
							$sql = array(
								"id_project" => $project['id_project'], 
								"status"	 => 1
							);

							$fields = array("id_project_task", "title", "color");
							$model = new ProjectTask();
							$model->fields = $fields;
							$tasks = $model->get($sql, 'id_project_task ASC');
							
							foreach ($tasks as $task) {
								$query = array(
									"id_project_task" => $task['id_project_task'],
									"status"		  => 1
								);

								$fields = array("id_project_task_items", "title", "comment");
								$model = new ProjectTaskItems();
								$model->fields = $fields;
								$items = $model->get($query, 'id_project_task_items DESC', '3');

								foreach ($items as $item) {
									$border = "border-left-".$task['color'];
									?>
									<div class="card card-effect <?php echo $border;?>" onclick="$('#modal_window').empty(); boss.ajax.load('/app/task/view_item/?pk=<?php echo $item['id_project_task_items'];?>', '#modal_window', 'active');">
										<div class="card-content">
											<h5><?php echo $item['title']; ?></h5>
										</div>
									</div>
									<?php
								}
							}
						}
					}
				?>
			</div>
		</div>
	</div>
</div>
