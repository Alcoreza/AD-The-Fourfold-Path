<?php
require_once UTILS_PATH . 'envSetter.util.php';

$host = $typeConfig['pgHost'];
$port = $typeConfig['pgPort'];
$db   = $typeConfig['pgDb'];
$user = $typeConfig['pgUser'];
$pass = $typeConfig['pgPass'];

if (!$host || !$port || !$db || !$user || !$pass) {
    echo "❌ Missing PostgreSQL environment variables.<br>";
    exit;
}

$connStr = "host=$host port=$port dbname=$db user=$user password=$pass";
$conn = pg_connect($connStr);

if (!$conn) {
    echo "❌ Connection Failed: " . htmlspecialchars(pg_last_error()) . "<br>";
} else {
    echo "✅ PostgreSQL Connection<br>";
}
