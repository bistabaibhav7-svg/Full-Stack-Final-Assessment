<!DOCTYPE html>
<html>
<head>
    <title>Food Recipe Hub</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="auth-body">

<nav class="navbar">
    <a class="brand" href="landing.php">🍽️ Food Recipe Hub</a>
    <div>
        <a class="pill" href="landing.php">Home</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </div>
</nav>

<div class="auth-container">

    <div class="hero">
        <div class="hero-badge">🌿 Dark Emerald Edition • Premium UI • Fast Live Search</div>

        <h1>Cook Bold. Eat Better.</h1>
        <p>
            A modern recipe platform with clear ingredients, step-by-step instructions, and a clean dark UI.
            Admins manage recipes securely; users explore instantly.
        </p>

        <div class="hero-actions">
            <a href="login.php" class="btn">Login</a>
            <a href="register.php" class="btn btn-secondary">Create Account</a>
        </div>

        <p class="muted" style="font-size:14px;">
            Tip: After login, use the live search on the recipes page to find meals in seconds.
        </p>
    </div>

    <div class="features">
        <div class="feature">
            <div class="icon">🔎</div>
            <h3>Live AJAX Search</h3>
            <p>Recipes update instantly as you type — no page reload.</p>
        </div>

        <div class="feature">
            <div class="icon">🛡️</div>
            <h3>Secure System</h3>
            <p>Prepared statements + CSRF tokens + output escaping for XSS.</p>
        </div>

        <div class="feature">
            <div class="icon">👨‍🍳</div>
            <h3>Recipe Details</h3>
            <p>Single recipe view with organized ingredients and step-by-step cooking.</p>
        </div>
    </div>

    <div class="tips">
        <div class="tip">
            <strong>🍋 Quick Tip</strong>
            Add lemon at the end of cooking to boost flavor without extra salt.
        </div>
        <div class="tip">
            <strong>🧂 Quick Tip</strong>
            Season in layers: a little while cooking + a final touch at the end = better taste.
        </div>
        <div class="tip">
            <strong>🔥 Pro Tip</strong>
            Preheat your pan properly — better browning, less sticking, more flavor.
        </div>
        <div class="tip">
            <strong>🧄 Pro Tip</strong>
            Garlic burns fast — add after onions soften and keep heat medium-low.
        </div>
        <div class="tip">
            <strong>🍯 Fun Fact</strong>
            Honey never spoils. Archaeologists have found edible honey thousands of years old.
        </div>
        <div class="tip">
            <strong>🍚 Fun Fact</strong>
            Let rice rest for 10 minutes after cooking — it becomes fluffier and less sticky.
        </div>
        <div class="tip">
            <strong>🥬 Fun Fact</strong>
            Leafy greens shrink a lot while cooking — start with more than you think.
        </div>
        <div class="tip">
            <strong>🍝 Fun Fact</strong>
            Salt your pasta water: it’s the best way to season pasta from the inside.
        </div>
    </div>

</div>

<footer>
    © <?= date('Y') ?> Food Recipe Hub · Dark Emerald Theme
</footer>

</body>
</html>