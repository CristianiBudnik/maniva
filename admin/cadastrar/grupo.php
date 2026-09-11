<?php
if (!isset($page)) exit;

$nome = $descricao = "";

if (!empty($id)) {
    $sql = "SELECT * FROM grupo WHERE id = :id LIMIT 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id);
    $consulta->execute();
    $dados = $consulta->fetch(PDO::FETCH_OBJ);

    if ($dados) {
        $id = $dados->id;
        $nome = $dados->nome;
        $descricao = $dados->descricao;
    }
}
?>
<div class="container pt-5 pb-5">
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h2><?= empty($id) ? 'Cadastro' : 'Edição' ?> de Grupo</h2>
            </div>
            <div class="float-end">
                <a href="cadastrar/grupo" class="btn btn-success">Novo Grupo</a>
                <a href="listar/grupo" class="btn btn-warning">Listar Grupos</a>
            </div>
        </div>
        <div class="card-body">
            <form name="formCadastro" method="post" action="salvar/grupo" data-parsley-validate>
                <div class="row">
                    <div class="col-12 col-md-2">
                        <label for="id">ID:</label>
                        <input type="number" name="id" id="id" readonly class="form-control" value="<?= htmlspecialchars($id ?? '') ?>">
                    </div>
                    <div class="col-12 col-md-10">
                        <label for="nome">Nome do Grupo:</label>
                        <input type="text" name="nome" id="nome" class="form-control" required
                            data-parsley-required-message="Digite o nome do grupo" value="<?= htmlspecialchars($nome ?? '') ?>">
                    </div>
                    <div class="col-12 col-md-12 mt-3">
                        <label for="descricao">Descrição:</label>
                        <textarea name="descricao" id="descricao" class="form-control"><?= htmlspecialchars($descricao ?? '') ?></textarea>
                    </div>
                    <div class="col-12 col-md-12 mt-4">
                        <button type="submit" class="btn btn-success float-end">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#descricao').summernote({
            placeholder: 'Digite a descrição do grupo',
            tabsize: 2,
            height: 150
        });
    });
</script>
