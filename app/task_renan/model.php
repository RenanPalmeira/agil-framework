<?php

require_once 'init.php';

use Agil\Model\Model as Model;

class ProjectTask extends Model {
	public $fields = array('title', 'color', 'id_project');
	public $auto_fields = array('create_date', 'update_date', 'status');
}

class ProjectTaskItems extends Model {
	public $fields = array('id_project_task', 'title', 'comment');
	public $auto_fields = array('create_date', 'update_date', 'status');
}