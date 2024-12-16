 <?php 

	include_once("conexao.php");

	session_start();

	$idCliente = mysqli_real_escape_string($conn, $_POST['idCliente']);
	$nomeCliente = mysqli_real_escape_string($conn, $_POST['nomeCliente']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$senha = mysqli_real_escape_string($conn, $_POST['senha']);
	$cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
	$contatoCliente = mysqli_real_escape_string($conn, $_POST['contatoCliente']);
	$senha = md5($senha);

	if($idCliente == 0){
		$resultado = mysqli_query($conn, "SELECT * FROM clientes WHERE email = '$email' OR cpf = '$cpf'");
		if (mysqli_num_rows($resultado)>0) {
			header("Location: ../login.php?tipo=erro&mensagem=E-mail e/ou CPF já cadastrado!");
		}
		else{
			$sql = "INSERT INTO clientes (nomeCliente, email, senha, cpf, contatoCliente)
										VALUES ('$nomeCliente', '$email', '$senha', '$cpf', '$contatoCliente')";

	            if (isset($_SESSION['idProfissionalLogado'])) {
	                if ($_SESSION['emailProfissionalLogado'] == 'admin@gmail.com') {
	                    $redirectPage = 'adminClientes.php';
	                } else {
	                    $redirectPage = 'homeProfissional.php';
	                }
	            }else {
	                $redirectPage = 'login.php';
	            }
	       

			if (mysqli_query($conn, $sql)) {
				header("Location:../$redirectPage?tipo=sucesso&mensagem=Usuario foi cadastrado com sucesso");
			} else {
				header("Location: ../cadastrarCliente.php?tipo=erro&mensagem=ERRO usuario não foi cadastrado");
			}
		}
	} else {

		$sql = "UPDATE clientes SET nomeCliente = '$nomeCliente', email = '$email', senha = '$senha', cpf = '$cpf', contatoCliente = '$contatoCliente' WHERE idCliente = '$idCliente'";
			if (mysqli_query($conn, $sql)) {
				header("Location: ../login.php?tipo=sucesso&mensagem=A conta do cliente foi atualizado com sucesso");
			}
			else{
				header("Location: ../cadastrarCliente.php?tipo=erro&mensagem=ERRO-cadastro da conta do usuario não foi atualizado");
			}

	}
	
	mysqli_close($conn);
?>