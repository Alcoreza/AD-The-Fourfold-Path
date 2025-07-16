<?php
// admin.handler.php
require_once UTILS_PATH . 'envSetter.util.php';
require_once UTILS_PATH . 'admin.util.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

try {
    if ($method === 'GET') {
        // Optional filter by element: /handlers/admin.handler.php?element=fire
        $element = isset($_GET['element']) ? $_GET['element'] : null;
        $products = getAllProducts($element);
        echo json_encode(['products' => $products]);
        exit;
    }

    if ($method === 'POST') {
        $input = $_POST;
        $action = $input['action'] ?? null;
        if ($action === 'add') {
            $product = addProduct($input);
            if ($product) {
                echo json_encode(['success' => true, 'product' => $product]);
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Failed to add product.']);
            }
            exit;
        } elseif ($action === 'update' && isset($input['item_id'])) {
            $product = updateProduct($input['item_id'], $input);
            if ($product) {
                echo json_encode(['success' => true, 'product' => $product]);
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Failed to update product.']);
            }
            exit;
        } elseif ($action === 'delete' && isset($input['item_id'])) {
            $deleted = deleteProduct($input['item_id']);
            echo json_encode(['success' => $deleted]);
            exit;
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Invalid POST parameters.']);
            exit;
        }
    }

    if ($method === 'DELETE') {
        parse_str(file_get_contents("php://input"), $input);
        if (isset($input['item_id'])) {
            $deleted = deleteProduct($input['item_id']);
            echo json_encode(['success' => $deleted]);
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Missing item_id for deletion.']);
        }
        exit;
    }

    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed.']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Server Error: ' . $e->getMessage()]);
}
