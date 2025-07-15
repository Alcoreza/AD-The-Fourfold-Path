<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once UTILS_PATH . 'loginUser.util.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrEmail = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validate fields before sending to util
    if (empty($usernameOrEmail) || empty($password)) {
        $_SESSION['login_error'] = 'Please fill in all fields.';
        header('Location: /pages/loginPage/index.php');
        exit;
    }

    $result = loginUser($usernameOrEmail, $password);

    if (isset($result['error'])) {
        $_SESSION['login_error'] = $result['error'];
        header('Location: /pages/loginPage/index.php');
        exit;
    }

    if (isset($result['success'])) {
        $_SESSION['login_success'] = $result['success'];
        // Delay 2 seconds before redirecting to homepage
        header('Refresh: 2; URL=/index.php');
        include __DIR__ . '/../pages/loginPage/index.php'; // Render login page with success message
        exit;
    }
} else {
    // If someone tries to access directly
    header('Location: /pages/loginPage/index.php');
    exit;
}
