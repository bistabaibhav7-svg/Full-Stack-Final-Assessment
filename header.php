<?php include_once 'auth.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Food Recipe Website</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<nav class="navbar">
    <div>
        <a href="index.php">🍽️ Food Recipe Hub</a>
    </div>
    <div>
        <?php if (isAdmin()): ?>
            <a href="add.php">➕ Add Recipe</a>
        <?php endif; ?>

        <?php if (isLoggedIn()): ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </div>
</nav>
