<?php ?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title> Exames do Paciente</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css"  href="css/main.css" >

  </head>
  <body>
  	<?php include 'header.php';?>
	<h1 class="title-bd">Tabela de exames</h1>
	<br>

		<?php
	session_start();
		include("conexao.php");
			$id_usuario = $_SESSION['id_usuario'];
			//$_SESSION['id_usuario'] = $dados['valor_nome'];
		//	var_dump($id_usuario);
			$query = "SELECT id, nome_exame,data_exame,valor_exame,id_usuario  FROM exame WHERE id_usuario = '$id_usuario' ORDER BY data_exame ASC";
			$resultados = mysqli_query($conexao, $query);
			$exame = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
			//var_dump($exame);	
			$query = "SELECT DISTINCT id,data_exame  FROM exame WHERE id_usuario = '$id_usuario' GROUP BY data_exame";
			$resultados = mysqli_query($conexao, $query);
			$data_filtro = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
			
			$query = "SELECT data_exame  FROM exame WHERE id_usuario = '$id_usuario'  GROUP BY data_exame";
			$resultados = mysqli_query($conexao, $query);
			$data = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
			
			$query = "SELECT id,nome_exame  FROM exame WHERE id_usuario = '$id_usuario' GROUP BY nome_exame";
			$resultados = mysqli_query($conexao, $query);
			$nome_filtro = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
			
			$query = "SELECT nome_exame  FROM exame WHERE id_usuario = '$id_usuario'  GROUP BY nome_exame";
			$resultados = mysqli_query($conexao, $query);
			$nomes = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
		
		
			$query = "SELECT valor_nome FROM valores_exame";
			$resultados = mysqli_query($conexao, $query);
			$valores = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
	//	var_dump($valores);

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
					$data = array_map('array2', $data);
					 if(in_array($filtro, $data, TRUE)){
						$filtro = implode("-",array_reverse(explode("/",$filtro)));
						$query1 = "SELECT nome_exame,data_exame,valor_exame FROM exame WHERE id_usuario = '$id_usuario'&& data_exame = '$filtro'ORDER BY data_exame ASC  ";
						$resultados = mysqli_query($conexao, $query1);
						$exame 	= mysqli_fetch_all($resultados, MYSQLI_ASSOC);
						//var_dump( $exame);
					}
						
					 					 
						  $filtros = $_POST['filtros'];
							$nomes = array_map('array2', $nomes);
							 if(in_array($filtros, $nomes, TRUE)){
								$query1 = "SELECT nome_exame,data_exame,valor_exame FROM exame WHERE id_usuario = '$id_usuario'&& nome_exame = '$filtros' ORDER BY data_exame ASC ";
								$resultados = mysqli_query($conexao, $query1);
								$exame 	= mysqli_fetch_all($resultados, MYSQLI_ASSOC);
								
								
					}
					 }else{
						$query = "SELECT id,nome_exame,data_exame,valor_exame FROM exame WHERE id_usuario = '$id_usuario' ORDER BY data_exame ASC ";
						$resultados = mysqli_query($conexao, $query);
						$exame 	= mysqli_fetch_all($resultados, MYSQLI_ASSOC);
				}
			?>
			
			
			<form class='filtross' action="exame_medico.php?id_usuario='$id_usuario'" method="POST">
				Filtrar nome:
			<select class="grafico-select" name="filtros">
			
			<option value=""> 
			<?php
			 foreach ($nome_filtro as $res) {  ?>
			<option value="<?php echo $res['nome_exame']?>"> <?php echo $res['nome_exame'];?></option> <?php }  ?>  
			</select>
						<div class="div-filtro">

				Filtrar data: 
			<select class="grafico-select" id="grafico-select" name="filtro">
			
			<option class="grafico-option" value=""> 
			<?php
				 foreach ($data_filtro as $res) { 
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
						
						
						echo "<div class='ScrollDiv' id='ScrollDiv'>";
						
							printf(
								"<tr class='head'><td class='cedula'>&nbsp;</td><td class='cedula'>%s</td></tr>",
								implode("</td><td class='cedula'>", $columns)
							);
							foreach ($grouped as $nome_exame => $records) {
							//var_dump($nome_exame);
							//var_dump($nome);
								
								printf(
									"<tr class='row' id='row'><td class='cedula'>%s</td><td>%s</td></tr>\n",
									$nome_exame,
									implode("</td><td class='cedula'>", array_replace($defaults, $records))
								);
							}
							
						echo "</td>";					
						echo "</table>";
						
						echo "</div>";  
					
							
		?>
		
		
								
			<br>
			<br>
			
				
		<form class="grafico-form" action="exame_medico.php#" method="POST">
		<h1 class="t-grafico">Monte seu Gráfico</h1>
		<br>
		<br>
				<div class="grafico-filtro"><h3> Selecione o exame:
			<select class="grafico-select" name="grafico-f">
			</h3>
			<option value=""> 
			<?php
			 foreach ($nome_filtro as $res) { ?>
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
    <?php 
			$daata = [];
			$vaalor = [];
			$max = [];
			$min = [];	
			$vir = ',';
		?> 
		
				 
   
    <?php
			
       if (!empty($_POST['grafico-f'])) {	
					$graficof = $_POST['grafico-f'];
					$nomes = array_map('array2', $nomes);
					if(in_array($graficof, $nomes, TRUE)){
						$query1 = "SELECT nome_exame,data_exame,valor_exame FROM exame WHERE id_usuario = '$id_usuario'&& nome_exame = '$graficof' ORDER BY data_exame ASC ";
						$resultado = mysqli_query($conexao, $query1);
						$exame 	= mysqli_fetch_all($resultado, MYSQLI_ASSOC);
						 
							$valoref= array_map('array2', $valores);
			if(in_array($graficof, $valoref, TRUE)){
									$query = "SELECT valor_nome, min_valor, max_valor FROM valores_exame WHERE valor_nome = '$graficof'";
									$resultados = mysqli_query($conexao, $query);
			   $valorref = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
			 
			   foreach($valorref as $dados){
							$_SESSION['nome'] = $dados['valor_nome'];
							$min_valor = $dados['min_valor'];			
							$max_valor = $dados['max_valor'];
							$max[$max_valor] = $dados['max_valor'];
							$min[$min_valor] =  $dados['min_valor'];
						 }	}}
							
         ?>
		    var data_linha = google.visualization.arrayToDataTable([
			['Data', 'Valor do Exame', { role: 'annotation'} <?php if($min[$min_valor] == null ){?>, ' Valor maximo de Referência', { role: 'annotation'}
			<?php }if($max[$max_valor] == null){?>,' Valor mínimo de Referência', { role: 'annotation'}
			
			<?php }elseif($min[$min_valor] != null AND $max[$max_valor] != null ){?>, ' Valor mínimo de Referência', { role: 'annotation'},' Valor maximo de Referência', { role: 'annotation'}<?php }?>],
		<?php
		foreach($exame as $dados){
							$datae = $dados['data_exame'];
							$valore = $dados['valor_exame'];
							$vaalor[$valore] = $valore;
						
							$datae = strtotime($datae);
							$datae = date("d/m/Y",$datae);
							$daata = $datae;
		  foreach($valorref as $dados){
							$_SESSION['nome'] = $dados['valor_nome'];
							$max[$max_valor] = $dados['max_valor'];
							$min[$min_valor] =  $dados['min_valor'];
							$minvalor = $dados['min_valor'];			
							$maxvalor = $dados['max_valor'];
		?>
		
			['<?php echo $daata ?>',  <?php echo $valore ?>, '<?php echo $valore ?>' <?php if($max[$max_valor] == null){echo $vir; echo $min[$min_valor];echo $vir; } ?>
			<?php if($max[$max_valor] == null){?>' <?php  echo $min[$min_valor]; ?>' <?php }if($min[$min_valor] == null ){echo  $vir; echo $max[$max_valor];echo  $vir;?>
			' <?php }if($min[$min_valor] == null ){ echo $max[$max_valor]   ?>' <?php } if($min[$min_valor] != null AND $max[$max_valor] != null ){?> <?php echo  $vir; echo  $min[$min_valor]; echo  $vir;?>
		  '<?php echo $min[$min_valor]?>'<?php echo $vir; echo $max[$max_valor];echo  $vir;?> '<?php echo $max[$max_valor]?>' <?php }?>],
		
	   <?php }}
		   
	   }else{$query = "SELECT id,nome_exame,data_exame,valor_exame FROM exame WHERE id_usuario = '$id_usuario' ORDER BY data_exame ASC ";
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
            legend: 'bottom',
		  hAxis: {title: 'Data do Exame'},
		  vAxis: {title: 'Valor do Exame'},
		   
			
        };
 
        var chart = new google.visualization.LineChart(document.getElementById('grafico-linha'));
 
        chart.draw(data_linha, options);
  }
  
  </script>
  
  <script>
 
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
 
    function drawChart() {
      		
				
        <?php
			
       if (!empty($_POST['grafico-f'])) {	
					$graficof = $_POST['grafico-f'];
					if(in_array($graficof, $nomes, TRUE)){
						$query1 = "SELECT nome_exame,data_exame,valor_exame FROM exame WHERE id_usuario = '$id_usuario'&& nome_exame = '$graficof' ORDER BY data_exame ASC ";
						$resultado = mysqli_query($conexao, $query1);
						$exame 	= mysqli_fetch_all($resultado, MYSQLI_ASSOC);
						
							
			if(in_array($graficof, $valoref, TRUE)){
									$query = "SELECT valor_nome, min_valor, max_valor FROM valores_exame WHERE valor_nome = '$graficof'";
									$resultados = mysqli_query($conexao, $query);
			   $valor_ref = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
			   //var_dump($valor_ref);
			    foreach($valor_ref as $dados){
							$_SESSION['nome'] = $dados['valor_nome'];
							$min_valor = $dados['min_valor'];			
							$max_valor = $dados['max_valor'];
							$max[$max_valor] = $dados['max_valor'];
							$min[$min_valor] =  $dados['min_valor'];
						 }	}}
							
         ?>
		    var data = google.visualization.arrayToDataTable([
			['Data', 'Valor do Exame', { role: 'annotation'} <?php if($min[$min_valor] == null ){?>, ' Valor maximo de Referência', { role: 'annotation'}
			<?php }if($max[$max_valor] == null){?>,' Valor mínimo de Referência', { role: 'annotation'}
			
			<?php }elseif($min[$min_valor] != null AND $max[$max_valor] != null ){?>, ' Valor mínimo de Referência', { role: 'annotation'},' Valor maximo de Referência', { role: 'annotation'}<?php }?>],
		<?php
		 foreach($exame as $dados){
							$date = $dados['data_exame'];
							$valor = $dados['valor_exame'];
							
							$date = strtotime($date);
							$date = date("d/m/Y",$date);
							
		  foreach($valor_ref as $dados){
							$_SESSION['nome'] = $dados['valor_nome'];
							$minvalor = $dados['min_valor'];			
							$maxvalor = $dados['max_valor'];
		?>
		
			['<?php echo $date ?>',  <?php echo $valor ?>, '<?php echo $valor ?>' <?php if($max[$max_valor] == null){echo $vir; echo $min[$min_valor];echo $vir; } ?>
			<?php if($max[$max_valor] == null){?>' <?php  echo $min[$min_valor]; ?>' <?php }if($min[$min_valor] == null ){echo  $vir; echo $max[$max_valor];echo  $vir;?>
			' <?php }if($min[$min_valor] == null ){ echo $max[$max_valor]?>' <?php } if($min[$min_valor] != null AND $max[$max_valor] != null ){?> <?php echo  $vir; echo  $min[$min_valor]; echo  $vir;?>
		  '<?php echo $min[$min_valor]?>'<?php echo $vir; echo $max[$max_valor];echo  $vir;?> '<?php echo $max[$max_valor]?>' <?php }?>],
		
	   <?php }}
		   
	   }else{$query = "SELECT id,nome_exame,data_exame,valor_exame FROM exame WHERE id_usuario = '$id_usuario' ORDER BY data_exame ASC ";
						$resultados = mysqli_query($conexao, $query);
						$exame 	= mysqli_fetch_all($resultados, MYSQLI_ASSOC);
				}
			?>
			
						
			

      ]);
 
      
      var options = {
          title: 'Gráfico em barra do exame de <?php   if (!empty($_POST['grafico-f'])) {	echo $_SESSION['nome'];}?>',
		  responsive: true,
          curveType: 'function',
		   pointSize:7	,
           legend: 'bottom',
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
			
			
			<br>
			<br><br>
  
	</body>	
	
</html>
