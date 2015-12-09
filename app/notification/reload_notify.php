<?php

require_once 'init.php';

use Agil\Session\Session as Session;


header('Content-Type: application/json');

$logado = Session::get('logado');

$sql = array(
	"id_receiver" => $logado['id_member'],
	"status" => 1
);

$result = array();
$model = new NotificationGranttype();
$model->fields = array('id_notification_granttype', 'title', 'body', 'id_sender');
$count = $model->count($sql);
$result['count'] = $count;

if(!empty($_COOKIE['comment_loadplace'])) {
	$result['ajax'] = array(
		'url'       => $_COOKIE['comment_loadplace'],
		'place'     => '#comment_loadplace'
	);
}
echo json_encode($result);
?>