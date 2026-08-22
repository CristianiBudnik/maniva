<?php
if (!isset($page) || !isset($_SESSION["maniva"])) exit;
?>

<div class="container pt-5 pb-5">
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h2>Listagem de Usuários</h2>
            </div>
            <div class="float-end">
                <a href="cadastrar/usuario" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Novo Usuário
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="60px">ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>CPF</th>
                        <th>Nascimento</th>
                        <th>Salário</th>
                        <th width="80px" class="text-center">Ativo</th>
                        <th width="150px" class="text-center">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sqlListar = "SELECT id, nome, email, cpf, datanascimento, salario, ativo
                                  FROM usuario
                                  ORDER BY nome";

                    $consultaListar = $pdo->prepare($sqlListar);
                    $consultaListar->execute();
                    $dadosListar = $consultaListar->fetchAll(PDO::FETCH_OBJ);

                    foreach ($dadosListar as $dados) {
                        $nascimento = !empty($dados->datanascimento)
                            ? date('d/m/Y', strtotime($dados->datanascimento))
                            : '—';
                        $salario = !empty($dados->salario)
                            ? 'R$ ' . number_format($dados->salario, 2, ',', '.')
                            : '—';
                    ?>
                        <tr>
                            <td><?= $dados->id ?></td>
                            <td><strong><?= htmlspecialchars($dados->nome) ?></strong></td>
                            <td><?= htmlspecialchars($dados->email) ?></td>
                            <td><?= htmlspecialchars($dados->cpf) ?></td>
                            <td><?= $nascimento ?></td>
                            <td><?= $salario ?></td>
                            <td class="text-center">
                                <?php if ($dados->ativo === 'Sim'): ?>
                                    <span class="badge bg-success">Sim</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Não</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="cadastrar/usuario/<?= $dados->id ?>" class="btn btn-warning btn-sm d-flex justify-content-center align-items-center gap-2 mb-2" title="Editar">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>
                                <?php if ($dados->ativo === 'Sim'): ?>
                                    <a href="javascript:inativar(<?= $dados->id ?>)" class="btn btn-danger btn-sm d-flex justify-content-center align-items-center gap-2" title="Inativar">
                                        <i class="bi bi-trash"></i> Inativar
                                    </a>
                                <?php else: ?>
                                    <a href="javascript:ativar(<?= $dados->id ?>)" class="btn btn-success btn-sm d-flex justify-content-center align-items-center gap-2" title="Ativar">
                                        <i class="bi bi-check"></i> Ativar
                                    </a>
                                <?php endif; ?>
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
    function inativar(id) {
        Swal.fire({
            title: "Deseja realmente inativar?",
            text: "Esta ação não poderá ser desfeita!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sim, inativar!",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = "excluir/usuario/" + id;
            }
        });
    }

    function ativar(id) {
        Swal.fire({
            title: "Deseja realmente ativar?",
            text: "Esta ação não poderá ser desfeita!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sim, ativar!",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = "excluir/usuario/" + id;
            }
        });
    }
</script>
