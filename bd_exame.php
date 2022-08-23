<?php
	session_start();
	if (strcmp($_SESSION['login'], $_SESSION['login-post']) == 0) {
		session_destroy();
		header("Location: cad_usuario.php");
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Cadastro de exames</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet"  href="main.css" >

  </head>
  <body>
  	<?php include 'header.php';?>
	
	<h1 class="title-bd">Tabela de exames</h1>
		<div class="bemvindo">
		<?php echo "<div <i>Bem vindo <b>".$_SESSION['nome_usuario']."!</b></i></div>"; ?>
				<br>
		</div>
		<?php
			include("conexao.php");
			$login = $_SESSION['login'];
			$id_usuario = $_SESSION['id_usuario'];
			$query = "SELECT nome_exame,data_exame,valor_exame FROM exame WHERE id_usuario = '$id_usuario' ";
			$resultados = mysqli_query($conexao, $query);
			$exame = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
			$query2 = "SELECT nome_exame FROM exame WHERE id_usuario = '$id_usuario' ";
			$resultados2 = mysqli_query($conexao, $query2);
			$nome= mysqli_fetch_all($resultados2, MYSQLI_ASSOC);
			$query3 = "SELECT valor_exame FROM exame WHERE id_usuario = '$id_usuario' ";
			$resultados3 = mysqli_query($conexao, $query3);
			$valor = mysqli_fetch_all($resultados3, MYSQLI_ASSOC);
			$query4 = "SELECT data_exame FROM exame WHERE id_usuario = '$id_usuario'";
			$resultados4 = mysqli_query($conexao, $query4);
			$data = mysqli_fetch_all($resultados4, MYSQLI_ASSOC);
			//var_dump( $exame);
					function array2($array){
						foreach ($array as $key1 => $a1)
						{
							//	var_dump( $a1);
						}
						return $a1;
					}
					$nome_exame = array_map('array2', $nome);
				//						var_dump( $b);
					$data_exame = array_map('array2', $data);
					$valor_exame = array_map('array2', $valor);
			//var_dump( $nome_exame);
			//var_dump( $data_exame);
			//var_dump( $valor_exame);

					function matriz(string $nome, string $data, int $valor){
						
						
			
							$tabela [$nome][$data] = $valor;										
								
										//		var_dump($tabela);	

								return $tabela;
	
					}
								//array_walk($e, "array2");			
					$tabela = array_map('matriz', $nome_exame, $data_exame,$valor_exame );
						
					var_dump($tabela);	
					?>
					<div class="table">
					
				<?php					
					if (!$exame) {
							$exame = array();
							//var_dump($exame);	
						}
						if (!$tabela) {
							$tabelas = array();
							//var_dump($tabela);	
						}												
						//var_dump($tabela);	
						echo( "<table class='table'>");
						foreach($tabela as $tabelas) {
									var_dump($tabelas);	
						echo key($tabelas).'<br/>';
												foreach($tabelas as $key1 => $val2) {
																					

										$first = true;
												
												if($first){
												echo ("<tr>");	
													echo ("<td></td>");	
													foreach($val2 as $key2 => $val3) {	
													//var_dump($key2);
														$data_exame = implode("/",array_reverse(explode("-",$key2)));
														echo("<td>$data_exame</td>");												
													}
												
												$first = false;
												}echo ("</tr>");
												//	var_dump ( $val13);
												echo '<tr><td>'.$key1.'</td>';	
												foreach($val2  as $key2 => $value2){
													//$value3 = array_map('array2', $value3);
												//	var_dump ( $value2);	
													echo ('<td>'.$value2.'</td>');												
												}	echo '</tr>';															
													
												}
										
						}
																						echo '</table>';

						echo("<table class='table'><thead><tr><td></td>");
						foreach($exame as $exames) {
												//		var_dump($exames);	

							$data_examee = $exames['data_exame'];
							$nome_examee = $exames['nome_exame'];
							$valor_examee = $exames['valor_exame'];
							$first = true;
												
												if($first){
							
										$data_examee = implode("/",array_reverse(explode("-",$data_examee)));
										echo("<td>$data_examee</td>");
						}
						}echo("</tr></thead>");
						foreach($exame as $exames) {
							$data_examee = $exames['data_exame'];
							$nome_examee = $exames['nome_exame'];
							$valor_examee = $exames['valor_exame'];
								
							echo("<tr><td>$nome_examee</td>
							
									 <td>$valor_examee</td></tr>");
						}
						echo("</table>");


												echo( "<table class='table'>");

												foreach($tabela as $key1 => $val2) {
																					
													foreach($val2 as $key1 => $val2) {

										$first = true;
												
												if($first){
												echo ("<tr>");	
													echo ("<td></td>");	
													foreach($val2 as $key2 => $val3) {	
													//var_dump($key2);
														$data_exame = implode("/",array_reverse(explode("-",$key2)));
														echo("<td>$data_exame</td>");												
													}
												echo ("</tr>");
												$first = false;
												}
												//	var_dump ( $val13);
												echo '<tr><td>'.$key1.'</td>';	
												foreach($val2  as $key2 => $value2){
													//$value3 = array_map('array2', $value3);
												//	var_dump ( $value2);	
													echo ('<td>'.$value2.'</td>');												
												}	echo '</tr>';															
													
												}}
										echo '</table>';
										
										
										
										
										
										
										
										
										
										echo( "<table class='table'>");

					$foo['one']['a'] = '1a';
					$foo['one']['b'] = '1b';
					$foo['two']['a'] = '2a';
					$foo['two']['b'] = '1b';
					

					//open table

					//our control variable
					$first = true;

					foreach($foo as $key1 => $val1) {
						//if first time through, we need a header row
						if($first){
							echo '<tr><th></th>';
							foreach($val1 as $key2 => $value2){
								echo '<th>'.$key2.'</th>';
							}
							echo '</tr>';

							//set control to false
							$first = false;
						}

						//echo out each object in the table
						echo '<tr><td>'.$key1.'</td>';
						foreach($val1 as $key2 => $value2){
							echo '<td>'.$value2.'</td>';
						}
						echo '</tr>';
					}

					echo '</table>';

		?>
				</div>

			<br>
			<a type="button" class="b-cad" href="cad_exame.php">Cadastra novo exame</a>
			<a class="b-out" href="logout.php"> Logout </a>

	</body>	
</html>
