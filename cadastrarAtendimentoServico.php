<?php
session_start();
if (isset($_GET["idAtendimentoServico"])) {
    $sql = "SELECT * FROM atendimentosservicos WHERE idAtendimentoServico = '{$_GET['idAtendimentoServico']}'";
    $resultados = mysqli_query($conn, $sql);
    $dados = mysqli_fetch_assoc($resultados);

    // Variáveis recebidas do formulário
    $idAtendimentoServico = $dados['idAtendimentoServico'];
    $idAtendimento = $dados['idAtendimento'];
    $precoServico = $dados['precoServico'];
    $idServicoProfissionais = $dados['idServicoProfissionais'];
    $horarioInicio = $dados['horarioInicio'];
    $fim = $dados['fim'];
    $precoTotal = $dados['precoTotal'];

} else {
    $idAtendimentoServico = 0;
    $idAtendimento = "";
    $precoServico = "";
    $idServicoProfissionais = "";
    $horarioInicio = "";
    $fim = "";
    $precoTotal = 0;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastrar Atendimento Serviços</title>
    <link rel="stylesheet" type="text/css" href="css/cadastrarAtendimentoServico.css">
</head>
<body>
    <?php
        if (isset($_SESSION['idProfissionalLogado'])) {
            include_once('includes/menuProfissional.php');
        }else{
            include_once('includes/menuCliente.php');
        }
    ?>
    <header>Cadastrar Atendimento Serviços</header>

    <div class="container">
        <h1>Serviços</h1>
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

        <form id="service-form" action="includes/criar.atendimentoServico.php" method="POST">

            <input type="time" value="<?php echo $_GET['horarioInicio'] ?>" name="horarioInicio" hidden>
            <input type="text" value="<?php echo $_GET['idAtendimento'] ?>" name="idAtendimento" hidden>
            <input type="text" value="<?php echo $idAtendimentoServico ?>" name="idAtendimentoServico" hidden>
            <label for="profissional">Profissional:</label>
            <select id="profissional" name="profissional">
                <?php
                include_once('includes/conexao.php');
                $sql2 = "SELECT * FROM profissionais 
                         INNER JOIN tiposprofissionais ON profissionais.idTipoProfissional = tiposprofissionais.idTipoProfissional 
                         ORDER BY nomeProfissionais ASC";
                $resultados = mysqli_query($conn, $sql2);
                while ($dados = mysqli_fetch_assoc($resultados)) {
                    echo '<option value="'.$dados['idProfissional'].'">'.$dados['nomeProfissionais'].' - '.$dados['nomeTipo'].'</option>';
                }
                ?>
            </select>

            <label for="idServicoProfissionais">Serviço:</label>
            <select id="idServicoProfissionais" name="idServicoProfissionais">
                <option value="">Selecione um serviço</option>
                <?php
                $sql2 = "SELECT * FROM servicoprofissionais 
                         INNER JOIN profissionais ON servicoprofissionais.idProfissional = profissionais.idProfissional 
                         INNER JOIN servicos ON servicoprofissionais.idServico = servicos.idServico 
                         ORDER BY nomeProfissionais ASC";
                $resultados = mysqli_query($conn, $sql2);
                while ($dados = mysqli_fetch_assoc($resultados)) {
                    echo '<option value="'.$dados['idServicoProfissionais'].'" data-profissional="'.$dados['idProfissional'].'">'
                         .$dados['nomeServco'].' - '.$dados['nomeProfissionais'].'</option>';
                }
                ?>
            </select>

            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="precoServico" placeholder="R$" readonly required>

            <button class="btn btn-danger" type="submit" form="service-form">Adicionar Serviço</button>
        </form>

    </div>

    <div class="container">
        <form id="service-form" action="includes/agendar.atendimento.php" method="POST">
            <input type="text" value="<?php echo $_GET['idAtendimento'] ?>" name="idAtendimento" hidden>
                <table id="service-table">
                    <thead>
                        <tr>
                            <th>Profissional</th>
                            <th>Serviço</th>
                            <th>Preço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                                if (isset($_GET['idAtendimento'])) {
                                    $idAtendimento = $_GET['idAtendimento'];
                                    $sql = "SELECT idAtendimento, idAtendimentoServico , nomeProfissionais, nomeServco, precoProfissional FROM atendimentosservicos
                                    INNER JOIN servicoProfissionais ON atendimentosservicos.idServicoProfissionais = servicoprofissionais.idServicoProfissionais
                                    INNER JOIN profissionais ON servicoprofissionais.idProfissional = profissionais.idProfissional
                                    INNER JOIN servicos ON servicoProfissionais.idServico = servicos.idServico
                                    WHERE idAtendimento = $idAtendimento
                                    ORDER BY inicio ASC";
                                }

                                $resultados = mysqli_query($conn, $sql);
                                while ($dados = mysqli_fetch_assoc($resultados)) {
                                echo '<tr>
                                        <td>'.$dados['nomeProfissionais'].'</td>
                                        <td>'.$dados['nomeServco'].'</td>
                                        <td>'.$dados['precoProfissional'].'</td>
                                        
                                        
                                        <td style="text-align: center;">
                                            <a href="#excluir" data-toggle="modal" data-target="#excluir_'.$dados['idAtendimentoServico'].'" class= "btn btn-delete">Remover</a>
                                        </td>
                                        </tr>';

                                        echo '<div class="modal fade" id="excluir_'.$dados['idAtendimentoServico'].'" tabindex="-1" role="dialog" aria-labelledby="">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Confirmar Exclusão</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            Gostaria de excluir o serviço ('.$dados['nomeServco'].')?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <a class="btn btn-delete" href="includes/excluir.atendimentoServico.php?idAtendimentoServico='.$dados['idAtendimentoServico'].'&idAtendimento='.$idAtendimento.'&horarioInicio='.$horarioInicio.'">Excluir</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';

                                    }
                            ?>

                    </tbody>
                </table>
                <br>

                <?php
                    if (isset($_GET['idAtendimento'])) {
                        $idAtendimento = $_GET['idAtendimento'];
                        $sql = "SELECT SUM(precoProfissional) AS totalPreco FROM atendimentosservicos
                                INNER JOIN servicoprofissionais ON atendimentosservicos.idServicoProfissionais = servicoprofissionais.idServicoProfissionais
                                INNER JOIN profissionais ON servicoprofissionais.idProfissional = profissionais.idProfissional
                                INNER JOIN servicos ON servicoprofissionais.idServico = servicos.idServico
                                WHERE idAtendimento = $idAtendimento";

                        $resultados = mysqli_query($conn, $sql);
                        $dados = mysqli_fetch_assoc($resultados);
                        $precoTotal = $dados['totalPreco'] ?? 0;
                    }
                ?>

            <div class="row">
                <div class="col-md-12">
                    <h4 class="totalPagar">Total a Pagar: R$ <?php echo $precoTotal ?></h4>
                    <input type="hidden" name="precoTotal" value="<?php echo $precoTotal ?>" hidden>
                </div>

            </div>
            <?php

                if (isset($_SESSION['idClienteLogado'])) {
                        $redirectPage = 'homeCliente.php';

                }elseif (isset($_SESSION['idProfissionalLogado'])) {

                    if ($_SESSION['emailProfissionalLogado'] == 'admin@gmail.com') {
                        $redirectPage = 'homeAdmin.php';
                    }
                    else {
                        $redirectPage = 'homeProfissional.php';
                    }
                } else {
                    $redirectPage = 'login.php';
                }
            ?>
           <div class="button-container row">

                <!-- Botão Excluir Atendimento -->
                <a href="includes/excluir.atendimento.php?idAtendimento=<?php echo $idAtendimento; ?>" class="btn btn-danger">Cancelar</a>
                
                <!-- Botão Finalizar -->
                <button type="submit" class="btn btn-success" formaction="includes/agendar.atendimento.php?idAtendimento=<?php echo $idAtendimento; ?>&precoTotal=<?php echo $precoTotal; ?>">Finalizar</button>
            </div>


        </form>
            
        



    </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        function search() {
            const input = document.getElementById("searchInput").value.toLowerCase();
            const table = document.getElementById("professionalTable");
            const rows = table.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const nome = rows[i].getElementsByTagName("td")[1]?.innerText.toLowerCase();
                const email = rows[i].getElementsByTagName("td")[2]?.innerText.toLowerCase();
                const tipoProfissional = rows[i].getElementsByTagName("td")[4]?.innerText.toLowerCase();

                if (nome?.includes(input) || email?.includes(input) || tipoProfissional?.includes(input)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    </script>

   <script>
    const totalPriceInput = document.getElementById('total-price');
    const idAtendimento = "<?php echo $_GET['idAtendimento'] ?? ''; ?>";

    async function fetchTotalPreco() {
        if (!idAtendimento) {
            totalPriceInput.value = '0.00';
            return;
        }

        try {
            const response = await fetch('includes/get_preco_total.php', {
                method: 'POST',
                body: new URLSearchParams({
                    idAtendimento: idAtendimento
                })
            });

            const data = await response.json();

            if (data && data.precoTotal) {
                totalPriceInput.value = data.precoTotal.toFixed(2);
            } else {
                totalPriceInput.value = '0.00';
            }
        } catch (error) {
            console.error("Erro ao buscar dados de preço total:", error);
            totalPriceInput.value = '0.00';
        }
    }

    // Carregar soma de preços ao carregar a página
    document.addEventListener('DOMContentLoaded', fetchTotalPreco);
</script>

<script>
    // Seletores dos elementos
    const profissionalSelect = document.getElementById("profissional");
    const servicoSelect = document.getElementById("idServicoProfissionais");
    const precoInput = document.getElementById("preco");

    // Filtrar as opções de serviços com base no profissional selecionado
    profissionalSelect.addEventListener("change", function () {
        const profissionalId = profissionalSelect.value;

        // Mostra/Esconde as opções de serviço com base no profissional selecionado
        for (const option of servicoSelect.options) {
            if (option.dataset.profissional === profissionalId || option.value === "") {
                option.style.display = "block"; // Mostra a opção
            } else {
                option.style.display = "none"; // Esconde a opção
            }
        }

        // Limpa a seleção de serviços e o preço
        servicoSelect.value = "";
        precoInput.value = ""; // Limpa o campo de preço quando mudar o profissional
    });

    // Atualizar o preço do serviço selecionado
    servicoSelect.addEventListener("change", function () {
        const idServicoProfissionais = servicoSelect.value;

        // Verifica se algum serviço foi selecionado
        if (idServicoProfissionais) {
            // Fazendo a requisição AJAX para pegar o preço do serviço
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "includes/get_preco.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Envia a requisição com o ID do serviço
            xhr.send("idServicoProfissionais=" + idServicoProfissionais);

            // Manipula a resposta da requisição
            xhr.onload = function () {
                if (xhr.status === 200) {
                    try {
                        // A resposta será o preço em formato JSON
                        const response = JSON.parse(xhr.responseText);

                        // Verifica se o preço foi retornado
                        if (response.preco !== undefined) {
                            precoInput.value = response.preco; // Atualiza o campo de preço com o valor retornado
                        } else {
                            console.error("Erro: Preço não encontrado na resposta do servidor.");
                            precoInput.value = "0"; // Se não encontrar preço, coloca zero
                        }
                    } catch (e) {
                        console.error("Erro ao processar a resposta JSON: ", e);
                        precoInput.value = "0";
                    }
                } else {
                    console.error("Erro na requisição AJAX. Status:", xhr.status);
                    precoInput.value = "0"; // Se houver erro na requisição, coloca zero
                }
            };
        } else {
            // Se nenhum serviço for selecionado, limpa o campo de preço
            precoInput.value = "";
        }
    });

</script>

</body>
</html>
