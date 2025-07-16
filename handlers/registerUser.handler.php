<?php

require_once dirname(__DIR__) . '/bootstrap.php';
require_once UTILS_PATH . 'registerUser.util.php';

function handleUserRegister(): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: /pages/registerPage/index.php");
        exit();
    }

    // Retrieve and sanitize user input
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Basic validation
    if (!$username || !$email || !$password || !$confirmPassword) {
        $_SESSION['register_error'] = "All fields are required.";
        header("Location: /pages/registerPage/index.php");
        exit();
    }

    if ($password !== $confirmPassword) {
        $_SESSION['register_error'] = "Passwords do not match.";
        header("Location: /pages/registerPage/index.php");
        exit();
    }

    // Call the registerUser function for business logic
    $result = registerUser($username, $email, $password);

    // Handle success or error
    if (isset($result['success'])) {
        $_SESSION['register_success'] = $result['success'];
    } else {
        $_SESSION['register_error'] = $result['error'];
    }

    // Redirect back to the register page with a session message
    header("Location: /pages/registerPage/index.php");
    exit();
}

// Run the registration handler
handleUserRegister();
