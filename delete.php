<?php
session_start();
include '../config/db.php';
include '../includes/auth.php';

if (!isAdmin()) {
    die("Access denied");
}

if (
    !isset($_GET['id']) ||
    !isset($_GET['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_GET['csrf_token'])
) {
    die("Invalid request");
}

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM recipes WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
