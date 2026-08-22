<?php

if (!isset($page) || !isset($_SESSION["maniva"])) exit;

if ($_POST) {
    $id = trim($_POST["id"] ?? NULL);
    $produto_id = trim($_POST["produto_id"] ?? NULL);
    $peso = trim($_POST["peso"] ?? NULL);
    $disponivel = trim($_POST["disponivel"] ?? 1);

    if (empty($produto_id)) {
        echo "<script>mensagem('Selecione um produto!', 'error');</script>";
        exit;
    }
    if (empty($peso)) {
        echo "<script>mensagem('Digite o peso/variação!', 'error');</script>";
        exit;
    }

    if (empty($id)) {
        // Inserir nova variação
        $sqlCadastro = "INSERT INTO variacao_produto (produto_id, peso, disponivel) VALUES (:produto_id, :peso, :disponivel)";
        $consulta = $pdo->prepare($sqlCadastro);
        $consulta->bindParam(":produto_id", $produto_id);
        $consulta->bindParam(":peso", $peso);
        $consulta->bindParam(":disponivel", $disponivel);

    } else {
        // Atualizar variação existente
        $sqlCadastro = "UPDATE variacao_produto SET produto_id = :produto_id, peso = :peso, disponivel = :disponivel WHERE id = :id";
        $consulta = $pdo->prepare($sqlCadastro);
        $consulta->bindParam(":produto_id", $produto_id);
        $consulta->bindParam(":peso", $peso);
        $consulta->bindParam(":disponivel", $disponivel);
        $consulta->bindParam(":id", $id);
    }

    if ($consulta->execute()) {
        echo "<script>mensagem('Registro salvo com sucesso!', 'success', 'listar/variacao');</script>";
        exit;
    } else {
        echo "<script>mensagem('Falha ao salvar registro!', 'error');</script>";
        exit;
    }

} else {
    echo "<script>mensagem('Requisição inválida!', 'error');</script>";
    exit;
}
