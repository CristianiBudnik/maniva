<?php
if (!isset($page)) exit;

if (empty($id)) {
    echo "<script>mensagem('Reclamação inválida!', 'error');</script>";
    exit;
}

$sqlDelete = "DELETE FROM reclamacao WHERE id = :id LIMIT 1";
$consultaDelete = $pdo->prepare($sqlDelete);
$consultaDelete->bindParam(":id", $id);

if ($consultaDelete->execute()) {
    echo "<script>mensagem('Registro excluído', 'success', 'listar/reclamacao');</script>";
} else {
    echo "<script>mensagem('Erro ao excluir Registro','error');</script>";
}
exit;