<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

require_once '../config.php';

$totalProdutos = $pdo->query("SELECT COUNT(id) as total FROM produto")->fetch(PDO::FETCH_OBJ)->total;

$sqlProdutos = "SELECT id, nome, descricao, imagem_url, disponivel, categoria, grupo FROM vw_produtos_analitico ORDER BY nome";
$produtos = $pdo->query($sqlProdutos)->fetchAll(PDO::FETCH_OBJ);

echo json_encode([
    'totalProdutos' => (int) $totalProdutos,
    'produtos' => $produtos
]); 