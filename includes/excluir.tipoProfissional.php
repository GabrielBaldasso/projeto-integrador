<?php
	include_once("conexao.php");

	$idTipoProfissional = $_GET['idTipoProfissional'];

	$sql = "DELETE FROM tiposprofissionais WHERE idTipoProfissional = '$idTipoProfissional'";

	if (mysqli_query($conn, $sql)) {
		header("Location: ../adminTipoProfissional.php?tipo=sucesso&mensagem=Tipo Profissional excluida com sucesso");
	}else{
		header("Location: ../adminTipoProfissional.php?tipo=erro&mensagem=Erros Tipo Profissional não excluida, varifique se tem algum profissional cadastrado com esse tipo profissional, exclua ou altere o tipo desse profissional para poder excluiro o tipo");
	}

//echo mysqli_error($conn);
?>