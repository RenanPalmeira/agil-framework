<?php
	require_once 'init.php';

	use Agil\View\View as View;
	
	$request = View::route($_GET);
	$pk = $request['pk'];

	$sql = array(
		"id_project_task" => $pk, 
		"status"     => 1
	);

	$fields = array("title", "color");
	$model = new ProjectTask();
	$model->fields = $fields;
	$rs = $model->get($sql);
	$rs = $rs[0];

	$color = $rs['color'] ? $rs['color'] : 'default';
?>
<div class="modal-content">
	<div class="modal-header">
		<button class="close" onclick="boss.removeClass('modal_dialog', 'active')">x</button>
		<h3 class="modal-title font-open-sans">Editar cartão</h3>
	</div>
	<form action="/app/task/edit_task/" method="post" target="iframesubmit">
		<input type="hidden" id="color" name="color" value="<?php echo $color; ?>">
		<input type="hidden" id="pk" name="pk" value="<?php echo $pk;?>">
		<input type="hidden" id="delete" name="delete" value="0">
		<div class="modal-body">
			<div class="container">
				<div class="form-group">
					<label>Título do cartão</label>
					<input name="title" type="text" value="<?php echo $rs['title'];?>" placeholder="<?php echo $rs['title'];?>" class="form-control">
				</div>
				<div id="select_color" class="form-group">
					<label>Selecione uma cor</label>
					<br>
					<button type="button" name="primary" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
					<button type="button" name="success" class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
					<button type="button" name="danger" class="btn btn-danger">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
					<button type="button" name="default" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-success" value="Editar cartão">
			<input type="submit" class="btn btn-danger" value="Deletar" onclick="$('#delete').attr('value', '1');">
		</div>
	</form>
</div>
<script type="text/javascript">
	$("#select_color>.btn-<?php echo$rs['color'];?>").html("OK");

	$("#select_color [type=button]").on("click", function(){
		$("#select_color [type=button]").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
		$("#color").attr("value", $(this).attr("name"));
		$(this).html("OK");
	});
</script>