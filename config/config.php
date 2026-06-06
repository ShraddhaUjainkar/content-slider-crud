<?php
declare(strict_types=1);

define('APP_NAME', 'WPoets Tabs Slider');
define('BASE_URL', '');
define('UPLOAD_DIR', __DIR__ . '/../assets/uploads/');
define('UPLOAD_URL', 'assets/uploads/');
define('MAX_UPLOAD_SIZE', 2 * 1024 * 1024);

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'wpoets_assignment');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function verify_csrf(): void
{
    $token = (string) ($_POST['csrf_token'] ?? '');
    if ($token === '' || !hash_equals((string) ($_SESSION['csrf_token'] ?? ''), $token)) {
        throw new RuntimeException('Security token expired. Please refresh and try again.');
    }
}

function redirect(string $path): never
{
    header('Location: ' . $path);
    exit;
}

function admin_url(string $query = ''): string
{
    $path = rtrim(BASE_URL, '/') . '/admin/index.php';

    return $query === '' ? $path : $path . '?' . ltrim($query, '?');
}
