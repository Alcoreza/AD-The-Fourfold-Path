<?php
require_once dirname(__DIR__, 2) . '/bootstrap.php'; // [QA] add a named custom path

// Retrieve and clear session messages
$registerError = $_SESSION['register_error'] ?? '';
$registerSuccess = $_SESSION['register_success'] ?? '';
unset($_SESSION['register_error'], $_SESSION['register_success']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | The Fourfold Path</title>
    <link href="/assets/css/styles.css" rel="stylesheet" />
    <link href="/pages/registerPage/assets/css/register.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Caudex:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet" />
</head>

<body>
    <?php include COMPONENTS_PATH . '/navbar.component.php'; ?>

    <main class="register-container">
        <div class="register-box">
            <h2>Create Bender</h2>
            <form class="register-form" action="/handlers/userRegister.handler.php" method="post" autocomplete="off">
                <?php if ($registerError): ?>
                    <div class="error-message"><?= htmlspecialchars($registerError) ?></div>
                <?php endif; ?>
                <?php if ($registerSuccess): ?>
                    <div class="success-message"><?= htmlspecialchars($registerSuccess) ?></div>
                <?php endif; ?>

                <label for="username">Username</label>
                <input type="text" id="username" name="username" required />

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required />

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required />

                <label for="confirm">Confirm Password</label>
                <input type="password" id="confirm" name="confirm" required />

                <button type="submit" class="register-btn">Register</button>
            </form>
            <p class="login-link">Already have an account? <a href="/pages/loginPage/index.php">Login here</a></p>
        </div>
    </main>

    <?php include COMPONENTS_PATH . '/footer.component.php'; ?>
</body>

</html>
