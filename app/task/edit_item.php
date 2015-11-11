<?php
	require_once 'init.php';

	use Agil\View\View as View;
	use Agil\Config\Config as Config;
	use Agil\Session\Session as Session;

	$request = View::route($_POST);

	$pk = $request['pk'];

	if($request['METHOD']=='POST' 
	&& !empty($request['pk'])
	&& Session::exist('logado')
	&& (!empty($request['delete'])
	|| !empty($request['title']) 
	|| !empty($request['comment']))){

		$title = $request['title'];
		$comment = $request['comment'];
		$pk = $request['pk'];
		$delete = $request['delete'];

		$model = new ProjectTaskItems();
		$sql = array(
			'id_project_task_items' => $pk,
			'status'    => '1'
		);

		$fields = array("id_project_task");
		$model->fields = $fields;
		$rs = $model->get($sql);
		$rs = $rs[0];

		$query = array(
			'id_project_task' => $rs['id_project_task'],
			'status'    => '1'
		);

		$modelProject = new ProjectTask();
		$fields = array("id_project");
		$modelProject->fields = $fields;

		$rs = $modelProject->get($query);
		$rs = $rs[0];


		if($delete){

			$model->fields = array('status'=>'0');
			$update = $model->update($sql);

			if($update){
				?>
				<script>
					var timePopup = setTimeout(function(){
						window.parent.boss.ajax.load('/app/task/view_task/?pk=<?php echo $rs["id_project"];?>', '#app_pane_body');
						window.parent.boss.removeClass('modal_dialog', 'active');
					}, 100);
					window.parent.boss.popup("Tarefa deletada com sucesso.");
				</script>
				<?php
			}
		}
		else{
			$query = array(
				'id_project_task_items' => $pk,
				'title' => $title,
				'comment' => $comment,
				'status' => '1'
			);

			$count = $model->count($query);

			if($count!=0){
				?>
				<script>
					var timePopup = setTimeout(function(){
						window.parent.boss.removeClass('modal_dialog', 'active');
					}, 100);
				</script>
				<?php
			}
			else{
				
				$model->fields = array('title'=>$title, 'comment'=>$comment);
				$update = $model->update($sql);

				if($update){
					?>
					<script>
						var timePopup = setTimeout(function(){
							window.parent.boss.ajax.load('/app/task/view_task/?pk=<?php echo $rs["id_project"];?>', '#app_pane_body');
							window.parent.boss.removeClass('modal_dialog', 'active');
						}, 100);
						window.parent.boss.popup("Sucesso ao atualizar tarefa.");
					</script>
					<?php
				}
			}
		}
	}
	else {
		?>
		<script>
			var timePopup = setTimeout(function(){
				window.parent.boss.removeClass('modal_dialog', 'active');
			}, 100);
			window.parent.boss.popup("Erro ao atualizar tarefa.");
		</script>
		<?php
	}