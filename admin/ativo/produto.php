<?php
if (!isset($page)) exit;

if (empty($id)) {
    echo "<script>mensagem('Produto inválido!', 'error');</script>";
    exit;
}

$pdo->beginTransaction();

try {
    // Alterna o status: se 1 vira 0 (desativa), se 0 vira 1 (ativa)
    $sql = "UPDATE produto SET disponivel = IF(disponivel = 1, 0, 1) WHERE id = :id LIMIT 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id);

    if ($consulta->execute()) {
        $pdo->commit();
        echo "<script>mensagem('Status do produto alterado com sucesso!', 'success', 'listar/produto');</script>";
    } else {
        $pdo->rollBack();
        echo "<script>mensagem('Erro ao alterar status do produto!', 'error');</script>";
    }
} catch (Exception $e) {
    $pdo->rollBack();
    echo "<script>mensagem('Falha no servidor ao atualizar o status!', 'error');</script>";
}
exit;
