<?php
	require_once 'init.php';

	use Agil\Session\Session as Session;
	use Agil\View\View as View;
	use Agil\Config\Config as Config;
	
	$logado = Session::get('logado');

	if(isset($_FILES['image']) && !empty($_FILES['image'])) {


		$name = md5(sha1(date("Y-m-d H:m:s")));
		$file = $_FILES['image'];

		$ds = Config::get('ds');
		$media = Config::get('media');
		$extensions = Config::get('images');;

		$ext = explode(".", $file['name']);
		$ext = $ext[count($ext)-1];

		$sql = array(
			"id_member" => $logado['id_member'],
			"status" 	=> 1
		);

		$member = new Member();
		$row = $member->count($sql);
		if($row==1 && in_array($ext, $extensions)) {
			
			$user = $media.$logado['id_member'];
			if(!is_dir($user)) {
				$mkdir = mkdir($user, 0700);
				$chmod = chmod($user, 0700);
			}

			$user = $media.$logado['id_member'];
			
			$tmp = $file['tmp_name'];

			$name .= ".".$ext;

			$profile = $user.$ds.'profile';

			if(!is_dir($profile)) {
				$mkdir = mkdir($profile, 0700);
				$chmod = chmod($profile, 0700);
			}

			$source = $profile.$ds.$name;

			if (move_uploaded_file($tmp, $source)) {
				$sql = array(
					"id_member" => $logado['id_member'],
					"status"	=> 1
				);
				$image = new MemberImage();
				$image->fields = array('id_member_image');

				if($image->count($sql)==1) {

					$rs = $image->get($sql);
					$rs = $rs[0];
					
					echo $source = $logado['id_member'].$ds.$ds.'profile'.$ds.$ds.$name;
					
					$sql = array(
						"src"        => $source,
						"name"       => $file['name'],
						"mime_type"  => $file['type']
					);
					$image = new MemberImage();
					$image->fields = $sql;
					$image = $image->update(array("id_member_image"=>$rs['id_member_image']));

					if(count($image)>0){
						$image = new MemberImage();
						$image->fields = array('src');
						$rsImage = $image->get($sql);
						if(count($rsImage)>0 && is_array($rsImage)){
							$rs = array_merge($rsImage[0], $logado);
							Session::update('logado', $rs);
						}
					}

					if($image){
						?>
						<script>
							window.parent.boss.removeClass('modal_dialog', 'active');
							window.parent.location.href='/';
							window.parent.boss.popup("Sucesso ao atualizar foto do perfil.");
						</script>
						<?php
					}
				}
				else {
					$source = $logado['id_member'].$ds.$name;
					
					$sql = array(
						"id_member" => $logado['id_member'],
						"src"        => $source,
						"name"       => $file['name'],
						"mime_type"  => $file['type']
					);
					$image = new MemberImage($sql);
					$image = $image->save();

					$sql = array(
						'id_member'=>$logado['id_member'],
						'status'=>'1'
					);

					if(count($image)>0){
						$image = new MemberImage();
						$image->fields = array('src');
						$rsImage = $image->get($sql);
						if(count($rsImage)>0 && is_array($rsImage)){
							$rs = array_merge($rsImage[0], $logado);
							Session::update('logado', $rs);
							echo "Pass";
						}
					}

					if($image){
						?>
						<script>
							window.parent.boss.removeClass('modal_dialog', 'active');
							window.parent.boss.popup("Sucesso ao atualizar foto do perfil.");
						</script>
						<?php
					}
				}
			} 
			else {
				?>
				<script>
					window.parent.boss.removeClass('modal_dialog', 'active');
					window.parent.boss.popup("Falha ao atualizar foto do perfil.");
				</script>
				<?php
			}
		}
		else{
			?>
			<script>
				window.parent.boss.removeClass('modal_dialog', 'active');
				window.parent.boss.popup("Falha ao atualizar foto do perfil.");
			</script>
			<?php
		}
	}
	else{
		?>
		<script>
			window.parent.boss.removeClass('modal_dialog', 'active');
			window.parent.boss.popup("Falha ao atualizar foto do perfil.");
		</script>
		<?php
	}
?>