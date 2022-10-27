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
    <title>Seus Exames</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css"  href="css/mainn.css" >

  </head>
  <body>
  	<?php include 'header.php';?>
	 
		<script>
			function confirmarDelecao(id,nome_exame){
				var resposta = confirm("Tem certeza que deseja deletar a linha inteira "+nome_exame+"?");
				if (resposta) {
					window.location.href = 'http://localhost/monitoraSaude/del_exame.php?nome_exame='+nome_exame;
				}
			}
			
		</script>
		<script>
			function confirmarAtualizar(id_usuario,nome_exame){
				
				var resposta = confirm("Tem certeza que deseja atualizar a linha inteira "+nome_exame+"?");
				
				if (resposta) {
				
					window.location.href = 'http://localhost/monitoraSaude/update_exame.php?id_usuario='+id_usuario+'&nome_exame='+nome_exame;
				}
			}
			
		</script>
		
	<h1 class="title-bd">Tabela de exames</h1>
		<?php echo "<div class='bemvindo' <i>Bem vindo(a) <b>".$_SESSION['nome_usuario']."!</b></i></div>"; ?>
				<br>

		<?php
			include("conexao.php");
			$login = $_SESSION['login'];
			$id_usuario = $_SESSION['id_usuario'];
			$query = "SELECT id, nome_exame,data_exame,valor_exame  FROM exame WHERE id_usuario = '$id_usuario' ORDER BY data_exame ASC";
			$resultados = mysqli_query($conexao, $query);
			$exame = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
			$query = "SELECT DISTINCT id,data_exame  FROM exame WHERE id_usuario = '$id_usuario' ORDER BY data_exame ASC";
			$resultados = mysqli_query($conexao, $query);
			$data = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
			$query = "SELECT   id,data_exame  FROM exame WHERE id_usuario = '$id_usuario' ORDER BY data_exame ASC";
			$resultados = mysqli_query($conexao, $query);
			$dataa = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
			$query = "SELECT id,nome_exame  FROM exame WHERE id_usuario = '$id_usuario' ORDER BY data_exame ASC";
			$resultados = mysqli_query($conexao, $query);
			$nome = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
			$query = "SELECT   nome_exame  FROM exame WHERE id_usuario = '$id_usuario' ORDER BY data_exame ASC ";
			$resultados = mysqli_query($conexao, $query);
			$nomes = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
			
			function array2($array){
						foreach ($array as $key1 => $a1)
						{
						 $a1 = implode("/",array_reverse(explode("-",$a1)));

						}
						return $a1;
					}	
					?>
					
		
			<?php	
					
				if (!empty($_POST['filtro']) || !empty($_POST['filtros'])) {	
				  $filtro = $_POST['filtro'];
					$dataa = array_map('array2', $dataa);
					 if(in_array($filtro, $dataa, TRUE)){
						$filtro = implode("-",array_reverse(explode("/",$filtro)));
						$query1 = "SELECT id,nome_exame,data_exame,valor_exame FROM exame WHERE id_usuario = '$id_usuario'&& data_exame = '$filtro'ORDER BY data_exame ASC  ";
						$resultados = mysqli_query($conexao, $query1);
						$exame 	= mysqli_fetch_all($resultados, MYSQLI_ASSOC);
						//var_dump( $exame);
					}
						
					 					 
						  $filtros = $_POST['filtros'];
							$nomes = array_map('array2', $nomes);
							 if(in_array($filtros, $nomes, TRUE)){
								$query1 = "SELECT id,nome_exame,data_exame,valor_exame FROM exame WHERE id_usuario = '$id_usuario'&& nome_exame = '$filtros' ORDER BY data_exame ASC ";
								$resultados = mysqli_query($conexao, $query1);
								$exame 	= mysqli_fetch_all($resultados, MYSQLI_ASSOC);
								//var_dump( $exame);
								
					}
					 }else{
						$query = "SELECT id,nome_exame,data_exame,valor_exame FROM exame WHERE id_usuario = '$id_usuario' ORDER BY data_exame ASC ";
						$resultados = mysqli_query($conexao, $query);
						$exame 	= mysqli_fetch_all($resultados, MYSQLI_ASSOC);
				}
			?>
			
			
			<form class='filtross' action="bd_exame.php" method="POST">
				Filtrar nome:
			<select class="grafico-select" name="filtros">
			
			<option value=""> 
			<?php
			 foreach ($nome as $res) { ?>
			<option value="<?php echo $res['nome_exame']?>"> <?php echo $res['nome_exame'];?></option> <?php }  ?>  
			</select>
						<div class="div-filtro">

				Filtrar data: 
			<select class="grafico-select" id="grafico-select" name="filtro">
			
			<option class="grafico-option" value=""> 
			<?php
				 foreach ($data as $res) { 
				// var_dump( $data);
				 //				var_dump( $res);

				$res['data_exame'] = implode("/",array_reverse(explode("-",$res['data_exame'])));
				//var_dump( $res['data_exame']);?>
				<option value="<?php echo $res['data_exame'];?>"> <?php echo $res['data_exame'];?></option> 
				<?php }  ?>  
				</select>
				<input class="btn-filtro" type="submit"  value="Filtrar"/>
				</div>
				</form>				


	<?php
	
						$grouped = [];
						$columns = [];
						$value = [];
						echo "<table class='table' id='tabela'>";
						foreach ($exame as $row) {
							$nome_exame = $row['nome_exame'];
								
							$row['data_exame']= strtotime($row['data_exame']);
							$row['data_exame'] = date("d/m/Y",$row['data_exame']);
							$grouped [$row['nome_exame']][$row['data_exame']] = $row['valor_exame'];
							$value [$row['valor_exame']]= $row['valor_exame'];
							$columns[$row['data_exame']] = $row['data_exame'];
					

						}
						
					
						$defaults = array_fill_keys($columns, '-');
						
						
						echo "<div class='ScrollDiv'>";
						
							printf(
								"<tr class='head'><td class='cedula'>&nbsp;</td><td class='cedula'>%s</td></tr>",
								implode("</td><td class='cedula'>", $columns)
							);
							foreach ($grouped as $nome_exame => $records) {
							//var_dump($nome_exame);
								
							$buttons = "<button class='botao-atualiza' onClick ='confirmarAtualizar($id_usuario, `$nome_exame`)'>Atualizar</button>";
							
							//var_dump($nome);
								$buttons2 = "<button class='botao-deleta'  onClick ='confirmarDelecao($nome_exame, `$nome_exame`)'>Deletar</button>";
								printf(
									"<tr class='row' id='row'><td class='cedula'>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",
									$nome_exame,
									implode("</td><td class='cedula'>", array_replace($defaults, $records)),$buttons2,$buttons
								);
							}
							
						echo "</td>";					
						echo "</table>";
						
						echo "</div>";  
					
							
		?>
		
		
								
			<br>
			<br>
			<a type="button" class="b-cad" href="cad_exame.php">Cadastra novo exame</a>
				
		<form class="grafico-form" action="bd_exame.php" method="POST">
		<h1 class="t-grafico">Monte seu Gráfico</h1>
		<br>
		<br>
				<div class="grafico-filtro"><h3> Selecione o exame:
			<select class="grafico-select" name="grafico-f">
			</h3>
			<option value=""> 
			<?php
			 foreach ($nome as $res) { ?>
			<option value="<?php echo $res['nome_exame']?>"> <?php echo $res['nome_exame'];?></option> <?php }  ?>  
			</select>
			<input class="btn-filtro" type="submit"  value="Filtrar"/>
			</div>
				</form>
			<br><br>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script>
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
 
    function drawChart() {
      var data1 = google.visualization.arrayToDataTable([
				[{label: 'Data do exame', type: 'string'},
                 {label: 'Valor do exame', type: 'number'}
                ],    
				
        <?php
			
       if (!empty($_POST['grafico-f'])) {	
					$graficof = $_POST['grafico-f'];
					$nomes = array_map('array2', $nomes);
					if(in_array($graficof, $nomes, TRUE)){
						$query1 = "SELECT nome_exame,data_exame,valor_exame FROM exame WHERE id_usuario = '$id_usuario'&& nome_exame = '$graficof' ORDER BY data_exame ASC ";
						$resultado = mysqli_query($conexao, $query1);
						$exame 	= mysqli_fetch_all($resultado, MYSQLI_ASSOC);
						 foreach($exame as $dados){
							$a = $dados['data_exame'];
							$b = $dados['valor_exame'];
							$_SESSION['nome'] = $dados['nome_exame'];
							$a = strtotime($a);
							$a = date("d/m/Y",$a);
         ?>
		 ['<?php echo $a ?>',<?php echo $b ?>],

					<?php }}}else{
						$query = "SELECT nome_exame,data_exame,valor_exame FROM exame WHERE id_usuario = '$id_usuario' ORDER BY data_exame ASC";
						$resultados = mysqli_query($conexao, $query);
						$exame 	= mysqli_fetch_all($resultados, MYSQLI_ASSOC);
				}
			?>

      ]);
 
      
      var options = {
          title: 'Gráfico em linha do exame de <?php if (!empty($_POST['grafico-f'])) {	echo $_SESSION['nome'];}?>',
		  responsive: true,
          curveType: 'function',
		   pointSize:7	,
          legend: 'none',
		  hAxis: {title: 'Data do Exame'},
		  vAxis: {title: 'Valor do Exame'},
		   
			
        };
 
        var chart = new google.visualization.LineChart(document.getElementById('grafico-linha'));
 
        chart.draw(data1, options);
  }
  
  </script>
  <script>
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
 
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
				[{label: 'Data do exame', type: 'string'},
                 {label: 'Valor do exame', type: 'number'},
                 { role: 'annotation' }],    
				
        <?php
			
       if (!empty($_POST['grafico-f'])) {	
					$graficof = $_POST['grafico-f'];
					if(in_array($graficof, $nomes, TRUE)){
						$query1 = "SELECT nome_exame,data_exame,valor_exame FROM exame WHERE id_usuario = '$id_usuario'&& nome_exame = '$graficof' ORDER BY data_exame ASC ";
						$resultado = mysqli_query($conexao, $query1);
						$exame 	= mysqli_fetch_all($resultado, MYSQLI_ASSOC);
						 foreach($exame as $dados){
							$a = $dados['data_exame'];
							$b = $dados['valor_exame'];
							$_SESSION['nome'] = $dados['nome_exame'];

							$a = strtotime($a);
							$a = date("d/m/Y",$a);
         ?>
		 ['<?php echo $a ?>',<?php echo $b ?>,<?php echo $b ?>],

					<?php }}}else{
						$query = "SELECT  nome_exame,data_exame,valor_exame FROM exame WHERE id_usuario = '$id_usuario' ORDER BY data_exame ASC";
						$resultados = mysqli_query($conexao, $query);
						$exame 	= mysqli_fetch_all($resultados, MYSQLI_ASSOC);
				}
			?>

      ]);
 
      
      var options = {
          title: 'Gráfico em barra do exame de <?php  if (!empty($_POST['grafico-f'])) {	echo $_SESSION['nome'];}?>',
		  responsive: true,
          curveType: 'function',
		   pointSize:7	,
          legend: 'none',
		  hAxis: {title: 'Data do Exame'},
		  vAxis: {title: 'Valor do Exame'},
		    bar: {groupWidth: "40%"},
			
        };
 
        var chartt = new google.visualization.ColumnChart(document.getElementById('grafico-barra'));
 
        chartt.draw(data, options);
  }
  
  </script>
<div id="style-grafico" ><div id="grafico-linha" class ="grafico-linha"  style="width: 100%; height: 500px; display: block; margin-left: auto; margin-right: auto; 
	overflow: hidden;";></div></div>
	<div id="style-grafico" ><div id="grafico-barra" class ="grafico-linha"  style="width: 100%; height: 500px; display: block; margin-left: auto; margin-right: auto; 
	overflow: hidden;";></div></div>
			<br>
			<a type="button" class="b-cad" href="cad_exame.php">Cadastra novo exame</a>
			
			<br>
			<br><br>
  
	</body>	
	
</html>
