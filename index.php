<?php
declare(strict_types=1);

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/controllers/HomeController.php';

$controller = new HomeController(Database::connection());
$controller->index();

