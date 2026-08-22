<?php
if (!isset($page)) exit;

$pdo->beginTransaction();

if (empty($id)) {
    echo "<script>mensagem('Grupo inválido!', 'error');</script>";
    exit;
}

$sqlCategoria = "SELECT id FROM categoria WHERE grupo_id = :id LIMIT 1";
$consultaCategoria = $pdo->prepare($sqlCategoria);
$consultaCategoria->bindParam(":id", $id);
$consultaCategoria->execute();
$dadosCategoria = $consultaCategoria->fetch(PDO::FETCH_OBJ);

if (!empty($dadosCategoria->id)) {
    $pdo->rollBack();
    echo "<script>mensagem('Não foi possível excluir esse grupo, existem categorias vinculadas!', 'error');</script>";
    exit;
}

$sqlDelete = "DELETE FROM grupo WHERE id = :id LIMIT 1";
$consultaDelete = $pdo->prepare($sqlDelete);
$consultaDelete->bindParam(":id", $id);

if ($consultaDelete->execute()) {
    $pdo->commit();
    echo "<script>mensagem('Grupo excluído com sucesso!', 'success', 'listar/grupo');</script>";
} else {
    $pdo->rollBack();
    echo "<script>mensagem('Falha ao excluir grupo!', 'error');</script>";
}
exit;