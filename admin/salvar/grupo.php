<?php

if (!isset($page)) exit;

if ($_POST) {
    $id = trim($_POST["id"] ?? NULL);
    $nome = trim($_POST["nome"] ?? NULL);
    $descricao = trim($_POST["descricao"] ?? NULL);

    if (empty($nome)) {
        echo "<script>mensagem('Digite o nome do grupo!', 'error');</script>";
        exit;
    }

    if (empty($id)) {
        // Inserir novo grupo
        $sqlCadastro = "INSERT INTO grupo (nome, descricao) VALUES (:nome, :descricao)";
        $consulta = $pdo->prepare($sqlCadastro);
        $consulta->bindParam(":nome", $nome);
        $consulta->bindParam(":descricao", $descricao);

    } else {
        // Atualizar grupo existente
        $sqlCadastro = "UPDATE grupo SET nome = :nome, descricao = :descricao WHERE id = :id";
        $consulta = $pdo->prepare($sqlCadastro);
        $consulta->bindParam(":nome", $nome);
        $consulta->bindParam(":descricao", $descricao);
        $consulta->bindParam(":id", $id);
    }

    if ($consulta->execute()) {
        echo "<script>mensagem('Registro salvo com sucesso!', 'success', 'listar/grupo');</script>";
        exit;
    } else {
        echo "<script>mensagem('Falha ao salvar registro!', 'error');</script>";
        exit;
    }

} else {
    echo "<script>mensagem('Requisição inválida!', 'error');</script>";
    exit;
}
