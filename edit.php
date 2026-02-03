<?php
session_start();
include '../config/db.php';
include '../includes/auth.php';

if (!isAdmin()) {
    die("Access denied");
}

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM recipes WHERE id = ?");
$stmt->execute([$id]);
$recipe = $stmt->fetch();

if (!$recipe) {
    die("Recipe not found");
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (
        !isset($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        die("Invalid CSRF token");
    }

    $title = trim($_POST['title']);
    $ingredients = trim($_POST['ingredients']);
    $instructions = trim($_POST['instructions']);
    $image_url = trim($_POST['image_url']);

    $stmt = $pdo->prepare(
        "UPDATE recipes
         SET title=?, ingredients=?, instructions=?, image_url=?
         WHERE id=?"
    );
    $stmt->execute([$title, $ingredients, $instructions, $image_url, $id]);

    header("Location: recipe.php?id=$id");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Recipe</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
<form method="post">
<h2>Edit Recipe</h2>

<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

<input name="title"
 value="<?= htmlspecialchars($recipe['title']) ?>" required>

<textarea name="ingredients" required><?= htmlspecialchars($recipe['ingredients']) ?></textarea>

<textarea name="instructions" required><?= htmlspecialchars($recipe['instructions']) ?></textarea>

<input name="image_url"
 value="<?= htmlspecialchars($recipe['image_url']) ?>" required>

<button>Update Recipe</button>
</form>
</div>
</body>
</html>
