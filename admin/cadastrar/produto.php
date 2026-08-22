<?php
   if (!isset($page)) exit;

    $nome = $descricao = $imagem_url = "";
    $categoria_id = "";

    if (!empty($id)) {
        $sql = "SELECT p.*, pc.categoria_id 
                FROM produto p 
                LEFT JOIN produto_categoria pc ON (pc.produto_id = p.id) 
                WHERE p.id = :id 
                LIMIT 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);
    }
    $nome = $dados->nome ?? null;
    $descricao = $dados->descricao ?? null;
    $imagem_url = $dados->imagem_url ?? null;
    $disponivel = $dados->disponivel ?? null;
    $categoria_id = $dados->categoria_id ?? null;

?>
<div class="container pt-5 pb-5">
    <div class="card shadow">
        <div class="card-header">
            <div class="float-start">
                <h2>Cadastro de Produto</h2>
            </div>
            <div class="float-end">
                <a href="cadastrar/produto" class="btn btn-success">
                    Novo Registro</a>
                <a href="listar/produto" class="btn btn-success">
                    Listar Registros
                </a>
            </div>
        </div>
        <div class="card-body">
            <form name="formCadastro" method="post" action="salvar/produto" data-parsley-validate
                enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12 col-md-1">
                        <label for="id">ID:</label>
                        <input type="number" name="id" id="id" readonly class="form-control" value="<?= htmlspecialchars($id ?? '') ?>">
                    </div>
                    <div class="col-12 col-md-5">
                        <label for="categoria_id">Categoria:</label>
                        <select name="categoria_id" id="categoria_id" class="form-select" required
                            data-parsley-required-message="Selecione uma categoria" value="<?= $categoria_id ?>">
                            <option value="">Selecione uma categoria</option>

                            <?php
                            $sqlCategoria = "SELECT c.id, c.nome as categoria, g.nome as grupo 
                                       FROM categoria c 
                                       INNER JOIN grupo g ON g.id = c.grupo_id 
                                       ORDER BY g.nome, c.nome";
                            $consultaCategoria = $pdo->prepare($sqlCategoria);
                            $consultaCategoria->execute();

                            $dadosCategoria = $consultaCategoria->fetchAll(PDO::FETCH_OBJ);
                            $grupoAtual = '';
                            foreach ($dadosCategoria as $cat) {
                                if ($grupoAtual !== $cat->grupo) {
                                    if ($grupoAtual !== '')
                                        echo '</optgroup>';
                                    $grupoAtual = $cat->grupo;
                                    echo '<optgroup label="' . htmlspecialchars($grupoAtual) . '">';
                                }
                                $selected = ($categoria_id == $cat->id) ? 'selected' : '';
                                ?>
                                <option value="<?= $cat->id ?>" <?= $selected ?>><?= htmlspecialchars($cat->categoria) ?>
                                </option>
                                <?php
                            }
                            if ($grupoAtual !== '')
                                echo '</optgroup>';
                            ?>
                        </select>
                        <script>
                            $(document).ready(function () {
                                $('#categoria_id').val("<?= $categoria_id ?>");
                            });
                        </script>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="nome">Nome do Produto:</label>
                        <input type="text" name="nome" id="nome" class="form-control" required
                            data-parsley-required-message="Digite o nome do produto"
                            value="<?= htmlspecialchars($nome) ?>">
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <label for="descricao">Descrição:</label>
                        <textarea name="descricao" id="descricao" class="form-control" required
                            data-parsley-required-message="Digite a descrição"><?= htmlspecialchars($descricao) ?></textarea>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <label for="imagem">Selecione a imagem do produto:</label>
                        <input type="file" name="imagem_url" id="imagem_url" class="form-control" accept="image/*"
                            <?= empty($id) ? 'required data-parsley-required-message="Selecione a imagem do produto"' : '' ?>>
                        <?php if (!empty($imagem_url)): ?>
                            <div class="mt-2 text-muted small">
                                Imagem atual: <strong><?= htmlspecialchars(basename($imagem_url)) ?></strong>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-12 col-md-12 mt-4">
                        <button type="submit" class="btn btn-success float-end">
                            Salvar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#descricao').summernote({
            placeholder: 'Digite a descrição do produto',
            tabsize: 2,
            height: 150
        });
    });
</script>