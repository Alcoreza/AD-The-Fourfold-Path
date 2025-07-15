<?php

require_once dirname(__DIR__) . '/bootstrap.php';
require_once UTILS_PATH . 'registerUser.util.php';

function handleUserRegister(): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: /pages/registerPage/index.php");
        exit();
    }

    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($password !== $confirmPassword) {
        $_SESSION['register_error'] = "Passwords do not match.";
        header("Location: /pages/registerPage/index.php");
        exit();
    }

    $result = registerUser($username, $email, $password, $confirmPassword);

    if (isset($result['success'])) {
        $_SESSION['register_success'] = $result['success'];
        header("Location: /pages/registerPage/index.php");
    } else {
        $_SESSION['register_error'] = $result['error'];
        header("Location: /pages/registerPage/index.php");
    }

    exit();
}

handleUserRegister();
