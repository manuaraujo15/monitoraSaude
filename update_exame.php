
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		 <title>Atualizar exames</title>
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	
  </head>
	<body>
	<script>
			function confirmarDelecao(id,nome_exame){
				var resposta = confirm("Tem certeza que deseja mesmo?");
				if (resposta) {
					window.location.href = 'http://localhost/monitoraSaude/del_exame_solo.php?id='+id;
				}
			}
			
		</script>
		<script>
	function mostra_oculta(id,data_exame,nome_exame,valor_exame){
		window.location.href = 'http://localhost/monitoraSaude/form_atualizar.php?&id='+id+'&data_exame='+data_exame+'&nome_exame='+nome_exame+'&valor_exame='+valor_exame;
}</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<?php  include 'header-novo.php';?>
	<br><br>
	<h2 class=" mt-5 text-center"><strong>Qual exame deseja atualizar?</strong></h3>	
	 <?php
	
	
	if ($_GET['id_usuario'] ) {
			echo "<div class=' m-2 mt-5  text-justify row border-0 d-flex justify-content-center' class='informa-dados' id='informa-dados'  >";
			
		include("conexao.php");
		$id_usuario = $_GET['id_usuario'];
		$nome= $_GET['nome_exame'];
	//	var_dump($nome);
		$query = "SELECT id from exame WHERE nome_exame ='$nome' AND  id_usuario= '$id_usuario'";
			$resultados = mysqli_query($conexao , $query);
			$count_id = mysqli_num_rows($resultados);
			
		$query = "SELECT * FROM exame WHERE nome_exame ='$nome' AND  id_usuario= '$id_usuario'";
		$conj_resultados = mysqli_query($conexao, $query);
		$dados = mysqli_fetch_all($conj_resultados, MYSQLI_ASSOC);
		
		foreach($dados as $dado){
			//var_dump($dado);
		$id = $dado['id'];
		$data_exame = $dado['data_exame'];
		$nome_exame = $dado['nome_exame'];
		$valor_exame = $dado['valor_exame'];
		$data_exame = strtotime($data_exame);
		$data_exame = date("d/m/Y",$data_exame);
		
	echo "<div class=' p-2 m-2  col-lg-auto col-sm-auto   border border-dark rounded-2 '   >";
		echo "<input type='hidden' name='id_usuario' value='$id_usuario'/>";
		echo "<input type='hidden' name='id' value='$id'/>";
		echo "<p class='text-justify' type='date' name='data_exame' ><strong>Digite a data do exame:</strong> $data_exame</p>";
		echo "<p class='text-justify'type='text' name='nome_exame' ><strong>Digite o nome do exame:</strong> $nome_exame </p>";
		echo "<p class='text-justify' type='number' lang='pt' type='number' step='0.001' name='valor_exame' id='valor_exame'><strong>Digite o valor do exame:</strong>  $valor_exame</p>";
	echo "<div class='d-flex justify-content-between'>";
		echo "<button class='btn btn-danger m-'  onClick ='confirmarDelecao($id, `$nome_exame`)'>Deletar</button>";
		echo "<button class='btn btn-warning'   onclick='mostra_oculta( `$id`, `$data_exame`, `$nome_exame`, `$valor_exame`)'>Atualizar</button>";
			echo "</div>";
			
			echo "</div>";
			echo "<br>";
			
		} echo "<div class=''><a class='btn btn-secondary ' style='float:right; margin-right:29.5%; margin-top:5px;' href='bd_exame.php'>Voltar</a></div>";
		
			echo "</div>";
			
		mysqli_close($conexao);}
		?> 
	</body>
</html>
