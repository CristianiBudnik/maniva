<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

require_once '../config.php';

try {
    // 1. Indicadores da dashboard via Stored Procedure
    $stmtGeral = $pdo->query("CALL sp_dashboard_geral()");
    $kpis = $stmtGeral->fetch(PDO::FETCH_OBJ);
    $stmtGeral->closeCursor();

    // 2. Consulta dos produtos pela View Analítica
    $sqlProdutos = "SELECT id, nome, descricao, imagem_url, peso, tipo_embalagem, disponivel, categoria, grupo FROM vw_produtos_dashboard ORDER BY nome";
    $produtos = $pdo->query($sqlProdutos)->fetchAll(PDO::FETCH_OBJ);

    // 3. Consulta das categorias pela View Analítica
    $sqlCategorias = "SELECT id, nome FROM vw_categoria_dashboard ORDER BY nome";
    $categorias = $pdo->query($sqlCategorias)->fetchAll(PDO::FETCH_OBJ);

    // 4. Consulta dos grupos pela View Analítica
    $sqlGrupos = "SELECT id, nome FROM vw_grupo_dashboard ORDER BY nome";
    $grupos = $pdo->query($sqlGrupos)->fetchAll(PDO::FETCH_OBJ);

    echo json_encode([
        'totalProdutos' => (int) ($kpis->total_produtos ?? count($produtos)),
        'produtosDisponiveis' => (int) ($kpis->produtos_disponiveis ?? 0),
        'totalCategorias' => (int) ($kpis->total_categorias ?? count($categorias)),
        'totalGrupos' => (int) ($kpis->total_grupos ?? count($grupos)),
        'produtos' => $produtos,
        'categorias' => $categorias,
        'grupos' => $grupos
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'erro' => true,
        'mensagem' => $e->getMessage()
    ]);
}