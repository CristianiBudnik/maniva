<?php
if (!isset($page)) exit;

$pdo->beginTransaction();

if (empty($id)) {
    echo "<script>mensagem('Produto inválido!', 'error');</script>";
    exit;
}

try {
    
    $sqlFoto = "SELECT imagem_url FROM produto WHERE id = :id LIMIT 1";
    $consultaFoto = $pdo->prepare($sqlFoto);
    $consultaFoto->bindParam(":id", $id);
    $consultaFoto->execute();
    $foto = $consultaFoto->fetchColumn();

    $sqlPC = "DELETE FROM produto_categoria WHERE produto_id = :id";
    $consultaPC = $pdo->prepare($sqlPC);
    $consultaPC->bindParam(":id", $id);
    $consultaPC->execute();

    $sqlDelete = "DELETE FROM produto WHERE id = :id LIMIT 1";
    $consultaDelete = $pdo->prepare($sqlDelete);
    $consultaDelete->bindParam(":id", $id);

    if ($consultaDelete->execute()) {
        $pdo->commit();

        if (!empty($foto) && file_exists("../arquivos/{$foto}")) {
            unlink("../arquivos/{$foto}");
        }

        echo "<script>mensagem('Produto excluído com sucesso!', 'success', 'listar/produto');</script>";
    } else {
        $pdo->rollBack();
        echo "<script>mensagem('Falha ao excluir produto!', 'error');</script>";
    }
} catch (Exception $e) {
    $pdo->rollBack();
    echo "<script>mensagem('Erro ao processar exclusão do produto!', 'error');</script>";
}
exit;
