<?php
require_once dirname(__DIR__, 2) . '/bootstrap.php';
require_once UTILS_PATH . 'loginUser.util.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $result = loginUser($username, $password);

    if (isset($result['success'])) {
        header("Location: /index.php");
        exit();
    } else {
        $_SESSION['login_error'] = $result['error'];
        header("Location: /pages/loginPage/index.php");
        exit();
    }
} else {
    header("Location: /pages/loginPage/index.php");
    exit();
}
