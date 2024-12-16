<?php 

	include_once("conexao.php");
	session_start();

	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$senha = mysqli_real_escape_string($conn, $_POST['senha']);

	echo $senha = md5($senha);

	$sql = mysqli_query($conn, "SELECT * FROM clientes WHERE email = '$email' AND senha = '$senha'");
	if (mysqli_num_rows($sql)>0) {

		$dados = mysqli_fetch_assoc($sql);

		$_SESSION['idClienteLogado'] = $dados['idCliente'];
		$_SESSION['nomeClienteLogado'] = $dados['nomeCliente'];
		$_SESSION['emailClienteLogado'] = $dados['email'];
		$_SESSION['contatoClienteLogado'] = $dados['contatoCliente'];
		$_SESSION['cpfClienteLogado'] = $dados['cpf'];
		$_SESSION['senhaClienteLogado'] = $dados['senha'];

		header("Location: ../homeCliente.php");
		exit();
		
	} 

	$sql = mysqli_query($conn, "SELECT * FROM profissionais WHERE email = '$email' AND senha = '$senha'");
	
	if (mysqli_num_rows($sql)>0) {
	
		$dados = mysqli_fetch_assoc($sql);

		$_SESSION['idProfissionalLogado'] = $dados['idProfissional'];
		$_SESSION['nomeProfissionaisLogado'] = $dados['nomeProfissionais'];
		$_SESSION['emailProfissionalLogado'] = $dados['email'];
		$_SESSION['idTipoProfissionalLogado'] = $dados['idTipoProfissional'];

		if ($email == 'admin@gmail.com' AND $senha == '21232f297a57a5a743894a0e4a801fc3') {
			header("Location: ../homeAdmin.php");
			exit();
		}

		header("Location: ../homeProfissional.php");
		exit();

	}



	header("Location: ../login.php?tipo=erro&mensagem=Login e/ou senha invalidos!");


?>