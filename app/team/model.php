<?php

require_once 'init.php';

use Agil\Model\Model as Model;

class Team extends Model {
	public $fields = array('id_team', 'id_admin', 'id_project', 'name', 'website', 'slug');
	public $auto_fields = array('create_date', 'update_date', 'status');
}

class TeamMemberSet extends Model {
	public $fields = array('id_team_member_set', 'id_team', 'id_member');
	public $auto_fields = array('create_date', 'update_date', 'status');
}