<?php
	require_once 'init.php';

	use Agil\View\View as View;

	
	$request = View::route($_GET);
	$pk = $request['pk'];

	$sql = array(
		"id_project" => $pk, 
		"status"     => 1
	);

	$fields = array("id_project_task", "id_project", "title", "color");
	$model = new ProjectTask();
	$model->fields = $fields;
	$tasks = $model->get($sql);

	$agil = new ProjectMethod();
	$count = $agil->count($sql);
	if($count==1) {
		$agil = $agil->get($sql);
		$agil = $agil[0]['agil_method'];
	}
?>
<div id="app_pane_body" class="app-pane-body" style="background-color:#F9F9F9;">
	<div class="board-wrapper">
		<div class="board-surface fancy-scrollbar">
			<?php
				if(count($tasks)>0) {
					$i=1;
					foreach ($tasks as $index => $task) {
					?>
					<div id="<?php echo $task['id_project_task']; ?>" class="board-list">
						<div class="board-list-content fancy-scrollbar btn-<?php echo $task['color'];?>">
							<div class="board-list-title">
								<div class="col-9 pull-left text-left"><?php echo mb_strimwidth($task['title'], 0, 15, "...");?></div>
								<div class="col-3 pull-left text-right">
									<img src="/static/img/icons/gear_black.png" onclick="boss.ajax.load('/app/task/form_edit/?pk=<?php echo $task['id_project_task'];?>', '#modal_dialog', 'active');" onmouseover="boss.addClass('info_task_<?php echo $i;?>', 'active');" onmouseout="boss.removeClass('info_task_<?php echo $i;?>', 'active');" width="20px" class="img-effect">
								</div>
								<div id="info_task_<?php echo $i;?>" class="popover left fade-popover" style="top: -8%; left:30%; width:50%;">
									<div class="arrow"></div>
									<p class="text-white no-bold">Configurações do cartão</p>
								</div>
							</div>
							<div class="card-group culmun">
							<?php
								$query = array(
									"id_project_task" => $task['id_project_task'],
									"status"     => 1
								);

								$fields = array("id_project_task_items", "id_project_task", "title", "comment");
								$model = new ProjectTaskItems();
								$model->fields = $fields;
								$items = $model->get($query);

								foreach ($items as $item){			
									if(ctype_upper($item['comment'])){
										$comment = mb_strimwidth($item['comment'], 0, 150, "..."); 
									}
									else{
										$comment = mb_strimwidth($item['comment'], 0, 150, "...");
									}
									?>
									<div class="card" onclick="$('#modal_window').empty(); boss.ajax.load('/app/task/view_item/?pk=<?php echo $item['id_project_task_items']; ?>', '#modal_window', 'active');">
										<div class="card-content">
											<div class="card-title">
												<?php echo $item['title']; ?>
											</div>
										</div>
									</div>
									<?php
								}
								?>
							</div>
							<div class="board-list-add text-center" onclick="boss.ajax.load('/app/task/form_create_item/?pk=<?php echo $task['id_project_task'];?>', '#modal_dialog', 'active');">
								<h6 class="font-white bold">
									<?php if ($agil=='scrum') :?>
										Adicionar um item
									<?php else: ?>
										Adicionar uma tarefa
									<?php endif; ?>
								</h6>
							</div>
						</div>
					</div>
					<?php
					$i++;
					}
				}
			?>
			<div class="no-board-list board-list-add text-center" onclick="boss.ajax.load('/app/task/form_create/?pk=<?php echo $pk;?>', '#modal_dialog', 'active');">
				<h6 class="font-white bold">
					<?php if ($agil=='scrum') :?>
						Adicionar um sprint
					<?php else: ?>
						Adicionar um cartão
					<?php endif; ?>
				</h6>
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
				ui.item.startPos = ui.item.index();	
			},
			stop: function(event, ui){
				ui.item.css({"transform": "rotateZ(0deg)"});
				/*console.log("Start position: " + ui.item.startPos);
				console.log("New position: " + ui.item.index());
				console.log("Id: " + ui.item.attr("id"));*/
			}
		});
		$(".board-list").disableSelection();

		if(boss.isMobile()){
			$('#btn_group_options').css({'width': '100%!important'});
			$('#btn_group_icons').addClass('mobile-hidden');
		}
	});
</script>