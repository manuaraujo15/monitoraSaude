<?php
	session_start();
	ob_start();
	include_once 'conexao.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require './lib/vendor/autoload.php';
	$mail = new PHPMailer(true);


?>
<?php

	if (isset($_POST['login'])) {
		include "conexao.php";
		$login = mysqli_real_escape_string($conexao , $_POST['login']);
		$login = trim($login);
		if ($login != "") {
			$query = "SELECT * FROM usuario WHERE login = '$login'";
			$conj_resultados = mysqli_query($conexao , $query);
			$qtd_usuarios = mysqli_num_rows($conj_resultados);
			if ($qtd_usuarios > 0) {
				$dados = mysqli_fetch_array($conj_resultados);
				$_SESSION['id_usuario'] = $dados['id'];
				    $_SESSION['nome_usuario'] = $dados['nome'];
					$query_usuario = "SELECT id, nome, login 
                    FROM usuario 
                    WHERE login =:login  
                    LIMIT 1";
					$result_usuario = $conn->prepare($query_usuario);
					$result_usuario->bindParam(":login", $dados['login'], PDO::PARAM_STR);
					$result_usuario->execute();
		if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            $chave_recuperar_senha = password_hash($row_usuario['id'], PASSWORD_DEFAULT);
            //echo "Chave $chave_recuperar_senha <br>";

            $query_up = "UPDATE usuario 
                        SET recuperar_senha =:recuperar_senha 
                        WHERE id =:id 
                        LIMIT 1";
            $result_up_usuario = $conn->prepare($query_up);
            $result_up_usuario->bindParam(':recuperar_senha', $chave_recuperar_senha, PDO::PARAM_STR);
            $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);

            if ($result_up_usuario->execute()) {
                $link = "http://localhost/monitoraSaude/atualizar_senha.php?chave=$chave_recuperar_senha";

                try {
                    /*$mail->SMTPDebug = SMTP::DEBUG_SERVER;*/
                    $mail->CharSet = 'UTF-8';
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.mailtrap.io';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = '01fe8b8bcab804';
                    $mail->Password   = '011d885d0c2ea6';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 2525;

                    $mail->setFrom('esaude.suportecliente@gmail.com', 'Suporte ao cliente');
                    $mail->addAddress($row_usuario['login'], $row_usuario['nome']);

                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Recuperar senha';
                    $mail->Body    = 'Prezado(a) ' . $row_usuario['nome'] .".<br><br>Você solicitou alteração de senha.<br><br>Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: <br><br><a href='" . $link . "'>" . $link . "</a><br><br>Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.<br><br>";
                    $mail->AltBody = 'Prezado(a) ' . $row_usuario['nome'] ."\n\nVocê solicitou alteração de senha.\n\nPara continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: \n\n" . $link . "\n\nSe você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.\n\n";

                    $mail->send();

                    $_SESSION['msg'] = "<p style='color: green'>Enviado e-mail com instruções para recuperar a senha. Acesse a sua caixa de e-mail para recuperar a senha!</p>";
                } catch (Exception $e) {
                    echo "Erro: E-mail não enviado sucesso. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo  "<p style='color: #ff0000'>Erro: Tente novamente!</p>";
            }
        } else {
            echo "<p style='color: #ff0000'>Erro: Usuário não encontrado!</p>";
        }
    }

    

    
				
				} else {
						$_SESSION['senhaErro'] = " Senha Inválida!";
				}
		
		} else {
			$_SESSION['campoVazio'] = " Digite o email";
			}


?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Recupere sua senha</title>
    <meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
	<?php include 'header.php';?>
	<?php if (isset($_SESSION['msg_rec'])) {
        echo $_SESSION['msg_rec'];
        unset($_SESSION['msg_rec']);
    }?>

	<form action="recuperaSenha.php" method="POST" class="ml-5 pr-5" >
				<div class=" container-cad form-group col-5 float-left ml-5 mr-0 pr-0 pl-5   border-- border-dark h-5 "  >	
					<h3><strong>Recupere sua senha</strong></h3>
					<br>
						<label for="login" class="form-label"><strong>Digite o email cadastrado: </strong> </label>
						<input class="form-control" type="email" name="login">
						<br>

						<input class="btn btn-primary" type="submit"  value="Recuperar Senha"/>
	</form> 
  </body>

</html>