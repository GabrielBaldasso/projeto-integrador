<?php

    include_once("includes/conexao.php");
    session_start();

    if(!isset($_SESSION['idProfissionalLogado'])){
      header("Location: login.php");
    }

    if (isset($_GET["idServico"])) {
        $sql = "SELECT * FROM servicos WHERE idServico = '{$_GET['idServico']}'";
        $resultados = mysqli_query($conn, $sql);
        $dados = mysqli_fetch_assoc($resultados);

        $idServico = $dados['idServico'];
        $descricaoServicos = $dados['descricaoServicos'];
        $tempo = $dados['tempo'];
        $nomeServco = $dados['nomeServco'];


    }else{

        $idServico = 0;
        $descricaoServicos = "";
        $tempo = "";
        $nomeServco = "";

    }
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/estilo_cadastrarServico.css">
    <title>Cadastro de Serviços</title>
</head>
<body>
    <?php
        include_once('includes/menuProfissional.php');
    ?>
        <header>Cadastro de Serviços</header>
        <div class="container">
            <h1>Cadastrar Serviço</h1>
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
<br>
        <form action="includes/criar.servico.php" method="POST">
            <input type="text" name="idServico" value="<?php echo $idServico ?>" hidden>

            <label for="nomeServco">Nome do Serviço</label>
            <input type="text" id="nomeServco" name="nomeServco" value="<?php echo $nomeServco ?>" placeholder="Digite o nome do serviço" required>

            <label for="descricaoServicos">Descrição</label>
            <textarea id="descricaoServicos" name="descricaoServicos" value="<?php echo $descricaoServicos ?>"  rows="4" placeholder="Digite uma breve descrição do serviço" required></textarea>

            <label for="tempo">Tempo Estimado (horas:minutos)</label>
            <input type="time" id="tempo" name="tempo" value="<?php echo $tempo ?>" placeholder="Digite o tempo estimado" min="1" required>

            <button type="submit">Cadastrar</button>
        </form>
        <?php

            if (isset($_SESSION['idProfissionalLogado'])) {
                if ($_SESSION['emailProfissionalLogado'] == 'admin@gmail.com') {
                    $redirectPage = 'homeAdmin.php';
                } else {
                    $redirectPage = 'homeProfissional.php';
                }
            } else {
                $redirectPage = 'login.php';
            }
        ?>
        <a href="<?= $redirectPage ?>" class="back-button">Voltar</a>
    </div>
</body>
</html>
