<?php

    session_start();
    
    if(!isset($_SESSION['idClienteLogado'])){
      header("Location: login.php");
    }
    
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laris Salon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/estilo_homeCliente.css">
    <style>
        .hero {
            background: url('img/baner2.jpg') center center/cover no-repeat;
            height: 60vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        }

        .entrada img{
            height: 75%;
            width: 84%;
            margin-top: 10px;
        }

        .services img {
            max-width: 100px;
            margin-bottom: 15px;
        }

        footer {
            background: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>

    <?php
        include_once('includes/menuCliente.php');
    ?>

    <!-- Hero Section -->
    <div class="hero text-center">
        <div>
            <h1>Larissa Araújo</h1>
            <p>Sua beleza, nossa paixão</p>
            <a href="#services" class="btn btn-primary btn-lg">Conheça nossos serviços</a>
        </div>
    </div>

    <!-- About Us Section -->
    <section class="container py-5">
        <div class="row">
            <div class="col-md-6">
                <h2>Sobre Nós</h2>
                <p>Bem-vindo ao Larissa Araújo - Salão de Beleza , um espaço criado para realçar a sua beleza e elevar a sua autoestima! Somos especialistas em oferecer serviços de alta qualidade, com atenção aos detalhes e um atendimento totalmente personalizado.</p>

                <p>Cada cliente é único, e meu objetivo é garantir que você tenha uma experiência inesquecível, saindo daqui sentindo-se ainda mais confiante e radiante.</p>

                <p><a style="text-decoration: none;" href="https://www.google.com.br/maps/place/Av.+S%C3%A3o+Judas+Tadeu,+1075+-+Jardim+Copacabana,+Maring%C3%A1+-+PR,+87023-200/@-23.3894437,-51.941223,17z/data=!3m1!4b1!4m6!3m5!1s0x94ecd6b31a5348bb:0xf190c27eef520623!8m2!3d-23.3894486!4d-51.9386481!16s%2Fg%2F11csct7tlm?entry=ttu&g_ep=EgoyMDI0MTIwNC4wIKXMDSoASAFQAw%3D%3D">📍 Localização: Estamos na Avenida São Judas Tadeu, 1075,</a> um lugar aconchegante e de fácil acesso, pronto para você receber com todo o carinho que você merece.</p>

                <p>Venha me visitar e permita-se viver uma transformação especial. A sua beleza é a minha maior inspiração!</p>
            </div>
            <div class="col-md-6 entrada">
                <img src="img/entrada.jpg" alt="Salão de beleza" class="img-fluid rounded">
            </div>
        </div>
    </section>


    <!-- Services Section -->
    <section id="services" class="bg-light py-5">
        <div class="container text-center">
            <h2>Nossos Serviços Principais</h2>
            <div class="row mt-4">
                <div class="col-md-4">
                    <img src="img/corte.png" alt="Corte de Cabelo">
                    <h4>Corte de Cabelo</h4>
                    <p>Estilos modernos e clássicos.</p>
                </div>
                <div class="col-md-4">
                    <img src="img/pintura.png" alt="Coloração">
                    <h4>Coloração</h4>
                    <p>Tonalidades que combinam com você.</p>
                </div>
                <div class="col-md-4">
                    <img src="img/maquiar.png" alt="Manicure e Pedicure">
                    <h4>Maquiagem Estética</h4>
                    <p>Realçando sua beleza no dia a dia mais.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="text-center py-5">
        <div class="container">
            <h2>Pronto para transformar o seu visual?</h2>
            <p>Agende seu horário agora mesmo!</p>
            <a href="cadastrarAtendimento.php" class="btn btn-success btn-lg">Agendar Agora</a>
        </div>
    </section>

    <!-- Footer -->
    <?php
        include_once('includes/rodaPe.php');
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
