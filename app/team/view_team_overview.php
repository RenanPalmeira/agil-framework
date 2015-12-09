<?php
	require_once 'init.php';

	use Agil\View\View as View;
	use Agil\Session\Session as Session;
	
	$logado = Session::get('logado');
	$request = View::route($_GET);
	$pk = $request['pk'];

	$sql = array(
		"id_team" => $pk,
		"status"     => 1
	);

	$fields = array("id_team", "id_admin", "name", "website", "slug");
	$model = new Team();
	$model->fields = $fields;
	$teams = $model->get($sql);
	$team = $teams[0];

	$sql = array(
		"id_team" => $team['id_team'], 
		"status"	 => 1
	);

	$fields = array('id_member');
	$model = new TeamMemberSet();
	$model->fields = $fields;
	$rsTeamMembers = $model->get($sql);
?>
<div class="modal-content">
	<div class="modal-header">
		<button class="close" onclick="boss.removeClass('modal_dialog', 'active')">x</button>
		<h3 class="modal-title font-open-sans"><?php echo $team['name'];?></h3>
	</div>
	<div class="modal-body">
		<div class="container">
			<label>Membros</label>
			<ul id="select_member" class="list-group">
					<?php
						if(count($rsTeamMembers)>0) {
							foreach ($rsTeamMembers as $index => $rsTeamMember) {
								$sql = array(
									'id_member' => $rsTeamMember['id_member'],
									'status'=>'1'
								);

								$fields = array('id_member', 'name', 'email');
								$model = new Member();
								$model->fields = $fields;
								$members = $model->get($sql);

								foreach ($members as $index => $member) {	
									?>
									<li class="list-group-item">
										<?php echo $member['name']; ?>
									</li>
									<?php
								}
							}
						}
					?>
				</ul>
		</div>
	</div>
	<?php
		if($team['website']){
			?>
			<div class="modal-footer">
				<p class="link text-left" onclick="OpenInNewTab('<?php echo strtolower($team['website']); ?>');">
					<b>Site:</b> <?php echo strtolower($team['website']); ?>
				</p>
			</div>
			<?php 
		}
	?>
</div>
<script type="text/javascript">
	function OpenInNewTab(url) {
		if(url.indexOf('http://')>-1 || url.indexOf('https://')>-1){
			var win = window.open(url, '_blank');
		}
		else{
			var win = window.open('http://'+url, '_blank');
		}
		win.focus();
	}
</script>