<?php
session_start();
include '../config/db.php';
include '../includes/auth.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM recipes WHERE id = ?");
$stmt->execute([$id]);
$r = $stmt->fetch();

if (!$r) {
    die("Recipe not found");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($r['title']) ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<nav class="navbar">
    <a href="index.php">← Back</a>
    <?php if (isAdmin()): ?>
        <a href="edit.php?id=<?= $r['id'] ?>">Edit</a>
        <a href="delete.php?id=<?= $r['id'] ?>&csrf_token=<?= $_SESSION['csrf_token'] ?>"
           class="btn btn-danger">
           Delete
        </a>
    <?php endif; ?>
</nav>

<div class="container recipe-page">

    <img src="<?= htmlspecialchars($r['image_url']) ?>"
         alt="<?= htmlspecialchars($r['title']) ?>"
         class="recipe-image">

    <h1 class="recipe-title">
        <?= htmlspecialchars($r['title']) ?>
    </h1>

    <div class="recipe-section">
        <h2>Ingredients</h2>
        <ul>
            <?php foreach (explode(',', $r['ingredients']) as $i): ?>
                <li><?= htmlspecialchars(trim($i)) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="recipe-section">
        <h2>Cooking Steps</h2>
        <ol>
            <?php foreach (explode('.', $r['instructions']) as $step): ?>
                <?php if (trim($step)): ?>
                    <li><?= htmlspecialchars(trim($step)) ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ol>
    </div>

</div>

</body>
</html>
