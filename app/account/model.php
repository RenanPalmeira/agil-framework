<?php

require_once 'init.php';

use Agil\Model\Model as Model;

class Member extends Model {
	public $fields = array('name', 'avatar', 'email');
	public $auto_fields = array('create_date', 'update_date', 'status');
}

class MemberImage extends Model {
	public $fields = array('id_member_image', 'id_member', 'src', 'name', 'mime_type');
	public $auto_fields = array('create_date', 'update_date', 'status');
}

class Login extends Model {
	public $fields = array('username', 'id_member');
	public $hidden = array('password');
	public $auto_fields = array('create_date', 'update_date', 'status');
}