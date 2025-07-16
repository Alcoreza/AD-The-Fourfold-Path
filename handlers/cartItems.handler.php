<?php
require_once BASE_PATH . '/bootstrap.php';
require_once UTILS_PATH . 'envSetter.util.php';
require_once UTILS_PATH . 'cartItems.util.php';

header('Content-Type: application/json');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']['id'])) {
    echo json_encode(['error' => 'User not authenticated']);
    exit;
}

$userId = $_SESSION['user']['id'];


// Determine operation
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Fetch all cart items
    $items = fetchCartItems($userId);
    echo json_encode($items);
    exit;
}

if ($method === 'POST') {
    $action = $_POST['action'] ?? '';

    // Add to cart
    if ($action === 'add') {
        $itemId = intval($_POST['item_id'] ?? 0);
        $qty = intval($_POST['quantity'] ?? 1);
        if ($itemId <= 0 || $qty <= 0) {
            echo json_encode(['error' => 'Invalid item ID or quantity']);
            exit;
        }

        $result = addToCart($userId, $itemId, $qty);
        echo json_encode($result);
        exit;
    }

    // Update quantity of existing cart item
    if ($action === 'update') {
        $cartItemId = intval($_POST['cart_item_id'] ?? 0);
        $qty = intval($_POST['quantity'] ?? -1);
        if ($cartItemId <= 0 || $qty < 0) {
            echo json_encode(['error' => 'Invalid cart item ID or quantity']);
            exit;
        }

        updateCartItemQuantity($cartItemId, $qty);
        http_response_code(204); // No Content
        exit;
    }

    echo json_encode(['error' => 'Invalid action']);
    exit;
}

echo json_encode(['error' => 'Unsupported request method']);
exit;