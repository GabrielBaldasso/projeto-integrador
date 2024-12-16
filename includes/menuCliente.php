

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Superior com Deslizamento</title>
    <!-- Link para Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Estilos gerais */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Barra de navegação */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            color: white;
            padding: 10px 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar .logo {
            font-size: 20px;
            font-weight: bold;
        }

        .menu-icon {
            cursor: pointer;
            font-size: 24px;
        }

        /* Menu lateral */
        .side-menu {
            position: fixed;
            top: 0;
            left: -250px; /* Inicialmente fora da tela */
            width: 250px;
            height: 100%;
            background-color: #444;
            color: white;
            padding: 20px;
            box-shadow: 5px 0 5px rgba(0, 0, 0, 0.5);
            transition: left 0.3s ease;
        }

        .side-menu ul {
            list-style: none;
            padding: 0;
        }

        .side-menu ul li {
            margin: 15px 0;
        }

        .side-menu ul li a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .side-menu ul li a i {
            margin-right: 10px; /* Espaço entre o ícone e o texto */
        }

        .side-menu ul li a:hover {
            text-decoration: underline;
        }

        .close-btn {
            cursor: pointer;
            font-size: 20px;
            color: #ff4c4c;
            display: block;
            text-align: right;
        }
    </style>
</head>
<body>

    <!-- Barra de Navegação -->
    <div class="navbar">
        <span class="menu-icon" onclick="toggleMenu()">☰</span>
        <div class="logo">Larissa Araújo</div>
    </div>

    <!-- Menu Lateral -->
    <div id="sideMenu" class="side-menu">
        <span class="close-btn" onclick="toggleMenu()">✖</span>
        <ul>
            <li><a href="#about"><i class="fas fa-info-circle"></i> Sobre Nós</a></li>
            <li><a href="#services"><i class="fas fa-concierge-bell"></i> Serviços</a></li>
            <li><a href="agendamentosCliente.php"><i class="fas fa-user-friends"></i> Meus Agendamentos</a></li>
            <li><a href="#contact"><i class="fas fa-envelope"></i> Contato</a></li>
            <li><a href="cadastrarAtendimento.php"><i class="fas fa-calendar-alt"></i> Agende Agora</a></li>
            <li><a href="cadastrarCliente.php?idCliente=<?php echo $_SESSION['idClienteLogado']; ?>"><i class="fas fa-user"></i>Minha Conta</a></li>
            <li><a href="includes/sair.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
        </ul>
    </div>

    <!-- JavaScript -->
    <script>
        function toggleMenu() {
            const sideMenu = document.getElementById('sideMenu');
            if (sideMenu.style.left === '0px') {
                sideMenu.style.left = '-250px';
            } else {
                sideMenu.style.left = '0px';
            }
        }
    </script>

</body>
</html>
