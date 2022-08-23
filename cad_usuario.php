<?php 
	session_start();
	include('conexao.php');
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
		include('conexao.php');
		$tab = "SELECT * FROM usuario";
		$conj = mysqli_query($conexao, $tab);
		$dadoss = mysqli_fetch_array($conj);
		$nome = $_POST['nome'];
		$login = $_POST['login'];
		$senha = md5($_POST['senha']);	
		if (strcmp($login, $dadoss['login']) != 0) {
			session_start();
			$_SESSION['login-post'] = $login;
			$_SESSION['nome_usuario'] = $nome;
			$_SESSION['senha'] = $senha;
			$_SESSION['login'] = $dadoss['login'];
			
			$query = "INSERT INTO usuario (nome, login, senha) VALUES ('$nome','$login','$senha')";
			$conj_resultados = mysqli_query($conexao, $query);
			$query = "SELECT * FROM usuario WHERE login = '$login'";
			$conj_resultados = mysqli_query($conexao , $query);
			$dados = mysqli_fetch_array($conj_resultados);
			$_SESSION['id_usuario'] = $dados['id_usuario'];
			mysqli_close($conexao);
			header("Location: cad_exame.php");		
	} else{
        $_SESSION['login_existe'] = "Este e-mail já foi cadastrado!";
	}
	}
 
	
?>

<?php


	if (isset($_POST['login1']) and isset($_POST['senha1'])) {
		require "conexao.php";
		$login1 = mysqli_real_escape_string($conexao , $_POST['login1']);
		$senha1 = mysqli_real_escape_string($conexao , $_POST['senha1']);
		$login1 = trim($login1);
		$senha1 = md5(trim($senha1));

		if ($login1 != "" and $senha1 != "") {
			$query = "SELECT * FROM usuario WHERE login = '$login1'";
			$conj_resultados = mysqli_query($conexao , $query);
			$qtd_usuarios = mysqli_num_rows($conj_resultados);
						
			if ($qtd_usuarios > 0) {
				$dados = mysqli_fetch_array($conj_resultados);
				//var_dump($dados);
				$_SESSION['dados'] =  $dados;

			if (strcmp($senha1, $dados['senha']) == 0) {
					$senha = password_hash($senha1, PASSWORD_DEFAULT);
					$_SESSION['login-post'] = $_SESSION['login-post'];
					$_SESSION['id_usuario'] = $dados['id_usuario'];
				    $_SESSION['nome_usuario'] = $dados['nome'];
				    $_SESSION['senha'] = $dados['senha'];
				    $_SESSION['login'] = $dados['login'];

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


<?php 
 if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>

<?php 
 if (isset($_SESSION['login_existe'])) {
        echo $_SESSION['login_existe'];
        unset($_SESSION['login_existe']);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>	Cadastro de Usuário</title>
		 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">	
		<link rel="stylesheet"  href="main.css" >
  </head>

	<body>
  		<?php include 'header.php';?>
			<div class=" container-cad ml-xl-5 ">

			<form action="cad_usuario.php" method="POST" class="ml-xl-5 pr-xl-5 mt-xl-2" >
				<div class="form-group col-xl-5  float-xl-left  pr-xl-5 ml-xl-5  mr-xl-0 border-right border-dark-xl-5 h-xl-5 ">
				<br>
					<h4 class=""><strong>Quero criar uma conta</strong></h4> 
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
					<br><br>
					<label for="email" class="form-label">E-mail: </label>
					<input  class="form-control" type="email" name="login" id="login"  placeholder="Digite seu melhor email"
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