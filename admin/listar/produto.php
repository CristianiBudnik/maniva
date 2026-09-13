<?php
    if (!isset($page)) exit;
?>

<div class="container pt-5 pb-5">
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h2>Listagem de Produtos</h2>
            </div>
            <div class="float-end">
                <a href="cadastrar/produto" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Novo Produto
                </a>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle col-12 col-md-6">
                <thead class="table-light">
                    <tr>
                        <th width="80px">Imagem</th>
                        <th width="60px">ID</th>
                        <th>Nome</th>
                        <th>Grupo</th>
                        <th>Categoria</th>
                        <th>Descrição</th>
                        <th>Peso</th>
                        <th width="100px" class="text-center">Status</th>
                        <th width="150px" class="text-center">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sqlListar = "SELECT 
                                    p.id,
                                    p.nome,
                                    p.descricao,
                                    p.peso,
                                    p.imagem_url,
                                    p.disponivel,
                                    c.nome AS categoria,
                                    g.nome AS grupo
                                  FROM produto p
                                  INNER JOIN produto_categoria pc ON (pc.produto_id = p.id)
                                  INNER JOIN categoria c ON (c.id = pc.categoria_id)
                                  INNER JOIN grupo g ON (g.id = c.grupo_id)
                                  ORDER BY p.id DESC";

                    $consultaListar = $pdo->prepare($sqlListar);
                    $consultaListar->execute();

                    $dadosListar = $consultaListar->fetchAll(PDO::FETCH_OBJ);

                    foreach ($dadosListar as $dados) {
                        
                        $foto = !empty($dados->imagem_url) ? "../arquivos/{$dados->imagem_url}" : "../img/sem-foto.png";
                    ?>
                        <tr>
                            <td class="text-center">
                                <img src="<?= $foto ?>" alt="<?= htmlspecialchars($dados->nome) ?>" width="50px" class="rounded">
                            </td>
                            <td><?= $dados->id ?></td>
                            <td><strong><?= htmlspecialchars($dados->nome) ?></strong></td>
                            <td><?= htmlspecialchars($dados->grupo) ?></td>
                            <td><?= htmlspecialchars($dados->categoria) ?></td>
                            <td><?= strip_tags($dados->descricao) ?></td>
                            <td><?= htmlspecialchars($dados->peso) ?></td>
                            <td class="text-center">
                                <?php if ($dados->disponivel == 1): ?>
                                    <span class="badge bg-success">Disponível</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Indisponível</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="cadastrar/produto/<?= $dados->id ?>" class="btn btn-warning btn-sm d-flex justify-content-center align-items-center gap-2 mb-2" title="Editar">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>
                                <?php if ($dados->disponivel == 1): ?>
                                    <a href="javascript:alterarStatus(<?= $dados->id ?>, 'desativar')" class="btn btn-outline-secondary btn-sm d-flex justify-content-center align-items-center gap-2 mb-2" title="Desativar Produto">
                                        <i class="bi bi-slash-circle"></i> Desativar
                                    </a>
                                <?php else: ?>
                                    <a href="javascript:alterarStatus(<?= $dados->id ?>, 'ativar')" class="btn btn-outline-success btn-sm d-flex justify-content-center align-items-center gap-2 mb-2" title="Ativar Produto">
                                        <i class="bi bi-check-circle"></i> Ativar
                                    </a>
                                <?php endif; ?>
                                <a href="javascript:excluir(<?= $dados->id ?>)" class="btn btn-danger btn-sm d-flex justify-content-center align-items-center gap-2" title="Excluir">
                                    <i class="bi bi-trash"></i> Excluir
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function alterarStatus(id, acao) {
        const textoAcao = acao === 'desativar' ? 'desativar este produto' : 'ativar este produto';
        const textoBotao = acao === 'desativar' ? 'Sim, desativar!' : 'Sim, ativar!';
        const corBotao = acao === 'desativar' ? '#6c757d' : '#198754';

        Swal.fire({
            title: `Deseja realmente ${textoAcao}?`,
            text: acao === 'desativar' ? 'O produto ficará indisponível para exibição.' : 'O produto voltará a ficar disponível.',
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: corBotao,
            cancelButtonColor: "#3085d6",
            confirmButtonText: textoBotao,
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = "ativo/produto/" + id;
            }
        });
    }

    function excluir(id) {
        Swal.fire({
            title: "Deseja realmente excluir?",
            text: "Esta ação não poderá ser desfeita!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sim, excluir!",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = "excluir/produto/" + id;
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $(".table").DataTable({
            "language": {
                "lengthMenu": "Exibindo _MENU_ registros por página",
                "zeroRecords": "Nenhum registro encontrado",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro encontrado",
                "infoFiltered": "(filtrado de _MAX_ registros)",
                "loadingRecords": "Carregando...",
                "processing": "Processando...",
                "search": "Pesquisar:",
                "paginate": {
                    "first": "Primeira",
                    "last": "Última",
                    "next": "Próxima",
                    "previous": "Anterior"
                }
            }
        });
    }) 
</script>
