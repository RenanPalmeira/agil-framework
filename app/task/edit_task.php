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
	|| !empty($request['color']))){

		$title = $request['title'];
		$color = $request['color'];
		$pk = $request['pk'];
		$delete = $request['delete'];

		if($delete){
			$model = new ProjectTask();
			$sql = array(
				'id_project_task' => $pk,
				'status'    => '1'
			);

			$fields = array("id_project");
			$model->fields = $fields;

			$rs = $model->get($sql);
			$rs = $rs[0];

			$model->fields = array('status'=>'0');
			$update = $model->update($sql);

				
			if($update){
				?>
				<script>
					var timePopup = setTimeout(function(){
						window.parent.boss.ajax.load('/app/task/view_task/?pk=<?php echo $rs["id_project"];?>', '#app_pane_body');
						window.parent.boss.removeClass('modal_dialog', 'active');
					}, 100);
					window.parent.boss.popup("Cartão deletado com sucesso.");
				</script>
				<?php
			}
		}
		else{
			$model = new ProjectTask();
			$sql = array(
				'id_project_task' => $pk,
				'status'    => '1'
			);
			
			$query = array(
				'id_project_task' => $pk,
				'title' => $title,
				'color' => $color
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
				$model->fields = array('title'=>$title, 'color'=>$color);
				$update = $model->update($sql);

				$fields = array("id_project");
				$model->fields = $fields;

				$rs = $model->get($sql);
				$rs = $rs[0];

				if($update){
					?>
					<script>
						var timePopup = setTimeout(function(){
							window.parent.boss.ajax.load('/app/task/view_task/?pk=<?php echo $rs["id_project"];?>', '#app_pane_body');
							window.parent.boss.removeClass('modal_dialog', 'active');
						}, 100);
						window.parent.boss.popup("Sucesso ao atualizar cartão.");
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
			window.parent.boss.popup("Erro ao atualizar cartão.");
		</script>
		<?php
	}