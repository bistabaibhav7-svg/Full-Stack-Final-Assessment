<?php
session_start();
include '../config/db.php';
include '../includes/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (
        !isset($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        die("Invalid CSRF token");
    }

    $login = $_POST['login'];

    $stmt = $pdo->prepare(
        "SELECT * FROM users WHERE username = ? OR email = ?"
    );
    $stmt->execute([$login, $login]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="auth-body">

<nav class="navbar">
    <a href="landing.php">Home</a>
    <a href="register.php">Register</a>
</nav>

<div class="auth-container">
<div class="auth-card">
<h2>Login</h2>

<?php if ($error): ?>
<div class="auth-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post">
<input type="hidden" name="csrf_token"
       value="<?= $_SESSION['csrf_token'] ?>">

<input name="login" placeholder="Username or Email" required>
<input type="password" name="password" placeholder="Password" required>
<button>Login</button>
</form>
</div>
</div>
</body>
</html>
