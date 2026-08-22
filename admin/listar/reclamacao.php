<?php
    if (!isset($page)) exit;
?>

<div class="container pt-5 pb-5">
    <div class="card">
        <div class="card-header">
            <h2>Reclamações e Elogios</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="60px">ID</th>
                        <th width="110px">Tipo</th>
                        <th>Nome</th>
                        <th>Produto</th>
                        <th>Mensagem</th>
                        <th width="120px">Status</th>
                        <th width="140px">Data</th>
                        <th width="180px" class="text-center">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sqlListar = "SELECT id, tipo, nome, email, produto, mensagem, status, data_envio
                                  FROM reclamacao
                                  ORDER BY data_envio DESC";

                    $consultaListar = $pdo->prepare($sqlListar);
                    $consultaListar->execute();
                    $dadosListar = $consultaListar->fetchAll(PDO::FETCH_OBJ);

                    foreach ($dadosListar as $dados) {
                        $badgeTipo = $dados->tipo === 'reclamacao'
                            ? '<span class="badge bg-danger">Reclamação</span>'
                            : '<span class="badge bg-success">Elogio</span>';

                        $badgeStatus = match ($dados->status) {
                            'resolvido' => '<span class="badge bg-success">Resolvido</span>',
                            'em_analise' => '<span class="badge bg-warning text-dark">Em análise</span>',
                            default => '<span class="badge bg-secondary">Pendente</span>',
                        };
                    ?>
                        <tr>
                            <td><?= $dados->id ?></td>
                            <td><?= $badgeTipo ?></td>
                            <td><strong><?= htmlspecialchars($dados->nome) ?></strong><br><small><?= htmlspecialchars($dados->email) ?></small></td>
                            <td><?= htmlspecialchars($dados->produto ?? '-') ?></td>
                            <td><?= htmlspecialchars(mb_strimwidth($dados->mensagem, 0, 80, '...')) ?></td>
                            <td><?= $badgeStatus ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($dados->data_envio)) ?></td>
                            <td class="text-center">
                                <?php if ($dados->status !== 'resolvido'): ?>
                                <a href="javascript:marcarResolvido(<?= $dados->id ?>)" class="btn btn-success btn-sm d-flex justify-content-center align-items-center gap-2 mb-2" title="Marcar como resolvido">
                                    <i class="bi bi-check-circle"></i> Resolver
                                </a>
                                <?php endif; ?>
                                <a href="javascript:excluir(<?= $dados->id ?>)" class="btn btn-danger btn-sm d-flex justify-content-center align-items-center gap-2" title="Excluir">
                                    <i class="bi bi-trash"></i> Excluir
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function marcarResolvido(id) {
        Swal.fire({
            title: "Marcar como resolvido?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Sim, marcar!",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = "marcar/reclamacao/" + id;
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
                location.href = "excluir/reclamacao/" + id;
            }
        });
    }
</script>