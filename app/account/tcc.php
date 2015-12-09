<?php

require 'init.php';

$alunos = array(
	'Beatriz Moreira',
	'Danielle Apolinario',
	'Estella Menna das Neves',
	'Gabriela Santos',
	'Gagriele Costa',
	'Gustavo Magico',
	'Izaura Maya',
	'Jocilene da Silva',
	'Jose vitor',
	'Leticia Januario',
	'Nathalia Cristinie',
	'Pablo Victor',
	'Jovem nerd',
	'Pedro Lucas',
	'Quezia Quirino',
	'Rafael Santos',
	'Renan Palmeira',
	'Samuel da Silva',
	'Stefany Yukari',
	'Thais Capitao',
	'Thales Comunista',
	'Thalita Caetano',
	'Veronica Palmeira',
	'Victoria da Silva',
	'Hailander gelarina',
	'Walter Cavalcante',
	'Wellington Eugenio'
);
foreach ($alunos as $index => $name) {
	$login = strtolower($name);
	$login = preg_replace('/[^A-Za-z0-9-]+/', '_', $name);
	$login = explode("_", $login);
	$username = strtolower($login[0]);

	$email = $username.'@tecfalcon.com.br';

	$member = compact('name', 'email');
	$model = new Member($member);
	//$member = $model->save();
	
	$id_member = $model->lastInsertId();
	$password = md5($username);

	$login = compact('username', 'password');
	echo "<pre>";
	print_r($login);
	echo "</pre>";
	
	$login = new Login($login);
	//$login = $login->save();
}
