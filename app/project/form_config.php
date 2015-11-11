<?php
	require_once 'init.php';

	use Agil\View\View as View;
	use Agil\Session\Session as Session;

	try {
		$logado = Session::get('logado');

		$request = View::route($_GET);
		$pk = $request['pk'];
		$id = $logado['id_member'];

		$sql = array(
			'id_project'=>$pk,
			'status'=>'1'
		);
		$project = new Project();
		$project->fields = array('id_admin', 'title', 'website');
		$rs = $project->get($sql);
		$rs = $rs[0];

		$sql = array(
			'id_member'=>$rs['id_admin'],
			'status'=>'1'
		);
		$image = new MemberImage();	
		$rsImage = $image->get($sql);
		$rsImage = $rsImage ? $rsImage[0] : null;

	} catch (Exception $e) {
		echo "Desculpe acabou o café";
	}
	
?>
<div class="container">
	<div class="col-12">
		<form action="/app/team/project_member/" method="post" target="compiler">
			<div class="form-group">
				<label>Projeto</label>
				<input type="text" name="name" value="<?php echo $rs['title'];?>" placeholder="Nome do projeto" class="form-control"/>
			</div>
			<div class="form-group">
				<label>Website</label>
				<input type="text" name="text" value="<?php echo $rs['website'];?>" placeholder="Site principal de <?php echo $rs['title'];?>" class="form-control">
			</div>
			<?php
				if($rs['id_admin']==$id) {
					?>
					<div class="form-group">
						<label>Administrador</label>
						<div class="form-group">
							<button type="button" title="Administrador" class="btn btn-success btn-disabled">
								<?php
									if($rsImage['src']){
										$userImage = $rsImage['src'];
									}
									else{
										$userImage = '/static/img/icons/user.png';
									}
								?>
								<img src="<?php echo $userImage?>" style="width: 25px;height: 25px;float: left;padding-right: 10px;"/><span class="title" style="line-height: 25px;"><?php echo $logado['name'];?></span>
							</button>
						</div>
					</div>
					<?php
				}
			?>
			<div class="form-group">
				<label>Alterar foto</label>
				<button type="button" class="btn btn-block" onclick="boss.ajax.load('/app/project/form_project_image/?pk=<?php echo $pk;?>', '#modal_dialog', 'active');">Alterar foto</button>
			</div>
			<div class="form-group" style="display: table;width: 103.3%;">
				<div class="pull-left" style="width: 50%;">
					<input type="submit" class="btn btn-success" value="Atualizar projeto" style="width: 100%;border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
				</div>
				<div class="pull-left" style="width: 50%;">
					<input type="reset" class="btn btn-danger" value="Cancelar" style="width: 100%;border-top-left-radius: 0px;border-bottom-left-radius: 0px;" onclick="boss.title('Perfil');boss.ajax.load('/app/user/view_profile/', '#app_conteiner');"/>
				</div>
			</div>
		</form>
	</div>
</div>