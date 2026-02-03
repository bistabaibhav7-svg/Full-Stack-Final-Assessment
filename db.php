<?php
$host = "localhost";
$db   = "np03cs4a240121";
$user = "np03cs4a240121";
$pass = "EkGlxrjtI8";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=UTF8",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("DB Connection Failed");
}
