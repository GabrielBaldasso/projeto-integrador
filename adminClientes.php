<?php

    include_once("includes/conexao.php");
    
    session_start();

    if(!isset($_SESSION['idProfissionalLogado'])){
      header("Location: login.php");
    }



    if (isset($_GET["idCliente"])) {
        $sql = "SELECT * FROM clientes WHERE idCliente = '{$_GET['idCliente']}'";
        $resultados = mysqli_query($conn, $sql);
        $dados = mysqli_fetch_assoc($resultados);



        $idCliente= $dados['idCliente'];
        $nomeCliente= $dados['nomeCliente'];
        $email= $dados['email'];
        $senha= $dados['senha'];
        $contatoCliente= $dados['contatoCliente'];
        $cpf= $dados['cpf'];

    }else{
        
        $idCliente= "";
        $nomeCliente= "";
        $email= "";
        $senha= "";
        $contatoCliente= "";
        $cpf= "";
    }

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/estilo_adminClientes.css">
    <title>Admin - Clientes</title>
</head>
<body>
     <?php
        include_once('includes/menuProfissional.php');
    ?>
    <header>Gerenciamento de Clientes</header>
    <div class="container">
        <a href="homeAdmin.php" class="back-button">Voltar</a>
        <h1>Lista de Clientes</h1>

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
            <input type="text" id="searchInput" placeholder="Digite o CPF ou Email para buscar">
            <button onclick="search()">Buscar</button>
        </div>

        <!-- Container Estilizado da Tabela  -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>Contato</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="clientTable">
                    <?php

                        if (!isset($_GET['nomeCliente'])) {
                            $sql = "SELECT * FROM clientes ORDER BY idCliente ASC";
                        }

                        $resultados = mysqli_query($conn, $sql);
                        while ($dados = mysqli_fetch_assoc($resultados)) {
                        echo '<tr>
                                <td>'.$dados['idCliente'].'</td>
                                <td>'.$dados['nomeCliente'].'</td>
                                <td>'.$dados['email'].'</td>
                                <td>'.$dados['contatoCliente'].'</td>
                                <td>'.$dados['cpf'].'</td>
                                
                                <td style="text-align: center;">
                                    <a class="btn btn-edit" href="cadastrarCliente.php?idCliente='.$dados['idCliente'].'">Editar</a>
                                    <a href="#excluir" data-toggle="modal" data-target="#excluir_'.$dados['idCliente'].'" class= "btn btn-delete">Excluir</a>
                                </td>
                                </tr>';

                                echo '<div class="modal fade" id="excluir_'.$dados['idCliente'].'" tabindex="-1" role="dialog" aria-labelledby="">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Confirmar Exclusão</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                    Gostaria de excluir esse usuario ('.$dados['nomeCliente'].')?
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <a class= "btn btn-danger" href="includes/excluir.cliente.php?idCliente='.$dados['idCliente'].'">Excluir</a>
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
            const table = document.getElementById("clientTable");
            const rows = table.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const email = rows[i].getElementsByTagName("td")[2]?.innerText.toLowerCase();
                const cpf = rows[i].getElementsByTagName("td")[3]?.innerText.toLowerCase();

                if (email?.includes(input) || cpf?.includes(input)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    </script>
</body>
</html>
