<?php
if (!isset($page)) exit;

$id = intval($id ?? 0);

if ($id <= 0) {
    echo "<script>mensagem('ID inválido!', 'error');</script>";
    exit;
}

$sqlStatus = "SELECT ativo FROM usuario WHERE id = :id LIMIT 1";
$consultaStatus = $pdo->prepare($sqlStatus);
$consultaStatus->bindParam(":id", $id);
$consultaStatus->execute();
$statusAtual = $consultaStatus->fetchColumn();

if ($statusAtual === false) {
    echo "<script>mensagem('Usuário não encontrado!', 'error');</script>";
    exit;
}

$novoStatus = ($statusAtual === 'Sim') ? 'Não' : 'Sim';
$mensagem = ($novoStatus === 'Sim') ? 'Usuário ativado com sucesso!' : 'Usuário inativado com sucesso!';

$sql = "UPDATE usuario SET ativo = :novoStatus WHERE id = :id";
$consulta = $pdo->prepare($sql);
$consulta->bindParam(":novoStatus", $novoStatus);
$consulta->bindParam(":id", $id);


if ($consulta->execute()){
    echo "<script>mensagem('{$mensagem}', 'success', 'listar/usuario');</script>";
}
 else {
    echo "<script>mensagem('Falha ao atualizar status do usuário!', 'error', 'listar/usuario');</script>";
}
exit;
?>
