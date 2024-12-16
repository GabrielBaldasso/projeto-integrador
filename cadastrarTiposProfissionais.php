<?php
    session_start();

    if(!isset($_SESSION['idProfissionalLogado'])){
      header("Location: login.php");
    }

include_once("includes/conexao.php");

    if (isset($_GET["idTipoProfissional"])) {
        $sql = "SELECT * FROM tiposprofissionais WHERE idTipoProfissional = '{$_GET['idTipoProfissional']}'";
        $resultados = mysqli_query($conn, $sql);
        $dados = mysqli_fetch_assoc($resultados);



        $idTipoProfissional = $dados['idTipoProfissional'];
        $nomeTipo = $dados['nomeTipo'];
        $descricao = $dados['descricao'];
    }else{
         
        $idTipoProfissional= 0 ;
        $nomeTipo = "";
        $descricao = "";
    }

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastro de Tipo de Profissional</title>
    <link rel="stylesheet" type="text/css" href="css/estilo_cadastrarTipoProfissionais.css">
</head>
<body>
     <?php
        include_once('includes/menuProfissional.php');
    ?>
    <header>Cadastro de Tipo de Profissional</header>
    <div class="container">
        <h1>Cadastrar Tipo de Profissional</h1>
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
        <form action="includes/criar.tipoProfissional.php" method="POST" class="login100-form validate-form">
            <input type="text" name="idTipoProfissional" value="<?php echo $idTipoProfissional ?>" hidden>
            <label for="nomeTipo">Nome do Tipo</label>
            <input type="text" id="nomeTipo" value="<?php echo $nomeTipo ?>" name="nomeTipo" placeholder="Digite o nome do tipo de profissional" required>

            <label for="descricao">Descrição</label>
            <textarea id="descricao" value="<?php echo $descricao ?>" name="descricao" rows="4" placeholder="Digite uma breve descrição do tipo de profissional" required></textarea>

            <button type="submit">Cadastrar</button>
        </form>
        <?php

            if (isset($_SESSION['idProfissionalLogado'])) {
                if ($_SESSION['emailProfissionalLogado'] == 'admin@gmail.com') {
                    $redirectPage = 'homeAdmin.php';
                } else {
                    $redirectPage = 'homeProfissional.php';
                }
            }elseif (isset($_SESSION['idClienteLogado'])) {
                    $redirectPage = 'homeCliente.php';
            } else {
                $redirectPage = 'login.php';
            }
        ?>
        <a href="<?= $redirectPage ?>" class="back-button">Voltar</a>
    </div>
</body>
</html>
