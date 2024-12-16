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
    <title>Home - Administrador</title>
    <link rel="stylesheet" type="text/css" href="css/estilo_homeAdmin.css">
</head>
<style>
    body{
        background-image: url('img/fundo5.jpg'); /* Substitua com a imagem de fundo de uma mesa de madeira */
        background-size: cover;
        background-position: center;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<body>
    <!-- Botão de Sair -->
    <button class="logout-button">
        <a href="login.php">Sair</a>
    </button>

    <!-- Container principal -->
    <div class="admin-home-container">
        <h1>Bem-vindo, Administrador</h1>
        <div class="button-grid">
            <!-- Botões para navegar para as outras telas -->
            <button class="admin-button">
                <a href="adminClientes.php">Clientes</a>
            </button>
            <button class="admin-button">
                <a href="adminProfissionais.php">Profissionais</a>
            </button>
            <button class="admin-button">
                <a href="adminServicos.php">Serviços</a>
            </button>
            <button class="admin-button">
                <a href="adminAtendimentos.php">Atendimentos</a>
            </button>
            <button class="admin-button">
                <a href="adminVinculacao.php">Vinculação</a>
            </button>
            <button class="admin-button">
                <a href="adminTipoProfissional.php">Tipo de Profissional</a>
            </button>
        </div>
    </div>
</body>
</html>
