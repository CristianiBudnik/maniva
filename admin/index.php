<?php

//iniciar sessao
session_start();

//conectar no banco

require "../config.php";
require "functions.php";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Maniva</title>

    <base href="http://<?= $_SERVER["SERVER_NAME"] . $_SERVER["SCRIPT_NAME"] ?>">

    <link rel="shortcut icon" href="../img/manivaLogo.png" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <link href="css/summernote-bs5.min.css" rel="stylesheet">

    <link href="css/sweetalert2.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="js/jquery.inputmask.min.js"></script>
    <script src="js/parsley.min.js"></script>
    <script src="js/summernote-bs5.min.js"></script>
    <script src="js/sweetalert2.js"></script>
    <script src="js/jquery.mask.min.js"></script>


    <script>
        function mensagem(mensagem, tipo, link = null) {
            Swal.fire({
                icon: tipo,
                title: mensagem,
                confirmButtonText: "OK",
            }).then((result) => {

                if (tipo == "error") history.back();
                else location.href = link;

            });
        }
    </script>
</head>

<body>
    <?php

    if ((!isset($_SESSION["maniva"])) && ($_POST)) {

        $email = trim($_POST["email"] ?? NULL);
        $senha = trim($_POST["senha"] ?? NULL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>mensagem('E-mail inválido', 'error');</script>";
            exit;
        } else if (strlen($senha) < 4) {
            echo "<script>mensagem('Senha inválida', 'error');</script>";
            exit;
        }

        $sqlLogin = "select id, nome, email, senha from usuario
                where ativo = 'Sim'
                AND email = :email
                limit 1";
        $consultaLogin = $pdo->prepare($sqlLogin);
        $consultaLogin->bindParam(":email", $email);
        $consultaLogin->execute();

        $dadosUsuario = $consultaLogin->fetch(PDO::FETCH_OBJ);

        if (empty($dadosUsuario->id)) {
            echo "<script>mensagem('Dados Inválidos','error');</script>";
            exit;
        } else if (!password_verify($senha, $dadosUsuario->senha)) {
            echo "<script>mensagem('Dados Inválidos','error');</script>";
            exit;
        }
        //registyra sessao
        $_SESSION["maniva"] = array(
            "id" => $dadosUsuario->id,
            "nome" => $dadosUsuario->nome,
            "email" => $dadosUsuario->email
        );

        //redireciona a página
        echo "<script>location.href='index.php';</script>";

    } else if (!isset($_SESSION["maniva"])) {

        include "pages/login.php";

    } else {
        //mostrar a tela do sistema
        ?>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">
                        <img src="../img/maniva.PNG" alt="Logo Painel" width="130px">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cadastrar/categoria">Categoria</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cadastrar/grupo">Grupo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cadastrar/usuario">Usuario</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cadastrar/produto">Produto</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cadastrar/variacao">Variação</a>
                            </li>
                        </ul>
                        <div class="d-flex">
                            <div class="dropdown">
                                <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Olá <?= htmlspecialchars($_SESSION["maniva"]["nome"] ?? '') ?>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="pages/sair">Sair</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            
            <main class="container mt-5 mb-5">
                <?php
                $param = $_GET["param"] ?? "pages/home";
                $param = explode("/", $param);

                $pasta = count($param);

                if ($pasta == 1)
                    $page = "pages/{$param[0]}.php";
                else
                    $page = "{$param[0]}/{$param[1]}.php";

                $id = $param[2] ?? NULL;

                if (file_exists($page))
                    require $page;
                else
                    require "pages/erro.php";

                ?>
            </main>

        <?php
    }
    ?>

    <script src="../dist/app.js"></script>

</body>

</html>