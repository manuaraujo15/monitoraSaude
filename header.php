<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Monitora Saúde</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css"  href="main.css" >
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,700,1,200" >
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
    <header class="header" id="header">
		<input type="checkbox"  id="check" class="check" onchange="minhaFuncao()" >
		<label for="check" class="btn_icon_header">
			<span class="material-symbols-rounded">menu</span>
		</label>
	  
	  	<div class="logo-header" id="logo-header">
			<h1><a href="index.php" id="logo-header"><img id="logo-header" class="logo-header" src="logo.png" alt="E-Saúde"></a></h1>
		</div>
			<nav class="nav-header" id="nav-header">	
				<input type="checkbox" id="check1">
				<label for="check1" class="btn_icon_header">
					<span class="material-symbols-rounded" class="close">close</span>
				</label>
						
				<a href="">Como usar</a> 
				<a href="">Para que serve o monitoramento</a>
				<a href="">Contato</a>
				<a href="cad_usuario.php">Entre ou Cadastre-se</a>			
				<a href="bd_exame.php">Área do usuário</a>
			 </nav>
			 <div for="check" id="fechar"> <div>
			 <script> 
			 
			 function minhaFuncao(){
					var check= document.getElementById('check');
					var div = document.getElementById('nav-header');
					var close = document.getElementsByClassName('close');

				if(check.checked) {
					div.style.left = '0';
					console.log("O cliente marcou o checkbox");
					window.addEventListener('click', event => {
					check.checked = window.onclick;
					div.style.left = '100%';
					console.log("O cliente marcou o checkbox");
					});
				} else {
					div.style.left = '0';
					console.log("O cliente não marcou o checkbox");
				}
				}		
			</script>	
	</header>
</html>