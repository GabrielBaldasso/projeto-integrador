<?php
include_once('conexao.php');

if (isset($_POST['idServicoProfissionais'])) {
    $idServicoProfissionais = intval($_POST['idServicoProfissionais']);

    // Construir a consulta diretamente
    $sql = "SELECT precoProfissional FROM servicoprofissionais WHERE idServicoProfissionais = $idServicoProfissionais";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode(['preco' => $row['precoProfissional']]); // Retorna o preço
    } else {
        echo json_encode(['preco' => 0]); // Caso não haja preço encontrado
    }

    // Fechar a conexão
    mysqli_close($conn);
}
?>
