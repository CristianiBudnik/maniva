<?php
    header('Content-Type: application/json');

    $id = $_GET['id'] ?? NULL;

    include '../config.php';

    $sqlProdutos = "SELECT * FROM produto where id = :id limit 1";
    $consultaProduto = $pdo->prepare($sqlProdutos);
    $consultaProduto->bindParam(":id", $id);
    $consultaProduto->execute();

    $produto = $consultaProduto->fetch(PDO::FETCH_OBJ);

    echo json_encode($produto);