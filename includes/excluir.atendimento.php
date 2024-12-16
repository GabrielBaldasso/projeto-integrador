<?php
    include_once("conexao.php");
    session_start();

    // Recebe o idAtendimento da URL
    $idAtendimento = $_GET['idAtendimento'];

    // Inicia a transação
    mysqli_begin_transaction($conn);

    try {
        // Primeiro, exclui os registros da tabela atendimentosservicos com base no idAtendimento
        $sql_atendimentos_servicos = "DELETE FROM atendimentosservicos WHERE idAtendimento = '$idAtendimento'";

        // Executa a consulta
        if (!mysqli_query($conn, $sql_atendimentos_servicos)) {
            throw new Exception('Erro ao excluir atendimentosservicos');
        }

        // Agora, exclui o registro na tabela atendimentos
        $sql_atendimentos = "DELETE FROM atendimentos WHERE idAtendimento = '$idAtendimento'";

        // Executa a consulta
        if (!mysqli_query($conn, $sql_atendimentos)) {
            throw new Exception('Erro ao excluir atendimento');
        }

        // Se tudo ocorrer sem erros, confirma a transação
        mysqli_commit($conn);

        

        if (isset($_SESSION['idProfissionalLogado'])) {
            if ($_SESSION['emailProfissionalLogado'] == 'admin@gmail.com') {
                header("Location: ../adminAtendimentos.php?tipo=sucesso&mensagem=Atendimento e serviços excluídos com sucesso");
            } else {
                header("Location: ../homeProfissional.php?tipo=sucesso&mensagem=Atendimento e serviços excluídos com sucesso");
            }
        }elseif (isset($_SESSION['idProfissionalLogado'])) {
            header("Location: ../homeCliente.php?tipo=sucesso&mensagem=Atendimento e serviços excluídos com sucesso");
        }else {
            header("Location: ../login.php?tipo=sucesso&mensagem=Atendimento e serviços excluídos com sucesso");
        }


    } catch (Exception $e) {
        // Se ocorrer algum erro, desfaz a transação
        mysqli_roll_back($conn);

        // Redireciona para a página com erro
        header("Location: ../adminAtendimentos.php?tipo=erro&mensagem=Erro: " . $e->getMessage());
    }
    
?>
