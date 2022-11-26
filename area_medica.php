
<?php 
include('conexao.php');
	
		session_start();			
	if (!empty($_POST['token'])) {
		$id_usuario = $_POST['token'];
		$query = "SELECT * FROM exame WHERE id_usuario='$id_usuario'";
		$_SESSION['id_usuario'] = $_POST['token'];
		//var_dump($token);
			$conj_resultados = mysqli_query($conexao , $query);
			$dados = mysqli_fetch_array($conj_resultados);
			var_dump($dados);		
		if(in_array($id_usuario, $dados, TRUE)){
			header("Location: exame_medico.php?id_usuario=$id_usuario");	
		}else{
			echo 'error';
		}
	}
	
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Área Médica</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">		
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> 
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
<?php include 'header.php';?>
<br><br>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

	
	<div class=" container-cad ">
	
		<form action="area_medica.php" method="POST" class="m-4 ">
		<div class=" form-group col-xl-6 offset-xl-3 "  >	
				<h3 class='mt-5 text-center'><strong>Área Médica</strong></h3>
				
				<label class="form-label align-baseline">Insira o token do paciente:</label>
				<input class="form-control border border-right-0" type="number" name="token" id="token" placeholder="token do paciente" required>
					
						  <br>
				<button class="btn btn-primary mb-3" type="submit"  id="token_btn" name="token_btn">Ver Exames</button>
				<br>
				
				</div>
			</form>		
			</div>

    <br>	 
</body>

</html>