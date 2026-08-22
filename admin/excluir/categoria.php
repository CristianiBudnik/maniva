<?php
if (!isset($page)) exit;

$pdo->beginTransaction();

if (empty($id)) {
    echo "<script>mensagem('Categoria inválida!', 'error');</script>";
    exit;
}

$sqlCategoria = "SELECT produto_id FROM produto_categoria WHERE categoria_id = :id LIMIT 1";
$consultaCategoria = $pdo->prepare($sqlCategoria);
$consultaCategoria->bindParam(":id", $id);
$consultaCategoria->execute();
$dadosCategoria = $consultaCategoria->fetch(PDO::FETCH_OBJ);

if (!empty($dadosCategoria->produto_id)) {
    $pdo->rollBack();
    echo "<script>mensagem('Não foi possível excluir essa categoria, existem produtos vinculados!', 'error');</script>";
    exit;
}

$sqlDelete = "DELETE FROM categoria WHERE id = :id LIMIT 1";
$consultaDelete = $pdo->prepare($sqlDelete);
$consultaDelete->bindParam(":id", $id);

if ($consultaDelete->execute()) {
    $pdo->commit();
    echo "<script>mensagem('Registro excluído', 'success', 'listar/categoria');</script>";
} else {
    $pdo->rollBack();
    echo "<script>mensagem('Erro ao excluir Registro','error');</script>";
}
exit;