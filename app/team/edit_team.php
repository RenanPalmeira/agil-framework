<?php

require_once 'init.php';

use Agil\View\View as View;
use Agil\Helpers\Slugify as Slugify;
use Agil\Session\Session as Session;

$request = View::route($_POST);


if($request['METHOD']=='POST'
	&& !empty($request['name'])
	&& Session::exist('logado')
	&& (!empty($request['website'])
	|| !empty($request['delete']))){

	$pk = $request['pk'];
	$logado = Session::get('logado');
	$name = $request['name'];
	$website = $request['website'];
	$slug = Slugify::toSlug($name);
	$delete = $request['delete'] ? $request['delete'] : 0;

	if($delete){
			$model = new Team();
			$sql = array(
				'id_team'	=> $pk,
				'status'	=> '1'
			);

			$fields = array("id_project");
			$rs = $model->get($sql);
			$rs = $rs[0];

			$model->fields = array('status'=>'0');
			$update = $model->update($sql);
			
			if($update){
				?>
				<script type="text/javascript">
					var timePopup = setTimeout(function(){
						window.parent.boss.removeClass('modal_dialog', 'active');
						window.parent.boss.ajax.load('/app/team/view_team/?pk=<?php echo $rs["id_project"];?>', '#app_pane_body');
					}, 100);
					window.parent.boss.popup("Deletada ao criar equipe.");
				</script>
				<?php
			}
			else{
				?>
				<script type="text/javascript">
					var timePopup = setTimeout(function(){
						window.parent.boss.removeClass('modal_dialog', 'active');
						window.parent.boss.ajax.load('/app/team/view_team/?pk=<?php echo $rs["id_project"];?>', '#app_pane_body');
					}, 100);
					window.parent.boss.popup("Error ao deletar equipe.");
				</script>
				<?php
			}
	}
	else{
		$model = new Team();
		$sql = array(
			'id_team'	=> $pk,
			'status'	=> '1'
		);

		$fields = array("id_project");
		$rs = $model->get($sql);
		$rs = $rs[0];

		$model->fields = array('name'=>$name, 'website'=>$website, 'slug'=> $slug);
		$update = $model->update($sql);

		if($update){
			?>
			<script>
				var timePopup = setTimeout(function(){
					window.parent.boss.removeClass('modal_dialog', 'active');
					window.parent.boss.ajax.load('/app/team/view_team/?pk=<?php echo $rs["id_project"];?>', '#app_pane_body');
				}, 100);
				window.parent.boss.popup("Sucesso ao editar equipe.");
			</script>
			<?php
		}
		else{
			?>
			<script>
				var timePopup = setTimeout(function(){
					window.parent.boss.removeClass('modal_dialog', 'active');
					window.parent.boss.ajax.load('/app/team/view_team/?pk=<?php echo $pk;?>', '#app_pane_body');
				}, 100);
				window.parent.boss.popup("Error ao criar equipe.");
			</script>
			<?php
		}
	}
}
else {
	?>
	<script>
		window.parent.boss.ajax.load('/app/team/view_team/');
		window.parent.boss.removeClass('modal_dialog', 'active');
		window.parent.boss.popup("Erro ao criar equipe.");
	</script>
	<?php
}
?>