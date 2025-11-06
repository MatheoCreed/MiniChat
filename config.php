<?php
session_start();

$db_host = 'localhost';
$db_name = 'duhamel_minichatphp';
$db_user = 'root';
$db_pass = '';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
}   catch (Exception $e){
    die('Erreur de connexion : ' . htmlspecialchars($e->getMessage()));
}

function h($s) { return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }

