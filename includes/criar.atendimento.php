<?php 
include_once("conexao.php");

$idAtendimento = mysqli_real_escape_string($conn, $_POST['idAtendimento']);
$data = mysqli_real_escape_string($conn, $_POST['data']);
$horarioInicio = mysqli_real_escape_string($conn, $_POST['horarioInicio']);
$comentario = mysqli_real_escape_string($conn, $_POST['comentario']);
$status = "Agendado";
$idFormaPagamento = mysqli_real_escape_string($conn, $_POST['idFormaPagamento']);
$idCliente = mysqli_real_escape_string($conn, $_POST['idCliente']);

if($idAtendimento == 0){
        $resultado = mysqli_query($conn, "SELECT * 
                        FROM atendimentos 
                        WHERE data = '$data' AND status = 'Agendado' AND '$horarioInicio' = horarioInicio");
        if (mysqli_num_rows($resultado)>0) {
            header("Location: ../cadastrarAtendimento.php?tipo=erro&mensagem=Erro: Horário não disponível. Tente outro horário.");        
        }else{
            $sql = "INSERT INTO atendimentos (data, horarioInicio, comentario, status, idFormaPagamento, idCliente)
                    VALUES ('$data', '$horarioInicio', '$comentario', '$status', '$idFormaPagamento', '$idCliente')";

            if (mysqli_query($conn, $sql)) {
                 $idAtendimento = mysqli_insert_id($conn);

                    header("Location: ../cadastrarAtendimentoServico.php?tipo=sucesso&mensagem=O Atendimento foi confirmado cadestre os serviços desejados.&idAtendimento=".$idAtendimento."&horarioInicio=".$horarioInicio);

            } else {
                //echo mysqli_error($conn);
                header("Location: ../cadastrarAtendimento.php?tipo=erro&mensagem=ERRO atendimento não foi cadastrado");
            }
        }
    } else {

        $sql = "UPDATE atendimentos SET data = '$data', horarioInicio = '$horarioInicio', comentario = '$comentario', status = '$status', idFormaPagamento = '$idFormaPagamento', idCliente = '$idCliente' WHERE idAtendimento = '$idAtendimento'";
            if (mysqli_query($conn, $sql)) {
                header("Location: ../cadastrarAtendimentoServico.php?tipo=sucesso&mensagem=O atendimento foi alterado, remova todos os Serviços e remarque para que ele receba o novo horarios.&idAtendimento=".$idAtendimento."&horarioInicio=".$horarioInicio);
            }
            else{
                //echo mysqli_error($conn);
                header("Location: ../cadastrarAtendimento.php?tipo=erro&mensagem=ERRO-cadastro da conta do profissional não foi atualizado");
            }

    }




 ?>
