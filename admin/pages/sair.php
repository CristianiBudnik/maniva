<?php
    //iniciar a sessão
    session_start();
    //apagar a sessão
    unset($_SESSION["maniva"]);
    //redirecionar para a página de login
    echo"<script>location.href='index.php';</script>";
?>