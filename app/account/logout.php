<?php

require_once 'init.php';

use Agil\Session\Session as Session;

Session::start();
Session::clear('logado');
Session::destroy();

?>
<script>
	window.parent.location.href='/';
</script>