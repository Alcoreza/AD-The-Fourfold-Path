<?php
require_once dirname(__DIR__, 2) . '/bootstrap.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | The Fourfold Path</title>
    <link href="/assets/css/styles.css" rel="stylesheet">
    <link href="/pages/loginPage/assets/css/login.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caudex:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet">
</head>

<body>
    <?php include COMPONENTS_PATH . '/navbar.component.php'; ?>

    <main class="login-container">
        <div class="login-box fade-in-section">
            <h2>Welcome Back, Bender</h2>

            <!-- Show success or error message if any -->
            <?php if (isset($_SESSION['login_error'])): ?>
                <div class="error-message"><?= htmlspecialchars($_SESSION['login_error']) ?></div>
                <?php unset($_SESSION['login_error']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['login_success'])): ?>
                <div class="success-message"><?= htmlspecialchars($_SESSION['login_success']) ?></div>
                <?php unset($_SESSION['login_success']); ?>
            <?php endif; ?>

            <form action="/pages/loginPage/authenticate.php" method="POST" class="login-form">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="explore-btn">Log In</button>
                <p class="register-link">Don't have an account? <a href="/pages/registerPage/index.php">Register</a></p>
            </form>
        </div>
    </main>

    <?php include COMPONENTS_PATH . '/footer.component.php'; ?>
    <script src="/assets/js/scripts.js"></script>
</body>

</html>
