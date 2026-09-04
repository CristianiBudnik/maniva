<?php
    if (!isset($page)) exit;

    $nome = $descricao = "";
    $grupo_id_selecionado = "";

    if (!empty($id)) {
        $sql = "SELECT * FROM categoria WHERE id = :id LIMIT 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        $categoria = $consulta->fetch(PDO::FETCH_OBJ);

        if ($categoria) {
            $nome               = $categoria->nome;
            $descricao          = $categoria->descricao;
            $grupo_id_selecionado = $categoria->grupo_id;
        }
    }
?>
<div class="container pt-5 pb-5">
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h2 class="titulo-categoria d-flex align-items-center">Cadastro de Categoria</h2>
            </div>
            <div class="float-end">
                <a href="cadastrar/categoria" class="btn btn-success">
                    Nova Categoria</a>
                <a href="listar/categoria" class="btn btn-warning">
                    Listar Categorias
                </a>
            </div>
        </div>
        <div class="card-body">
            <form name="formCadastro" method="post" action="salvar/categoria" data-parsley-validate>
                <div class="row">
                    <div class="col-12 col-md-1">
                        <label for="id">ID:</label>
                        <input type="number" name="id" id="id" readonly class="form-control"
                            value="<?= htmlspecialchars($id ?? '') ?>">
                    </div>
                    <div class="col-12 col-md-5">
                        <label for="grupo_id">Grupo:</label>
                        <select name="grupo_id" id="grupo_id" class="form-select" required
                            data-parsley-required-message="Selecione um grupo">
                            <option value="">Selecione um grupo</option>
                            <?php
                            $sqlGrupo = "SELECT id, nome FROM grupo ORDER BY nome";
                            $consultaGrupo = $pdo->prepare($sqlGrupo);
                            $consultaGrupo->execute();
                            $dadosGrupo = $consultaGrupo->fetchAll(PDO::FETCH_OBJ);
                            foreach ($dadosGrupo as $grupo) {
                                $selected = ($grupo_id_selecionado == $grupo->id) ? 'selected' : '';
                                ?>
                                <option value="<?= $grupo->id ?>" <?= $selected ?>><?= htmlspecialchars($grupo->nome) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="nome">Nome da Categoria:</label>
                        <input type="text" name="nome" id="nome" class="form-control" required
                            data-parsley-required-message="Digite o nome da categoria"
                            value="<?= htmlspecialchars($nome ?? '') ?>">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="descricao">Descrição:</label>
                        <textarea name="descricao" id="descricao" class="form-control" required
                            data-parsley-required-message="Digite a descrição"><?= htmlspecialchars($descricao ?? '') ?></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-success float-end">
                    Salvar
                </button>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#descricao').summernote({
            placeholder: 'Digite a descrição da categoria',
            tabsize: 2,
            height: 150
        });
    });
</script>