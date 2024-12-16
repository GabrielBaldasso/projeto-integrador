<?php
	include_once("conexao.php");

	$idAtendimentoServico = $_GET['idAtendimentoServico'];
	$idAtendimento = $_GET['idAtendimento'];
	$horarioInicio = $_GET['horarioInicio'];

	$sql = "DELETE FROM atendimentosservicos WHERE idAtendimentoServico = '$idAtendimentoServico'";

	if (mysqli_query($conn, $sql)) {
		header("Location: ../cadastrarAtendimentoServico.php?tipo=sucesso&mensagem=Serviço removido excluida com sucesso.&idAtendimento=".$idAtendimento."&horarioInicio=".$horarioInicio);
	}else{
		header("Location: ../cadastrarAtendimentoServico.php?tipo=erro&mensagem=Erros Serviço removido não foi removido");
	}

//echo mysqli_error($conn);
?>