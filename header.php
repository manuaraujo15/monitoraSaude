<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Monitora Saúde</title>
    <meta charset="utf-8">
	<link rel="stylesheet" type="text/css"  href="css/mainnn.css" >
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,700,1,200" >
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
	<script src="https://kit.fontawesome.com/bc9af11c84.js" crossorigin="anonymous"></script>	
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,200" />
	

  </head>
    <header class="header" id="header">		
		<img id="logo-header" class="logo-header" href="index.php" src="logo11.png" alt="E-Saúde"/>
			<h1><a href="index.php" class="texto-header">E-saúde</a></h1>
		<input type="checkbox"  id="check" class="check" onchange="minhaFuncao()" />
		<label for="check" class="btn_icon_header">
			<span class="material-symbols-rounded">menu</span>
		</label>
			<nav class="nav-header" id="nav-header">	
				<input type="checkbox" id="check1">
				<label for="check1" class="btn_icon_close" >
					<span class="material-symbols-rounded" class="close">close</span>
				</label>
				<a class="textbar" href="index.php">Home</a>
				<a class="textbar" href="comoUsar.php">Como usar</a> 
				<a class="textbar" href="bd_exame.php">Seus exames</a>
				<a class="textbar" href="cad_exame.php">Cadastre seus exames</a>
				<a class="textbar" href="area_medica.php">Área Médica</a>
				<a class="textbar" href="cad_usuario.php">Entre ou Cadastre-se</a>
				<a class="textbar" class="btn_icon_logout"  id="logout" onclick="logout()" >
					<span class="material-symbols-rounded"  type="button" >logout</span>
				</a>

			 </nav>
			 <div for="check" id="fechar"> </div>
			 <script> 
			 function logout(){
			 	var logout= document.getElementById('logout');
				var resultado = confirm("Deseja mesmo sair?");
					if (resultado == true) {
						window.location.replace('logout.php');
					}else{}
			 }

			 function minhaFuncao(){
					var check= document.getElementById('check');
					var div = document.getElementById('nav-header');
					var close = document.getElementsByClassName('close');

				if(check.checked) {
					div.style.right = '0';
					console.log("O cliente marcou o checkbox");
					window.addEventListener('click', event => {
					check.checked = window.onclick;
					div.style.right = '100%';
					console.log("O cliente marcou o checkbox");
					});
				} else {
					div.style.right = '0';
					console.log("O cliente não marcou o checkbox");
				}
				}		
			</script>	
	</header>
	
</html>