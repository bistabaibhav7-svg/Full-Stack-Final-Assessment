<?php
session_start();
require_once '../config/db.php';

header('Content-Type: application/json; charset=utf-8');

$q = trim($_GET['q'] ?? '');

// Get all columns in recipes (so we don't guess and break your DB)
$cols = [];
try {
    $c = $pdo->query("SHOW COLUMNS FROM recipes")->fetchAll();
    foreach ($c as $row) {
        $cols[$row['Field']] = true;
    }
} catch (Exception $e) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT id, title, image_url FROM recipes WHERE 1=1";
$params = [];

// Keyword search (title + ingredients if that column exists)
if ($q !== '') {
    if (isset($cols['ingredients'])) {
        $sql .= " AND (title LIKE ? OR ingredients LIKE ?)";
        $params[] = "%$q%";
        $params[] = "%$q%";
    } else {
        $sql .= " AND title LIKE ?";
        $params[] = "%$q%";
    }
}

/**
 * Advanced filters (ONLY applied if both:
 *  - parameter is provided
 *  - column exists in your recipes table
 *
 * This keeps your old advanced search options working without guessing your schema.
 */
$filterMapExact = [
    'category'   => 'category',
    'difficulty' => 'difficulty',
    'cuisine'    => 'cuisine',
];

foreach ($filterMapExact as $param => $col) {
    $val = trim($_GET[$param] ?? '');
    if ($val !== '' && isset($cols[$col])) {
        $sql .= " AND {$col} = ?";
        $params[] = $val;
    }
}

// time / cook_time (common naming)
$timeVal = trim($_GET['time'] ?? ($_GET['cook_time'] ?? ($_GET['max_time'] ?? '')));
if ($timeVal !== '') {
    if (isset($cols['cook_time'])) {
        $sql .= " AND cook_time <= ?";
        $params[] = (int)$timeVal;
    } elseif (isset($cols['time'])) {
        $sql .= " AND time <= ?";
        $params[] = (int)$timeVal;
    }
}

// ingredients filter (if your advanced form has it)
$ing = trim($_GET['ingredients'] ?? '');
if ($ing !== '' && isset($cols['ingredients'])) {
    $sql .= " AND ingredients LIKE ?";
    $params[] = "%$ing%";
}

$sql .= " ORDER BY id DESC LIMIT 60";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    echo json_encode($stmt->fetchAll());
} catch (Exception $e) {
    echo json_encode([]);
}