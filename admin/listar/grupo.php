<?php
    if (!isset($page) || !isset($_SESSION["maniva"])) exit;
?>

<div class="container pt-5 pb-5">
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h2>Listagem de Grupos</h2>
            </div>
            <div class="float-end">
                <a href="cadastrar/grupo" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Novo Grupo
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="60px">ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th width="150px" class="text-center">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sqlListar = "SELECT id, nome, descricao FROM grupo ORDER BY nome";

                    $consultaListar = $pdo->prepare($sqlListar);
                    $consultaListar->execute();
                    $dadosListar = $consultaListar->fetchAll(PDO::FETCH_OBJ);

                    foreach ($dadosListar as $dados) {
                    ?>
                        <tr>
                            <td><?= $dados->id ?></td>
                            <td><strong><?= htmlspecialchars($dados->nome) ?></strong></td>
                            <td><?= strip_tags($dados->descricao) ?></td>
                            <td class="text-center">
                                <a href="cadastrar/grupo/<?= $dados->id ?>" class="btn btn-warning btn-sm d-flex justify-content-center align-items-center gap-2 mb-2" title="Editar">
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
                location.href = "excluir/grupo/" + id;
            }
        });
    }
</script>
