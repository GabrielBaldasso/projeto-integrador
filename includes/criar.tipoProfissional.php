<?php 

	include_once("conexao.php");

	$idTipoProfissional = mysqli_real_escape_string($conn, $_POST['idTipoProfissional']);
	$nomeTipo = mysqli_real_escape_string($conn, $_POST['nomeTipo']);
	$descricao = mysqli_real_escape_string($conn, $_POST['descricao']);

	if($idTipoProfissional == 0){
		$resultado = mysqli_query($conn, "SELECT * FROM tiposprofissionais WHERE nomeTipo = '$nomeTipo'");
		if (mysqli_num_rows($resultado)>0) {
			header("Location: ../cadastrarTiposProfissionais.php?tipo=erro&mensagem=Tipo profissional ja cadastrado!Tente outro!!!");
		}
		else{
			$sql = "INSERT INTO tiposprofissionais (nomeTipo, descricao)
										VALUES ('$nomeTipo', '$descricao')";

			if (mysqli_query($conn, $sql)) {
				header("Location:../cadastrarTiposProfissionais.php?tipo=sucesso&mensagem=Tipo profissional foi cadastrado com sucesso");
			} else {
				//echo mysqli_error($conn);
				header("Location: ../cadastrarTiposProfissionais.php?tipo=erro&mensagem=ERRO tipo profissional não foi cadastrado");
			}
		}
	} else {

		$sql = "UPDATE tiposprofissionais SET nomeTipo = '$nomeTipo', descricao = '$descricao' WHERE idTipoProfissional = '$idTipoProfissional'";
			if (mysqli_query($conn, $sql)) {
				header("Location: ../adminTipoProfissional.php?tipo=sucesso&mensagem=Tipo profissional foi atualizado com sucesso");
			}
			else{
				header("Location: ../adminTipoProfissional.php?tipo=erro&mensagem=ERRO-Tipo profissional não foi atualizado");
			}

	}
	
	mysqli_close($conn);
?>