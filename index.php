<?php
$paginaAtual = $_GET["page"] ?? "home";
$page = "pages/{$paginaAtual}.php";

include "config.php";
include "templates/funcoes.php";
?>

<?php include "templates/header.php"; ?>

<?php
if (file_exists($page))
    include $page;
else
    include "pages/erro.php";
?>

<?php include "templates/footer.php"; ?>