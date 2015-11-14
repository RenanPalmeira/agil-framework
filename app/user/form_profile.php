<?php
	require_once 'init.php';

	use Agil\Session\Session as Session;

	$logado = Session::get('logado');
?>
<div class="app-pane">
	<div class="app-pane-header">
		<h3 class="font-lato" style="margin-top: 0px; padding-top: 10px;">Editar Perfil</h3>
	</div>
	<div class="app-pane-body">
		<div class="container">
			<div class="col-12">
				<form action="/app/user/update_profile/" method="post" target="iframesubmit">
					<div class="form-group">
						<label>Nome</label>
						<input type="text" name="name" value="<?php echo $logado['name'];?>" placeholder="Seu Nome" class="form-control"/>
					</div>
					<div class="form-group">
						<label>Usuário</label>
						<input type="text" name="username" value="<?php echo $logado['username'];?>" placeholder="Usuário" class="form-control">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" value="<?php echo $logado['email'];?>" placeholder="E-Mail" class="form-control">
					</div>
					<div class="form-group">
						<label>Alterar foto</label>
						<span class="form-control btn btn-file">
							<input name="name" type="file" accept="image" placeholder="Adicionar foto" class="form-control">
							<span>Alterar foto</span>
						</span>
					</div>
					<div class="form-group" style="display: table;width: 103.3%;">
						<div class="pull-left" style="width: 50%;">
							<input type="submit" class="btn btn-success" value="Editar conta" style="width: 100%;border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
						</div>
						<div class="pull-left" style="width: 50%;">
							<input type="reset" class="btn btn-danger" value="Cancelar" style="width: 100%;border-top-left-radius: 0px;border-bottom-left-radius: 0px;" onclick="boss.title('Perfil');boss.ajax.load('/app/user/view_profile/', '#app_conteiner');"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>