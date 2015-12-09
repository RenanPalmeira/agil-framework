<?php
	require_once 'init.php';

	use Agil\Session\Session as Session;
	use Agil\View\View as View;
	use Agil\Config\Config as Config;
	
	$request = View::route($_GET);

	if(isset($_FILES['image']) && !empty($_FILES['image']) && !empty($request['pk']) && is_numeric($request['pk'])) {

		$logado = Session::get('logado');
		$id_admin = $logado['id_member'];
		
		$pk = $request['pk'];

		$name = md5(sha1(date("Y-m-d H:m:s")));
		$file = $_FILES['image'];	

		$ds = Config::get('ds');
		$media = Config::get('media');
		$extensions = Config::get('images');;

		$ext = explode(".", $file['name']);
		$ext = $ext[count($ext)-1];

		$sql = array(
			"id_project" => $pk,
			"id_admin" => $id_admin
		);

		$project = new Project();
		$row = $project->count($sql);

		if($row==1 && in_array($ext, $extensions)) {
			
			$user = $media.$id_admin;
			if(!is_dir($user)) {
				$mkdir = mkdir($user, 0700);
				$chmod = chmod($user, 0700);
			}
				
			$project = $media.$id_admin.$ds.$pk;
			if(!is_dir($project)) {
				$mkdir = mkdir($project, 0700);
				$chmod = chmod($project, 0700);
			}

			$tmp = $file['tmp_name'];

			$name .= ".".$ext;

			$source = $project.$ds.$name;

			if (move_uploaded_file($tmp, $source)) {
				$source = $id_admin.$ds.$ds.$pk.$ds.$ds.$name;
				$sql = array(
					"id_project" => $pk
				);
				$image = new ProjectImage();
				$image->fields = array('id_project_image');

				if($image->count($sql)==1) {
					$rs = $image->get($sql);
					$rs = $rs[0];
					$sql = array(
						"src"        => $source,
						"name"       => $file['name'],
						"mime_type"  => $file['type']
					);
					$image = new ProjectImage();
					$image->fields = $sql;
					$image->update(array("id_project_image"=>$rs['id_project_image']));
				}
				else {
					$sql = array(
						"id_project" => $pk,
						"src"        => $source,
						"name"       => $file['name'],
						"mime_type"  => $file['type']
					);
					$image = new ProjectImage($sql);
					$image = $image->save();

					if($image){
						?>
						<script>
							window.parent.boss.removeClass('modal_dialog', 'active');
							window.parent.boss.popup("Sucesso ao atualizar foto do projeto.");
						</script>
						<?php
					}
				}
			} 
			else {
				?>
				<script>
					window.parent.boss.removeClass('modal_dialog', 'active');
					window.parent.boss.popup("Falha ao atualizar foto do projeto.");
				</script>
				<?php
			}
		}
		else{
			?>
			<script>
				window.parent.boss.removeClass('modal_dialog', 'active');
				window.parent.boss.popup("Falha ao atualizar foto do projeto.");
			</script>
			<?php
		}
	}
	else{
		?>
		<script>
			window.parent.boss.removeClass('modal_dialog', 'active');
			window.parent.boss.popup("Falha ao atualizar foto do projeto.");
		</script>
		<?php
	}
?>