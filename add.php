<?php
session_start();
include '../config/db.php';
include '../includes/auth.php';

if (!isAdmin()) {
    die("Access denied");
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

    if ($title && $ingredients && $instructions && $image_url) {
        $stmt = $pdo->prepare(
            "INSERT INTO recipes (title, ingredients, instructions, image_url)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$title, $ingredients, $instructions, $image_url]);
        header("Location: index.php");
        exit;
    } else {
        $error = "All fields are required";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Recipe</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<nav class="navbar">
    <a href="index.php">Back</a>
</nav>

<div class="container">
<form method="post">
<h2>Add Recipe</h2>

<?php if ($error): ?>
<div class="auth-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

<input name="title" placeholder="Recipe title" required>
<textarea name="ingredients" placeholder="Ingredients" required></textarea>
<textarea name="instructions" placeholder="Instructions" required></textarea>
<input name="image_url" placeholder="Image URL" required>

<button>Add Recipe</button>
</form>
</div>
</body>
</html>
