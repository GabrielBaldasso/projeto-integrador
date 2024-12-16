<?php

    include_once("includes/conexao.php");
    
    session_start();

    
    if(!isset($_SESSION['idProfissionalLogado'])){
      header("Location: login.php");
    }
    
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Admin - Atendimentos</title>
    <link rel="stylesheet" type="text/css" href="css/estilo_adminAtendimentos.css">
</head>
<body>
     <?php
        include_once('includes/menuProfissional.php');
    ?>
    <header>Gerenciamento de Atendimentos</header>
    <div class="container">
        <a href="homeAdmin.php" class="back-button">Voltar</a>
        <h1>Atendimentos</h1>

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
        ?><br>


        <!-- Campo de Busca -->
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Digite o cliente, status ou forma de pagamento para buscar">
            <button onclick="search()">Buscar</button>
        </div>

        <!-- Container Estilizado da Tabela -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Horário Inicial</th>
                        <th>Horário Final</th>
                        <th>Observação</th>
                        <th>Status</th>
                        <th>Cliente</th>
                        <th>Forma de Pagamento</th>
                        <th>Preço Total (R$)</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="atendimentosTable">
                    <?php
                        if (!isset($_GET['data'])) {
                            $sql = "SELECT * FROM atendimentos
                                INNER JOIN formaspagamentos ON atendimentos.idFormaPagamento=formaspagamentos.idFormaPagamento
                                INNER JOIN clientes ON atendimentos.idCliente=clientes.idCliente
                                ORDER BY idAtendimento ASC";
                        }

                        $resultados = mysqli_query($conn, $sql);

                        while ($dados = mysqli_fetch_assoc($resultados)) {
                            // Formatar data e hora
                            $dataFormatada = date('d/m/Y', strtotime($dados['data']));
                            $horarioInicioFormatado = date('H:i', strtotime($dados['horarioInicio']));
                            $horarioFinalizaFormatado = date('H:i', strtotime($dados['horarioFinaliza']));

                            echo '<tr>
                                    <td>'.$dados['idAtendimento'].'</td>
                                    <td class="centro">'.$dataFormatada.'</td>
                                    <td class="centro">'.$horarioInicioFormatado.'</td>
                                    <td class="centro">'.$horarioFinalizaFormatado.'</td>
                                    <td>'.$dados['comentario'].'</td>
                                    <td>'.$dados['status'].'</td>
                                    <td>'.$dados['nomeCliente'].'</td>
                                    <td>'.$dados['descricaoPagamento'].'</td>
                                    <td>R$ '.$dados['precoTotal'].'</td>
                                    
                                    <td>
                                        <div class="botoes">                                        
                                            <a class="btn btn-edit" href="cadastrarAtendimento.php?idAtendimento='.$dados['idAtendimento'].'">Editar</a>
                                            <a href="#excluir" data-toggle="modal" data-target="#excluir_'.$dados['idAtendimento'].'" class= "btn btn-delete">Excluir</a>
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
                                                  Gostaria de excluir o agendamento ('.$dados['idAtendimento'].')?
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                  <a class="btn btn-danger" href="includes/excluir.atendimento.php?idAtendimento='.$dados['idAtendimento'].'">Excluir</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>';
                        }
                    ?>

                </tbody>
            </table>
        </div>

    </div>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        function search() {
            const input = document.getElementById("searchInput").value.toLowerCase();
            const table = document.getElementById("atendimentosTable");
            const rows = table.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const cliente = rows[i].getElementsByTagName("td")[6]?.innerText.toLowerCase();
                const status = rows[i].getElementsByTagName("td")[5]?.innerText.toLowerCase();
                const formaPagamento = rows[i].getElementsByTagName("td")[7]?.innerText.toLowerCase();

                if (cliente?.includes(input) || status?.includes(input) || formaPagamento?.includes(input)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    </script>
</body>
</html>
