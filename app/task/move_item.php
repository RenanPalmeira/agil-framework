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
	&& (!empty($request['card'])
	|| !empty($request['arquiva']))) {

		$arquiva = $request['arquiva'];
		$card = $request['card'];
		$pk = $request['pk'];
		
		if($arquiva){
			$model = new ProjectTaskItems();
			$sql = array(
				'id_project_task_items' => $pk,
				'status'				=> 1
			);
			$rs = $model->get($sql);
			$fields = array("id_project_task");
			$rs = $rs[0];


			$modelTask = new ProjectTask();
			$sql = array(
				'id_project_task' => $rs['id_project_task'],
				'status'				=> 1
			);
			$fields = array("id_project");
			$modelTask->fields = $fields;

			$rs = $modelTask->get($sql);
			$rs = $rs[0];

			$model->fields = array('status' => 2);
			$update = $model->update($sql);
			?>
			<script>
				var timePopup = setTimeout(function(){
					window.parent.boss.ajax.load('/app/task/view_task/?pk=<?php echo $rs["id_project"];?>', '#app_pane_body');
					window.parent.boss.removeClass('modal_dialog', 'active');
				}, 100);
				window.parent.boss.popup("Sucesso ao arquiva tarefa.");
			</script>
			<?php
		}
		else{
			$model = new ProjectTaskItems();
			$sql = array(
				'id_project_task_items' => $pk,
				'id_project_task'		=> $request['card'],
				'status'				=> '1'
			);

			$count = $model->count($sql);

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
				
				$query = array(
					'id_project_task' => $card,
					'status'    => '1'
				);

				$sql = array(
					'id_project_task_items' => $pk,
					'status' => '1'
				);

				$modelTask = new ProjectTask();
				$fields = array("id_project");
				$modelTask->fields = $fields;

				$rs = $modelTask->get($query);
				$rs = $rs[0];

				$model->fields = array('id_project_task'=>$card);
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
			window.parent.boss.popup("Erro ao mover tarefa.");
		</script>
		<?php
	}