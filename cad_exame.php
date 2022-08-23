<?php
	session_start();
	if (strcmp($_SESSION['login'], $_SESSION['login-post']) == 0) {
		session_destroy();
		header("Location: cad_usuario.php");
	}
?>
<?php 
	include('conexao.php');
	if(empty($_POST['data_exame'])){
		$_SESSION['data_exame'] = "Campo obrigatório";
	}else{
		$_SESSION['value_data'] = $_POST['data_exame'];
	}
	if(empty($_POST['nome_exame'])){
		$_SESSION['nome_exame'] = "Campo obrigatório";
	}else{
		$_SESSION['value_nome'] = $_POST['nome_exame'];
	}
	if(empty($_POST['valor_exame'])){
		$_SESSION['valor_exame'] = "Campo obrigatório";
	}else{
		$_SESSION['value_valor'] = $_POST['valor_exame'];
	}
 if (!empty($_POST['data_exame']) and !empty($_POST['nome_exame'])and !empty($_POST['valor_exame'])) {
		$data_exame = ($_POST['data_exame']);
		$nome_exame = $_POST['nome_exame'];
		$valor_exame = $_POST['valor_exame'];
		$id_usuario = $_SESSION['id_usuario'];
		include("conexao.php");
		//var_dump ("$id_usuario");
		$query = "INSERT INTO exame (data_exame, nome_exame, valor_exame, id_usuario ) VALUES ('$data_exame','$nome_exame','$valor_exame', '$id_usuario')";
		$conj_resultados = mysqli_query($conexao, $query);
		mysqli_close($conexao);
		header("Location: bd_exame.php");	
	}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Cadastro de exames</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </head>
 <body>
	<?php include 'header.php';?>

	
		
	<div class=" container-cad form-group col-xl-4 offset-xl-4 "  >	
			<?php echo "<div><h1>Bem vindo(a) <b>".$_SESSION['nome_usuario']."!</b></h1></div>"; ?>
		<form action="cad_exame.php" method="POST" class='m-2'>	
						<h3 class=" mt-5 text-center"><strong>Cadastro de exame</strong></h3>	
						<br>
							<label for="data_exame" class="form-label align-baseline"><strong>Digite a data do exame: </strong> </label>
							<input class="form-control" type="date" name="data_exame"
							<?php
							if(!empty($_SESSION['value_data'])){
								echo "value='".$_SESSION['value_data']."'";
								unset($_SESSION['value_data']);
							}
						 ?>	>
						 <?php
							if(!empty($_SESSION['data_exame'])){
								echo "<p style='color: #f00; '>".$_SESSION['data_exame']."</p>";
								unset($_SESSION['data_exame']);
							}
						 ?> 
						<br>
							<label for="nome_exame" class="form-label align-baseline  "><strong>Digite o nome do exame: </strong> </label>
							<input class="form-control  " type="text" name="nome_exame" 
							<?php
							if(!empty($_SESSION['value_nome'])){
								echo "value='".$_SESSION['value_nome']."'";
								unset($_SESSION['value_nome']);
							}
						 ?>	>
						 <?php
							if(!empty($_SESSION['nome_exame'])){
								echo "<p style='color: #f00; '>".$_SESSION['nome_exame']."</p>";
								unset($_SESSION['nome_exame']);
							}
						 ?> 							
						<br>
							<label for="valor_exame" class="form-label align-baseline "><strong>Digite o valor do exame: </strong> </label>
							<input class="form-control" lang="pt" type="number" step="0.001" name="valor_exame"
							<?php
							if(!empty($_SESSION['value_valor'])){
								echo "value='".$_SESSION['value_valor']."'";
								unset($_SESSION['value_valor']);
							}
						 ?>	>
						 <?php
							if(!empty($_SESSION['valor_exame'])){
								echo "<p style='color: #f00; '>".$_SESSION['valor_exame']."</p>";
								unset($_SESSION['valor_exame']);
							}
						 ?> 							
						<br>
							<div class="align-items-center ">
							<b class=" text-truncate"> <a href="cad_usuario.php" >Deseja adicionar mais exames?</a></b>
							<br>
							<input class="btn btn-success mb-3 " type="submit"  value="Salvar"> 
							</div>
		</form> 
	</div>
</html>