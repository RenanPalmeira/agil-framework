<?php
	require_once 'init.php';

	use Agil\View\View as View;

	$request = View::route($_GET);
	$pk = $request['pk'];

	$sql = array(
		"id_project" => $pk
	);

	$model = new ProjectMemberSet();
	$rs = $model->get($sql);
?>
<div class="app-pane-body" style="background-color:#F9F9F9;">
	<div style="width:100%;">
		<div class="col-12">
			<div class="card-group">
				<div class="card">
					<div class="card-content">
						<div class="col-12 pull-left">
							<div class="col-8 pull-left">
								<h3>Colaboradores</h3>
							</div>
							<div class="col-4 pull-left text-right bleed-bottom">
								<button class="btn btn-primary" onclick="boss.ajax.load('/app/team/form_member_team/?pk=<?php echo $request['pk'];?>', '#task_member_loadpeace');">+ Adicionar colaboradores </button>
							</div>
						</div>
						<div id="task_member_loadpeace">
							<div class="col-12 pull-left" style="border-top:1px solid #ddd;padding:1%;">
								<div class="col-2 pull-left">
									<p class="font-lato bold">Data de início</p>
								</div>
								<div class="col-2 pull-left">
									<p class="font-lato bold">Data de termino</p>
								</div>
								<div class="col-2 pull-left">
									<p class="font-lato bold">Nome</p>
								</div>
								<div class="col-4 pull-left">
									<p class="font-lato  bold">E-Mail</p>
								</div>
								<div class="col-2 pull-left">
									<p class="font-lato  bold">Situação</p>
								</div>
							</div>
							<?php
								if(count($rs)>0){
									foreach ($rs as $index => $contributor) {
										$member = new Member();
										$member = $member->get(array("id_member"=>$contributor['id_member'], "status"=>1));
										$member = $member[0];
										?>
										<div id="task_member_loadpeace" class="col-12 pull-left" style="border-top:1px solid #ddd;padding:1%;">
											<div class="col-2 pull-left">
												-
											</div>
											<div class="col-2 pull-left">
												-
											</div>
											<div class="col-2 pull-left" style="text-transform: capitalize;">
												<?php echo $member['name'];?></p>
											</div>
											<div class="col-4 pull-left">
												<?php echo $member['email'];?>
											</div>
											<div class="col-2 pull-left">
												<?php
													if($contributor['status']==2) {
														echo "<img src=\"/static/img/icons/check_black.png\" style=\"width: 20px;\">Ativo";
													}
													else if($contributor['status']==1) {
														echo "<img src=\"/static/img/icons/check_black.png\" style=\"width: 20px;\">Pendente";
													}
													else {
														echo "Removido";
													}
												?>
											</div>
										</div>
										<?php
									}
								}
								else 
									echo "<div style=\"text-align: center;\">Nenhum colaborador no momento.</div>";
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>