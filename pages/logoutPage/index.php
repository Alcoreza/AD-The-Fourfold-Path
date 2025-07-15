<?php
require_once dirname(__DIR__, 2) . '/bootstrap.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

session_unset();
session_destroy();

header('Location: /pages/loginPage/index.php');
exit();
