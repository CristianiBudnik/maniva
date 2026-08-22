<?php
    if (!isset($page)) exit;
?>

<div class="container">
    <div class="card mt-5 mb-5 shadow">
        <div class="card-header">
            <h2>Dashboard:</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-4 text-center shadow">
                    <?php
                        $sqlCategoria = "select count(id) conta from categoria limit 1";
                        $consultaCategoria = $pdo->prepare($sqlCategoria);
                        $consultaCategoria->execute();

                        $categorias = $consultaCategoria->fetch(PDO::FETCH_OBJ)->conta;
                    ?>
                    <div class="alert alert-info text-center p-4">
                        <h2>Categorias</h2>
                        <p>Temos <?=$categorias ?> categorias cadastradas!</p>
                        <a href="listar/categoria" class="btn btn-primary">Ver Categorias</a>
                    </div>
                </div>
                <div class="col-12 col-md-4 text-center shadow">
                    <?php
                        $sqlProdutos = "select count(id) conta from produto limit 1";
                        $consultaProdutos = $pdo->prepare($sqlProdutos);
                        $consultaProdutos->execute();

                        $produtos = $consultaProdutos->fetch(PDO::FETCH_OBJ)->conta;
                    ?>
                    <div class="alert alert-warning text-center p-4">
                        <h2>Produtos</h2>
                        <p>Temos <span id="card-total-produtos"><?=$produtos ?></span> produtos cadastrados (<span id="card-produtos-ativos">carregando...</span>)!</p>
                        <a href="listar/produto" class="btn btn-warning">Ver Produtos</a>
                    </div>
                </div>
                <div class="col-12 col-md-4 text-center shadow">
                    <?php
                    $sqlGrupo = "select count(id) conta from grupo limit 1";
                    $consultaGrupo = $pdo->prepare($sqlGrupo);
                    $consultaGrupo->execute();
                    $grupos = $consultaGrupo->fetch(PDO::FETCH_OBJ)->conta;
                    ?>
                    <div class="alert alert-success text-center p-4">
                        <h2>Grupos</h2>
                        <p>Temos <?=$grupos ?> grupos cadastrados!</p>
                        <a href="listar/grupo" class="btn btn-success">Ver Grupos</a>
                    </div>
                </div>
            </div>

            <!-- Tabela Carregada Dinamicamente via TypeScript / API -->
            <div class="mt-4">
                <h4 class="mb-3">Produtos em Destaque</h4>
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th width="80px">ID</th>
                            <th>Produto</th>
                            <th>Categoria</th>
                            <th width="150px" class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody id="tabela-produtos-body">
                        <tr>
                            <td colspan="4" class="text-center">Carregando produtos via TypeScript...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>