<?php
if (!isset($page)) exit;

if (empty($id)) {
    echo "<script>mensagem('Reclamação inválida!', 'error');</script>";
    exit;
}

$sqlUpdate = "UPDATE reclamacao SET status = 'resolvido' WHERE id = :id LIMIT 1";
$consultaUpdate = $pdo->prepare($sqlUpdate);
$consultaUpdate->bindParam(":id", $id);

if ($consultaUpdate->execute()) {
    echo "<script>mensagem('Marcado como resolvido!', 'success', 'listar/reclamacao');</script>";
} else {
    echo "<script>mensagem('Erro ao atualizar registro','error');</script>";
}
exit;