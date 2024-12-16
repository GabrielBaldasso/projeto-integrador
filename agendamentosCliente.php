<?php
include_once("includes/conexao.php");

// Simulação de login: ID do cliente logado
session_start();
$idCliente = $_SESSION['idClienteLogado'] ?? 1; // Substitua com autenticação real conforme sua aplicação

// Buscar agendamentos no banco
$queryAgendamentos = "
    SELECT * FROM atendimentos
    WHERE idCliente = '$idCliente'
    ORDER BY data ASC, horarioInicio ASC
";

$resultados = mysqli_query($conn, $queryAgendamentos);

// Dividir atendimentos entre realizados e agendamentos futuros
$agendamentosRealisados = [];
$agendamentosFuturos = [];

while ($row = mysqli_fetch_assoc($resultados)) {
    $data_atendimento = strtotime($row['data']);
    if ($data_atendimento < time()) {
        $agendamentosRealisados[] = $row;
    } else {
        $agendamentosFuturos[] = $row;
    }
    include_once("includes/menuCliente.php");
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Agendamentos</title>
    <link rel="stylesheet" href="css/estilo_agendamentoCliente.css">
</head>

<body>
    <header>
        Agendamentos
    </header>
    <div class="container-central">
        <!-- Agendamentos Futuros -->
        <section>
            <h1>Seus Agendamentos</h1>
                <a class="voltar" href="homeCliente.php">Voltar</a>
            <h2 class="futuro">Agendados</h2>

            <?php
                if (isset($_GET['mensagem'])) {
                    if ($_GET['tipo'] == 'sucesso') {
                        echo '<div style="color: white; background-color: #a1746d; border-radius: 19px; padding: 8px 12px; text-align: center;" role="alert">
                                ' . $_GET['mensagem'] . '
                            </div>';
                    } else {
                        echo '<div style="color: white; background-color: #e7968b; border-radius: 19px; padding: 8px 12px; text-align: center;" role="alert">
                                ' . $_GET['mensagem'] . '
                            </div>';
                    }
                }
            ?>

            <?php if (count($agendamentosFuturos) > 0): ?>
                <ul class="list-group">
                    <?php foreach ($agendamentosFuturos as $agendamento): ?>
                        <li>
                            <div>
                                <strong>Data:</strong> <?= date('d/m/Y', strtotime($agendamento['data'])) ?> |
                                <strong>Horário:</strong> <?= $agendamento['horarioInicio'] ?> |
                                <br>
                                <strong>Status:</strong> <?= htmlspecialchars($agendamento['status']) ?>
                                <br>
                                <strong>Comentario:</strong> <?= htmlspecialchars($agendamento['comentario']) ?>
                            </div>
                            <div class="buttons">
                                <button onclick="window.location.href='includes/cancelarAtendimento.php?idAtendimento=<?= $agendamento['idAtendimento'] ?>'">Cancelar</button>
                                <button onclick="window.location.href='cadastrarAtendimentoServico.php?idAtendimento=<?= $agendamento['idAtendimento'] ?>&horarioInicio=<?= $agendamento['horarioInicio'] ?>'">Detalhes</button>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Você não possui nenhum agendamento futuro.</p>
            <?php endif; ?>
        </section>

        <!-- Agendamentos Realizados -->
        <section>
            <h2>Em Execução e Completados</h2>
            <?php if (count($agendamentosRealisados) > 0): ?>
                <ul class="list-group">
                    <?php foreach ($agendamentosRealisados as $agendamento): ?>
                        <li>
                            <div>
                                <strong>Data:</strong> <?= date('d/m/Y', strtotime($agendamento['data'])) ?> |
                                <strong>Horário:</strong> <?= $agendamento['horarioInicio'] ?> |
                                <br>
                                <strong>Status:</strong> <?= htmlspecialchars($agendamento['status']) ?>
                                <br>
                                <strong>Comentario:</strong> <?= htmlspecialchars($agendamento['comentario']) ?>
                            </div>
                            <div class="buttons">
                                <button onclick="window.location.href='cadastrarAtendimentoServico.php?idAtendimento=<?= $agendamento['idAtendimento'] ?>&horarioInicio=<?= $agendamento['horarioInicio'] ?>'">Detalhes</button>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Você ainda não tem agendamentos realizados.</p>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>
