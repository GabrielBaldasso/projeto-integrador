<?php
    include_once("conexao.php");
    session_start();

    // Recebe o idCliente da URL
    $idCliente = $_GET['idCliente'];

    // Inicia a transação
    mysqli_begin_transaction($conn);

    try {
        // Primeiro, exclui os registros da tabela atendimentosservicos relacionados aos atendimentos do cliente
        $sql_atendimentos_servicos = "
            DELETE atendimentosservicos 
            FROM atendimentosservicos 
            INNER JOIN atendimentos ON atendimentosservicos.idAtendimento = atendimentos.idAtendimento 
            WHERE atendimentos.idCliente = '$idCliente'";
        
        if (!mysqli_query($conn, $sql_atendimentos_servicos)) {
            throw new Exception('Erro ao excluir registros da tabela atendimentosservicos');
        }

        // Depois, exclui os registros da tabela atendimentos relacionados ao cliente
        $sql_atendimentos = "DELETE FROM atendimentos WHERE idCliente = '$idCliente'";
        
        if (!mysqli_query($conn, $sql_atendimentos)) {
            throw new Exception('Erro ao excluir registros da tabela atendimentos');
        }

        // Por fim, exclui o cliente
        $sql_cliente = "DELETE FROM clientes WHERE idCliente = '$idCliente'";
        
        if (!mysqli_query($conn, $sql_cliente)) {
            throw new Exception('Erro ao excluir o cliente');
        }

        // Se tudo ocorrer sem erros, confirma a transação
        mysqli_commit($conn);

        // Redireciona para a página com sucesso
        header("Location: ../adminClientes.php?tipo=sucesso&mensagem=Cliente e atendimentos excluídos com sucesso");

    } catch (Exception $e) {
        // Em caso de erro, desfaz a transação
        mysqli_roll_back($conn);

        // Redireciona para a página com erro
        header("Location: ../adminClientes.php?tipo=erro&mensagem=Erro: " . $e->getMessage());
    }
?>
