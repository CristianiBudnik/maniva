<?php
if (!isset($page)) exit;

$produto_id = $peso = "";
$disponivel = 1;

if (!empty($id)) {
    $sql = "SELECT * FROM variacao_produto WHERE id = :id LIMIT 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id);
    $consulta->execute();
    $dados = $consulta->fetch(PDO::FETCH_OBJ);

    if ($dados) {
        $id = $dados->id;
        $produto_id = $dados->produto_id;
        $peso = $dados->peso;
        $disponivel = $dados->disponivel;
    }
}
?>
<div class="container pt-5 pb-5">
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h2><?= empty($id) ? 'Cadastro' : 'Edição' ?> de Variação de Produto</h2>
            </div>
            <div class="float-end">
                <a href="cadastrar/variacao" class="btn btn-success">Nova Variação</a>
                <a href="listar/variacao" class="btn btn-success">Listar Variações</a>
            </div>
        </div>
        <div class="card-body">
            <form name="formCadastro" method="post" action="salvar/variacao" data-parsley-validate>
                <div class="row">
                    <div class="col-12 col-md-2">
                        <label for="id">ID:</label>
                        <input type="number" name="id" id="id" readonly class="form-control" value="<?= htmlspecialchars($id ?? '') ?>">
                    </div>
                    <div class="col-12 col-md-5">
                        <label for="produto_id">Produto:</label>
                        <select name="produto_id" id="produto_id" class="form-select" required
                            data-parsley-required-message="Selecione um produto">
                            <option value="">Selecione um produto</option>
                            <?php
                            $sqlProd = "SELECT id, nome FROM produto ORDER BY nome";
                            $consultaProd = $pdo->prepare($sqlProd);
                            $consultaProd->execute();
                            $produtos = $consultaProd->fetchAll(PDO::FETCH_OBJ);

                            foreach ($produtos as $prod) {
                                $selected = ($produto_id == $prod->id) ? 'selected' : '';
                                ?>
                                <option value="<?= $prod->id ?>" <?= $selected ?>><?= htmlspecialchars($prod->nome) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-5">
                        <label for="peso">Variação / Peso / Embalagem:</label>
                        <input type="text" name="peso" id="peso" class="form-control" placeholder="Ex: 500g - Pacote" required
                            data-parsley-required-message="Digite o peso/embalagem" value="<?= htmlspecialchars($peso ?? '') ?>">
                    </div>

                    <div class="col-12 col-md-4 mt-3">
                        <label for="disponivel">Disponível:</label>
                        <select name="disponivel" id="disponivel" class="form-select" required>
                            <option value="1" <?= ($disponivel == 1) ? 'selected' : '' ?>>Sim</option>
                            <option value="0" <?= ($disponivel == 0) ? 'selected' : '' ?>>Não</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-12 mt-4">
                        <button type="submit" class="btn btn-success float-end">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
