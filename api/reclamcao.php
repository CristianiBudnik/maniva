<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    include '../config.php';

    $dados = json_decode(file_get_contents('php://input'), true);

    $tipo = $dados['tipo'] ?? 'reclamacao';
    $nome = trim($dados['nome'] ?? '');
    $email = trim($dados['email'] ?? '');
    $telefone = trim($dados['telefone'] ?? '');
    $produto = trim($dados['produto'] ?? '');
    $dataFabricacao = $dados['data_fabricacao'] ?? '';
    $lote = trim($dados['lote'] ?? '');
    $mensagem = trim($dados['mensagem'] ?? '');

    if ($nome === '' || $email === '' || $mensagem === '') {
        http_response_code(422);
        echo json_encode(['sucesso' => false, 'erro' => 'Nome, e-mail e mensagem são obrigatórios.']);
        exit;
    }

    if ($tipo === 'reclamacao' && ($dataFabricacao === '' || $lote === '')) {
        http_response_code(422);
        echo json_encode(['sucesso' => false, 'erro' => 'Data de fabricação e lote são obrigatórios para reclamações.']);
        exit;
    }

    $sql = "INSERT INTO reclamacao (tipo, nome, email, telefone, produto, data_fabricacao, lote, mensagem)
            VALUES (:tipo, :nome, :email, :telefone, :produto, :data_fabricacao, :lote, :mensagem)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':tipo' => $tipo,
        ':nome' => $nome,
        ':email' => $email,
        ':telefone' => $telefone !== '' ? $telefone : null,
        ':produto' => $produto !== '' ? $produto : null,
        ':data_fabricacao' => $dataFabricacao !== '' ? $dataFabricacao : null,
        ':lote' => $lote !== '' ? $lote : null,
        ':mensagem' => $mensagem
    ]);

    echo json_encode(['sucesso' => true]);