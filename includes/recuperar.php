<?php
include_once("conexao.php");

// Obtém e sanitiza os dados enviados pelo formulário
$email = mysqli_real_escape_string($conn, $_POST['email']);
$cpf = mysqli_real_escape_string($conn, $_POST['cpf']);

// Consulta para verificar se o cliente existe pelo email ou CPF
$query = "SELECT idCliente FROM clientes WHERE email = '$email' OR cpf = '$cpf'";
$resultado = mysqli_query($conn, $query);

if (!$resultado) {
    // Verifica se houve erro na consulta ao banco de dados
    header("Location: ../login.php?tipo=erro&mensagem=Erro ao consultar o banco de dados");
    exit();
}

if (mysqli_num_rows($resultado) > 1) {
    // Se mais de um cliente é retornado, há um erro nos dados do banco
    header("Location: ../login.php?tipo=erro&mensagem=Erro no banco de dados: múltiplos registros encontrados");
    exit();
} elseif (mysqli_num_rows($resultado) == 1) {
    // Caso apenas um cliente seja encontrado
    $row = mysqli_fetch_assoc($resultado);
    $idCliente = $row['idCliente'];

    header("Location: ../cadastrarCliente.php?tipo=sucesso&mensagem=Edite o seu perfil.&idCliente=" . $idCliente);
    exit();
} else {
    // Caso nenhum cliente seja encontrado
    header("Location: ../login.php?tipo=erro&mensagem=Perfil não encontrado");
    exit();
}