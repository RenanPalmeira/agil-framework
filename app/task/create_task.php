<?php

require_once 'init.php';

use Agil\View\View as View;
use Agil\Config\Config as Config;
use Agil\Session\Session as Session;

$request = View::route($_POST);

if($request['METHOD']=='POST' 
	&& !empty($request['title']) 
	&& !empty($request['color'])
	&& !empty($request['pk'])
	&& Session::exist('logado')) {

	$logado = Session::get('logado');
	$title = $request['title'];
	$color = $request['color'];
	$pk = $request['pk'];
	
	$fields = array(
   		'title'      => $title,
   		'color'      => $color,
   		'id_project' => $pk
   	);

	$model = new ProjectTask($fields);
	$project_task = $model->save();
	
	if($project_task){
		?>
		<script>
			window.parent.boss.popup("Cartão criado com sucesso.");
			var timePopup = setTimeout(function(){
				window.parent.boss.removeClass('modal_dialog', 'active');
				window.parent.boss.ajax.load('/app/task/view_task/?pk=<?php echo $pk;?>', '#app_pane_body');
			}, 100);

		</script>
		<?php
	}
}
else {
	?>
	<script>
		var timePopup = setTimeout(function(){
			window.parent.boss.removeClass('modal_dialog', 'active');
		}, 100);
		window.parent.boss.popup("Erro ao criar cartão.");
	</script>
	<?php
}
?>