<?php

    include_once("includes/conexao.php");

        session_start();

    if (isset($_GET["idAtendimento"])) {
        $sql = "SELECT * FROM atendimentos WHERE idAtendimento = '{$_GET['idAtendimento']}'";
        $resultados = mysqli_query($conn, $sql);
        $dados = mysqli_fetch_assoc($resultados);

        $idAtendimento = $dados['idAtendimento'];
        $data = $dados['data'];
        $horarioInicio = $dados['horarioInicio'];
        $horarioFinaliza = $dados['horarioFinaliza'];
        $comentario = $dados['comentario'];
        $precoTotal = $dados['precoTotal'];
        $idFormaPagamento = $dados['idFormaPagamento'];
        $idCliente = $dados['idCliente'];

    }else{

        $idAtendimento = 0;
        $data = "";
        $horarioInicio = ""; 
        $horarioFinaliza = "";
        $comentario = "";
        $precoTotal = "";
        $idFormaPagamento = ""; 
        $idCliente = "";

    }

 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastrar Atendimento</title>
    <link rel="stylesheet" type="text/css" href="css/cadastrarAtendimentos.css">
</head>
<body>
    <?php
        if (isset($_SESSION['idProfissionalLogado'])) {
            include_once('includes/menuProfissional.php');
        }else{
            include_once('includes/menuCliente.php');
        }
    ?>
    <header>Agendar Atendimento</header>

    <div class="container">
        <h1>Atendimento</h1>
        <?php

            if (isset($_SESSION['idProfissionalLogado'])) {
                if ($_SESSION['emailProfissionalLogado'] == 'admin@gmail.com') {
                    $redirectPage = 'homeAdmin.php';
                } else {
                    $redirectPage = 'homeProfissional.php';
                }
            }elseif(isset($_SESSION['idClienteLogado'])) {
                $redirectPage = 'homeCliente.php';
            } else {
                $redirectPage = 'login.php';
            }
        ?>
        <a href="<?= $redirectPage ?>" class="back-button" >Voltar</a>
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
        <form id="atendimento-form"action="includes/criar.atendimento.php" method="POST" class="login100-form validate-form">
            <div class="form-row">
                <div>
                    <label for="data">Data</label>
                    <input type="date" id="data" name="data" value="<?php echo $data ?>"required>
                    <input type="text" name="idAtendimento" value="<?php echo $idAtendimento ?>" hidden>
                </div>
                <div>
                    <label for="horario-inicial">Horário Inicial</label>
                    <input type="time" id="horarioInicio" name="horarioInicio" value="<?php echo $horarioInicio ?>" required>
                </div>
            </div>

            <label for="observacao">Observação</label>
            <textarea id="observacao" name="comentario" rows="4" placeholder="Escreva observações aqui"><?php echo $comentario ?></textarea>

            <?php

                if (isset($_SESSION['idProfissionalLogado'])) {
                    include_once('includes/conexao.php');

                    ?>
                        <label for="idCliente">Cliente</label>
                        <select id="idCliente" name="idCliente" required>
                        <?php
                            $sql2 = "SELECT * FROM clientes ORDER BY nomeCliente ASC";
                            $resultados = mysqli_query($conn, $sql2);

                            while ($dados = mysqli_fetch_assoc($resultados)) {
                                if($idCliente  == $dados['idCliente']){$sel = 'selected';} else{$sel = '';}
                                echo '<option '.$sel.' value="'.$dados['idCliente'].'">'.$dados['nomeCliente'].' - '.$dados['email'].'</option>';
                            }
                        ?>
                    </select>
                    <?php
                }else{
                    include_once('includes/conexao.php');
                    ?>
                    <input type="text" name="idCliente" value="<?php echo $_SESSION['idClienteLogado'] ?>" hidden>
                    <?php

                }
            ?>

            <label for="idFormaPagamento">Forma de Pagamento</label>
            <select id="idFormaPagamento" name="idFormaPagamento" required>
                <?php

                    include_once('includes/conexao.php');

                    $sql2 = "SELECT * FROM formaspagamentos ORDER BY descricaoPagamento ASC";
                    $resultados = mysqli_query($conn, $sql2);

                    while ($dados = mysqli_fetch_assoc($resultados)) {
                        if($idFormaPagamento  == $dados['idFormaPagamento']){$sel = 'selected';} else{$sel = '';}
                        echo '<option '.$sel.' value="'.$dados['idFormaPagamento'].'">'.$dados['descricaoPagamento'].'</option>';
                    }

                ?>
            </select>
        </form>
        <button type="submit" form="atendimento-form">Definir Serviços para o Atendimento</button>
    </div>

    


</body>
</html>
