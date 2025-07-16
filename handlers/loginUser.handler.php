<?php

require_once dirname(__DIR__) . '/bootstrap.php';
require_once UTILS_PATH . 'loginUser.util.php';

function handleUserLogin(): void
{
    // Ensure the request is a POST request
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        redirectWithError('Invalid request method.', '/pages/loginPage/index.php');
    }

    // Sanitize and retrieve input
    $usernameOrEmail = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Basic validation: Ensure both fields are provided
    if (empty($usernameOrEmail) || empty($password)) {
        redirectWithError('Both username/email and password are required.', '/pages/loginPage/index.php');
    }

    // Attempt to login the user
    $result = loginUser($usernameOrEmail, $password);

    // Handle error if login fails
    if (isset($result['error'])) {
        redirectWithError($result['error'], '/pages/loginPage/index.php');
    }

    // If login is successful
    if (isset($result['success']) && isset($result['user'])) {
        // Store user info in the session
        $_SESSION['user'] = $result['user'];
        $_SESSION['user_id'] = $result['user']['id'] ?? null;
        $_SESSION['login_success'] = $result['success'];

        sleep(1);

        // Redirect to the homepage after the delay
        header('Location: /index.php');
        exit;
    }

    // If unexpected results occur, handle the error
    redirectWithError('An unexpected error occurred. Please try again later.', '/pages/loginPage/index.php');
}

/**
 * Helper function for redirecting with an error message
 *
 * @param string $message
 * @param string $location
 */
function redirectWithError(string $message, string $location): void
{
    $_SESSION['login_error'] = $message;
    header("Location: $location");
    exit;
}

// Run the login handler
handleUserLogin();
