<?php
require_once UTILS_PATH . 'envSetter.util.php';

// Safely access environment variables
$host = $_ENV['PG_HOST'] ?? null;
$port = $_ENV['PG_PORT'] ?? null;
$db   = $_ENV['PG_DB']   ?? null;
$user = $_ENV['PG_USER'] ?? null;
$pass = $_ENV['PG_PASS'] ?? null;

if (!$host || !$port || !$db || !$user || !$pass) {
    echo "❌ Missing one or more PostgreSQL environment variables.<br>";
    exit;
}

$connStr = "host=$host port=$port dbname=$db user=$user password=$pass";
$conn = pg_connect($connStr);

if (!$conn) {
    echo "❌ Connection Failed: " . htmlspecialchars(pg_last_error()) . "<br>";
} else {
    echo "✅ Connected to PostgreSQL successfully.<br>";
}
