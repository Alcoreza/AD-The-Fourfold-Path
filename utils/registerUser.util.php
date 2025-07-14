<?php
require_once UTILS_PATH . 'envSetter.util.php';

function registerUser(string $username, string $email, string $password, string $confirm): array {
    if ($password !== $confirm) {
        return ['error' => 'Passwords do not match.'];
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    global $typeConfig;
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
        return ['error' => 'Database connection failed.'];
    }

    // Check if user already exists
    $existsResult = pg_query_params(
        $conn,
        "SELECT id FROM users WHERE username = $1 OR email = $2",
        [$username, $email]
    );

    if (pg_num_rows($existsResult) > 0) {
        pg_close($conn);
        return ['error' => 'Username or email already exists.'];
    }

    // Insert new user
    $insertResult = pg_query_params(
        $conn,
        "INSERT INTO users (username, password, email) VALUES ($1, $2, $3) RETURNING id",
        [$username, $passwordHash, $email]
    );

    if ($insertResult && pg_num_rows($insertResult) === 1) {
        pg_close($conn);
        return ['success' => 'Registration successful! Redirecting to login...'];
    } else {
        pg_close($conn);
        return ['error' => 'Registration failed. Please try again.'];
    }
}
