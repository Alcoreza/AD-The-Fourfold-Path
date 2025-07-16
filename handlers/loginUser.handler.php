<?php

require_once BOOTSTRAP_PATH;
require_once UTILS_PATH . 'loginUser.util.php';

function handleUserLogin(): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        redirectWithError('Invalid request method.', '/pages/loginPage/index.php');
    }

    $usernameOrEmail = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($usernameOrEmail) || empty($password)) {
        redirectWithError('Both username/email and password are required.', '/pages/loginPage/index.php');
    }

    $result = loginUser($usernameOrEmail, $password);

    if (isset($result['error'])) {
        redirectWithError($result['error'], '/pages/loginPage/index.php');
    }

    if (isset($result['success']) && isset($result['user'])) {
        $_SESSION['user_id'] = $result['user']['id'];
        $_SESSION['login_success'] = $result['success'];

        sleep(1); // optional

        $role = $result['user']['role'] ?? 'user';

        if ($role === 'admin') {
            header('Location: /pages/adminPage/index.php');
        } else {
            header('Location: /index.php');
        }
        exit;
    }

    redirectWithError('An unexpected error occurred. Please try again later.', '/pages/loginPage/index.php');
}

function redirectWithError(string $message, string $location): void
{
    $_SESSION['login_error'] = $message;
    header("Location: $location");
    exit;
}

handleUserLogin();