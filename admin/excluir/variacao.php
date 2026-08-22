<?php
if (!isset($page)) exit;

$pdo->beginTransaction();

if (empty($id)) {
    echo "<script>mensagem('Variação inválida!', 'error');</script>";
    exit;
}

$sqlDelete = "DELETE FROM variacao_produto WHERE id = :id LIMIT 1";
$consultaDelete = $pdo->prepare($sqlDelete);
$consultaDelete->bindParam(":id", $id);

if ($consultaDelete->execute()) {
    $pdo->commit();
    echo "<script>mensagem('Variação excluída com sucesso!', 'success', 'listar/variacao');</script>";
} else {
    $pdo->rollBack();
    echo "<script>mensagem('Falha ao excluir variação!', 'error');</script>";
}
exit;