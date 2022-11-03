<?php
	session_start();
	if (strcmp($_SESSION['login'], $_SESSION['login-post']) == 0) {
		session_destroy();
		header("Location: cad_usuario.php");
		
	}
?>
<?php  
	include("conexao.php");
		
		$query = "SELECT * FROM valores_exame";
		$resultados = mysqli_query($conexao, $query);
		$valores = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
		//var_dump($valores);
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
		
		$data_exame = $_POST['data_exame'];
		$nome_exame = $_POST['nome_exame'];
		$valor_exame = $_POST['valor_exame'];
		$id_usuario = $_SESSION['id_usuario'];
		include("conexao.php");
		//var_dump ("$id_usuario");
		$query = "INSERT INTO exame (data_exame, nome_exame, valor_exame, id_usuario ) VALUES ('$data_exame','$nome_exame','$valor_exame', '$id_usuario')";
		$conj_resultados = mysqli_query($conexao, $query);
		
		mysqli_close($conexao);
		$R_botao=$_POST['Fm_submit'];
		if ($R_botao == "Salvar") {
					header("Location: bd_exame.php");	

		}else if($R_botao == "Deseja adicionar mais exames?"){
			header("Location: cad_exame.php");	
		}
	}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Cadastro de exames</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css"  href="css/mainn.css" >
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
	<script src="https://kit.fontawesome.com/bc9af11c84.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
  </head>
 <body>
	<?php include 'header-novo.php';?>
		<BR>
		
	<div class=" container-cad form-group col-xl-4 offset-xl-4 "  >	
	
			
		<form action="cad_exame.php" method="POST" class='m-2'>	
						<h3 class=" mt-5 text-center"><strong>Cadastro de exame</strong></h3>	
						<br>
							<label for="data_exame" class="form-label "><strong>Digite a data do exame: </strong> </label>
							<input class="form-control" type="date" name="data_exame"
							<?php
							if(!empty($_SESSION['value_data'])){
								echo "value='".$_SESSION['value_data']."'";
								unset($_SESSION['value_data']);
							}
						 ?>	> <span class="input-group-addon">
						  <i class="glyphicon glyphicon-calendar"></i>
						  </span>
						 <?php
							if(!empty($_SESSION['data_exame'])){
								echo "<p style='color: #f00; '>".$_SESSION['data_exame']."</p>";
								unset($_SESSION['data_exame']);
							}
						 ?> 
						<br>
						
						
							<label for="nome_exame" class="form-label align-baseline  "><strong>Digite o nome do exame: </strong> </label>	<br>
							<select class="referencia-select form-select h2" name="nome_exame" id="autocomplete">
								
								<option class="h2" value=""> 
								<?php
								 foreach ($valores as $valor) {  ?>
								<option  class="h4" value="<?php echo $valor['valor_nome']?>"> <?php echo $valor['valor_nome'];?></option> <?php }  ?>  
								
								<script>
								var tags = [ <?php foreach ($valores as $valor) { echo $valor['valor_nome']; } ?>];
								$( "#autocomplete" ).autocomplete({
								  source: function( request, response ) {
										  var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
										  response( $.grep( tags, function( item ){
											  return matcher.test( item );
										  }) );
									  }
								});
								</script>
								</select>
							<?php
							if(!empty($_SESSION['value_nome'])){
								echo "value='".$_SESSION['value_nome']."'";
								unset($_SESSION['value_nome']);
							}
						 ?>	
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
							
							<input class="btn btn-primary m-1 " name="Fm_submit"  type="submit"  value="Deseja adicionar mais exames?"> 
							
							<input class="btn btn-success m-1" name="Fm_submit" type="submit"  value="Salvar"> 
							<div><span href="logout.php" class="fa-solid fa-person-to-door"></span>	</div>
							
		</form> 
	</div>
</html>