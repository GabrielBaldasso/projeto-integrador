<?php
// Inclua a conexão com o banco de dados
include_once("conexao.php");

// Verifica se o ID do atendimento foi passado via GET
if (isset($_GET['idAtendimento'])) {
    $idAtendimento = intval($_GET['idAtendimento']); // Converte o ID para inteiro para evitar SQL Injection

    // Atualiza o status do atendimento para "concluído"
    $sql = "UPDATE atendimentos SET status = 'Concluído' WHERE idAtendimento = $idAtendimento";

    if (mysqli_query($conn, $sql)) {
        // Redireciona ou exibe uma mensagem de sucesso
        header("Location: ../homeProfissional.php?mensagem=O agendamento foi concluído com sucesso");
        exit;
    } else {
        // Mostra uma mensagem de erro
        echo "Erro ao concluído o atendimento: " . mysqli_error($conn);
    }
} else {
    echo "ID de atendimento inválido.";
}
?>