<?php
// Ensure session is always started early
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Path Constants
define('BASE_PATH', realpath(__DIR__));
define('UTILS_PATH', BASE_PATH . '/utils/');
define('VENDOR_PATH', BASE_PATH . '/vendor/');
define('HANDLERS_PATH', BASE_PATH . '/handlers/');
define('COMPONENTS_PATH', BASE_PATH . '/components/componentGroup');
define('TEMPLATES_PATH', BASE_PATH . '/components/templates');
define('ASSETS_PATH', BASE_PATH . '/assets/');
define('DATABASE_PATH', BASE_PATH . '/database');
define('DUMMIES_PATH', BASE_PATH . '/staticDatas/');
define('LAYOUT_PATH', BASE_PATH . '/layouts/');
define('BOOTSTRAP_PATH', BASE_PATH . '/bootstrap.php');

// Always ensure you’re working from base path
chdir(BASE_PATH);

// Load environment config if needed early on (optional but useful)
require_once UTILS_PATH . 'envSetter.util.php';
