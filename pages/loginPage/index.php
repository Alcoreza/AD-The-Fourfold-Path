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
    <nav class="navbar">
        <div class="nav-brand">The Fourfold Path</div>
        <ul class="nav-links">
            <li><a href="/index.php">Home</a></li>
            <li><a href="/pages/productPage/index.php">Products</a></li>
            <li><a href="/pages/aboutPage/index.php">About</a></li>
            <li><a href="/pages/loginPage/index.php" class="active">Login</a></li>
        </ul>
    </nav>

    <main class="login-container">
        <div class="login-box fade-in-section">
            <h2>Welcome Back, Bender</h2>
            <form action="/pages/loginPage/authenticate.php" method="POST" class="login-form">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="explore-btn">Log In</button>
                <p class="register-link">Don't have an account? <a href="/pages/registerPage/index.php"></a>Register</p>
            </form>
        </div>
    </main>

    <footer class="site-footer">
        <div class="footer-brand">The Fourfold Path</div>
        <p class="copyright">
            © 2025 The Fourfold Path. Crafted with balance and harmony.
        </p>
    </footer>

    <script src="/assets/js/scripts.js"></script>
</body>
</html>
