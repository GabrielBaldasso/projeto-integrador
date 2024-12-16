 <?php 

	include_once("conexao.php");
	session_start();

	$idProfissional = mysqli_real_escape_string($conn, $_POST['idProfissional']);
	$nomeProfissionais = mysqli_real_escape_string($conn, $_POST['nomeProfissionais']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$senha = mysqli_real_escape_string($conn, $_POST['senha']);
	$contato = mysqli_real_escape_string($conn, $_POST['contato']);
	$idTipoProfissional = mysqli_real_escape_string($conn, $_POST['idTipoProfissional']);
	$senha = md5($senha);

	if (isset($_SESSION['idProfissionalLogado'])) {
        if ($_SESSION['emailProfissionalLogado'] == 'admin@gmail.com') {
            $redirectPage = 'homeAdmin.php';
        } else {
            $redirectPage = 'homeProfissional.php';
        }
    }else {
        $redirectPage = 'login.php';
    }

	if($idProfissional == 0){
		$resultado = mysqli_query($conn, "SELECT * FROM profissionais WHERE email = '$email' AND nomeProfissionais = '$nomeProfissionais'");
		if (mysqli_num_rows($resultado)>0) {
			header("Location: ../login.php?tipo=erro&mensagem=E-mail já cadastrado!");
		}
		else{
			$sql = "INSERT INTO profissionais (nomeProfissionais, email, senha, contato, idTipoProfissional)
										VALUES ('$nomeProfissionais', '$email', '$senha', '$contato', '$idTipoProfissional')";

			if (mysqli_query($conn, $sql)) {
				header("Location:../$redirectPage?tipo=sucesso&mensagem=Profissional foi cadastrado com sucesso");
			} else {
				echo mysqli_error($conn);
				header("Location: ../cadastroProfissional.php?tipo=erro&mensagem=ERRO profissional não foi cadastrado");
			}
		}
	} else {

		$sql = "UPDATE profissionais SET nomeProfissionais = '$nomeProfissionais', email = '$email', senha = '$senha', contato = '$contato', idTipoProfissional = '$idTipoProfissional' WHERE idProfissional = '$idProfissional'";
			if (mysqli_query($conn, $sql)) {
				header("Location: ../$redirectPage?tipo=sucesso&mensagem=A conta do profissional foi atualizado com sucesso");
			}
			else{
				header("Location: ../cadastroProfissional.php?tipo=erro&mensagem=ERRO-cadastro da conta do profissional não foi atualizado");
			}

	}
	
	mysqli_close($conn);
?>