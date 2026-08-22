<?php
require_once 'templates/funcoes.php';
$grupos = buscarGrupos($pdo);

// Cores de fallback para o "produto-icone" quando o produto não tem imagem_url cadastrada
$coresFallback = ['#f7f2e2', '#d99a5b', '#e9c98a', '#f4c21a', '#e0af0c'];

$totalProdutos = contarProdutosDisponiveis($pdo);
?>

<header class="produtos-header">
    <div class="container">
        <a href="index.php?page=home" class="voltar-link">← Voltar ao início</a>

        <div class="row align-items-end mt-3">
            <div class="col-lg-8">
                <span class="produtos-eyebrow">LINHA COMPLETA</span>
                <h1 class="produtos-title">Nossos <em>Produtos</em></h1>
            </div>
            <div class="col-lg-4">
                <p class="produtos-subtitle ms-lg-auto mb-0">Do campo direto à sua cozinha — mandioca e milho em todas
                    as formas.</p>
            </div>
        </div>
    </div>
</header>

<div class="filtro-bar">
    <div class="container d-flex flex-wrap align-items-center gap-3">
        <div class="filtro-tabs">

            <button type="button" class="filtro-tab active" data-filtro="todos"
                onclick="filtrarCategoria('todos', this)">Todos</button>

            <?php foreach ($grupos as $grupo): ?>
                <?php $slugGrupo = strtolower($grupo['nome']); ?>
                <button type="button" class="filtro-tab" data-filtro="<?= htmlspecialchars($slugGrupo) ?>"
                    onclick="filtrarCategoria('<?= htmlspecialchars($slugGrupo) ?>', this)">
                    <?= htmlspecialchars($grupo['nome']) ?>
                </button>
            <?php endforeach; ?>
        </div>

        <input type="text" id="buscaProduto" class="filtro-busca flex-grow-1" placeholder="Buscar produto..."
            oninput="filtrarBusca()" style="min-width:200px; max-width:520px;">

        <span class="filtro-contador ms-auto" id="contadorProdutos"><?= $totalProdutos ?> produtos</span>
    </div>
</div>

<main class="container pb-5">

    <?php foreach ($grupos as $grupo): ?>
        <?php
            $slugGrupo = strtolower($grupo['nome']);
            $produtos = buscarProdutosPorGrupo($pdo, $grupo['id']);
            if (empty($produtos)) continue; // não renderiza grupo sem produto disponível
        ?>
        <section class="grupo-secao" data-grupo="<?= htmlspecialchars($slugGrupo) ?>">
            <div class="grupo-titulo-wrap">
                <div>
                    <span class="grupo-label">GRUPO</span>
                    <h2 class="grupo-titulo"><?= htmlspecialchars($grupo['nome']) ?></h2>
                </div>
            </div>

            <div class="row g-4">
                <?php foreach ($produtos as $i => $produto): ?>
                    <?php
                        $categorias = buscarCategoriasDoProduto($pdo, (int) $produto['id']);
                        $categoriaNome = $categorias[0]['nome'] ?? $grupo['nome'];

                        $variacoes = buscarVariacoesDoProduto($pdo, (int) $produto['id']);
                        $tamanhos = array_map(fn($v) => $v['peso'], $variacoes);
                        $tamanhosTexto = implode(' | ', $tamanhos);

                        $temImagem = !empty($produto['imagem_url']);
                        $corFallback = $coresFallback[$i % count($coresFallback)];
                    ?>
                    <div class="col-md-6 col-lg-4 produto-item"
                        data-categoria="<?= htmlspecialchars($slugGrupo) ?>"
                        data-nome="<?= htmlspecialchars(strtolower($produto['nome'])) ?>">
                        <div class="produto-card">
                            <?php if ($temImagem): ?>
                                <div class="produto-icone"
                                    style="background-image:url('arquivos/<?= htmlspecialchars($produto['imagem_url']) ?>'); background-size:cover; background-position:center;">
                                </div>
                            <?php else: ?>
                                <div class="produto-icone" style="background:<?= $corFallback ?>;"></div>
                            <?php endif; ?>

                            <span class="produto-categoria"><?= htmlspecialchars(strtoupper($categoriaNome)) ?></span>
                            <h3 class="produto-nome"><?= htmlspecialchars($produto['nome']) ?></h3>
                            <p class="produto-desc"><?= htmlspecialchars($produto['descricao']) ?></p>

                            <div class="produto-rodape">
                                <span class="produto-tamanho"><?= htmlspecialchars($tamanhosTexto) ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endforeach; ?>

    <p class="text-center py-5 mb-0" id="semResultados" style="display:none; color:var(--texto-claro);">
        Nenhum produto encontrado para essa busca.
    </p>

</main>