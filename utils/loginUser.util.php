<?php
require_once UTILS_PATH . 'envSetter.util.php';

function loginUser(string $username, string $password): array
{
    global $pgConfig;

    // Create PostgreSQL connection string
    $connStr = sprintf(
        "host=%s port=%s dbname=%s user=%s password=%s",
        $pgConfig['host'],
        $pgConfig['port'],
        $pgConfig['db'],
        $pgConfig['user'],
        $pgConfig['pass']
    );

    $conn = pg_connect($connStr);

    if (!$conn) {
        return ['error' => 'Database connection failed.'];
    }

    // Query to find user by username
    $result = pg_query_params(
        $conn,
        "SELECT id, username, password FROM users WHERE username = $1",
        [$username]
    );

    if (!$result || pg_num_rows($result) === 0) {
        pg_close($conn);
        return ['error' => 'Invalid username or password.'];
    }

    $user = pg_fetch_assoc($result);

    // Verify the hashed password
    if (!password_verify($password, $user['password'])) {
        pg_close($conn);
        return ['error' => 'Invalid username or password.'];
    }

    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Store user info in session
    $_SESSION['user'] = [
        'id' => $user['id'],
        'username' => $user['username']
    ];

    pg_close($conn);
    return ['success' => 'Login successful!'];
}
