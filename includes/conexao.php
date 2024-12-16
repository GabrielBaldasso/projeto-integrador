<?php 

	$host 		= "localhost";	
	$user 		= "root";
	$password 	= "";
	$database	= "laris_salon";

	$conn 		= mysqli_connect($host, $user, $password, $database);
	
	if(!$conn){
		echo "A conexão falhou. Erro: " . mysqli_connect_error();
	}
?>