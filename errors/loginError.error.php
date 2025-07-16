<?php
require_once '../bootstrap.php';

if (!isset($_SESSION['login_failed'])) {
    header('Location: /pages/loginPage/index.php');
    exit;
}
unset($_SESSION['login_failed']);

$pageTitle = 'Login Error';

ob_start();
?>

<main class="error-container">
    <div class="error-box animate-in">
        <h2 class="error-title">Login Failed</h2>
        <p>Sorry, your login attempt was unsuccessful.</p>
        <p>Please try again or <a href="/pages/registerPage/index.php" class="create-account">create an account</a>.</p>
        <a href="/pages/loginPage/index.php" class="back-btn">← Back to Login</a>
    </div>
</main>

<?php
$content = ob_get_clean();
include LAYOUT_PATH . '/error.layout.php';
