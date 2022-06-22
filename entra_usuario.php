
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>	Cadastro de Usuário</title>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,700,1,200" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  
	<body>

		<br>

			<form action="cad_usuario.php" method="POST" class="mr-5 pr-5" >
				<div class=" container-cad form-group col-5 float-right mr-5 ml-0 pl-0 pr-5 "  >	
					<h4><strong>Já tenho cadastro</strong></h4>
						<label for="email" class="form-label">Login: </label>
						<input class="form-control" type="email" name="login"  placeholder="Digite seu melhor email">
						<?php if(isset($_SESSION['loginErro'])){
								echo "<p style='color: #f00;' >".$_SESSION['loginErro']."</p>";
								unset($_SESSION['loginErro']);
							}?>
						<br><br> 
						<label for="senha" class="form-label">Senha: </label>
						<input class="form-control" type="password" name="senha">
							<?php if(isset($_SESSION['senhaErro'])){
								echo "<p style='color: #f00;' >".$_SESSION['senhaErro']."</p>";
								unset($_SESSION['senhaErro']);
							}?>
							<br><br>
							<?php if(isset($_SESSION['campoVazio'])){
								echo "<p style='color: #f00;' >".$_SESSION['campoVazio']."</p>";
								unset($_SESSION['campoVazio']);
							}?>
						<input class="btn btn-primary" type="submit"  value="Entrar"/>
						<a type="button" class="btn btn-secondary" href="recuperaSenha.php"> Esqueceu a senha?</a>

					<br>
				</div>
			</form>
		
    </body>
</html>