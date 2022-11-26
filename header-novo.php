
<!DOCTYPE html>
<html lang="pt-br">
 <head>
    <title>Monitora Saúde</title>
    <meta charset="utf-8">
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,700,1,200" >
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,200" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<link href="css/header.css" rel="stylesheet">
	
  <!-- Template Main JS File -->

  </head>
<body>
 <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"> <img class="logo-header"  src="logo11.png" class="img-fluid" ><a id="logotext" class="logotext" href="index.php">E-Saúde</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
	<input type="checkbox"  id="check" class="check" onchange="minhaFuncao()" >
		<label for="check" class="btn_icon_header">
			<span class="material-symbols-rounded">menu</span>
		</label>
			 <nav id="navbar" class="navbar">
				<input type="checkbox" id="check1">
				<label for="check1" class="btn_icon_close">
					<span class="material-symbols-rounded" class="close">close</span>
				</label>
     
				<ul>
				  <li><a class="nav-link scrollto " href="index.php">Home</a></li>
				  <li><a class="nav-link scrollto" href="comoUsar.php">Como usar</a></li> 
				  <li><a class="nav-link scrollto" href="cad_exame.php">Cadastre seus exames</a></li> 			
				  <li><a class="nav-link scrollto" href="bd_exame.php">Seus exames</a></li> 
				  <li><a class="nav-link scrollto" href="area_medica.php">Área Médica</a></li>				  
				  
				  <li><a class="nav-link scrollto" href="cad_usuario.php">Entre ou Cadastre-se</a></li>
				 <li><a class="btn_icon_logout"  id="logout" onclick="logout()"> <span class="material-symbols-rounded"  type="button">logout</a></span>
				</ul> 
			  </nav><!-- .navbar -->
    </div>	
  <!-- End Header -->	
   <div for="check" id="fechar"> <div>
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
					var bar = document.getElementById('navbar');
					var close = document.getElementsByClassName('close');

				if(check.checked) {
					bar.style.right = '0';
					console.log("O cliente marcou o checkbox");
					window.addEventListener('click', event => {
					check.checked = window.onclick;
					bar.style.right = '100%';
					console.log("O cliente marcou o checkbox");
					});
				} else {
					bar.style.right = '0';
					console.log("O cliente não marcou o checkbox");
				}
				}		
			</script>	
			</header>
			</body>
  <script src="js/main.js"></script>

  </html>