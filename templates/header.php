<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maniva - Do campo à sua mesa</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;0,700;1,400&family=Playfair+Display:ital,wght@0,700;0,800;0,900;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="shortcut icon" href="img/manivaLogo.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">

</head>

<body class="pagina-<?= $paginaAtual ?>">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-maniva">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="index.php?page=home">
                    <img src="./img/maniva.png" alt="Maniva Alimentos"
                        class="logo-img">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
                    aria-controls="navMenu" aria-expanded="false" aria-label="Alternar navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navMenu">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link<?= ($paginaAtual === 'home' ? ' active' : '') ?>"
                                href="index.php?page=home">Início</a></li>
                        <li class="nav-item"><a class="nav-link<?= ($paginaAtual === 'produtos' ? ' active' : '') ?>"
                                href="index.php?page=produtos">Produtos</a></li>
                        <li class="nav-item"><a class="nav-link<?= ($paginaAtual === 'saibamais' ? ' active' : '') ?>"
                                href="index.php?page=saibamais">Saiba Mais</a></li>
                        <li class="nav-item"><a class="nav-link<?= ($paginaAtual === 'contato' ? ' active' : '') ?>"
                                href="index.php?page=contato">Contato</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>