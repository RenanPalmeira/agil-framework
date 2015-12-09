<?php
	require_once 'init.php';

	use Agil\View\View as View;
	use Agil\Session\Session as Session;

	$logado = Session::get('logado');
	$request = View::route($_GET);
	$pk = $request['pk'];

	$query = array(
		"id_project_task_items" => $pk,
		"status"		  => 1
	);

	$fields = array("id_project_task_items", "id_project_task", "title", "comment");
	$model = new ProjectTaskItems();
	$model->fields = $fields;
	$item = $model->get($query);
	$item = $item[0];

	if(ctype_upper($item['comment'])){
		$comment = mb_strimwidth($item['comment'], 0, 150, "..."); 
	}
	else{
		$comment = mb_strimwidth($item['comment'], 0, 150, "...");
	}

	$sql = array(
		"id_project_task" => $item['id_project_task'],
		"status"		  => 1
	);

	$fields = array("id_project");
	$model = new ProjectTask();
	$model->fields = $fields;
	$task = $model->get($sql);
	$task = $task[0];

	$sql = array(
		"id_project" => $task['id_project'],
		"status"		  => 1
	);

	$fields = array("id_admin");
	$model = new Project();
	$model->fields = $fields;
	$project = $model->get($sql);
	$project = $project[0];

	$sql = array(
		"id_project_task_items" => $pk,
		"status"				=> 1
	);

	$fields = array("id_member");
	$model = new ProjectTaskItemsMemberSet();
	$model->fields = $fields;
	$rsItemMembers = $model->get($sql);
?>
<div class="window">
	<button class="icon-close-window" onclick="boss.removeClass('modal_window', 'active');boss.bookmark.remove('comment_loadplace');"></button>
	<div class="window-header">
		<div class="container">
			<h2 id="window_title"><?php echo $item['title']; ?></h2>
		</div>
	</div>
	<div class="window-content">
		<div class="container">
			<div class="col-8 pull-left">
				<div id="window_content" class="col-12 pull-left" style="padding-bottom: 8px; margin-bottom:10px; border-bottom:1px solid #D6DADC;">
					<p><?php echo $comment; ?></p>
				</div>
				<div id="window_members" class="col-12 pull-left">
					<?php 
						if(count($rsItemMembers)>0){
							?>
							<b>Membros:</b>
							<?php
							foreach ($rsItemMembers as $rsItemMember) {
								$query = array(
									"id_member" => $rsItemMember['id_member'],
									"status"	=> 1
								);

								$fields = array("name");
								$model = new Member();
								$model->fields = $fields;
								$rsMembers = $model->get($query);
								$rsMembers = $rsMembers[0];

								?>
								<p class='btn btn-xs btn-disabled' style='margin-left:2px; cursor: default!important; opacity:1;'><?php echo $rsMembers['name']; ?></p>
								<?php
							}
						}
					?>
				</div>
				<div class="col-12 pull-left" style=" margin-top:10px;">
					<b>Progresso:</b>
					<div class="progress">
						<div id="progress-bar" class="progress-bar" style="width:0%;">0%</div>
					</div>
				</div>
				<div class="col-12 pull-left">
					<div class="col-12 fancy-scrollbar" style="position: relative; overflow-y: auto; overflow-x: hidden; max-height:100px; height:100px; margin-bottom:5%; border-bottom:1px solid #D6DADC; box-shadow: 0 2px 2px -2px gray;">
						<ul id="window_items" class="list-group">
							<?php 
								$sql = array(
									"id_project_task_items" => $pk,
									"status"				=> 1
								);

								$fields = array("id_project_task_items_subitems", "title", "checked");
								$model = new ProjectTaskItemsSubitems();
								$model->fields = $fields;
								$rsSubItems = $model->get($sql);

								if(count($rsSubItems)>0){
									?>
									<b>Items:</b>
									<?php
									foreach ($rsSubItems as $rsSubItem) {
										if($rsSubItem['checked']==1){
											$checked = "checked";
										}
										else{
											$checked = "";
										}
										?>
										<li class="list-group-hover">
											<label>
												<input type="checkbox" onclick="boss.ajax.post('/app/task/update_subitem/', {pk: <?php echo $rsSubItem['id_project_task_items_subitems']; ?>});boss.progress('#progress-bar')" id="<?php echo $rsSubItem['id_project_task_items_subitems']; ?>" class="checkbox" <?php echo $checked; ?>>&nbsp;&nbsp;&nbsp;<?php echo $rsSubItem['title']; ?>
											</label>
											<div class="list-group-hidden pull-right">
												<button class="btn btn-xs" onclick="boss.removeClass('modal_window', 'active');boss.ajax.load('/app/task/form_edit_subitem/?pk=<?php echo $rsSubItem['id_project_task_items_subitems']; ?>', '#modal_dialog', 'active');boss.progress('#progress-bar');">Editar</button>
												<button class="btn btn-xs btn-danger" onclick="boss.removeClass('modal_window', 'active');boss.ajax.load('/app/task/form_remove_subitem/?pk=<?php echo $rsSubItem['id_project_task_items_subitems']; ?>', '#modal_dialog', 'active');boss.progress('#progress-bar');">Remove</button>
											</div>
										</li>
										<?php
									}
								}
							?>
						</ul>
					</div>
				</div>
				<div class="col-12 pull-left">
					<form action="/app/task/create_item_comment/" method="post" target="iframesubmit">
						<label>Comentar</label>
						<div class="form-group">
							<div class="col-8 pull-left">
								<input type="hidden" id="pk" name="pk" value="<?php echo $pk;?>">
								<input name="comment" type="text" placeholder="Nome do projeto" class="form-control" autocomplete="off">
							</div>
							<div class="col-3 pull-right">
								<input type="submit" class="btn btn-success btn-block" value="Comentar">
							</div>
						</div>
					</form>
				</div>
				<div id="comment_loadplace" class="col-12 pull-left bleed-top"></div>
			</div>
			<div class="col-3 pull-right text-center">
				<input type="hidden" id="window_pk" value="0">
				<ul class="list-group">
					<li class="list-group-title bg-blue-light text-white title">
						Opções												
					</li>
					<li id="window_check" onclick="boss.removeClass('modal_window', 'active');boss.ajax.load('/app/task/form_filed_item/?pk=<?php echo $pk;?>', '#modal_dialog', 'active');" class="list-group-item list-group-hover">
						<img src="/static/img/icons/check_black.png" width="25px" style="position:absolute; left:17px;">&nbsp;&nbsp;Concluido
					</li>
					<li id="window_add_members" onclick="boss.removeClass('modal_window', 'active');boss.ajax.load('/app/task/form_create_item_member/?pk=<?php echo $pk;?>', '#modal_dialog', 'active');" class="list-group-item list-group-hover">
						<img src="/static/img/icons/add_black.png" width="25px" style="position:absolute; left:17px;">&nbsp;&nbsp;Membros
					</li>
					<li id="window_add_item" onclick="boss.removeClass('modal_window', 'active');boss.ajax.load('/app/task/form_create_subitem/?pk=<?php echo $pk;?>', '#modal_dialog', 'active');" class="list-group-item list-group-hover">
						<img src="/static/img/icons/documento_black.png" width="25px" style="position:absolute; left:17px; margin-right:20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Adicionar Item
					</li>
					<li id="window_move" onclick="boss.removeClass('modal_window', 'active');boss.ajax.load('/app/task/form_move/?pk=<?php echo $pk; ?>&pk2=<?php echo $task['id_project']; ?>', '#modal_dialog', 'active');" class="list-group-item list-group-hover">
						<img src="/static/img/icons/arrow_black.png" width="20px" style="position:absolute; left:17px;">Mover
					</li>
					<li id="window_edit" onclick="boss.removeClass('modal_window', 'active');boss.ajax.load('/app/task/form_edit_item/?pk=<?php echo $pk; ?>', '#modal_dialog', 'active');" class="list-group-item list-group-hover">
						<img src="/static/img/icons/edit_black.png" width="20px" style="position:absolute; left:17px;">Ediar
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	boss.progress('#progress-bar');
	var url = '/app/team/view_team_comment/?pk=<?php echo $pk;?>&admin=<?php echo $project["id_admin"];?>';
	boss.ajax.load(url, "#comment_loadplace");
	boss.bookmark.set('comment_loadplace', url, true);
</script>