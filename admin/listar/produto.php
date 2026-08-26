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
                        <th width="150px" class="text-center">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sqlListar = "SELECT 
                                    p.id,
                                    p.nome,
                                    p.descricao,
                                    p.imagem_url,
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
                        // Caminho da imagem ou imagem padrão
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
                            <td class="text-center">
                                <a href="cadastrar/produto/<?= $dados->id ?>" class="btn btn-warning btn-sm d-flex justify-content-center align-items-center gap-2 mb-2" title="Editar">
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
