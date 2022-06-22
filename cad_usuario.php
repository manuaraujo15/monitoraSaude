<?php 

	session_start();
	include_once ('conexao.php');
	if(empty($_POST['nome'])){
		$_SESSION['vazio_nome'] = "Campo obrigatório";

	}else{
		$_SESSION['value_nome'] = $_POST['nome'];
	}
	if(empty($_POST['login'])){
		$_SESSION['vazio_login'] = "Campo obrigatório";
	}else{
		$_SESSION['value_login'] = $_POST['login'];
	}
	if(empty($_POST['senha'])){
		$_SESSION['vazio_senha'] = "Campo obrigatório";
	}else{
		$_SESSION['senha'] = $_POST['senha'];
	}
 if (!empty($_POST['nome']) and !empty($_POST['login'])and !empty($_POST['senha'])) {
		$nome = $_POST['nome'];
		$login = $_POST['login'];
		$senha = md5($_POST['senha']);
		include("conexao.php");
		$query = "INSERT INTO usuario (nome, login, senha) VALUES ('$nome','$login','$senha')";
		$conj_resultados = mysqli_query($conexao, $query);
		mysqli_close($conexao);
		header("Location: index.php"); 
		
		
	}	

?>

<?php 
	if (isset($_POST['login']) and isset($_POST['senha'])) {
		require "conexao.php";
		$login = mysqli_real_escape_string($conexao , $_POST['login']);
		$senha = mysqli_real_escape_string($conexao , $_POST['senha']);
		$login = trim($login);
		$senha = md5(trim($senha));
		if ($login != "" and $senha != "") {
			$query = "SELECT * FROM usuario WHERE login = '$login'";
			$conj_resultados = mysqli_query($conexao , $query);
			$qtd_usuarios = mysqli_num_rows($conj_resultados);
			if ($qtd_usuarios > 0) {
				$dados = mysqli_fetch_array($conj_resultados);
				if (strcmp($senha, $dados['senha']) == 0) {
					session_start();
					$_SESSION['id_usuario'] = $dados['id'];
				    $_SESSION['nome_usuario'] = $dados['nome'];
				header("Location: cad_exame.php");
				} else {
						$_SESSION['senhaErro'] = " Senha Inválida!";
				}
			} else {
				$_SESSION['loginErro'] = " Usuário inexistente!";

			}
		} else {
			$_SESSION['campoVazio'] = " Digite login e senha!";
			}
	}
?>



<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>	Cadastro de Usuário</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  
	<body>
		<?php include 'header.php';?>

		<br>
			<form action="cad_usuario.php" method="POST" class="ml-5 pr-5" >
				<div class=" container-cad ml-5">
				<div class="form-group col-5  float-left  pr-5 ml-5  mr-0 border-right border-dark-5 h-5 ">
					<h5><strong>Cadastrar de Usuário</strong></h5> 
					<label for="nome" class="form-label">Nome: </label>
					<input class="form-control" type="text" name="nome" id="nome"
					<?php
							if(!empty($_SESSION['value_nome'])){
								echo "value='".$_SESSION['value_nome']."'";
								unset($_SESSION['value_nome']);
							}
						 ?>	>
						 <?php
							if(!empty($_SESSION['vazio_nome'])){
								echo "<p style='color: #f00; '>".$_SESSION['vazio_nome']."</p>";
								unset($_SESSION['vazio_nome']);
							}
						 ?> 
					<br/><br/>
					<label for="login" class="form-label">Login: </label>
					<input  class="form-control" type="text" name="login" id="login"  placeholder="Digite seu melhor email"
					<?php
							if(!empty($_SESSION['value_login'])){
								echo "value='".$_SESSION['value_login']."'";
								unset($_SESSION['value_login']);
							}
						 ?>	>
						 <?php
							if(!empty($_SESSION['vazio_login'])){
								echo "<p style='color: #f00; '>".$_SESSION['vazio_login']."</p>";
								unset($_SESSION['vazio_login']);
							}
						 ?> 
					<br/><br/>
					<label for="senha" class="form-label">Senha: </label>
					<input  class="form-control" type="password" name="senha" id="senha"
					<?php
							if(!empty($_SESSION['value_senha'])){
								echo "value='".$_SESSION['value_senha']."'";
								unset($_SESSION['value_senha']);
							}
						 ?>	>
						 <?php
							if(!empty($_SESSION['vazio_senha'])){
								echo "<p style='color: #f00; '>".$_SESSION['vazio_senha']."</p>";
								unset($_SESSION['vazio_senha']);
							}
						 ?>
					<br/><br/>
					<input class="btn btn-success" type="submit"  value="Cadastrar"/>
					<a class="btn btn-secondary" href="index.php" value="Voltar"> voltar</a>
			    </div>
			    </div>
			</form>
		<?php include 'entra_usuario.php';?>


    </body>
</html>