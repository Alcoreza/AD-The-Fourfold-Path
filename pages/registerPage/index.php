<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Register – The Fourfold Path</title>
    <link href="/assets/css/styles.css" rel="stylesheet"/>
    <link href="/pages/registerPage/assets/css/register.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Caudex:wght@400;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet"/>
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">The Fourfold Path</div>
        <ul class="nav-links">
            <li><a href="/index.php">Home</a></li>
            <li><a href="/pages/productPage/index.php">Products</a></li>
            <li><a href="/pages/aboutPage/index.php">About</a></li>
            <li><a href="/pages/loginPage/index.php">Login</a></li>
        </ul>
    </nav>

    <div class="register-container">
        <div class="register-box">
            <h2>Create Account</h2>
                <form class="register-form" action="#" method="post">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required/>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required/>

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required/>

                    <label for="confirm">Confirm Password</label>
                    <input type="password" id="confirm" name="confirm" required/>

                    <button type="submit" class="register-btn">Register</button>
                </form>
            <p class="login-link">Already have an account? <a href="/pages/loginPage/index.php">Login here</a></p>
        </div>
    </div>

    <footer class="site-footer">
        <div class="footer-brand">The Fourfold Path</div>
        <p class="copyright">© 2025 The Fourfold Path. Crafted with balance and harmony.</p>
    </footer>
</body>
</html>