<?php
session_start();
include_once("includes/conexao.php");

if (!isset($_SESSION['idProfissionalLogado'])) {
    header("Location: login.php");
    exit;
}

$idProfissionalLogado = $_SESSION['idProfissionalLogado'];
$numeroAtendimentoHoje = 0;
$inicio = "N/A";
$numerodeAgendados = 0;

// Consulta para contar os atendimentos de hoje
$sqlHoje = "
    SELECT COUNT(*) AS totalHoje 
    FROM atendimentosservicos AS ats
    INNER JOIN atendimentos AS a ON ats.idAtendimento = a.idAtendimento
    INNER JOIN servicoProfissionais AS sp ON ats.idServicoProfissionais = sp.idServicoProfissionais
    WHERE a.data = CURDATE() 
      AND sp.idProfissional = $idProfissionalLogado
";
$resultHoje = mysqli_query($conn, $sqlHoje);
if ($rowHoje = mysqli_fetch_assoc($resultHoje)) {
    $numeroAtendimentoHoje = $rowHoje['totalHoje'];
}

// Consulta para obter o próximo horário de atendimento
$sqlProximoHorario = "
    SELECT a.horarioInicio 
    FROM atendimentos AS a
    INNER JOIN atendimentosservicos AS ats ON a.idAtendimento = ats.idAtendimento
    INNER JOIN servicoProfissionais AS sp ON ats.idServicoProfissionais = sp.idServicoProfissionais
    WHERE a.data >= CURDATE()
      AND sp.idProfissional = $idProfissionalLogado
      AND a.status = 'Agendado'
    ORDER BY a.data ASC, a.horarioInicio ASC
    LIMIT 1
";
$resultProximoHorario = mysqli_query($conn, $sqlProximoHorario);
if ($rowProximoHorario = mysqli_fetch_assoc($resultProximoHorario)) {
    $inicio = date('H:i', strtotime($rowProximoHorario['horarioInicio']));
}

// Consulta para contar o número total de agendamentos
$sqlTotalAgendados = "
    SELECT COUNT(*) AS totalAgendados 
    FROM atendimentosservicos AS ats
    INNER JOIN servicoProfissionais AS sp ON ats.idServicoProfissionais = sp.idServicoProfissionais
    INNER JOIN atendimentos AS at ON ats.idAtendimento = at.idAtendimento
    WHERE sp.idProfissional = $idProfissionalLogado AND at.status = 'Agendado'
";

$resultTotalAgendados = mysqli_query($conn, $sqlTotalAgendados);

if ($resultTotalAgendados) {
    $rowTotalAgendados = mysqli_fetch_assoc($resultTotalAgendados);
    $numerodeAgendados = $rowTotalAgendados['totalAgendados'] ?? 0; // Garante que será 0 caso não exista valor
} else {
    $numerodeAgendados = 0; // Define 0 em caso de erro na consulta
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Profissional</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/estilo_homeProfissional.css">
    <style>
       
    </style>
</head>
<body>
    <?php
        include_once('includes/menuProfissional.php');
    ?>

    <!-- Conteúdo Principal -->
    <div class="container">
        <!-- Resumo Geral -->
        <div class="summary">
            <div class="summary-card">
                <h2><?php echo $numeroAtendimentoHoje ?></h2>
                <p>Atendimentos Hoje</p>
            </div>
            <div class="summary-card">
                <h2><?php echo $inicio ?></h2>
                <p>Próximos Horários</p>
            </div>
            <div class="summary-card">
                <h2><?php echo $numerodeAgendados ?></h2>
                <p>Clientes Agendados</p>
            </div>
        </div>

        <!-- Notificações -->
        <div class="notifications">
            <h3>Notificações</h3>
            <p>📢 Lembrete: Reunião com a gerente às 14:00.</p>
            <p>📅 Novo agendamento: 23/11/2024 às 10:00 com Maria Silva.</p>
        </div>

        <!-- Tabela de horários -->
        <h2>Seus Horários de serviços de hoje</h2>
        <table class="schedule-table">
            <thead>
                <tr>
                    
                    <th>Horário</th>
                    <th>Cliente</th>
                    <th>Serviço</th>
                    <th>Comentário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        $idProfissionalLogado = mysqli_real_escape_string($conn, $_SESSION['idProfissionalLogado']);


                        if (!isset($_GET['data'])) {
                            $sql = "SELECT * FROM atendimentosservicos 
                                    INNER JOIN servicoprofissionais ON atendimentosservicos.idServicoProfissionais = servicoprofissionais.idServicoProfissionais 
                                    INNER JOIN atendimentos ON atendimentos.idAtendimento = atendimentosservicos.idAtendimento
                                    INNER JOIN clientes ON clientes.idCliente = atendimentos.idCliente
                                    INNER JOIN servicos ON servicos.idServico = servicoprofissionais.idServico
                                    WHERE servicoprofissionais.idProfissional = 24
                                      AND atendimentos.status = 'Agendado'
                                      AND DATE(atendimentos.data) = CURDATE();";
                                }

                        $resultados = mysqli_query($conn, $sql);

                        while ($dados = mysqli_fetch_assoc($resultados)) {
                            
                            // Formatar data e hor
                            $horarioInicioFormatado = date('H:i', strtotime($dados['inicio']));

                            echo '<tr>
                                    <td>'.$horarioInicioFormatado.'</td>
                                    <td>'.$dados['nomeCliente'].'</td>
                                    <td>'.$dados['nomeServco'].'</td>
                                    <td>'.$dados['comentario'].'</td>
                                    <td>
                                        <div class="botoes">                                     
                                            <a href="#excluir" data-toggle="modal" data-target="#excluir_'.$dados['idAtendimento'].'" class= "btn btn-delete">Remover</a>
                                        </div>
                                    </td>
                                  </tr>';

                            echo '<div class="modal fade" id="excluir_'.$dados['idAtendimento'].'" tabindex="-1" role="dialog" aria-labelledby="">
                                      <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4 class="modal-title">Confirmar Exclusão</h4>
                                              </div>
                                              <div class="modal-body">
                                                Gostaria de cancelar um servico agendamento pela ('.$dados['nomeCliente'].')?
                                                <br>Se sim entre em contato com a cliente ('.$dados['contatoCliente'].')
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                                  <a class="btn btn-danger" href="cadastrarAtendimentoServico.php?&idAtendimento='.$dados['idAtendimento'].'&horarioInicio='.$dados['horarioInicio'].'">Sim</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>';
                        }
                    ?>
            </tbody>
        </table>

        <!--Agendamentos de Hoje -->
        <h2>Atendimentos Agendados</h2>
        <table class="schedule-table">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Cliente</th>
                    <th>Serviço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        $idProfissionalLogado = mysqli_real_escape_string($conn, $_SESSION['idProfissionalLogado']);


                        if (!isset($_GET['data'])) {
                            $sql = "SELECT * 
                                    FROM atendimentos
                                    INNER JOIN clientes ON clientes.idCliente = atendimentos.idCliente
                                    WHERE atendimentos.status = 'Agendado' ORDER BY data ASC;";
                                }

                        $resultados = mysqli_query($conn, $sql);

                        while ($dados = mysqli_fetch_assoc($resultados)) {
                            // Formatar data e hora

                            $dataFormatada = date('d/m/Y', strtotime($dados['data']));
                            $horarioInicioFormatado = date('H:i', strtotime($dados['horarioInicio']));

                            echo '<tr>
                                    <td>'.$dataFormatada.'</td>
                                    <td>'.$horarioInicioFormatado.'</td>
                                    <td>'.$dados['nomeCliente'].'</td>
                                    <td>'.$dados['precoTotal'].'</td>
                                    <td>
                                        <div class="botoes">                                     
                                            <a href="#concluir" data-toggle="modal" data-target="#concluir'.$dados['idAtendimento'].'" class= "btn btn-delete">Concluir</a>
                                        </div>
                                    </td>
                                  </tr>';

                            echo '<div class="modal fade" id="concluir'.$dados['idAtendimento'].'" tabindex="-1" role="dialog" aria-labelledby="">
                                      <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4 class="modal-title">Confirmar Exclusão</h4>
                                              </div>
                                              <div class="modal-body">
                                                Gostaria de concluir o atendoimento de ('.$dados['nomeCliente'].')?
                                                <br>Se sim verifique se todos os serviços forama atendidos.
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                                  <a class="btn btn-danger" href="includes/concluirAtendimento.php?&idAtendimento='.$dados['idAtendimento'].'">Sim</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>';
                        }
                    ?>
            </tbody>
        </table>

        <!-- Botões -->
        <div class="actions">
            <button class="add-appointment"><a class="corLink" href="cadastrarAtendimento.php"><i class="fas fa-plus"></i> Adicionar Horário</a></button>
            <button class="view-profile"><a class="corLink" href=""><i class="fas fa-user"></i> Ver Perfil</a></button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        function search() {
            const input = document.getElementById("searchInput").value.toLowerCase();
            const table = document.getElementById("serviceTable");
            const rows = table.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const serviceName = rows[i].getElementsByTagName("td")[1]?.innerText.toLowerCase();

                if (serviceName?.includes(input)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    </script>
</body>
</html>
