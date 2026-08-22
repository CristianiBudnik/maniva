<?php
if (!isset($page)) exit;

$pdo->beginTransaction();

if (empty($id)) {
    echo "<script>mensagem('Produto inválido!', 'error');</script>";
    exit;
}

// tem variações vinculadas?

$sqlVariacao = "SELECT id FROM variacao_produto WHERE produto_id = :id LIMIT 1";
$consultaVariacao = $pdo->prepare($sqlVariacao);
$consultaVariacao->bindParam(":id", $id);
$consultaVariacao->execute();
$dadosVariacao = $consultaVariacao->fetch(PDO::FETCH_OBJ);

if (!empty($dadosVariacao->id)) {
    $pdo->rollBack();
    echo "<script>mensagem('Não foi possível excluir esse produto, existem variações vinculadas!', 'error');</script>";
    exit;
}

// Busca a imagem antes de excluir

$sqlFoto = "SELECT imagem_url FROM produto WHERE id = :id LIMIT 1";
$consultaFoto = $pdo->prepare($sqlFoto);
$consultaFoto->bindParam(":id", $id);
$consultaFoto->execute();
$foto = $consultaFoto->fetchColumn();

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
exit;
