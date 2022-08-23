<?php
	session_start();
	ob_start();
	include_once 'conexao.php';
	
	
?>
<?php
	$chave	= 	$_SESSION['chave'] ;
   // var_dump($chave);
    $dados = $_SESSION['dados'];


	include 'conexao.php';
		//var_dump($recupera);

        $query_usuario = "SELECT *
                            FROM usuario
                            WHERE recuperar_senha =:recuperar_senha  
                            LIMIT 1";

        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->bindParam(":recuperar_senha", $chave, PDO::PARAM_STR);
        $result_usuario->execute();

        if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            $dados = $_SESSION['dados'];

			//var_dump($dados);

            if (isset($_POST['senha'])) {

                $senha = $_POST['senha'];
				$senha = mysqli_real_escape_string($conexao , $_POST['senha']);
				$senha = md5(trim($senha));
                $recuperar_senha = 'NULL';

                $query_up_usuario = "UPDATE usuario 
                        SET senha = :senha,
                        recuperar_senha =:recuperar_senha
                        WHERE id =:id 
                        LIMIT 1";
                $result_up_usuario = $conn->prepare($query_up_usuario);
                $result_up_usuario->bindParam(':senha', $senha, PDO::PARAM_STR);
                $result_up_usuario->bindParam(':recuperar_senha', $recuperar_senha);
                $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);
	
                if ($result_up_usuario->execute()) {
					                $recuperar_senha = 'NULL';
                    $_SESSION['msg'] = "<p style='color: green'>Senha atualizada com sucesso!</p>";
                    header("Location: cad_usuario.php");


                } else {
                    echo "<p style='color: #ff0000'>Erro: Tente novamente!</p>";

                }
			
            } 
		

        } else {
           $_SESSION['msg_rec'] =  "<p style='color: #ff0000'>Erro: Link inválidDDDDDDDo, solicite novo link para atualizar a senha!</p>";
        header("Location: recuperaSenha.php");

        }
		
   


    ?>

 
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Atualizar Senha</title>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
	<script>
			function mostrarSenha(){
				var tipo = document.getElementById("senha");
				if(tipo.type == "password"){
					tipo.type = "text";
				}else{
					tipo.type = "password";
				}
			}
		</script>
	<?php include 'header.php';?>
	
	<div class=" container-cad m-xl-5">
		<div class=" container-cad form-group "  >	

			<form action="atualizar_senha.php" method="POST"   class=" col-xl-5 float-left col-xl-6 offset-xl-3 ">
				<h3 class='mt-5 text-center'><strong>Atualizar senha</strong></h3>
				
				<label class="form-label">Senha:</label>
				<input class="form-control" type="password" name="senha" id="senha" placeholder="Digite a nova senha" required><br><br>
				<input class="btn btn-primary mb-3" type="submit" value="Atualizar" name="SendNovaSenha" >
				<button type="button" class="btn btn-warning mb-3" onclick="mostrarSenha()"> Mostrar senha </button>
				<br>
				<div class="float-left mt-xl-3">
								  <b>  Lembrou? <a href="cad_usuario.php">clique aqui</a> para entrar!</b>
				</div>
			</form>
		</div>
	</div>
    <br>
	
	
	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>