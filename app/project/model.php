<?php

require_once 'init.php';

use Agil\Model\Model as Model;

class Project extends Model {
	public $fields = array('title', 'type_license', 'slug', 'id_admin');
	public $auto_fields = array('create_date', 'update_date', 'status');

	public function is_admin($pk, $id) {
		$sql = array(
			"id_project" => $pk,
			"id_admin" => $id
		);
		
		$count = $this->count($sql);

		if($count==1)
			return true;
		return false;
	}
}

class ProjectImage extends Model {
	public $fields = array('id_project', 'src', 'name', 'mime_type');
	public $auto_fields = array('create_date', 'update_date', 'status');
}

class ProjectMemberSet extends Model {
	public $fields = array('id_project', 'id_member', 'status');
	public $auto_fields = array('create_date', 'update_date');
}

class ProjectMethod extends Model {
	public $fields = array('id_project_dev', 'id_project', 'agil_method');
	public $auto_fields = array('create_date', 'update_date', 'status');
}