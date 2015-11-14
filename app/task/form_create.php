<?php
	require_once 'init.php';

	use Agil\View\View as View;
	
	$request = View::route($_GET);
	$pk = $request['pk'];

?>
<div class="modal-content">
	<div class="modal-header">
		<button class="close" onclick="boss.removeClass('modal_dialog', 'active')">x</button>
		<h3 class="modal-title font-open-sans">Adicionar um cartão</h3>
	</div>
	<form action="/app/task/create_task/" method="post" target="iframesubmit">
		<input type="hidden" id="color" name="color" value="default"/>
		<input type="hidden" id="pk" name="pk" value="<?php echo $pk;?>"/>
		<div class="modal-body">
			<div class="container">
				<div class="form-group">
					<label>Título do cartão</label>
					<input name="title" type="text" placeholder="Título do cartão" class="form-control">
				</div>
				<div id="select_color" class="form-group">
					<label>Selecione uma cor</label>
					<br/>
					<button type="button" name="primary" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
					<button type="button" name="success" class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
					<button type="button" name="danger" class="btn btn-danger">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
					<button type="button" name="default" class="btn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
				</div>
				<div class="form-group" id="error"></div>
			</div>
		</div>
		<div class="modal-footer">
			<input name="name" type="submit" class="btn btn-success" value="Criar cartão">
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