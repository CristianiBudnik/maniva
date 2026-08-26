<?php
if (!isset($page))
    exit;
?>


<link href="../src/css/style.css" rel="stylesheet">


<div class="dashboard-page">

    <header>
        <div class="row">
            <div class="d-flex">
                <img src="../img/manivinhaEscritorio.png" class="img-logo" alt="manivinha">
                <h1 class="dash-titulo"><strong>Dashboard <em class="text-warning">Maniva</em></strong></h1>
            </div>
        </div>
    </header>

    <div class="cards-grid text-center">
        <div class="card card-total">
            <div class="card-label">Total de Produtos</div>
            <div id="card-total" class="card-value">Carregando...</div>
            <br>
            <a href="listar/produto" class="btn-dash btn btn-primary">Ver Produtos</a>
        </div>
        <div class="card card-categoria">
            <div class="card-label">Categoria com mais produtos</div>
            <div id="card-categoria" class="card-value">Carregando...</div>
            <br>
            <a href="listar/categoria" class="btn-dash btn btn-warning">Ver Categorias</a>
        </div>
        <div class="card card-grupo">
            <div class="card-label">Grupo com mais produtos</div>
            <div id="card-grupo" class="card-value">Carregando...</div>
            <br>
            <a href="listar/grupo" class="btn-dash btn btn-success">Ver Grupos</a>
        </div>

    </div>
    <div class="tabela-container">
        <h2 class="tabela-titulo m-0 p-2">Lista de Produtos</h2>
        <div class="table-responsive">
            <table id="tabela-listagem-produtos"
                class="table table-bordered table-striped table-hover align-middle col-12 col-md-6">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Grupo</th>
                        <th>Categoria</th>
                        <th>Disponível</th>
                    </tr>
                </thead>
                <tbody id="tabela-produtos-body">

                </tbody>
            </table>
        </div>
    </div>
</div>