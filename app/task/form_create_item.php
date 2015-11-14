<?php
	require_once 'init.php';

	use Agil\View\View as View;
	
	$request = View::route($_GET);
	$pk = $request['pk'];

?>
<div class="modal-content">
	<div class="modal-header">
		<button class="close" onclick="boss.removeClass('modal_dialog', 'active')">x</button>
		<h3 class="modal-title font-open-sans">Adicionar uma tarefa</h3>
	</div>
	<form action="/app/task/create_item/" method="post" target="iframesubmit">
		<input type="hidden" id="pk" name="pk" value="<?php echo $pk;?>"/>
		<div class="modal-body">
			<div class="container">
				<div class="form-group">
					<label>Título da tarefa</label>
					<input name="title" type="text" placeholder="Título da tarefa" class="form-control">
				</div>
				<div class="form-group">
					<label>Descrição da tarefa</label>
					<textarea name="comment" class="form-control" style="resize: vertical; max-height:300px;"></textarea>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<input type="submit" class="btn btn-success" value="Criar tarefa">
		</div>
	</form>
</div>
<script type="text/javascript">
	$("#select_color [type=button]").on("click", function(){
		$("#select_color [type=button]").html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
		$("#color").attr("value", $(this).attr("name"));
		$(this).html("OK");
	});
</script>