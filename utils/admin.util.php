<?php
require_once UTILS_PATH . 'envSetter.util.php';

function getDbConnection() {
    global $pgConfig;
    $conn = pg_connect(sprintf(
        "host=%s port=%s dbname=%s user=%s password=%s",
        $pgConfig['host'],
        $pgConfig['port'],
        $pgConfig['db'],
        $pgConfig['user'],
        $pgConfig['pass']
    ));
    if (!$conn) {
        die("Database connection failed");
    }
    return $conn;
}

function getAllProducts(): array {
    $conn = getDbConnection();
    $result = pg_query($conn, "SELECT item_id, name, price, image_url, stock_quantity, description FROM items WHERE isDELETED = FALSE ORDER BY item_id DESC");
    $products = [];
    while ($row = pg_fetch_assoc($result)) {
        $row['element'] = getElementFromUrl($row['image_url'] ?? '');
        $products[] = $row;
    }
    pg_close($conn);
    return $products;
}

function addProduct($data): bool {
    $name = trim($data['name'] ?? '');
    $price = (float)($data['price'] ?? 0);
    $image = trim($data['image_url'] ?? '');
    $quantity = (int)($data['stock_quantity'] ?? 0);
    $desc = trim($data['description'] ?? '');
    if (!$name || $price <= 0 || $quantity < 0) return false;
    $conn = getDbConnection();
    $result = pg_query_params(
        $conn,
        "INSERT INTO items (name, price, image_url, stock_quantity, description) VALUES ($1, $2, $3, $4, $5)",
        [$name, $price, $image, $quantity, $desc]
    );
    pg_close($conn);
    return $result !== false;
}

function updateProduct($data): bool {
    $id = (int)($data['item_id'] ?? 0);
    $name = trim($data['name'] ?? '');
    $price = (float)($data['price'] ?? 0);
    $image = array_key_exists('image_url', $data) ? trim($data['image_url']) : '';
    $quantity = array_key_exists('stock_quantity', $data) && $data['stock_quantity'] !== '' ? (int)$data['stock_quantity'] : null;
    $desc = trim($data['description'] ?? '');
    if (!$id || !$name || $price <= 0) return false;
    $conn = getDbConnection();
    // If image_url or stock_quantity is empty, keep the old one
    $old = null;
    if ($image === '' || $quantity === null) {
        $res = pg_query_params($conn, "SELECT image_url, stock_quantity FROM items WHERE item_id = $1", [$id]);
        $old = pg_fetch_assoc($res);
    }
    if ($image === '' && $old) {
        $image = $old['image_url'];
    }
    if ($quantity === null && $old) {
        $quantity = (int)$old['stock_quantity'];
    }
    if ($quantity < 0) {
        pg_close($conn);
        return false;
    }
    $result = pg_query_params(
        $conn,
        "UPDATE items SET name = $1, price = $2, image_url = $3, stock_quantity = $4, description = $5 WHERE item_id = $6",
        [$name, $price, $image, $quantity, $desc, $id]
    );
    pg_close($conn);
    return $result !== false;
}

function deleteProduct($data): bool {
    $id = (int)($data['item_id'] ?? 0);
    if (!$id) return false;
    $conn = getDbConnection();
    $result = pg_query_params($conn, "UPDATE items SET isDELETED = TRUE WHERE item_id = $1", [$id]);
    pg_close($conn);
    return $result !== false;
}

function getElementFromUrl(string $url): string {
    if (strpos($url, '/fire/') !== false) return 'fire';
    if (strpos($url, '/water/') !== false) return 'water';
    if (strpos($url, '/earth/') !== false) return 'earth';
    if (strpos($url, '/air/') !== false) return 'air';
    return 'unknown';
}
