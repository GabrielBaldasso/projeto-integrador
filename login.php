<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

        /* Estilo do Container do Login */
        .login-wrapper {
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

        .login-container {
            background-color: rgba(0, 0, 0, 0.7); /* Fundo semi-transparente para contraste */
            padding: 40px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            color: white;
        }

        .login-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .login-container input {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            background-color: #ff7f50; /* Cor alaranjada suave para combinar com a madeira */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #e67e32; /* Cor de hover para o botão */
        }

        /* Links abaixo do formulário */
        .login-container .links {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .login-container .links a {
            color: #ff7f50;
            text-decoration: none;
            font-size: 15px;
        }

        .login-container .links a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

    <!-- Imagem de fundo e container de login -->
    <div class="bg">
        <div class="login-wrapper">
            <!-- Nome do Salão -->
            <div class="salon-name">Salão Larissa Araújo</div>

            <div class="login-container">
                <h2>Login</h2>
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
                <form action="includes/valida.php" method="POST" class="login100-form validate-form">
                    <input type="text" name="email" placeholder="Email" required><br>
                    <input type="password" name="senha" placeholder="Senha" required><br>
                    <button type="submit">Entrar</button>
                </form>

                <!-- Links abaixo do formulário -->
                <div class="links">
                    <a href="recuperarSenha.php">Esqueceu a senha?</a>
                    <a href="cadastrarCliente.php">Cadastrar</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
