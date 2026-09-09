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
            <div class="btn btn-container d-flex align-items-center gap-2">
                <a href="cadastrar/produto" class="btn btn-primary">Cadastrar Produto</a>
                <a href="cadastrar/categoria" class="btn btn-warning">Cadastrar Categoria</a>
                <a href="cadastrar/grupo" class="btn btn-success">Cadastrar Grupo</a>
            </div>
        </div>
    </header>
    <br>
    <div class="cards-grid text-center">
        <div class="card card-total">
            <div class="card-label">Total de Produtos</div>
            <div id="card-total" class="card-value">Carregando...</div>
        </div>
        <div class="card card-categoria">
            <div class="card-label">Total de Categorias</div>
            <div id="card-categoria" class="card-value">Carregando...</div>
        </div>
        <div class="card card-grupo">
            <div class="card-label">Total de Grupos</div>
            <div id="card-grupo" class="card-value">Carregando...</div>
        </div>
        <div class="card card-1kg-papel-plastico">
            <div class="card-label">Produtos disponiveis</div>
            <div id="card-produto-disponivel" class="card-value">Carregando...</div>
        </div>
        <div class="card card-destaque">
            <div class="card-label">Categoria com mais produtos</div>
            <div id="card-categoria-destaque" class="card-value">Carregando...</div>
        </div>
    </div>
    <br>
    <div class="accordion" id="accordionDashboard">
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading-produtos">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-produtos" aria-expanded="false" aria-controls="collapse-produtos">
                    Lista de Produtos
                </button>
            </h2>
            <div id="collapse-produtos" class="accordion-collapse collapse" aria-labelledby="heading-produtos"
                data-bs-parent="#accordionDashboard">
                <div class="accordion-body p-0">
                    <div class="p-3">
                        <input type="text" id="filtro-busca" class="form-control form-control-sm"
                            placeholder="Buscar por nome ou descrição...">
                    </div>
                    <div class="table-responsive">
                        <table id="tabela-listagem-produtos"
                            class="table table-bordered table-striped table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Produto</th>
                                    <th>Grupo</th>
                                    <th>Categoria</th>
                                    <th>Disponível</th>
                                </tr>
                            </thead>
                            <tbody id="tabela-produtos-body"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading-categorias">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-categorias" aria-expanded="false" aria-controls="collapse-categorias">
                    Lista de Categorias
                </button>
            </h2>
            <div id="collapse-categorias" class="accordion-collapse collapse" aria-labelledby="heading-categorias"
                data-bs-parent="#accordionDashboard">
                <div class="accordion-body p-0">
                    <div class="table-responsive">
                        <table id="tabela-listagem-categorias"
                            class="table table-bordered table-striped table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Categoria</th>
                                </tr>
                            </thead>
                            <tbody id="tabela-categorias-body"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading-grupos">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-grupos" aria-expanded="false" aria-controls="collapse-grupos">
                    Lista de Grupos
                </button>
            </h2>
            <div id="collapse-grupos" class="accordion-collapse collapse" aria-labelledby="heading-grupos"
                data-bs-parent="#accordionDashboard">
                <div class="accordion-body p-0">
                    <div class="table-responsive">
                        <table id="tabela-listagem-grupos"
                            class="table table-bordered table-striped table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Grupo</th>
                                </tr>
                            </thead>
                            <tbody id="tabela-grupos-body"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>