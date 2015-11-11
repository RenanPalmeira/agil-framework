<?php

require_once 'init.php';

use Agil\View\View as View;
use Agil\Config\Config as Config;
use Agil\Session\Session as Session;

$request = View::route($_POST);

if($request['METHOD']=='POST' 
	&& !empty($request['title']) 
	&& !empty($request['type_license']) 
	&& !empty($request['agil_method'])
	&& Session::exist('logado')) {

	$logado = Session::get('logado');
	$title = $request['title'];
	$type_license = $request['type_license'];
	$agil_method = $request['agil_method'];
	$slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $title);
	$id_admin = $logado['id_member'];
   	
   	$fields = compact('title', 'type_license', 'slug', 'id_admin');
   	$model = new Project($fields);
	$project = $model->save();

	$id_project = $model->lastInsertId();
	$fields = compact('id_project', 'agil_method');
	$projectMethod = new ProjectMethod($fields);
	$projectMethod->save();
	if($project){
		?>
		<script>
			var timePopup = setTimeout(function(){
				window.parent.boss.ajax.load('/app/project/view_project/', '#app_conteiner');
				window.parent.boss.removeClass('modal_dialog', 'active');
			}, 100);
			window.parent.boss.popup("Projeto criado com sucesso.");
		</script>
		<?php
	}
}
else {
	?>
	<script>
		window.parent.boss.ajax.load('/app/project/view_project/');
		window.parent.boss.removeClass('modal_dialog', 'active');
		window.parent.boss.popup("Erro ao criar Projeto.");
	</script>
	<?php
}
?>