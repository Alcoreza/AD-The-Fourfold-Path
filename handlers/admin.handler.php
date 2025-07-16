<?php
require_once UTILS_PATH . 'admin.util.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'add') {
        if (addProduct($_POST)) {
            header('Location: /pages/adminPage/index.php');
            exit;
        }
    } elseif ($action === 'update') {
        if (updateProduct($_POST)) {
            header('Location: /pages/adminPage/index.php');
            exit;
        }
    } elseif ($action === 'delete') {
        if (deleteProduct($_POST)) {
            header('Location: /pages/adminPage/index.php');
            exit;
        }
    }
    // If failed or invalid, redirect back
    header('Location: /pages/adminPage/index.php');
    exit;
}

// Default: GET - show products (for AJAX or API, not used by index.php)
if ($method === 'GET') {
    $products = getAllProducts();
    header('Content-Type: application/json');
    echo json_encode(['products' => $products]);
    exit;
}
