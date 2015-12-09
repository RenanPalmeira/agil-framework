<?php
	require_once 'init.php';

	use Agil\View\View as View;
	use Agil\Session\Session as Session;
	
	$logado = Session::get('logado');
	$request = View::route($_GET);
	$pk = $request['pk'];

	$sql = array(
		"id_project" => $pk, 
		"status"	 => 1
	);

	$fields = array("id_team", "id_project","id_admin", "name", "website", "slug");
	$model = new Team();
	$model->fields = $fields;

	$team = null;
	$teams = null;
	$count = $model->count($sql);
	if($count>0) {

		$teams = $model->get($sql);
		$team = $teams[0];
	
		$sql = array(
			"id_team" => $team['id_team'], 
			"status"	 => 1
		);

		$fields = array('id_member');
		$model = new TeamMemberSet();
		$model->fields = $fields;
		$rsTeamMembers = $model->get($sql);

		$sql = array(
			'id_project' => $team['id_project'],
			'status'=>'2'
		);

		$fields = array('id_member');
		$model = new ProjectMemberSet();
		$model->fields = $fields;
		$rs = $model->get($sql);
	}
?>
<div class="app-pane-body" style="background-color:#F9F9F9;">
	<div class="col-12 pull-center">
		<div class="col-11 pull-center">
			<div class="card-group">
				<div class="card">
					<div class="card-content">
						<div class="col-12">
							<div class="col-9 pull-left">
								<h2>Equipes</h2>
							</div>
							<?php
								if(is_array($team) && $team['id_admin'] == $logado['id_member']){
								?>
								<div class="col-3 pull-left text-right">
									<div class="btn-group">
										<button class="btn btn-primary" onclick="boss.ajax.load('/app/team/form_team_create/?pk=<?php echo $pk;?>', '#modal_dialog', 'active');">Criar equipe</button>
									</div>
								</div>
								<?php 
								}
							?>
						</div>
					</div>
				</div>
			</div>
			<?php 
				if(is_array($teams)) {

					foreach ($teams as $index => $team) {
						$name = mb_strimwidth($team['name'], 0, 15, "...");
					?>
					<div class="col-4 pull-left">
						<div class="card card-effect">
							<div class="card-image" onclick="boss.ajax.load('/app/team/view_team_overview/?pk=<?php echo $team['id_team'];?>', '#modal_dialog', 'active');">
								<img src="/static/img/icons/group_black.png" width="200px" heigth="177px"/>
							</div>
							<div class="card-action">
								<h3 id="task_title_1" class="font-open-sans link title" onclick="boss.ajax.load('/app/team/view_team_overview/?pk=<?php echo $team['id_team'];?>', '#modal_dialog', 'active');">
									<?php echo $name; ?>
								</h3>
								<?php
									if($team['id_admin'] == $logado['id_member']){
								?>
								<span class="card-icon icon" onclick="boss.addClass('card_hidden_<?php echo $index; ?>', 'active')">
									<i class="icon-dot"/>
									<i class="icon-dot"/>
									<i class="icon-dot"/>
								</span>
								<?php 
									} 
								?>
							</div>
							<div id="card_hidden_<?php echo $index; ?>" class="card-content-hidden">
								<i class="icon icon-close" onclick="boss.removeClass('card_hidden_<?php echo $index; ?>', 'active')"></i>
								<ul class="list-group">
									<li class="list-group-title bg-blue-light text-white">
										<?php echo $name ?>	
									</li>
									<li class="list-group-item list-group-hover" onclick="boss.ajax.load('/app/team/form_team_edit/?pk=<?php echo $team['id_team'];?>', '#modal_dialog', 'active');">
										<img src="/static/img/icons/edit_black.png" width="20px" style="position:absolute; left:30px;">Editar
									</li>
									<li class="list-group-item list-group-hover" onclick="boss.ajax.load('/app/team/form_member_team_set/?pk=<?php echo $team['id_team'];?>', '#modal_dialog', 'active');">
										<img src="/static/img/icons/add_black.png" width="20px" style="position:absolute; left:30px;">Membro
									</li>
								</ul>
							</div>
						</div>
					</div>
					<?php
					}
				}
			?>
		</div>
	</div>
</div> 