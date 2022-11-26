
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>	Cadastro de Usuário</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,700,1,200" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
  </head>
  
	<body>

		<br>

		<div class=" col-md-m-0">
		
			<form action="cad_usuario.php" method="POST" class="mr-xl-5 pr-xl-5 mt-xl-0 " >
				<div class=" container-cad form-group col-xl-5 float-xl-right mr-xl-5 ml-xl-0 pl-xl-0 pr-xl-5 "  >	
					<h4><strong>Já tenho cadastro</strong></h4>
						<label for="email" class="form-label">E-mail: </label>
						<input class="form-control" type="email" name="login1"  placeholder="Digite seu melhor email">
						<?php if(isset($_SESSION['loginErro'])){
								echo "<p style='color: #f00;' >".$_SESSION['loginErro']."</p>";
								unset($_SESSION['loginErro']);
							}?>
						<br><br> 
						<label for="senha" class="form-label">Senha: </label>
						<p class="input-group">
						<input class="form-control border-right-0" type="password" name="senha1" id="senha1" >
						     <span class="input-group-append bg-white border-left-0">
						  <span class="input-group-text bg-transparent">
						  <i class="bi bi-eye fa-lg "  onclick="mostrarSenhas()" ></i>
						  </span></span></p>
							<?php if(isset($_SESSION['senhaErro'])){
								echo "<p style='color: #f00;' >".$_SESSION['senhaErro']."</p>";
								unset($_SESSION['senhaErro']);	
							}?>
							<br><br>
							<?php if(isset($_SESSION['campoVazio'])){
								echo "<p style='color: #f00;' >".$_SESSION['campoVazio']."</p>";
								unset($_SESSION['campoVazio']);
							}?>
						<input class="btn btn-primary" type="submit" href="cad_exame.php" value="Entrar"/>
						<a type="button" class="btn btn-secondary" href="recuperaSenha.php"> Esqueceu a senha?</a>


					<br>
				</div>
			</form>
		</div>

    </body>
</html>