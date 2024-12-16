<?php 
	include_once("conexao.php");
    session_start();

	$idAtendimento = mysqli_real_escape_string($conn, $_POST['idAtendimento']);
	$precoTotal = mysqli_real_escape_string($conn, $_POST['precoTotal']);

// Consulta SQL para buscar o maior valor de 'fim' para o idAtendimento
    $sql = "SELECT MAX(fim) AS horarioFinaliza FROM atendimentosservicos WHERE idAtendimento = '$idAtendimento'";

    // Executar a consulta
    $result = mysqli_query($conn, $sql);
    $dados = mysqli_fetch_assoc($result);

    // Obter o valor do maior 'fim'
    $horarioFinaliza = $dados['horarioFinaliza'];

     $sql = "UPDATE atendimentos SET precoTotal = '$precoTotal', horarioFinaliza = '$horarioFinaliza' WHERE idAtendimento = '$idAtendimento'";


        
    if (mysqli_query($conn, $sql)) {

        header("Location: ../cadastrarAtendimento.php?tipo=sucesso&mensagem=O atendimento foi cadastrado pro completo com sucesso");

    }else{
        //echo mysqli_error($conn);
        header("Location: ../login.php?tipo=erro&mensagem=ERRO-O atendimento não foi cadastrado pro completo");
    }




?>