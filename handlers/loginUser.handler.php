<?php

require_once dirname(__DIR__) . '/bootstrap.php';
require_once UTILS_PATH . 'loginUser.util.php';

function handleUserLogin(): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: /pages/loginPage/index.php");
        exit();
    }

    // Sanitize and retrieve input from the POST request
    $usernameOrEmail = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Basic validation: Ensure both fields are provided
    if (empty($usernameOrEmail) || empty($password)) {
        $_SESSION['login_error'] = "Both username/email and password are required.";
        header("Location: /pages/loginPage/index.php");
        exit();
    }

    // Call the loginUser function to check credentials
    $result = loginUser($usernameOrEmail, $password);

    // Handle login success or error
    if (isset($result['success'])) {
        $_SESSION['login_success'] = $result['success'];
        header("Location: /pages/dashboard/index.php"); // Redirect to dashboard or another page
    } else {
        $_SESSION['login_error'] = $result['error'];
        header("Location: /pages/loginPage/index.php");
    }

    exit();
}

// Run the login handler
handleUserLogin();
