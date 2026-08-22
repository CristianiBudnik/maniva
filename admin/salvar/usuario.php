<?php

if (!isset($page))
    exit;

if ($_POST) {
    foreach ($_POST as $chave => $valor) {
        $$chave = $valor;
    }
    if (strlen($nome) < 5) {
        echo "<script>mensagem('Preencha o nome completo','error');</script>";
        exit;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>mensagem('E-mail inválido!','error');</script>";
        exit;
    } else {

        if (!validarCPF($cpf)) {
            echo "<script>mensagem('CPF inválido!','error');</script>";
            exit;
        }

        $datanascimento = dataUS($datanascimento);

        $salario = valor($salario);


        if (empty($id)) {

            $senha = password_hash($senha, PASSWORD_BCRYPT);

            $sql = "INSERT INTO usuario (nome, email, senha, cpf, salario, datanascimento, ativo) VALUES (:nome, :email, :senha, :cpf, :salario, :datanascimento, :ativo)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":nome", $nome);
            $consulta->bindParam(":email", $email);
            $consulta->bindParam(":senha", $senha);
            $consulta->bindParam(":cpf", $cpf);
            $consulta->bindParam(":salario", $salario);
            $consulta->bindParam(":datanascimento", $datanascimento);
            $consulta->bindParam(":ativo", $ativo);

        } else if (empty($senha)) {

            $sql = "update usuario set nome = :nome, email = :email, cpf = :cpf, salario = :salario, datanascimento = :datanascimento, ativo = :ativo where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":nome", $nome);
            $consulta->bindParam(":email", $email);
            $consulta->bindParam(":cpf", $cpf);
            $consulta->bindParam(":salario", $salario);
            $consulta->bindParam(":datanascimento", $datanascimento);
            $consulta->bindParam(":ativo", $ativo);
            $consulta->bindParam(":id", $id);

        } else {
            $senha = password_hash($senha, PASSWORD_BCRYPT);

            $sql = "update usuario set nome= :nome, email= :email, cpf= :cpf, salario= :salario, datanascimento= :datanascimento, ativo =:ativo, senha =:senha where id= :id";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":nome", $nome);
            $consulta->bindParam(":email", $email);
            $consulta->bindParam(":cpf", $cpf);
            $consulta->bindParam(":salario", $salario);
            $consulta->bindParam(":datanascimento", $datanascimento);
            $consulta->bindParam(":ativo", $ativo);
            $consulta->bindParam(":senha", $senha);
            $consulta->bindParam(":id", $id);
        }

        if ($consulta->execute()) {
            $msg = empty($id) ? "Usuário cadastrado com sucesso!" : "Usuário atualizado com sucesso!";
            echo "<script>mensagem('{$msg}','success','listar/usuario');</script>";
            exit;
        }
        echo "<script>mensagem('Ops! Erro ao cadastrar usuário!','error');</script>";
        exit;
    }
}