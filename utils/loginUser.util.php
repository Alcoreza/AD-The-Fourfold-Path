<?php
require_once UTILS_PATH . 'envSetter.util.php'; // Assuming this file contains necessary DB config

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

    // Establishing the connection
    $conn = pg_connect($connStr);

    if (!$conn) {
        return ['error' => 'Database connection failed.'];
    }

    // Query to find user by username OR email
    $query = "SELECT id, username, password, email FROM users WHERE username = $1 OR email = $1";
    $result = pg_query_params($conn, $query, [$usernameOrEmail]);

    if (!$result || pg_num_rows($result) === 0) {
        pg_close($conn);
        return ['error' => 'Invalid username/email or password.'];
    }

    // Fetch user data
    $user = pg_fetch_assoc($result);

    // Verify the password using password_verify
    if (!password_verify($password, $user['password'])) {
        pg_close($conn);
        return ['error' => 'Invalid credentials.'];
    }

    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Store user data in the session
    $_SESSION['user'] = [
        'id' => $user['id'],
        'username' => $user['username'],
        'email' => $user['email']
    ];

    // Close the database connection
    pg_close($conn);

    // Return success message along with user info
    return [
        'success' => 'Login successful!',
        'user' => [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email']
        ]
    ];
}
