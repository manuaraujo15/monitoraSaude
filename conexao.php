<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$dbname = "controle_exames" ;
	$port = 3306;
	$conexao = mysqli_connect("localhost:3306", "root", "");
		mysqli_set_charset($conexao, "utf8");
		mysqli_select_db($conexao, "controle_exames");
	try{
    //Conexão com a porta
    $conn = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);

    //Conexão sem a porta
    //$conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);
    //echo "Conexão com banco de dados realizado com sucesso!";
}catch(PDOException $err){
    //echo "Erro: Conexão com banco de dados não realizado com sucesso. Erro gerado " . $err->getMessage();
}

?>