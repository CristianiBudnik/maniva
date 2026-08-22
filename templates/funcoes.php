<?php
/**
 * ==========================================================================
 * Funções auxiliares do catálogo Maniva
 * ==========================================================================
 *
 * Estrutura do banco usada:
 *   grupo(id, nome, descricao)
 *   categoria(id, grupo_id, nome, descricao)
 *   produto(id, nome, descricao, imagem_url, disponivel)
 *   produto_categoria(produto_id, categoria_id)      -- N:N
 *   variacao_produto(id, produto_id, peso, disponivel)
 */

/**
 * Busca todos os grupos cadastrados (ex: Mandioca, Milho, Linha para Animais).
 * Usada na barra de filtro e para agrupar os produtos por seção.
 */
function buscarGrupos(PDO $pdo): array
{
    $stmt = $pdo->query("SELECT * FROM grupo ORDER BY nome");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Busca todos os produtos disponíveis que pertencem a alguma categoria
 * de um determinado grupo (via produto_categoria).
 */
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

/**
 * Busca as categorias às quais um produto pertence (relação N:N).
 * Usado para exibir a tag/etiqueta de categoria no card do produto.
 */
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

/**
 * Busca as variações (pesos/embalagens) disponíveis de um produto.
 */
function buscarVariacoesDoProduto(PDO $pdo, int $produtoId): array
{
    $sql = "SELECT *
            FROM variacao_produto
            WHERE produto_id = :produto_id
              AND disponivel = 1
            ORDER BY id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['produto_id' => $produtoId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Conta o total de produtos disponíveis no catálogo inteiro
 * (usado no contador "X produtos" da barra de filtro).
 */
function contarProdutosDisponiveis(PDO $pdo): int
{
    $stmt = $pdo->query("SELECT COUNT(*) FROM produto WHERE disponivel = 1");
    return (int) $stmt->fetchColumn();
}