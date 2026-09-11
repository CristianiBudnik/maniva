<?php
    session_start();
    
    unset($_SESSION["maniva"]);
    
    echo"<script>location.href='index.php';</script>";
?>