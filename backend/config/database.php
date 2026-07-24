<?php
/**
 * KEREA Database Configuration
 * PDO Singleton — PHP 8+
 */
declare(strict_types=1);

// ── Database Credentials ────────────────────────────────────
// Update these before deploying to production cPanel.
define('DB_HOST', 'localhost');
define('DB_NAME', 'kerea_db');
define('DB_USER', 'root');       // cPanel: your cPanel DB username
define('DB_PASS', '');           // cPanel: your cPanel DB password
define('DB_CHARSET', 'utf8mb4');

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
