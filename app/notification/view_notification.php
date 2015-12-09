<?php
	require_once('init.php');

	use Agil\Session\Session as Session;

	$logado = Session::get('logado');
	$name = $logado['name'];
	
	$id_member = $logado['id_member'];

	$sql = array(
		"id_receiver" => $id_member
	);

	$model = new NotificationGranttype();
	$model->fields = array('id_notification_granttype', 'title', 'body', 'typing', 'status');
	$rs = $model->get($sql, 'id_notification_granttype DESC');
	$count = $model->count($sql);
?>
<div class="app-pane">
	<div class="app-pane-header">
		<h3 class="font-lato" style="margin-top: 0px; padding-top: 10px;">Painel de Notificações</h3>
	</div>
	<div class="app-pane-body"  style="background-color:#F9F9F9;">
		<div class="container">
			<?php 
				if($count>0) {
					foreach ($rs as $index => $notification) {
						if($notification['status'] == 2){
							$disabled = "card-disabled";
						}
						else{
							$disabled = "";
						}
						?>
						<div class="row">
							<div class="card <?php echo $disabled;?>">
								<div class="card-content">
									<div class="col-12 pull-left" style="padding-top: 0%;padding-bottom: 1.5%;">
										<div class="col-1 pull-left">
											<img src="/static/img/icons/user_black.png" width="30px" class="pull-left">
										</div>
										<div class="col-10 pull-left" style="padding-top: 0.5%;">
											<p class="font-lato bold"><?php echo $notification['title']; ?></p>
										</div>
										<div class="col-1 pull-left text-center" style="padding-top: 0.5%;">
											<p class="font-lato link bold"><img src="/static/img/icons/check_black.png" width="20px"></p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
				}
			?>
		</div>
	</div>
</div>