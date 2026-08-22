<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    include '../config.php';

    $sqlProdutos = "SELECT id, nome, descricao, imagem_url, disponivel, categoria FROM vw_produtos_analitico ORDER BY nome";
    $consultaProduto = $pdo->prepare($sqlProdutos);
    $consultaProduto->execute();

    $produtos = $consultaProduto->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($produtos, JSON_UNESCAPED_UNICODE);
?>