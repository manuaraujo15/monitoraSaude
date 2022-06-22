<?php
	session_start();
	ob_start();
	include_once 'conexao.php';
?>
 <?php
    $chave = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT);


    if (!empty($chave)) {
        //var_dump($chave);

        $query_usuario = "SELECT id 
                            FROM usuario
                            WHERE recuperar_senha = :recuperar_senha  
                            LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->bindParam(':recuperar_senha', $chave, PDO::PARAM_STR);
        $result_usuario->execute();

        if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            //var_dump($dados);
            if (!empty($dados['SendNovaSenha'])) {
                $senha = password_hash($dados['senha'], PASSWORD_DEFAULT);
                $recuperar_senha = 'NULL';

                $query_up_usuario = "UPDATE usuario
                        SET senha =:senha,
                        recuperar_senha =:recuperar_senha
                        WHERE id =:id 
                        LIMIT 1";
                $result_up_usuario = $conn->prepare($query_up_usuario);
                $result_up_usuario->bindParam(':senha', $senha, PDO::PARAM_STR);
                $result_up_usuario->bindParam(':recuperar_senha', $recuperar_senha);
                $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);

                if ($result_up_usuario->execute()) {
                    $_SESSION['msg'] = "<p style='color: green'>Senha atualizada com sucesso!</p>";
                    header("Location: index.php");
                } else {
                    echo "<p style='color: #ff0000'>Erro: Tente novamente!</p>";
                }
            }
        } else {
            $_SESSION['msg_rec'] = "<p style='color: #ff0000'>Erro: Link inválido, solicite novo link para atualizar a senha!</p>";
            header("Location: recuperaSenha.php");
        }
    } else {
        $_SESSION['msg_rec'] = "<p style='color: #ff0000'>Erro: Link inválido, solicite novo link para atualizar a senha!</p>";
        header("Location: recuperaSenha.php");
    }

    ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Atualizar Senha</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
	<?php include 'header.php';?>
	<div class=" container-cad ml-5">
		<div class=" container-cad form-group float-left col-5 ml-5 pl-5 "  >	

			<form method="POST" action="atualizar_senha.php"  class="float-left ml-5 pl-5">
				<h3><strong>Atualizar senha</strong></h3>
				<?php
				$usuario = "";
				if (isset($dados['senha'])) {
					$usuario = $dados['senha'];
				} ?>

				<label class="form-label">Senha</label>
				<input class="form-control" type="password" name="senha_usuario" placeholder="Digite a nova senha" value="<?php echo $usuario; ?>"><br><br>

				<input class="btn btn-primary" type="submit" value="Atualizar" name="SendNovaSenha">
			</form>
		</div>
	</div>


    <br>
    Lembrou? <a href="cad_usuario.php">clique aqui</a> para logar

</body>

</html>