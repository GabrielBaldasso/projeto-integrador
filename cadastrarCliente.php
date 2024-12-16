<?php
session_start();

include_once("includes/conexao.php");

    if (isset($_GET["idCliente"])) {
        $sql = "SELECT * FROM clientes WHERE idCliente = '{$_GET['idCliente']}'";
        $resultados = mysqli_query($conn, $sql);
        $dados = mysqli_fetch_assoc($resultados);

        $idCliente = $dados['idCliente'];
        $nomeCliente = $dados['nomeCliente'];
        $email = $dados['email'];
        $cpf = $dados['cpf'];
        $senha = $dados['senha'];
        $contatoCliente = $dados['contatoCliente'];


    }elseif(isset($_SESSION['idClienteLogado'])){
        $idCliente = $dados['idClienteLogado'];
        $nomeCliente = $dados['nomeClienteLogado'];
        $email = $dados['emailClienteLogado'];
        $cpf = $dados['cpfClienteLogado'];
        $senha = $dados['senhaClienteLogado'];
        $contatoCliente = $dados['contatoClienteLogado'];
    }else{

        $idCliente = 0;
        $nomeCliente = "";
        $email = "";
        $cpf = "";
        $senha = "";
        $contatoCliente = "";

    }
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
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

        .register-container input {
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
            <div class="salon-name">Salão Larissa Araújo</div>

            <div class="register-container">
                <h2>Cadastro Cliente</h2>
                <form action="includes/criar.cliente.php" method="POST" class="login100-form validate-form">
                    <input type="text" name="idCliente" value="<?php echo $idCliente ?>" hidden>
                    <input type="text" name="nomeCliente" value="<?php echo $nomeCliente ?>" placeholder="Nome" required><br>
                    <input type="email" name="email" placeholder="Email" value="<?php echo $email ?>" required><br>
                    <input type="text" name="cpf" placeholder="CPF" value="<?php echo $cpf ?>" required><br>
                    <input type="password" name="senha" placeholder="Senha" required><br>
                    <input type="text" name="contatoCliente" placeholder="Contato (Celular)" value="<?php echo $contatoCliente ?>" required><br>
                    <button type="submit">Cadastrar</button>
                </form>

                <!-- Link abaixo do botão -->
                <div class="link">
                    <a href="login.php">Já estou cadastrado</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
