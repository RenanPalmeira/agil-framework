<?php

require_once 'init.php';

use Agil\Model\Model as Model;

class ProjectTask extends Model {
	public $fields = array('title', 'color', 'id_project');
	public $auto_fields = array('create_date', 'update_date', 'status');
}

class ProjectTaskItems extends Model {
	public $fields = array('id_project_task_items', 'id_project_task', 'title', 'comment');
	public $auto_fields = array('create_date', 'update_date', 'status');
}

class ProjectTaskItemsComments extends Model {
	public $fields = array('id_project_task_items_comments', 'id_project_task_items', 'id_member', 'body');
	public $auto_fields = array('create_date', 'update_date', 'status');
}

class ProjectTaskItemsSubitems extends Model {
	public $fields = array('id_project_task_items_subitems', 'id_project_task_items', 'id_creator', 'title', 'checked');
	public $auto_fields = array('create_date', 'update_date', 'status');
}

class ProjectTaskItemsMemberSet extends Model {
	public $fields = array('id_project_task_items_member_set', 'id_project_task_items', 'id_member', 'id_admin');
	public $auto_fields = array('create_date', 'update_date', 'status');
}