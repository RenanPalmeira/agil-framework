<?php

session_start();
unset($_SESSION['logado']);
session_destroy();
?>
<script>
	window.parent.location.href='/';
</script>