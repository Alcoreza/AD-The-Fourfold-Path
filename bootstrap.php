<?php
define('BASE_PATH', realpath(__DIR__));
define('HANDLERS_PATH', realpath(BASE_PATH . "/handlers"));
define('UTILS_PATH', realpath(BASE_PATH . "/utils") . '/');
define('COMPONENTS_PATH', realpath(BASE_PATH . "/components/componentGroup"));

chdir(BASE_PATH);