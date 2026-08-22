<?php

$host = "localhost";
$db = "maniva";
$user = "maniva";
$pass = "123456789";

try { 
    $pdo = new PDO ("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die ("Erro na conexão: " . $e->getMessage ());
}