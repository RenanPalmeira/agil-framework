<?php
	require_once 'init.php';

	use Agil\View\View as View;
	use Agil\Session\Session as Session;

	$request = View::route($_GET);
	$logado = Session::get('logado');
	$pk = $request['pk'];

	$sql = array(
		'id_member' => $logado['id_member'],
		'status'	=> '1'
	);

	$fields = array('id_member', 'id_project_task_items', 'id_admin');
	$model = new ProjectTaskItemsMemberSet();
	$model->fields = $fields;
	$rsItemMembers = $model->get($sql);

	if(count($rsItemMembers)==0){
		$sql = array(
			'id_admin' => $logado['id_member'],
			'status'	=> '1'
		);

		$fields = array('id_member', 'id_project_task_items', 'id_admin');
		$model = new ProjectTaskItemsMemberSet();
		$model->fields = $fields;
		$rsItemMembers = $model->get($sql);		
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
								<h2>Tarefas abertas</h2>
							</div>
							<div class="col-3 pull-left text-right">
								<div class="btn-group">
									<button class="btn" onclick="boss.ajax.load('/app/task/view_my_task/?pk=<?php echo $pk; ?>', '#app_pane_body');">Abertas</button>
									<button class="btn btn-primary" onclick="boss.ajax.load('/app/task/view_my_close_task/?pk=<?php echo $pk; ?>', '#app_pane_body');">Entregues</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php 
					foreach ($rsItemMembers as $rsItemMember) {
						$sql = array(
							'id_project_task_items' => $rsItemMember['id_project_task_items'],
						);

						$fields = array('id_project_task_items', 'id_project_task', 'title', 'comment');
						$model = new ProjectTaskItems();
						$model->fields = $fields;
						$rsItem = $model->get($sql);
						$rsItem = $rsItem[0];

						$sql = array(
							'id_project_task' => $rsItem['id_project_task'],
							'id_project'	  => $pk,
							'status'		  => '1'
						);

						$fields = array('id_project_task');
						$model = new ProjectTask();
						$model->fields = $fields;
						$tasks = $model->get($sql);
						$task = count($tasks)>0 ? $tasks[0] : $tasks;

						if(count($tasks)>0){

							$sql = array(
								'id_project_task' => $task['id_project_task'],
							);

							$fields = array('id_project_task_items', 'id_project_task', 'title', 'comment', 'status');
							$model = new ProjectTaskItems();
							$model->fields = $fields;
							$rsItem = $model->get($sql);
							$rsItem = $rsItem[0];
							
							if($rsItem['status']==2){
								if($rsItem['id_project_task']==$task['id_project_task'] || $logado['id_member']==$rsItemMember['id_admin']){
									?>
									<div class="card" onclick="boss.popup('Tarefa concluída e arquivada.');" disabled>
										<div class="card-content">
											<div class="col-12 pull-left" style="padding-bottom:1%;">
												<h3><?php echo $rsItem['title']; ?></h3>
											</div>
											<div class="col-12 pull-left" style="padding-bottom:1%;">
												<p><?php echo $rsItem['comment']; ?></p>
											</div>
											<div class="col-12 pull-left" style="border-top:1px solid #ddd;padding:1%;">
												<?php 
													$query = array(
														"id_member" => $rsItemMember['id_member'],
														"status"	=> 1
													);

													$fields = array("name");
													$model = new Member();
													$model->fields = $fields;
													$rsMembers = $model->get($query);
													foreach ($rsMembers as $rsMember) {
														?>
														<div class="col-6 pull-left">
															<b class="font-lato bold">Membros:</b>
															<span class="btn btn-xs text-white"><?php echo $rsMember['name']; ?></span>
														</div>
														<?php
													}

													$sql = array(
														"id_project_task_items" => $rsItem['id_project_task_items'],
														"status"				=> 1
													);

													$fields = array("id_project_task_items_comments", "id_member", "body");
													$comments = new ProjectTaskItemsComments();
													$comments->fields = $fields;
													$rsComments = $comments->get($sql, 'id_project_task_items_comments DESC');

													$num = count($rsComments);
												?>
												<div class="col-6 pull-left">
													<p class="font-lato bold">Comentarios: <?php echo $num;?></p>
												</div>
											</div>
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