<?php 

	include_once("conexao.php");

	$idServicoProfissionais = mysqli_real_escape_string($conn, $_POST['idServicoProfissionais']);
	$idProfissional = mysqli_real_escape_string($conn, $_POST['idProfissional']);
	$idServico = mysqli_real_escape_string($conn, $_POST['idServico']);
	$precoProfissional = mysqli_real_escape_string($conn, $_POST['precoProfissional']);

	if($idServicoProfissionais == 0){
		$resultado = mysqli_query($conn, "SELECT * FROM servicoprofissionais WHERE idProfissional = '$idProfissional' AND idServico = '$idServico'");
		if (mysqli_num_rows($resultado)>0) {
			header("Location: ../cadastrarVinculacao.php?tipo=erro&mensagem=Erro profissional e serviço ja viculados!");
		}
		else{
			$sql = "INSERT INTO servicoprofissionais (idProfissional, idServico, precoProfissional)
										VALUES ('$idProfissional', '$idServico','$precoProfissional')";

			if (mysqli_query($conn, $sql)) {
				header("Location:../cadastrarVinculacao.php?tipo=sucesso&mensagem=Vinculação foi cadastrado com sucesso");
			} else {
				header("Location: ../cadastrarVinculacao.php?tipo=erro&mensagem=ERRO Vinculação não foi cadastrado");
			}
		}
	} else {

		$sql = "UPDATE servicoprofissionais SET idProfissional = '$idProfissional', idServico = '$idServico', precoProfissional = '$precoProfissional' WHERE idServicoProfissionais = '$idServicoProfissionais'";
			if (mysqli_query($conn, $sql)) {
				header("Location: ../adminVinculacao.php?tipo=sucesso&mensagem=A vinculação foi atualizado com sucesso");
			}
			else{
				header("Location: ../adminVinculacao.php?tipo=erro&mensagem=ERRO-cadastro da vinculação não foi atualizado");
			}

	}
	
	mysqli_close($conn);
?>