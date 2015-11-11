<?php

require_once 'init.php';

use Agil\Model\Model as Model;

class NotificationGranttype extends Model {
	public $fields = array('typing', 'title', 'id_sender', 'id_receiver');
	public $auto_fields = array('create_date', 'update_date', 'status');
}
/*
class NotificationSimple extends Model {
	public $fields = array('id_project', 'src', 'name', 'mime_type');
	public $auto_fields = array('create_date', 'update_date', 'status');
}*/