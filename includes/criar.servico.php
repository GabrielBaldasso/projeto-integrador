 <?php 

	include_once("conexao.php");

	$idServico = mysqli_real_escape_string($conn, $_POST['idServico']);
	$descricaoServicos = mysqli_real_escape_string($conn, $_POST['descricaoServicos']);
	$tempo = mysqli_real_escape_string($conn, $_POST['tempo']);
	$nomeServco = mysqli_real_escape_string($conn, $_POST['nomeServco']);

	if($idServico == 0){
		$resultado = mysqli_query($conn, "SELECT * FROM servicos WHERE nomeServco = '$nomeServco'");
		if (mysqli_num_rows($resultado)>0) {
			header("Location: ../login.php?tipo=erro&mensagem=Erro nome do serviço já cadastrado!");
		}
		else{
			$sql = "INSERT INTO servicos (descricaoServicos, tempo, nomeServco)
										VALUES ('$descricaoServicos', '$tempo','$nomeServco')";

			if (mysqli_query($conn, $sql)) {
				header("Location:../cadastrarServico.php?tipo=sucesso&mensagem=Usuario foi cadastrado com sucesso");
			} else {
				header("Location: ../cadastrarServico.php?tipo=erro&mensagem=ERRO usuario não foi cadastrado");
			}
		}
	} else {

		$sql = "UPDATE servicos SET descricaoServicos = '$descricaoServicos', tempo = '$tempo', nomeServco = '$nomeServco' WHERE idServico = '$idServico'";
			if (mysqli_query($conn, $sql)) {
				header("Location: ../adminServicos.php?tipo=sucesso&mensagem=A conta do cliente foi atualizado com sucesso");
			}
			else{
				header("Location: ../adminServicos.php?tipo=erro&mensagem=ERRO-cadastro da conta do usuario não foi atualizado");
			}

	}
	
	mysqli_close($conn);
?>