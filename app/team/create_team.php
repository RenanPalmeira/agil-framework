<?php

require_once 'init.php';

use Agil\View\View as View;
use Agil\Helpers\Slugify as Slugify;
use Agil\Session\Session as Session;

$request = View::route($_POST);


if($request['METHOD']=='POST'
	&& !empty($request['name'])
	&& Session::exist('logado')
	|| !empty($request['website'])){


	$pk = $request['pk'];
	$logado = Session::get('logado');
	$name = $request['name'];
	$website = $request['website'];
	$slug = Slugify::toSlug($name);

	$fields = array(
   		'id_project' 	=> $pk,
   		'id_admin'		=> $logado['id_member'],
   		'name'			=> $name,
   		'website'		=> $website,
   		'slug'			=> $slug
   	);

   	$model = new Team($fields);
	$team = $model->save();

	if($team){
		?>
		<script>
			var timePopup = setTimeout(function(){
				window.parent.boss.removeClass('modal_dialog', 'active');
				window.parent.boss.ajax.load('/app/team/view_team/?pk=<?php echo $pk;?>', '#app_pane_body');
			}, 100);
			window.parent.boss.popup("Sucesso ao criar equipe.");
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