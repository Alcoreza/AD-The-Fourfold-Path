<?php
require_once UTILS_PATH . 'envSetter.util.php';

function getDbConnection() {
    global $pgConfig;
    return pg_connect(sprintf(
        "host=%s port=%s dbname=%s user=%s password=%s",
        $pgConfig['host'], $pgConfig['port'], $pgConfig['db'],
        $pgConfig['user'], $pgConfig['pass']
    ));
}

/**
 * Adds an item to the user's cart (or updates the quantity if already exists).
 */
function addToCart(int $userId, int $itemId, int $quantity = 1): array {
    $conn = getDbConnection();
    if (!$conn) return ['error' => 'Database connection failed'];

    // Get or create cart
    $cartRes = pg_query_params($conn, "SELECT cart_id FROM carts WHERE user_id = $1", [$userId]);
    if (!$cartRes) {
        pg_close($conn);
        return ['error' => 'Failed to retrieve cart'];
    }

    if (pg_num_rows($cartRes) === 0) {
        $createCart = pg_query_params($conn, "INSERT INTO carts(user_id) VALUES($1) RETURNING cart_id", [$userId]);
        if (!$createCart) {
            pg_close($conn);
            return ['error' => 'Failed to create cart'];
        }
        $cartId = pg_fetch_result($createCart, 0, 'cart_id');
    } else {
        $cartId = pg_fetch_result($cartRes, 0, 'cart_id');
    }

    // Check if item is already in cart
    $existing = pg_query_params($conn, "SELECT quantity FROM cart_items WHERE cart_id = $1 AND item_id = $2", [$cartId, $itemId]);
    if (!$existing) {
        pg_close($conn);
        return ['error' => 'Failed to check existing cart item'];
    }

    if (pg_num_rows($existing) > 0) {
        $currentQty = (int)pg_fetch_result($existing, 0, 'quantity');
        $newQty = $currentQty + $quantity;
        $update = pg_query_params($conn, "UPDATE cart_items SET quantity = $1 WHERE cart_id = $2 AND item_id = $3", [$newQty, $cartId, $itemId]);
        if (!$update) {
            pg_close($conn);
            return ['error' => 'Failed to update quantity'];
        }
    } else {
        $insert = pg_query_params($conn, "INSERT INTO cart_items(cart_id, item_id, quantity) VALUES ($1, $2, $3)", [$cartId, $itemId, $quantity]);
        if (!$insert) {
            pg_close($conn);
            return ['error' => 'Failed to insert cart item'];
        }
    }

    pg_close($conn);
    return ['success' => 'Item added to cart'];
}

/**
 * Fetches all items in the user's cart.
 */
function fetchCartItems(int $userId): array {
    $conn = getDbConnection();
    if (!$conn) return ['error' => 'Database connection failed'];

    $query = "
        SELECT 
            ci.cart_item_id, ci.quantity,
            i.item_id, i.name, i.price, i.image_url
        FROM carts c
        JOIN cart_items ci ON ci.cart_id = c.cart_id
        JOIN items i ON i.item_id = ci.item_id
        WHERE c.user_id = $1
    ";

    $result = pg_query_params($conn, $query, [$userId]);
    if (!$result) {
        pg_close($conn);
        return ['error' => 'Failed to fetch cart items'];
    }

    $items = [];
    while ($row = pg_fetch_assoc($result)) {
        $items[] = $row;
    }

    pg_close($conn);
    return $items;
}

/**
 * Updates the quantity of a specific cart item.
 */
function updateCartItemQuantity(int $cartItemId, int $newQuantity): array {
    $conn = getDbConnection();
    if (!$conn) return ['error' => 'Database connection failed'];

    if ($newQuantity > 0) {
        $update = pg_query_params($conn, "UPDATE cart_items SET quantity = $1 WHERE cart_item_id = $2", [$newQuantity, $cartItemId]);
        if (!$update) {
            pg_close($conn);
            return ['error' => 'Failed to update quantity'];
        }
    } else {
        $delete = pg_query_params($conn, "DELETE FROM cart_items WHERE cart_item_id = $1", [$cartItemId]);
        if (!$delete) {
            pg_close($conn);
            return ['error' => 'Failed to remove cart item'];
        }
    }

    pg_close($conn);
    return ['success' => 'Cart item updated'];
}
