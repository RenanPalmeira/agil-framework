<?php
	require_once 'init.php';

	use Agil\Session\Session as Session;

	$logado = Session::get('logado');
	$id_admin = $logado['id_member'];

	$project = new Project();
	$project->fields = array('id_project', 'title', 'slug');
	$rs = $project->get(array('id_admin'=>$id_admin, 'status'=>'1'));

	$projectMember = new ProjectMemberSet();
	$projectMember->fields = array('id_project_member_set', 'id_member', 'id_project');
	$memberRow = $projectMember->get(array('id_member'=>$id_admin, 'status'=>'2'));
	foreach ($memberRow as $index => $member) {
		$response = $project->get(array('id_project'=>$member['id_project'], 'status'=>'1'));
		$rs[] = $response[0];
	}
?>
<div class="app-pane">
	<div class="app-pane-header">
		<div class="col-6 pull-left">
			<div id="btn_group" class="btn-group">
				<a href="javascript: void(0);" class="btn" onclick="boss.bookmark.set('tab', '/app/user/view_overview/');boss.ajax.load('/app/user/view_overview/', '#app_conteiner');">Visão Geral</a>
				<a href="javascript: void(0);" class="btn btn-primary" onclick="boss.bookmark.set('tab', '/app/project/view_project/');boss.ajax.load('/app/project/view_project/', '#app_conteiner');">Projetos</a>
			</div>
		</div>
		<div class="col-6 pull-left">
			<div class="col-6 pull-left text-right">
				<buttom id="btn_new_project" onclick="boss.ajax.load('/app/project/form_create/', '#modal_dialog', 'active');" class="btn btn-success">
					<b>+</b> Novo projeto
				</buttom>
			</div>
			<div class="col-6 pull-left mobile-hidden">
				<form action="" method="post">
					<input name="name" type="text" id="name" class="search form-control" placeholder="Pesquisar">
				</form>
			</div>
		</div>
	</div>
	<div class="app-pane-body bleed-bottom" style="background-color:#F9F9F9;">
		<div class="col-12">
			<?php
				$n = 1;
				if($rs) {
					$image = new ProjectImage();
					foreach ($rs as $project) {
						$i = $image->get(array('id_project'=>$project['id_project']));
						$img = "/static/img/icons/cubo_black.png";
						if(count($i)>0) {
							if(array_key_exists('src', $i[0])) {
								$img = 'media/'.str_replace("\\", "/", $i[0]['src']);
							}
						}
						
						if(ctype_upper($project['title']))
							$title = mb_strimwidth($project['title'], 0, 10, "..."); 
						else
							$title = mb_strimwidth($project['title'], 0, 10, "...");
						
						?>
						<div class="col-3 pull-left" title="<?php echo $title;?>">
							<div class="card card-effect">
								<div class="card-image" onclick="lambda_project('<?php echo $project['id_project'];?>');">
									<img src="<?php echo $img;?>" width="200px" heigth="177px"/>
								</div>
								<div class="card-action">
									<h3 id="task_title_<?php echo $project['id_project'];?>" class="font-open-sans link title" onclick="lambda_project('<?php echo $project['id_project'];?>');"><?php echo mb_strimwidth($project['title'], 0, 10, "..."); ?></h3>
									<span class="card-icon icon" onclick="boss.addClass('card_hidden_<?php echo $n; ?>', 'active')">
										<i class="icon-dot"/>
										<i class="icon-dot"/>
										<i class="icon-dot"/>
									</span>
								</div>
								<div id="card_hidden_<?php echo $n; ?>" class="card-content-hidden">
									<i class="icon icon-close" onclick="boss.removeClass('card_hidden_<?php echo $n; ?>', 'active')"></i>
									<ul class="list-group">
										<?php
											if(ctype_upper($project['title'])) {
												?>
												<li class="list-group-title bg-blue-light text-white">
													<?php echo mb_strimwidth($project['title'], 0, 10, "..."); ?>
												</li>
												<?php
											}
											else{
												?>
												<li class="list-group-title bg-blue-light text-white title">
													<?php echo mb_strimwidth($project['title'], 0, 10, "..."); ?>
												</li>
												<?php
											}
										?>
										
										<li class="list-group-item list-group-hover" onclick="boss.ajax.load('/app/project/form_edit/?teste=wellington', '#modal_dialog', 'active');">
											<img src="/static/img/icons/edit_black.png" width="20px" style="position:absolute; left:30px;">Editar
										</li>
										<li class="list-group-item list-group-hover" onclick="boss.ajax.load('/app/project/form_delete/?teste=wellington', '#modal_dialog', 'active');">
											<img src="/static/img/icons/excluir_black.png" width="20px" style="position:absolute; left:30px;">Excluir
										</li>
									</ul>
								</div>
							</div>
						</div>
						<?php
						$n++;
					}
				}
				else {
					?>
					<div class="col-11 pull-center bleed-full">	
						Não existe projetos seus ou que você participa cadastrados. <a class="title linked" href="javascript: void(0);" onclick="boss.ajax.load('/app/project/form_create/', '#modal_dialog', 'active');">Criar um projeto</a>
					</div>
					<?php
				}
			?>
		</div>
	</div>
</div>
<script type="text/javascript">
	function lambda_project(id) {
		boss.title($("#task_title_"+id).html());
		boss.ajax.load('/app/project/view_project_graph/?pk='+id, '#app_conteiner');
	}
	if(boss.isMobile()){
		$('#btn_new_project').html('<b>+<b/>');
		$('#btn_group').addClass('mobile-hidden');
	}
</script>