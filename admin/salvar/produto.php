<?php

    if (!isset($page)) exit;

    if ($_POST) {

        $id = trim($_POST["id"] ?? NULL);
        $nome = trim($_POST["nome"] ?? NULL);
        $descricao = trim($_POST["descricao"] ?? NULL);
        $peso = trim($_POST["peso"] ?? NULL);
        $tipo_embalagem = trim($_POST["tipo_embalagem"] ?? NULL);
        $categoria_id = trim($_POST["categoria_id"] ?? NULL);
        $ativo = trim($_POST["ativo"] ?? 1);

        $arquivo = $_SESSION["maniva"]["id"] . "_" . time();

        if ((!empty($_FILES["imagem_url"]["name"])) && (!move_uploaded_file($_FILES["imagem_url"]["tmp_name"], "../arquivos/{$arquivo}.jpg"))) {
            echo "<script>mensagem('Falha ao enviar arquivo', 'error');</script>";
            exit;
        } 
        
        if (!empty($_FILES["imagem_url"]["name"])) {
            $origem = "../arquivos/{$arquivo}.jpg";
            redimensionarImagem($origem, 1200, 1200, 100);
        }

        $arquivo = "{$arquivo}.jpg";

        if (empty($id)) {
            if (empty($_FILES["imagem_url"]["name"])) {
                echo "<script>mensagem('Selecione uma Imagem!', 'error');</script>";
                exit;
            }

            // Inserir produto com peso e tipo_embalagem
            $sqlCadastro = "INSERT INTO produto (nome, descricao, imagem_url, peso, tipo_embalagem, disponivel) VALUES (:nome, :descricao, :imagem_url, :peso, :tipo_embalagem, :disponivel)";
            $consultaCadastro = $pdo->prepare($sqlCadastro);
            $consultaCadastro->bindParam(":nome", $nome);
            $consultaCadastro->bindParam(":descricao", $descricao);
            $consultaCadastro->bindParam(":imagem_url", $arquivo);
            $consultaCadastro->bindParam(":peso", $peso);
            $consultaCadastro->bindParam(":tipo_embalagem", $tipo_embalagem);
            $consultaCadastro->bindParam(":disponivel", $ativo);

            if ($consultaCadastro->execute()) {
                $produtoId = $pdo->lastInsertId();

                if (!empty($categoria_id)) {
                    $sqlPC = "INSERT INTO produto_categoria (produto_id, categoria_id) VALUES (:produto_id, :categoria_id)";
                    $consultaPC = $pdo->prepare($sqlPC);
                    $consultaPC->bindParam(":produto_id", $produtoId);
                    $consultaPC->bindParam(":categoria_id", $categoria_id);
                    $consultaPC->execute();
                }

                echo "<script>mensagem('Registro salvo com sucesso!', 'success', 'listar/produto');</script>";
                exit;
            } else {
                echo "<script>mensagem('Falha ao Salvar Registro!', 'error');</script>";
                exit;
            }

        } else if (empty($_FILES["imagem_url"]["name"])) {
            // Atualizar sem imagem
            $sqlCadastro = "UPDATE produto SET nome = :nome, descricao = :descricao, peso = :peso, tipo_embalagem = :tipo_embalagem, disponivel = :disponivel WHERE id = :id";
            $consultaCadastro = $pdo->prepare($sqlCadastro);
            $consultaCadastro->bindParam(":nome", $nome);
            $consultaCadastro->bindParam(":descricao", $descricao);
            $consultaCadastro->bindParam(":peso", $peso);
            $consultaCadastro->bindParam(":tipo_embalagem", $tipo_embalagem);
            $consultaCadastro->bindParam(":disponivel", $ativo);
            $consultaCadastro->bindParam(":id", $id);

            if ($consultaCadastro->execute()) {
                if (!empty($categoria_id)) {
                    $sqlDel = "DELETE FROM produto_categoria WHERE produto_id = :id";
                    $cDel = $pdo->prepare($sqlDel);
                    $cDel->bindParam(":id", $id);
                    $cDel->execute();

                    $sqlPC = "INSERT INTO produto_categoria (produto_id, categoria_id) VALUES (:id, :categoria_id)";
                    $consultaPC = $pdo->prepare($sqlPC);
                    $consultaPC->bindParam(":id", $id);
                    $consultaPC->bindParam(":categoria_id", $categoria_id);
                    $consultaPC->execute();
                }

                echo "<script>mensagem('Registro atualizado com sucesso!', 'success', 'listar/produto');</script>";
                exit;
            } else {
                echo "<script>mensagem('Falha ao Salvar Registro!', 'error');</script>";
                exit;
            }

        } else {
            // Atualizar com nova imagem
            $sqlCadastro = "UPDATE produto SET nome = :nome, descricao = :descricao, imagem_url = :imagem_url, peso = :peso, tipo_embalagem = :tipo_embalagem, disponivel = :disponivel WHERE id = :id";
            $consultaCadastro = $pdo->prepare($sqlCadastro);
            $consultaCadastro->bindParam(":nome", $nome);
            $consultaCadastro->bindParam(":descricao", $descricao);
            $consultaCadastro->bindParam(":imagem_url", $arquivo);
            $consultaCadastro->bindParam(":peso", $peso);
            $consultaCadastro->bindParam(":tipo_embalagem", $tipo_embalagem);
            $consultaCadastro->bindParam(":disponivel", $ativo);
            $consultaCadastro->bindParam(":id", $id);

            if ($consultaCadastro->execute()) {
                if (!empty($categoria_id)) {
                    $sqlDel = "DELETE FROM produto_categoria WHERE produto_id = :id";
                    $cDel = $pdo->prepare($sqlDel);
                    $cDel->bindParam(":id", $id);
                    $cDel->execute();

                    $sqlPC = "INSERT INTO produto_categoria (produto_id, categoria_id) VALUES (:id, :categoria_id)";
                    $consultaPC = $pdo->prepare($sqlPC);
                    $consultaPC->bindParam(":id", $id);
                    $consultaPC->bindParam(":categoria_id", $categoria_id);
                    $consultaPC->execute();
                }

                echo "<script>mensagem('Registro atualizado com sucesso!', 'success', 'listar/produto');</script>";
                exit;
            } else {
                echo "<script>mensagem('Falha ao Salvar Registro!', 'error');</script>";
                exit;
            }
        }
    }