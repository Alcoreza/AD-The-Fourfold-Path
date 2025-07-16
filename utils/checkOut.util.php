<?php
require_once UTILS_PATH . '/envSetter.util.php';


function completeOrderForUser($userId): array
{
    global $pgConfig;
    // Create the connection string
    $connStr = sprintf(
        "host=%s port=%s dbname=%s user=%s password=%s",
        $pgConfig['host'],
        $pgConfig['port'],
        $pgConfig['db'],
        $pgConfig['user'],
        $pgConfig['pass']
    );

    $conn = pg_connect($connStr);
    if (!$conn) {
        return ['status' => 'error', 'message' => 'Database connection failed'];
    }

    // Get user's cart ID
    $cartQuery = "SELECT cart_id FROM carts WHERE user_id = $1";
    $cartResult = pg_query_params($conn, $cartQuery, [$userId]);

    if (!$cartResult || pg_num_rows($cartResult) === 0) {
        pg_close($conn);
        return ['status' => 'error', 'message' => 'Cart not found for user'];
    }

    $cart = pg_fetch_assoc($cartResult);
    $cartId = $cart['cart_id'];

    // Get cart items
    $itemsQuery = "SELECT * FROM cart_items WHERE cart_id = $1";
    $itemsResult = pg_query_params($conn, $itemsQuery, [$cartId]);

    if (!$itemsResult || pg_num_rows($itemsResult) === 0) {
        pg_close($conn);
        return ['status' => 'error', 'message' => 'No items in cart'];
    }

    // Begin transaction
    pg_query($conn, 'BEGIN');

    // Deduct stock and validate
    while ($item = pg_fetch_assoc($itemsResult)) {
        $itemId = $item['item_id'];
        $quantity = $item['quantity'];

        $stockCheckQuery = "SELECT stock_quantity FROM items WHERE item_id = $1 FOR UPDATE";
        $stockCheckResult = pg_query_params($conn, $stockCheckQuery, [$itemId]);

        if (!$stockCheckResult || pg_num_rows($stockCheckResult) === 0) {
            pg_query($conn, 'ROLLBACK');
            pg_close($conn);
            return ['status' => 'error', 'message' => 'Item not found: ' . $itemId];
        }

        $stockRow = pg_fetch_assoc($stockCheckResult);
        $availableStock = (int) $stockRow['stock_quantity'];

        if ($availableStock < $quantity) {
            pg_query($conn, 'ROLLBACK');
            pg_close($conn);
            return ['status' => 'error', 'message' => 'Not enough stock for item ID ' . $itemId];
        }

        // Deduct stock
        $updateStockQuery = "UPDATE items SET stock_quantity = stock_quantity - $1 WHERE item_id = $2";
        pg_query_params($conn, $updateStockQuery, [$quantity, $itemId]);
    }

    // Create the order
    $insertOrderQuery = "INSERT INTO orders (user_id, cart_id, completed) VALUES ($1, $2, TRUE) RETURNING order_id";
    $orderResult = pg_query_params($conn, $insertOrderQuery, [$userId, $cartId]);

    if (!$orderResult) {
        pg_query($conn, 'ROLLBACK');
        pg_close($conn);
        return ['status' => 'error', 'message' => 'Failed to insert order'];
    }

    // Clear the cart items
    $deleteCartItemsQuery = "DELETE FROM cart_items WHERE cart_id = $1";
    pg_query_params($conn, $deleteCartItemsQuery, [$cartId]);

    // Commit the transaction
    pg_query($conn, 'COMMIT');
    pg_close($conn);

    return ['status' => 'success', 'message' => 'Order completed successfully'];
}