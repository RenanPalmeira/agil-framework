<?php
	require_once 'init.php';

	use Agil\View\View as View;

	$request = View::route($_GET);
	$pk = $request['pk'];
?>
<div class="col-11">
	<form action="/app/team/member_project_set/" method="post" target="compiler">
		<input type="hidden" name="pk" value="<?php echo $pk?>"/>
		<div class="form-group">
			<label>E-Mail</label>
			<input type="email" name="email" placeholder="E-Mail" class="form-control">
		</div>
		<div class="form-group">
			<label>Data de início</label>
			<input type="date" name="data" value="<?php echo date('Y-m-d'); ?>" />			
		</div>
		<div class="form-group">
			<label>Horario de início</label>
			<input type="time" name="time" value="<?php echo date('H:i'); ?>"/>
		</div>
		<div class="form-group" style="display: table;width: 103.3%;">
			<div class="pull-left" style="width: 50%;">
				<input type="submit" class="btn btn-success" value="Cadastrar colaborador" style="width: 100%;border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
			</div>
			<div class="pull-left" style="width: 50%;">
				<input type="reset" class="btn btn-danger" value="Cancelar" style="width: 100%;border-top-left-radius: 0px;border-bottom-left-radius: 0px;" onclick="boss.title('Perfil');boss.ajax.load('/app/user/view_profile/', '#app_conteiner');"/>
			</div>
		</div>
	</form>
</div>