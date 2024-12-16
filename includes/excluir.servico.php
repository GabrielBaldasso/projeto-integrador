<?php
	include_once("conexao.php");

	$idServico = $_GET['idServico'];

	$sql = "DELETE FROM servicos WHERE idServico = '$idServico'";

	if (mysqli_query($conn, $sql)) {
		header("Location: ../adminServicos.php?tipo=sucesso&mensagem=Serviço excluida com sucesso");
	}else{
		header("Location: ../adminServicos.php?tipo=erro&mensagem=Erros serviço não excluida, verifique se ele esta vinculado com algum profissional e exclua a vinculação antede de tentar excluir");
	}

//echo mysqli_error($conn);
?>