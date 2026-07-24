<?php
/**
 * KEREA — Vercel/Apache PHP Router
 * Routes incoming requests to the appropriate PHP file.
 * Works for both Vercel serverless and XAMPP local dev.
 */

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = rtrim($path, '/');
if (empty($path)) $path = '';

$routes = [
    // ── Homepage ──────────────────────────────────────────
    ''                              => 'index.php',

    // ── Public Pages ──────────────────────────────────────
    '/about'                        => 'about/index.php',
    '/contact'                      => 'contact/index.php',
    '/standards'                    => 'standards/index.php',
    '/policy-advocacy'              => 'policy-advocacy/index.php',
    '/member-directory'             => 'member-directory/index.php',
    '/news'                         => 'news/index.php',
    '/events'                       => 'events/index.php',
    '/publications'                 => 'publications/index.php',
    '/knowledge-hub'                => 'knowledge-hub/index.php',
    '/partnerships'                 => 'partnerships/index.php',
    '/access-to-finance'            => 'access-to-finance/index.php',
    '/market-development'           => 'market-development/index.php',
    '/kenya-renewable-energy-association' => 'kenya-renewable-energy-association/index.php',

    // ── Membership Portal ─────────────────────────────────
    '/membership'                   => 'membership/index.php',
    '/membership/index.php'         => 'membership/index.php',
    '/membership/register'          => 'membership/register.php',
    '/membership/register.php'      => 'membership/register.php',
    '/membership/dashboard'         => 'membership/dashboard/index.php',
    '/membership/dashboard/index.php' => 'membership/dashboard/index.php',
    '/membership/dashboard/renewal' => 'membership/dashboard/renewal.php',
    '/membership/dashboard/resources' => 'membership/dashboard/resources.php',
    '/membership/dashboard/status'  => 'membership/dashboard/status.php',
    '/membership/renewal'           => 'membership/renewal.php',

    // ── Marketplace Redirect ───────────────────────────────
    // Marketplace is hosted externally at marketplace.kerea.org
    '/marketplace'                  => 'marketplace/index.php',
    '/marketplace/index.php'        => 'marketplace/index.php',
    '/vendor'                       => 'vendor/index.php',
    '/vendor/index.php'             => 'vendor/index.php',

    // ── Auth ──────────────────────────────────────────────
    '/auth'                         => 'auth/index.php',
    '/auth/index.php'               => 'auth/index.php',
    '/auth/forgot-password'         => 'auth/forgot-password.php',
    '/auth/forgot-password.php'     => 'auth/forgot-password.php',
    '/auth/reset-password'          => 'auth/reset-password.php',
    '/auth/reset-password.php'      => 'auth/reset-password.php',

    // ── Admin CMS ────────────────────────────────────────
    '/admin'                        => 'admin/index.php',
    '/admin/index.php'              => 'admin/index.php',
    '/admin/content'                => 'admin/content.php',
    '/admin/content.php'            => 'admin/content.php',
    '/admin/pages'                  => 'admin/pages.php',
    '/admin/pages.php'              => 'admin/pages.php',
    '/admin/events'                 => 'admin/events.php',
    '/admin/events.php'             => 'admin/events.php',
    '/admin/partners'               => 'admin/partners.php',
    '/admin/partners.php'           => 'admin/partners.php',
    '/admin/media'                  => 'admin/media.php',
    '/admin/media.php'              => 'admin/media.php',
    '/admin/menus'                  => 'admin/menus.php',
    '/admin/menus.php'              => 'admin/menus.php',
    '/admin/users'                  => 'admin/users.php',
    '/admin/users.php'              => 'admin/users.php',
    '/admin/analytics'              => 'admin/analytics.php',
    '/admin/analytics.php'          => 'admin/analytics.php',
    '/admin/customization'          => 'admin/customization.php',
    '/admin/customization.php'      => 'admin/customization.php',

    // ── Backend APIs ─────────────────────────────────────
    '/backend/api/auth'             => 'backend/api/auth.php',
    '/backend/api/content'          => 'backend/api/content.php',
    '/backend/api/media'            => 'backend/api/media.php',
    '/backend/api/menus'            => 'backend/api/menus.php',
    '/backend/api/settings'         => 'backend/api/settings.php',
    '/backend/api/users'            => 'backend/api/users.php',
];

if (isset($routes[$path])) {
    $file = __DIR__ . '/../' . $routes[$path];
    if (file_exists($file)) {
        chdir(dirname($file));
        require $file;
        exit;
    }
}

// Serve static assets
$publicFile = __DIR__ . '/../' . ltrim($path, '/');
if (!empty($path) && file_exists($publicFile) && !is_dir($publicFile)) {
    $ext = strtolower(pathinfo($publicFile, PATHINFO_EXTENSION));
    if ($ext !== 'php') {
        $mimes = [
            'css'  => 'text/css',
            'js'   => 'application/javascript',
            'png'  => 'image/png',
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'svg'  => 'image/svg+xml',
            'webp' => 'image/webp',
            'pdf'  => 'application/pdf',
            'woff' => 'font/woff',
            'woff2'=> 'font/woff2',
        ];
        if (isset($mimes[$ext])) header('Content-Type: ' . $mimes[$ext]);
        readfile($publicFile);
        exit;
    }
}

// Fallback to homepage
chdir(__DIR__ . '/..');
require __DIR__ . '/../index.php';
