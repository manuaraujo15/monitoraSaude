<?php
	session_start();
	session_destroy();
	header("Location: cad_usuario.php");
?>