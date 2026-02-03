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

    $username = trim($_POST['username']);
    $email = trim($_POST['email']) ?: null;
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare(
            "INSERT INTO users (username, email, password, role)
             VALUES (?, ?, ?, 'user')"
        );
        $stmt->execute([$username, $email, $password]);
        header("Location: login.php");
        exit;
    } catch (PDOException $e) {
        $error = "Username or email already exists";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="auth-body">

<nav class="navbar">
    <a href="landing.php">Home</a>
    <a href="login.php">Login</a>
</nav>

<div class="auth-container">
<div class="auth-card">
<h2>Register</h2>

<?php if ($error): ?>
<div class="auth-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post">
<input type="hidden" name="csrf_token"
       value="<?= $_SESSION['csrf_token'] ?>">

<input name="username" placeholder="Username" required>
<input name="email" placeholder="Email (optional)">
<input type="password" name="password" placeholder="Password" required>
<button>Register</button>
</form>
</div>
</div>
</body>
</html>
