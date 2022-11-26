<?php

	session_start();
	if (!isset($_SESSION['nome_usuario'])) {
		session_destroy();
		header("Location: index.php");
	}

	if (isset($_GET['nome_exame'])) {
	
			$nome_exame= $_GET['nome_exame'];
			include("conexao.php");
			$query = "DELETE FROM exame WHERE nome_exame='$nome_exame'";
			mysqli_query($conexao, $query);
			mysqli_close($conexao);
			header("Location: bd_exame.php");
		
	}
?>		
