<?php
	include_once("conexao.php");

	$idServicoProfissionais = $_GET['idServicoProfissionais'];

	$sql = "DELETE FROM tiposprofissionais WHERE idServicoProfissionais = '$idServicoProfissionais'";

	if (mysqli_query($conn, $sql)) {
		header("Location: ../adminVinculacao.php?tipo=sucesso&mensagem=Vinculação serviço profissional excluida com sucesso");
	}else{
		header("Location: ../adminVinculacao.php?tipo=erro&mensagem=Erros Vinculação serviço profissional não excluida");
	}

//echo mysqli_error($conn);
?>