<?php

if (!isset($page)) exit;

if ($_POST) {
    $id = trim($_POST["id"] ?? NULL);
    $grupo_id = trim($_POST["grupo_id"] ?? NULL);
    $nome = trim($_POST["nome"] ?? NULL);
    $descricao = trim($_POST["descricao"] ?? NULL);

    

    // Validações básicas
    if (empty($grupo_id)) {
        echo "<script>mensagem('Selecione um grupo!', 'error');</script>";
        exit;
    }
    if (empty($nome)) {
        echo "<script>mensagem('Digite o nome da categoria!', 'error');</script>";
        exit;
    }

    if (empty($id)) {
        // Inserir nova categoria
        $sqlCadastro = "INSERT INTO categoria (grupo_id, nome, descricao) VALUES (:grupo_id, :nome, :descricao)";
        $consulta = $pdo->prepare($sqlCadastro);
        $consulta->bindParam(":grupo_id", $grupo_id);
        $consulta->bindParam(":nome", $nome);
        $consulta->bindParam(":descricao", $descricao);

    } else {
        // Atualizar categoria existente
        $sqlCadastro = "UPDATE categoria SET grupo_id = :grupo_id, nome = :nome, descricao = :descricao WHERE id = :id";
        $consulta = $pdo->prepare($sqlCadastro);
        $consulta->bindParam(":grupo_id", $grupo_id);
        $consulta->bindParam(":nome", $nome);
        $consulta->bindParam(":descricao", $descricao);
        $consulta->bindParam(":id", $id);
    }

    if ($consulta->execute()) {
        echo "<script>mensagem('Registro salvo com sucesso!', 'success', 'listar/categoria');</script>";
        exit;
    } else {
        echo "<script>mensagem('Falha ao salvar registro!', 'error');</script>";
        exit;
    }

} else {
    echo "<script>mensagem('Requisição inválida!', 'error');</script>";
    exit;
}
