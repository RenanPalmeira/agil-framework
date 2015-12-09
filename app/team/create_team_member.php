<?php

require_once 'init.php';

use Agil\View\View as View;
use Agil\Config\Config as Config;
use Agil\Session\Session as Session;

$request = View::route($_POST);

if($request['METHOD']=='POST'
	&& Session::exist('logado')
	&& (!empty($request['pk_member'])
	|| !empty($request['remove']))){
	
	$logado = Session::get('logado');
	$id_admin = $logado['id_member'];
	$pk = $request['pk'];
	$pk_members = explode("|", $request['pk_member']);
	unset($pk_members[0]);
	$remove = $request['remove'] ? $request['remove'] : 0;

	$model = new TeamMemberSet();
	if($remove){
		if(count($pk_members)>0){
			foreach ($pk_members as $index => $pk_member) {
				$sql = array(
					'id_member' => $pk_member,
					'status'	=> '1'
				);
				$rs = $model->get($sql);

				if(count($rs)>0){
					$model->fields = array('status'=>'0');
					$update = $model->update($sql);
					
					if($update){
						$model = new Team();
						$sql = array(
							'id_team' 	=> $pk,
							'id_admin'	=> $logado['id_member'],
							'status'	=> 1
						);
						$model->fields = array('id_project');
						$rs = $model->get($sql);
						$rs = $rs[0];
						?>
						<script>
							var timePopup = setTimeout(function(){
								window.parent.boss.removeClass('modal_dialog', 'active');
							}, 100);
							window.parent.boss.ajax.load('/app/team/view_team/?pk=<?php echo $rs["id_project"];?>', '#app_pane_body');
							window.parent.boss.popup("Membro(s) removido(s) com sucesso.");
						</script>
						<?php
					}
				}
				else{
					?>
					<script>
						var timePopup = setTimeout(function(){
							window.parent.boss.removeClass('modal_dialog', 'active');
						}, 100);
					</script>
					<?php
				}
			}
		}
		else{
			?>
			<script>
				var timePopup = setTimeout(function(){
					window.parent.boss.removeClass('modal_dialog', 'active');
				}, 100);
				window.parent.boss.popup("Erro ao remover membro(s).");
			</script>
			<?php
		}
	}
	else{
		if(count($pk_members)>0){
			foreach ($pk_members as $index => $pk_member) {
				$sql = array(
					'id_team' 				=> $pk,
					'id_member'				=> $pk_member,
					'status'				=> 1
				);
			}

			$count = $model->count($sql);
			if($count!=0){
				?>
				<script>
					var timePopup = setTimeout(function(){
						window.parent.boss.removeClass('modal_dialog', 'active');
					}, 100);
					window.parent.boss.popup("Esse(s) membro(s) já estão participando desta equipe.");
				</script>
				<?php
				die();
			}
			foreach ($pk_members as $index => $pk_member) {
				$fields = array(
					'id_team' 				=> $pk,
					'id_member'				=> $pk_member,
				);
				$query = array(
					'id_team' 				=> $pk,
					'id_member'				=> $pk_member,
					'status'				=> 1
				);
				$count = $model->count($query);
				if($count==0){
					$model = new TeamMemberSet($fields);
					$team_member_set = $model->save();
				}
				else{
					?>
					<script>
						var timePopup = setTimeout(function(){
							window.parent.boss.removeClass('modal_dialog', 'active');
						}, 100);
						window.parent.boss.popup("Esse(s) membro(s) já estão participando desta equipe.");
					</script>
					<?php
					die();
				}

				if($team_member_set){
					$model = new Team();
					$sql = array(
						'id_team' 	=> $pk,
						'id_admin'	=> $logado['id_member'],
						'status'	=> 1
					);
					$model->fields = array('id_project');
					$rs = $model->get($sql);
					$rs = $rs[0];
					?>
					<script>
						var timePopup = setTimeout(function(){
							window.parent.boss.removeClass('modal_dialog', 'active');
						}, 100);
						window.parent.boss.ajax.load('/app/team/view_team/?pk=<?php echo $rs["id_project"];?>', '#app_pane_body');
						window.parent.boss.popup("Membro(s) adicionados com sucesso.");
					</script>
					<?php
				}
			}

		}
	}
}
else {
	?>
	<script>
		var timePopup = setTimeout(function(){
			window.parent.boss.removeClass('modal_dialog', 'active');
		}, 100);
		window.parent.boss.popup("Erro ao adicionar membro(s).");
	</script>
	<?php
}