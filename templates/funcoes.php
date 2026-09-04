<?php
function buscarGrupos(PDO $pdo): array
{
    $stmt = $pdo->query("SELECT * FROM grupo ORDER BY nome");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function buscarProdutosPorGrupo(PDO $pdo, int $grupoId): array
{
    $sql = "SELECT DISTINCT p.*
            FROM produto p
            INNER JOIN produto_categoria pc ON pc.produto_id = p.id
            INNER JOIN categoria c ON c.id = pc.categoria_id
            WHERE c.grupo_id = :grupo_id
              AND p.disponivel = 1
            ORDER BY p.nome";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['grupo_id' => $grupoId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function buscarCategoriasDoProduto(PDO $pdo, int $produtoId): array
{
    $sql = "SELECT c.*
            FROM categoria c
            INNER JOIN produto_categoria pc ON pc.categoria_id = c.id
            WHERE pc.produto_id = :produto_id
            ORDER BY c.nome";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['produto_id' => $produtoId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function buscarVariacoesDoProduto(PDO $pdo, int $produtoId): array
{
    $sql = "SELECT id, nome, peso, tipo_embalagem
            FROM produto
            WHERE id = :produto_id
              AND disponivel = 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['produto_id' => $produtoId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function contarProdutosDisponiveis(PDO $pdo): int
{
    $stmt = $pdo->query("SELECT COUNT(*) FROM produto WHERE disponivel = 1");
    return (int) $stmt->fetchColumn();
}