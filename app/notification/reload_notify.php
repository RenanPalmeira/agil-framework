<?php

require_once 'init.php';

use Agil\Session\Session as Session;

$logado = Session::get('logado');

$sql = array(
	"id_receiver" => $logado['id_member'],
	"typing" => 1,
	"status" => 1
);

$model = new NotificationGranttype();
$model->fields = array('id_notification_granttype', 'title', 'body', 'id_sender');
$count = $model->count($sql);
echo $count;
	

