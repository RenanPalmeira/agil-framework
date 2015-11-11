<?php

require_once 'init.php';

use Agil\Model\Model as Model;

class Contact extends Model {
	public $fields = array('name', 'subject', 'body', 'email');
	public $auto_fields = array('create_date', 'update_date', 'status');
}