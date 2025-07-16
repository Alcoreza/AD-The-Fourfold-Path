<?php
require_once UTILS_PATH . 'envSetter.util.php'; // Loads $pgConfig

function loginUser(string $usernameOrEmail, string $password): array
{
    global $pgConfig;

    // PostgreSQL connection string
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

    // Include 'role' in the query
    $query = "SELECT id, username, password, email, role FROM users WHERE username = $1 OR email = $1";
    $result = pg_query_params($conn, $query, [$usernameOrEmail]);

    if (!$result || pg_num_rows($result) === 0) {
        pg_close($conn);
        return ['error' => 'Invalid credentials.'];
    }

    $user = pg_fetch_assoc($result);

    if (!password_verify($password, $user['password'])) {
        pg_close($conn);
        return ['error' => 'Invalid credentials.'];
    }

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION['user'] = [
        'id' => $user['id'],
        'username' => $user['username'],
        'email' => $user['email'],
        'role' => $user['role']
    ];

    pg_close($conn);

    return [
        'success' => 'Login successful!',
        'user' => $_SESSION['user']
    ];
}