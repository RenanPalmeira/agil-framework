<?php
	require_once 'init.php';

	use Agil\Session\Session as Session;

	$logado = Session::get('logado');

	$id_member = $logado['id_member'];

	$sql = array(
		"id_receiver" => $id_member
	);

	$model = new NotificationGranttype();
	$model->fields = array('id_notification_granttype', 'title', 'body', 'typing', 'status');
	$rs = $model->get($sql, 'id_notification_granttype DESC');
	?>

	<table id="notification_granttype" class="table table-striped" style="margin-bottom: 0px;">
		<?php
			if(count($rs)>0) {
				foreach ($rs as $index => $notification) {
					$url = '/app/notification/view_notification_body/?pk='.$notification['id_notification_granttype'];
					if($notification['typing']==2 && $notification['status']==1) 
						$url .= '&b=false';
					?>
						<tr style="cursor: pointer;" onclick="boss.ajax.load('<?php echo $url;?>', '#modal_dialog', 'active-lg');">
							<td>
								<div class="col-12">
									<div class="col-1 pull-left">
										<img src="/static/img/icons/user_black.png" width="28px">
									</div>
									<div class="col-10 pull-left" style="padding-left: 10px;">
										<p class="font-dark" style="line-height: 29px;font-size:14px;"><?php echo $notification['title']; ?></p>
									</div>
								</div>
							</td>
						</tr>
					<?php
				}
			}
			else {
				?>
					<tr style="cursor: default;">
						<td>
							<div class="col-12 pull-center">
								Nenhuma notificação até o momento.
							</div>
						</td>
					</tr>
				<?php
			}
		?>
	</table>
	<script>
		$("#notification_granttype tr").on('click', function(){
			$('#notify-box').addClass("hidden");
		});
	</script>
