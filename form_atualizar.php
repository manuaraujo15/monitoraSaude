<?php
		if (isset($_GET['id'])) {
		include("conexao.php");
		$id = $_GET['id'];
		$query = "SELECT * FROM exame WHERE id = $id";
		$resultados = mysqli_query($conexao, $query);
		$dados = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
		//var_dump($serie);
		$dado = $dados[0];	
		$id = $dado['id'];
		$data_exame = $dado['data_exame'];
		$nome_exame = $dado['nome_exame'];
		$valor_exame = $dado['valor_exame'];
		mysqli_close($conexao);
	}			
	   if (isset ($_POST['data_exame'])  and isset($_POST['nome_exame']) and isset ($_POST['valor_exame'])){
				$id_usuario = $_POST['id_usuario'] ;
			
				$id = $_POST['id'] ;
				$data_exame = $_POST['data_exame'] ; 
				$nome_exame = $_POST['nome_exame'];
				$valor_exame = $_POST['valor_exame'] ;
				
				//var_dump($id_usuario);
				
	    include("conexao.php");
	
        $query = "UPDATE exame SET nome_exame = '$nome_exame', data_exame = '$data_exame', valor_exame = '$valor_exame' WHERE id = '$id' ";		
	
		mysqli_query($conexao, $query);

		mysqli_close($conexao);
		header("Location:bd_exame.php"); 
	}
?>
			

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		 <title>Atualizar exames</title>
	<link rel="stylesheet" type="text/css"  href="css/mainn.css" >
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	
  </head>
	<body>
	<?php  include 'header-novo.php';?>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

		<br><br>
		<div  id="container-form" class=" container-cad form-group col-xl-4 offset-xl-4 "  >	
			<form action="form_atualizar.php" method="POST" class='m-2'>
			<h3 class=" mt-5 text-center"><strong>Atualizar exames</strong></h3>	

			<br>
			  <?php
				echo "<input type='hidden' name='id' value='$id'/>";	
			
				echo "<label for='data_exame' class='form-label align-baseline'>Digite a data do exame: </label>";
				echo "<input class='form-control' lang='pt' type='date' name='data_exame' id='data_exame' value= '$data_exame'> ";
					 
				echo "<br>";
				echo "<label for='nome_exame' class='form-label align-baseline'>Digite o nome do exame:  </label>";
				echo "<input class='form-control'  lang='pt' type='text' name='nome_exame' id='nome_exame' value= '$nome_exame'/>";
				echo "<br>"; 
				
				echo "<label for='valor_exame' class='form-label align-baseline'>Digite o valor do exame: </label>";
				echo "<input class='form-control'  lang='pt' type='number' step='0.001' name='valor_exame' id='valor_exame' value='$valor_exame' />";
				echo "<br>";
				echo "<input  class='btn btn-success' type='submit' value='Atualizar' />";
				echo "<br>";echo "<br>";
				
		
	

			?>
				</form>
			<a class="btn btn-secondary" href="bd_exame.php">Voltar</a>
		</div>
	</body>
</html>
