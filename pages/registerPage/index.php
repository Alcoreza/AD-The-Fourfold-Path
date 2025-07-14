<?php
require_once dirname(__DIR__, 2) . '/bootstrap.php';

$registerError = '';
$registerSuccess = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    // Confirm password matches
    if ($password !== $confirm) {
        $registerError = 'Passwords do not match.';
    } else {
        // Call the registration handler directly
        require_once UTILS_PATH . 'envSetter.util.php';

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $connStr = sprintf(
            "host=%s port=%s dbname=%s user=%s password=%s",
            $typeConfig['pgHost'],
            $typeConfig['pgPort'],
            $typeConfig['pgDb'],
            $typeConfig['pgUser'],
            $typeConfig['pgPass']
        );
        $conn = pg_connect($connStr);

        if (!$conn) {
            $registerError = 'Database connection failed.';
        } else {
            // Check if username or email already exists
            $existsResult = pg_query_params(
                $conn,
                "SELECT id FROM users WHERE username = $1 OR email = $2",
                [$username, $email]
            );

            if (pg_num_rows($existsResult) > 0) {
                $registerError = 'Username or email already exists.';
            } else {
                // Insert new user
                $insertResult = pg_query_params(
                    $conn,
                    "INSERT INTO users (username, password, email) VALUES ($1, $2, $3) RETURNING id",
                    [$username, $passwordHash, $email]
                );

                if ($insertResult && pg_num_rows($insertResult) === 1) {
                    $registerSuccess = 'Registration successful! Redirecting to login...';
                    // Redirect after 2 seconds
                    header("refresh:2;url=/pages/loginPage/index.php");
                } else {
                    $registerError = 'Registration failed. Please try again.';
                }
            }
            pg_close($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Register | The Fourfold Path</title>
    <link href="/assets/css/styles.css" rel="stylesheet"/>
    <link href="/pages/registerPage/assets/css/register.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Caudex:wght@400;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet"/>
</head>
<body>
    <?php include COMPONENTS_PATH . '/navbar.component.php'; ?>

    <main class="register-container">
        <div class="register-box">
            <h2>Create Bender</h2>
                <form class="register-form" action="" method="post" autocomplete="off">
                    <?php if ($registerError): ?>
                        <div class="error-message"><?= htmlspecialchars($registerError) ?></div>
                    <?php endif; ?>
                    <?php if ($registerSuccess): ?>
                        <div class="success-message"><?= htmlspecialchars($registerSuccess) ?></div>
                    <?php endif; ?>

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
    </main>

    <?php include COMPONENTS_PATH . '/footer.component.php'; ?>
</body>
</html>