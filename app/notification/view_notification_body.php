<?php
	require_once 'init.php';

	use Agil\View\View as View;

	$request = View::route($_GET);
	$pk = $request['pk'];

	$sql = array(
		"id_notification_granttype" => $pk
	);
	
	$model = new NotificationGranttype();
	$model->fields = array('status'=>2);
	$model->update($sql);

	$model->fields = array('id_notification_granttype', 'title', 'body', 'id_sender');
	$count = $model->count($sql);

	if($count==1) {
		$rs = $model->get($sql);
		$rs = $rs[0];
		?>
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" onclick="boss.removeClass('modal_dialog', 'active')">x</button>
				<h3 class="modal-title font-open-sans"><?php echo $rs['title']; ?></h3>
			</div>
			<form action="/app/team/contribute/" method="post" target="compiler">
				<div class="modal-body">
					<div class="container">
						<?php
							if($rs['body']) {
								?>
								<p>
									<?php echo $rs['body'];?>
								</p>
								<?php
							}
						?>
						<div class="form-group" id="error"></div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="pk" value="<?php echo $rs['id_notification_granttype']?>"/>
					<input type="hidden" name="sender" value="<?php echo $rs['id_sender']?>"/>
					<input name="accept" type="submit" class="btn btn-success" value="Aceitar">
					<input name="recuse" type="submit" class="btn btn-danger" value="Recusar">
				</div>
			</form>
		</div>
		<script type="text/javascript">
			$("[type=file]").on("change", function(){
				
				var file = this.files[0].name;
				var dflt = $(this).attr("placeholder");
				
				if($(this).val()!=""){
					$(this).next().text(file);
				}
				else{
					$(this).next().text(dflt);
				}
			});
		</script>
		<?php
	}
?>