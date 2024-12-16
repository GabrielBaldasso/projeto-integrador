<?php

    include_once("includes/conexao.php");
    session_start(); // Inicia a sessão

    if (isset($_GET["idServicoProfissionais"])) {
        $sql = "SELECT * FROM servicoprofissionais WHERE idServicoProfissionais = '{$_GET['idServicoProfissionais']}'";
        $resultados = mysqli_query($conn, $sql);
        $dados = mysqli_fetch_assoc($resultados);

        $idServicoProfissionais = $dados['idServicoProfissionais'];
        $idProfissional = $dados['idProfissional'];
        $idServico = $dados['idServico'];
        $precoProfissional = $dados['precoProfissional'];
    
    }else{

        $idServicoProfissionais = 0;
        $idProfissional = "";
        $idServico = "";
        $precoProfissional = "";
        

    }

 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastro de Vinculação</title>
    <link rel="stylesheet" type="text/css" href="css/estilo_cadastrarVinculacao.css">
    
</head>
<body>
    <?php
        include_once('includes/menuProfissional.php');
    ?>
    <header>Cadastro de Vinculação</header>
    <div class="container">
        <h1>Cadastrar Vinculação</h1>

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

        
        <form action="includes/criar.vinculacao.php" method="POST" class="login100-form validate-form">

            <input type="text" id="idServicoProfissionais" value="<?php echo $idServicoProfissionais ?>" name="idServicoProfissionais"  hidden>

            <label for="profissional">Profissional</label>
            <select id="idProfissional" name="idProfissional" required>
                <option value="" disabled selected>Selecione o profissional</option>
                <?php

                    $sql2 = "SELECT * FROM profissionais 
                    INNER JOIN tiposprofissionais ON profissionais.idTipoProfissional=tiposprofissionais.idTipoProfissional
                    ORDER BY nomeProfissionais ASC";
                    $resultados = mysqli_query($conn, $sql2);

                    while ($dados = mysqli_fetch_assoc($resultados)) {
                        if($idProfissional  == $dados['idProfissional']){$sel = 'selected';} else{$sel = '';}
                        echo '<option '.$sel.' value="'.$dados['idProfissional'].'">'.$dados['nomeProfissionais'].' - '.$dados['nomeTipo'].'</option>';
                    }

                ?>
            </select>

            <label for="servico">Serviço</label>
            <select id="idServico" name="idServico" required>
                <?php

                        include_once('includes/conexao.php');

                        $sql2 = "SELECT * FROM servicos ORDER BY nomeServco ASC";
                        $resultados = mysqli_query($conn, $sql2);

                        while ($dados = mysqli_fetch_assoc($resultados)) {
                            if($idServico  == $dados['idServico']){$sel = 'selected';} else{$sel = '';}
                            echo '<option '.$sel.' value="'.$dados['idServico'].'">'.$dados['nomeServco'].'</option>';
                        }

                        ?>
            </select>

            <label for="preco">Preço do Profissional (R$)</label>
            <input type="number" id="precoProfissional" name="precoProfissional" value="<?php echo $precoProfissional ?>" placeholder="Digite o preço do profissional" min="0" step="0.01" required>

            

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
