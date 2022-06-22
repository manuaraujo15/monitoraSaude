<?php
	session_start();
	if (!isset($_SESSION['nome_usuario'])) {
		session_destroy();
		header("Location: entra_usuario.php");
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Cadastro de exames</title>
    <meta charset="utf-8">
	
  </head>
  <body>
	<?php include 'header.php';?>

  </body>

</html>