<?php
	session_start();
	ob_start();
	include_once 'conexao.php';
	
	
?>
<?php
	$chave	= 	$_SESSION['chave'] ;
   // var_dump($chave);
  //  $dados = $_SESSION['dados'];


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
          //  $dados = $_SESSION['dados'];

			//var_dump($dados);

            if (isset($_POST['senha'])) {

                $senha = $_POST['senha'];
				$senha = mysqli_real_escape_string($conexao , $_POST['senha']);
				$senha = md5(trim($senha));
                $recuperar_senha = 'NULL';

                $query_up_usuario = "UPDATE usuario 
                        SET senha = :senha,
                        recuperar_senha =:recuperar_senha
                        WHERE id_usuario =:id_usuario 
                        LIMIT 1";
                $result_up_usuario = $conn->prepare($query_up_usuario);
                $result_up_usuario->bindParam(':senha', $senha, PDO::PARAM_STR);
                $result_up_usuario->bindParam(':recuperar_senha', $recuperar_senha);
                $result_up_usuario->bindParam(':id_usuario', $row_usuario['id_usuario'], PDO::PARAM_INT);
	
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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">		
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> 
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
<?php include 'header-novo.php';?>
<br>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
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
	
	<div class=" container-cad ">
	
		<form action="atualizar_senha.php" method="POST" class="m-4 ">
		<div class=" form-group col-xl-6 offset-xl-3 "  >	
				<h3 class='mt-5 text-center'><strong>Atualizar senha</strong></h3>
				
				<label class="form-label align-baseline">Senha:</label>
				
				<div class="input-group">
				<input class="form-control border border-right-0" type="password" name="senha" id="senha" placeholder="Digite a nova senha" required>
					  <div class="input-group-append bg-transparent">
						  <span class="input-group-text  p-2 bg-white border-left-0">
						  <i class="bi bi-eye fa-lg "  onclick="mostrarSenha()" ></i>
						  </span></div></div>
						  <br><br>
				<input class="btn btn-primary mb-3" type="submit" value="Atualizar" name="SendNovaSenha" >
				<br>
				<div class="float-left mt-xl-3">
					<b>  Lembrou? <a href="cad_usuario.php">clique aqui</a> para entrar!</b>
				</div>
				</div>
			</form>		
			</div>

    <br>
	
	
	 
</body>

</html>