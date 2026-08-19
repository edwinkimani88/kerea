<?php
/**
 * KEREA Database Configuration
 * PDO Singleton — PHP 8+
 */
declare(strict_types=1);

// ── Database Credentials ────────────────────────────────────
if (!defined('DB_HOST')) {
    $dbHost = getenv('DB_HOST') ?: (getenv('MYSQLHOST') ?: 'localhost');
    $dbPort = getenv('DB_PORT') ?: (getenv('MYSQLPORT') ?: '3306');
    if ($dbPort !== '3306' && !str_contains($dbHost, ':')) {
        $dbHost .= ':' . $dbPort;
    }
    define('DB_HOST', $dbHost);
}
if (!defined('DB_NAME')) {
    define('DB_NAME', getenv('DB_NAME') ?: (getenv('MYSQLDATABASE') ?: 'kerea_db'));
}
if (!defined('DB_USER')) {
    define('DB_USER', getenv('DB_USER') ?: (getenv('MYSQLUSER') ?: 'root'));
}
if (!defined('DB_PASS')) {
    $pass = getenv('DB_PASS');
    if ($pass === false) $pass = getenv('MYSQLPASSWORD');
    define('DB_PASS', $pass !== false ? (string)$pass : '');
}
if (!defined('DB_CHARSET')) {
    define('DB_CHARSET', 'utf8mb4');
}

// ── Application URLs ────────────────────────────────────────
// Set BASE_URL to your actual domain in production.
// e.g. 'https://kerea.org'  (no trailing slash)
define('BASE_URL', '');          // Leave empty for relative URLs on shared hosting

// ── Upload Settings ─────────────────────────────────────────
define('UPLOAD_DIR',     dirname(__DIR__, 2) . '/uploads/');
define('UPLOAD_URL',     BASE_URL . '/uploads/');
define('MAX_FILE_SIZE',  20 * 1024 * 1024); // 20 MB

// ── Session ──────────────────────────────────────────────────
define('SESSION_NAME',     'kerea_session');
define('SESSION_LIFETIME', 3600 * 8); // 8 hours

// ── Security ─────────────────────────────────────────────────
define('CSRF_TOKEN_KEY', 'kerea_csrf_token');

// ── Marketplace External URL ─────────────────────────────────
define('MARKETPLACE_URL', 'https://marketplace.kerea.org/');
