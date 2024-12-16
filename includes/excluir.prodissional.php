<?php
    include_once("conexao.php");

    // Recebe o idProfissional da URL
    $idProfissional = $_GET['idProfissional'];

    try {
        // Exclui os registros da tabela atendimentosservicos relacionados ao profissional
        $sql_atendimentos_servicos = "
            DELETE atendimentosservicos
            FROM atendimentosservicos
            INNER JOIN servicoProfissionais 
            ON atendimentosservicos.idServicoProfissionais = servicoProfissionais.idServicoProfissionais
            WHERE servicoProfissionais.idProfissional = '$idProfissional'
        ";

        if (!mysqli_query($conn, $sql_atendimentos_servicos)) {
            throw new Exception('Erro ao excluir atendimentosservicos relacionados ao profissional: ' . mysqli_error($conn));
        }

        // Exclui os registros da tabela atendimentos relacionados ao profissional
        $sql_atendimentos = "
            DELETE atendimentos
            FROM atendimentos
            INNER JOIN atendimentosservicos 
            ON atendimentos.idAtendimento = atendimentosservicos.idAtendimento
            INNER JOIN servicoProfissionais 
            ON atendimentosservicos.idServicoProfissionais = servicoProfissionais.idServicoProfissionais
            WHERE servicoProfissionais.idProfissional = '$idProfissional'
        ";

        if (!mysqli_query($conn, $sql_atendimentos)) {
            throw new Exception('Erro ao excluir atendimentos relacionados ao profissional: ' . mysqli_error($conn));
        }

        // Exclui os registros da tabela servicoProfissionais relacionados ao profissional
        $sql_servico_profissionais = "
            DELETE FROM servicoProfissionais 
            WHERE idProfissional = '$idProfissional'
        ";

        if (!mysqli_query($conn, $sql_servico_profissionais)) {
            throw new Exception('Erro ao excluir servicoProfissionais relacionados ao profissional: ' . mysqli_error($conn));
        }

        // Finalmente, exclui o profissional
        $sql_profissional = "
            DELETE FROM profissionais 
            WHERE idProfissional = '$idProfissional'
        ";

        if (!mysqli_query($conn, $sql_profissional)) {
            throw new Exception('Erro ao excluir profissional: ' . mysqli_error($conn));
        }

        // Redireciona com mensagem de sucesso
        header("Location: ../adminProfissionais.php?tipo=sucesso&mensagem=Profissional e dados relacionados excluídos com sucesso");

    } catch (Exception $e) {
        // Redireciona com mensagem de erro
        header("Location: ../adminProfissionais.php?tipo=erro&mensagem=Erro: " . $e->getMessage());
    }
?>
