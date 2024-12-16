<?php

    include_once("includes/conexao.php");

    session_start();

    if(!isset($_SESSION['idProfissionalLogado'])){
      header("Location: login.php");
    }
    

    if (isset($_GET["idProfissional"])) {
        $sql = "SELECT * FROM profissionais WHERE idProfissional = '{$_GET['idProfissional']}'";
        $resultados = mysqli_query($conn, $sql);
        $dados = mysqli_fetch_assoc($resultados);

        $idProfissional = $dados['idProfissional'];
        $nomeProfissionais = $dados['nomeProfissionais'];
        $email = $dados['email'];
        $senha = $dados['senha'];
        $contato = $dados['contato'];
        $idTipoProfissional = $dados['idTipoProfissional'];

    }else{

        $idProfissional = 0;
        $nomeProfissionais = "";
        $email = "";
        $senha = "";
        $contato = "";
        $idTipoProfissional = "";

    }

 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastro de Profissional</title>
    <style>
        /* Estilos Gerais */
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Imagem de fundo */
        .bg {
            background-image: url('img/fundo5.jpg'); /* Substitua com a imagem de fundo de uma mesa de madeira */
            background-size: cover;
            background-position: center;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Estilo do Container de Cadastro */
        .register-wrapper {
            text-align: center;
            color: white;
        }

        .salon-name {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .register-container {
            background-color: rgba(0, 0, 0, 0.7); /* Fundo semi-transparente para contraste */
            padding: 40px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            color: white;
        }

        .register-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .register-container input, .register-container select {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .register-container button {
            width: 100%;
            padding: 12px;
            background-color: #ff7f50; /* Cor alaranjada suave para combinar com a madeira */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        .register-container button:hover {
            background-color: #e67e32; /* Cor de hover para o botão */
        }

        /* Link abaixo do botão */
        .register-container .link {
            margin-top: 20px;
        }

        .register-container .link a {
            color: #ff7f50;
            text-decoration: none;
            font-size: 15px;
        }

        .register-container .link a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

    <!-- Imagem de fundo e container de cadastro -->
    <div class="bg">
        <div class="register-wrapper">
            <!-- Nome do Salão -->
            <div class="salon-name">Cadastro de Profissional</div>

            <div class="register-container">
                <h2>Cadastro</h2>
                <?php

                    if (isset($_GET['mensagem'])) {
                
                
                        if($_GET['tipo']=='sucesso'){
                            echo '<div style="color: white; background-color: MediumSeaGreen; border-radius: 19px; padding: 8px 12px; text-align: center;" role="alert">
                                    ' . $_GET['mensagem'] . '
                                </div>';
                        }
                        else{
                            echo '<div style="color: white; background-color: red; border-radius: 19px; padding: 8px 12px; text-align: center;" role="alert">
                                    ' . $_GET['mensagem'] . '
                                </div>';
                        }
                    }
                ?>
                <form action="includes/criar.profissional.php" method="POST" class="login100-form validate-form">
                    <input type="text" name="idProfissional" value="<?php echo $idProfissional ?>" hidden>
                    <input type="text" name="nomeProfissionais" value="<?php echo $nomeProfissionais ?>" placeholder="Nome" required><br>
                    <input type="email" name="email" placeholder="Email" value="<?php echo $email ?>" required><br>
                    <input type="password" name="senha" placeholder="Senha" value="" required><br>
                    <input type="text" name="contato" placeholder="Contato (Celular)" value="<?php echo $contato ?>" required><br>
                    <select style="text-align: center;" name="idTipoProfissional" class="form-select">
                        <?php

                        include_once('includes/conexao.php');

                        $sql2 = "SELECT * FROM tiposprofissionais ORDER BY nomeTipo ASC";
                        $resultados = mysqli_query($conn, $sql2);

                        while ($dados = mysqli_fetch_assoc($resultados)) {
                            if($idTipoProfissional  == $dados['idTipoProfissional']){$sel = 'selected';} else{$sel = '';}
                            echo '<option '.$sel.' value="'.$dados['idTipoProfissional'].'">'.$dados['nomeTipo'].'</option>';
                        }

                        ?>
                    </select><br>
                    <button type="submit">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
