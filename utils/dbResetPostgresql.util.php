<?php
declare(strict_types=1);

require_once 'bootstrap.php';
require VENDOR_PATH . 'autoload.php';
require_once UTILS_PATH . 'envSetter.util.php';

$dsn = "pgsql:host={$pgConfig['host']};port={$pgConfig['port']};dbname={$pgConfig['db']}";
$pdo = new PDO($dsn, $pgConfig['user'], $pgConfig['pass'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

echo "Working on Iskima\n";
$schemaFiles = [
    'database/users.model.sql',
    'database/carts.model.sql',
    'database/cart.items.model.sql',
    'database/items.model.sql',
    'database/orders.model.sql'
];

foreach ($schemaFiles as $file) {
    echo "Applying $file...\n";
    $sql = file_get_contents($file);
    if ($sql === false) {
        throw new RuntimeException("Di ko mabasa file mo na $file");
    }
    $pdo -> exec($sql);
}

echo "Nareset na and mga DITABIS SUCKSESPULLY.\n";