<?php
// Inclua a conexão com o banco de dados
include_once("conexao.php");

// Verifica se o ID do atendimento foi passado via GET
if (isset($_GET['idAtendimento'])) {
    $idAtendimento = intval($_GET['idAtendimento']); // Converte o ID para inteiro para evitar SQL Injection


    // Primeiro, exclui os registros da tabela atendimentosservicos com base no idAtendimento
        $sql_atendimentos_servicos = "DELETE FROM atendimentosservicos WHERE idAtendimento = '$idAtendimento'";

        // Executa a consulta
        if (!mysqli_query($conn, $sql_atendimentos_servicos)) {
            throw new Exception('Erro ao excluir atendimentosservicos');
        }

    // Atualiza o status do atendimento para "Cancelado"
    $sql = "UPDATE atendimentos SET status = 'Cancelado' WHERE idAtendimento = $idAtendimento";

    if (mysqli_query($conn, $sql)) {
        // Redireciona ou exibe uma mensagem de sucesso
        header("Location: ../agendamentosCliente.php?tipo=sucesso&mensagem=O agendamento foi cancelado com sucesso");
        exit;
    } else {
        // Mostra uma mensagem de erro
        echo "Erro ao cancelar o atendimento: " . mysqli_error($conn);
    }
} else {
    echo "ID de atendimento inválido.";
}
?>
