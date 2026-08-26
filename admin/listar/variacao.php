<?php
    if (!isset($page)) exit;
?>

<div class="container pt-5 pb-5">
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h2>Listagem de Variações</h2>
            </div>
            <div class="float-end">
                <a href="cadastrar/variacao" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Nova Variação
                </a>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle col-12 col-md-6">
                <thead class="table-light">
                    <tr>
                        <th width="60px">ID</th>
                        <th>Produto</th>
                        <th>Variação / Peso</th>
                        <th width="100px" class="text-center">Disponível</th>
                        <th width="150px" class="text-center">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sqlListar = "SELECT v.id, v.peso, v.disponivel, p.nome AS produto
                                  FROM variacao_produto v
                                  LEFT JOIN produto p ON (p.id = v.produto_id)
                                  ORDER BY p.nome, v.peso";

                    $consultaListar = $pdo->prepare($sqlListar);
                    $consultaListar->execute();
                    $dadosListar = $consultaListar->fetchAll(PDO::FETCH_OBJ);

                    foreach ($dadosListar as $dados) {
                    ?>
                        <tr>
                            <td><?= $dados->id ?></td>
                            <td><strong><?= htmlspecialchars($dados->produto) ?></strong></td>
                            <td><?= htmlspecialchars($dados->peso) ?></td>
                            <td class="text-center">
                                <?php if ($dados->disponivel == 1): ?>
                                    <span class="badge bg-success">Sim</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Não</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="cadastrar/variacao/<?= $dados->id ?>" class="btn btn-warning btn-sm d-flex justify-content-center align-items-center gap-2 mb-2" title="Editar">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>
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
                location.href = "excluir/variacao/" + id;
            }
        });
    }
</script>
