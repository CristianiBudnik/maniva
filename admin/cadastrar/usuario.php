<?php
if (!isset($page))
    exit;

$nome = $email = $cpf = $salario = $data = $datanascimento = $ativo = null;

if (!empty($id)) {
    $sql = "SELECT *, date_format(datanascimento, '%d/%m/%Y') data FROM usuario WHERE id = :id LIMIT 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id);
    $consulta->execute();

    $dadosCadastro = $consulta->fetch(PDO::FETCH_OBJ);

    $nome = $dadosCadastro->nome ?? null;
    $email = $dadosCadastro->email ?? null;
    $cpf = $dadosCadastro->cpf ?? null;
    $salario = $dadosCadastro->salario ?? null;
    $data = $dadosCadastro->data ?? null;
    $ativo = $dadosCadastro->ativo ?? null;

    if (!empty($salario))
        $salario = number_format($salario, 2, ",", ".");
}
?>
<div class="container pt-5 pb-5">
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h2><?= empty($id) ? 'Cadastro' : 'Edição' ?> de Usuário</h2>
            </div>
            <div class="float-end">
                <a href="cadastrar/usuario" class="btn btn-success">Novo Usuário</a>
                <a href="listar/usuario" class="btn btn-success">Listar Usuários</a>
            </div>
        </div>
        <div class="card-body">
            <form name="formCadastro" method="post" action="salvar/usuario" data-parsley-validate>
                <div class="row">
                    <div class="col-12 col-md-1">
                        <label for="id">ID:</label>
                        <input type="number" name="id" id="id" readonly class="form-control" value="<?= htmlspecialchars($id ?? '') ?>">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="nome">Nome Completo:</label>
                        <input type="text" name="nome" id="nome" class="form-control" required
                            data-parsley-required-message="Digite o nome" value="<?= htmlspecialchars($nome ?? '') ?>">
                    </div>
                    <div class="col-12 col-md-5">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" class="form-control" required
                            data-parsley-required-message="Digite o e-mail" data-parsley-type-message="Email inválido"
                            value="<?= htmlspecialchars($email ?? '') ?>">
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="senha">Digite uma senha com o mínimo de 6 caracteres:</label>
                        <input type="password" name="senha" id="senha" class="form-control" required
                            data-parsley-required-message="Digite a senha">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="senha2">Redigite a senha:</label>
                        <input type="password" name="senha2" id="senha2" class="form-control" required
                            data-parsley-required-message="Digite a senha" data-parsley-equalto="#senha"
                            data-parsley-equalto-message="As senhas não conferem">
                    </div>

                    <div class="col-12 col-md-3">
                        <label for="salario">Salário:</label>
                        <input type="text" name="salario" id="salario" class="form-control" required
                            data-parsley-required-message="Digite o salário" value="<?= htmlspecialchars($salario ?? '') ?>">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="datanascimento">Data de Nascimento:</label>
                        <input type="text" name="datanascimento" id="datanascimento" class="form-control" required
                            data-parsley-required-message="Digite a data de nascimento" value="<?= htmlspecialchars($data ?? '') ?>">
                    </div>

                    <div class="col-12 col-md-3">
                        <label for="cpf">CPF:</label>
                        <input type="text" name="cpf" id="cpf" class="form-control" required
                            data-parsley-required-message="Digite o CPF" value="<?= htmlspecialchars($cpf ?? '') ?>">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="ativo">Ativo:</label>
                        <select name="ativo" id="ativo" class="form-select" required>
                            <option value="">Selecione</option>
                            <option value="Sim" <?= ($ativo == 'Sim') ? 'selected' : '' ?>>Sim</option>
                            <option value="Não" <?= ($ativo == 'Não') ? 'selected' : '' ?>>Não</option>
                        </select>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-success float-end">
                    Salvar
                </button>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#cpf").inputmask("999.999.999-99");
        $("#datanascimento").inputmask("99/99/9999");

        $("#salario").inputmask({
            alias: "numeric",
            groupSeparator: ".",
            radixPoint: ",",
            autoGroup: true,
            digits: 2,
            digitsOptional: false,
            placeholder: "0"
        });



        $("#ativo").val("<?= $ativo ?>");

        <?php
        if (!empty($id)) {
            ?>
            $("#senha").removeAttr("required").parsley().reset();
            $("#senha2").removeAttr("required").parsley().reset();
            <?php
        }
        ?>
    });
</script>