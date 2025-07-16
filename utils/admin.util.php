<?php
// admin.util.php

require_once UTILS_PATH . 'envSetter.util.php';

/**
 * Establish and return a PostgreSQL database connection.
 *
 * @return resource PostgreSQL connection resource
 */
function getDbConnection()
{
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

/**
 * Retrieve all non-deleted products from the database, optionally filtered by element.
 *
 * @param string|null $element
 * @return array
 */
function getAllProducts(?string $element = null): array
{
    $conn = getDbConnection();
    $params = [];
    $where = "WHERE isDELETED = FALSE";
    if ($element && in_array($element, ['fire', 'water', 'earth', 'air'])) {
        $where .= " AND image_url LIKE $1";
        $params[] = "%/{$element}/%";
    }
    $query = "SELECT item_id, name, price, image_url, stock_quantity, description FROM items $where ORDER BY item_id DESC";
    $result = pg_query_params($conn, $query, $params);

    $products = [];
    while ($row = pg_fetch_assoc($result)) {
        $row['element'] = getElementFromUrl($row['image_url'] ?? '');
        $products[] = $row;
    }
    pg_close($conn);
    return $products;
}

/**
 * Get a single product by ID.
 */
function getProductById($itemId)
{
    $conn = getDbConnection();
    $query = "SELECT item_id, name, price, image_url, stock_quantity, description FROM items WHERE item_id = $1 AND isDELETED = FALSE";
    $result = pg_query_params($conn, $query, [$itemId]);
    $product = pg_fetch_assoc($result);
    if ($product) {
        $product['element'] = getElementFromUrl($product['image_url'] ?? '');
    }
    pg_close($conn);
    return $product;
}

/**
 * Infer the elemental type from the image URL.
 */
function getElementFromUrl(string $url): string
{
    if (strpos($url, '/fire/') !== false) {
        return 'fire';
    } elseif (strpos($url, '/water/') !== false) {
        return 'water';
    } elseif (strpos($url, '/earth/') !== false) {
        return 'earth';
    } elseif (strpos($url, '/air/') !== false) {
        return 'air';
    }
    return 'unknown';
}

/**
 * Adds a new product to the database.
 * @param array $data
 * @return array|false The inserted product or false on failure
 */
function addProduct(array $data)
{
    $conn = getDbConnection();
    $query = "INSERT INTO items (name, price, image_url, stock_quantity, description) VALUES ($1, $2, $3, $4, $5) RETURNING item_id, name, price, image_url, stock_quantity, description";
    $result = pg_query_params($conn, $query, [
        $data['name'],
        $data['price'],
        $data['image_url'] ?? '',
        $data['stock_quantity'] ?? 0,
        $data['description'] ?? ''
    ]);
    $product = $result ? pg_fetch_assoc($result) : false;
    if ($product) {
        $product['element'] = getElementFromUrl($product['image_url'] ?? '');
    }
    pg_close($conn);
    return $product;
}

/**
 * Updates an existing product.
 * @param string $itemId
 * @param array $data
 * @return array|false The updated product or false on failure
 */
function updateProduct(string $itemId, array $data)
{
    $conn = getDbConnection();
    $query = "UPDATE items SET name = $1, price = $2, image_url = $3, stock_quantity = $4, description = $5 WHERE item_id = $6 RETURNING item_id, name, price, image_url, stock_quantity, description";
    $result = pg_query_params($conn, $query, [
        $data['name'],
        $data['price'],
        $data['image_url'] ?? '',
        $data['stock_quantity'] ?? 0,
        $data['description'] ?? '',
        $itemId
    ]);
    $product = $result ? pg_fetch_assoc($result) : false;
    if ($product) {
        $product['element'] = getElementFromUrl($product['image_url'] ?? '');
    }
    pg_close($conn);
    return $product;
}

/**
 * Soft deletes a product by setting isDELETED to true.
 * @param string $itemId
 * @return bool
 */
function deleteProduct(string $itemId): bool
{
    $conn = getDbConnection();
    $query = "UPDATE items SET isDELETED = TRUE WHERE item_id = $1";
    $result = pg_query_params($conn, $query, [$itemId]);
    pg_close($conn);
    return $result !== false;
}
