<?php

	session_start();
	if (!isset($_SESSION['nome_usuario'])) {
		session_destroy();
		header("Location: index.php");
	}

	if (isset($_GET['id'])) {
	
			$id= $_GET['id'];
			include("conexao.php");
			$query = "DELETE FROM exame WHERE id='$id'";
			mysqli_query($conexao, $query);
			mysqli_close($conexao);
			header("Location: bd_exame.php");
		
	}
?>		
