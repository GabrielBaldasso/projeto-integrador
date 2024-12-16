<?php
    include_once("conexao.php");

    $idAtendimentoServico = mysqli_real_escape_string($conn, $_POST['idAtendimentoServico']);
    $idAtendimento = mysqli_real_escape_string($conn, $_POST['idAtendimento']);
    $precoServico = mysqli_real_escape_string($conn, $_POST['precoServico']);
    $idServicoProfissionais = mysqli_real_escape_string($conn, $_POST['idServicoProfissionais']);
    $horarioInicio = mysqli_real_escape_string($conn, $_POST['horarioInicio']);

    // Consulta para obter a duração do serviço relacionado
    $sqlTempo = "
        SELECT s.tempo 
        FROM servicoProfissionais sp 
        JOIN servicos s ON sp.idServico = s.idServico 
        WHERE sp.idServicoProfissionais = '$idServicoProfissionais'
    ";

    $resultado = mysqli_query($conn, $sqlTempo);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $linha = mysqli_fetch_assoc($resultado);
        $duracao = $linha['tempo']; // Duração do serviço no formato 'HH:MM:SS'

        // Somando o horário inicial com a duração do serviço
        $sqlSomar = "SELECT ADDTIME('$horarioInicio', '$duracao') AS fim";
        $resultadoSomar = mysqli_query($conn, $sqlSomar);

        if ($resultadoSomar && mysqli_num_rows($resultadoSomar) > 0) {
            $linhaFim = mysqli_fetch_assoc($resultadoSomar);
            $fim = $linhaFim['fim']; // Horário final calculado

            // Agora você pode usar as variáveis $horarioInicio e $fim conforme necessário
        }

    if ($idAtendimentoServico == 0) {
        $resultado = mysqli_query($conn, "SELECT 
                            a1.idAtendimento AS Atendimento1,
                            a2.idAtendimento AS Atendimento2,
                            ats1.idAtendimentoServico AS AtendimentoServico1,
                            ats2.idAtendimentoServico AS AtendimentoServico2,
                            a1.data,
                            ats1.inicio AS Inicio1,
                            ats1.fim AS Fim1,
                            ats2.inicio AS Inicio2,
                            ats2.fim AS Fim2,
                            sp1.idProfissional
                        FROM 
                            atendimentos a1
                        JOIN 
                            atendimentosservicos ats1 ON a1.idAtendimento = ats1.idAtendimento
                        JOIN 
                            servicoprofissionais sp1 ON ats1.idServicoProfissionais = sp1.idServicoProfissionais
                        JOIN 
                            atendimentos a2 ON a1.data = a2.data
                        JOIN 
                            atendimentosservicos ats2 ON a2.idAtendimento = ats2.idAtendimento
                        JOIN 
                            servicoprofissionais sp2 ON ats2.idServicoProfissionais = sp2.idServicoProfissionais
                        WHERE 
                            a1.status = 'Agendado'
                            AND a2.status = 'Agendado'
                            AND sp1.idProfissional = sp2.idProfissional
                            AND a1.idAtendimento <> a2.idAtendimento
                            AND (
                                (ats1.inicio < ats2.fim AND ats1.fim > ats2.inicio)
                                OR
                                (ats2.inicio < ats1.fim AND ats2.fim > ats1.inicio)
                            );
                        ");
        if (mysqli_num_rows($resultado) > 0) {
            //echo mysqli_error($conn);
            header("Location: ../cadastrarAtendimentoServico.php?tipo=erro&mensagem=Profissinal já tem agendamento para o horario inicial escolhido! Marque esse serviço com outro profissional ou marque outros serviços antes de marcar esse!&idAtendimento=".$idAtendimento."&horarioInicio=".$horarioInicio);
        } else {

                $sql = "INSERT INTO atendimentosservicos (idAtendimento, precoServico, idServicoProfissionais, inicio, fim)
                        VALUES ('$idAtendimento', '$precoServico', '$idServicoProfissionais', '$horarioInicio', '$fim')";

                if (mysqli_query($conn, $sql)) {
                    header("Location:../cadastrarAtendimentoServico.php?tipo=sucesso&mensagem=Serviço foi cadastrado para o atendimento com sucesso.&idAtendimento=".$idAtendimento."&horarioInicio=".$fim);
                } else {
                    header("Location:../cadastrarAtendimentoServico.php?tipo=erro&mensagem=ERRO Serviço não foi cadastrado, tente novamente. Caso o erro persista, entre em contato com o salão.&idAtendimento=".$idAtendimento."&horarioInicio=".$horarioInicio);
                }
            }
        }
    }

    mysqli_close($conn);
?>
