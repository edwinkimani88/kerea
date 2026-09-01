<?php
/**
 * KEREA — Vercel/Serverless PHP Router
 * Routes incoming requests to the appropriate PHP file.
 */

$rawUri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($rawUri, PHP_URL_PATH) ?? '/';
$path = rtrim($path, '/');
if (empty($path)) $path = '';

$cleanPath = ltrim($path, '/');

// ── Explicit Route Map ───────────────────────────────────────
$routes = [
    // ── Homepage ──────────────────────────────────────────────
    ''                                    => 'index.php',
    '/'                                   => 'index.php',
    '/index.php'                          => 'index.php',

    // ── Public Pages ──────────────────────────────────────────
    '/about'                              => 'about/index.php',
    '/about/index.php'                    => 'about/index.php',
    '/leadership'                         => 'leadership/index.php',
    '/leadership/index.php'               => 'leadership/index.php',
    '/contact'                            => 'contact/index.php',
    '/contact/index.php'                  => 'contact/index.php',
    '/standards'                          => 'standards/index.php',
    '/standards/index.php'                => 'standards/index.php',
    '/policy-advocacy'                    => 'policy-advocacy/index.php',
    '/policy-advocacy/index.php'          => 'policy-advocacy/index.php',
    '/member-directory'                   => 'member-directory/index.php',
    '/member-directory/index.php'         => 'member-directory/index.php',
    '/news'                               => 'news/index.php',
    '/news/index.php'                     => 'news/index.php',
    '/events'                             => 'events/index.php',
    '/events/index.php'                   => 'events/index.php',
    '/publications'                       => 'publications/index.php',
    '/publications/index.php'             => 'publications/index.php',
    '/knowledge-hub'                      => 'knowledge-hub/index.php',
    '/knowledge-hub/index.php'            => 'knowledge-hub/index.php',
    '/partnerships'                       => 'partnerships/index.php',
    '/partnerships/index.php'             => 'partnerships/index.php',
    '/access-to-finance'                  => 'access-to-finance/index.php',
    '/access-to-finance/index.php'        => 'access-to-finance/index.php',
    '/market-development'                 => 'market-development/index.php',
    '/market-development/index.php'       => 'market-development/index.php',
    '/kenya-renewable-energy-association' => 'kenya-renewable-energy-association/index.php',
    '/kenya-renewable-energy-association/index.php' => 'kenya-renewable-energy-association/index.php',

    // ── Membership Portal ─────────────────────────────────────
    '/membership'                         => 'membership/index.php',
    '/membership/index.php'               => 'membership/index.php',
    '/membership/register'                => 'membership/register.php',
    '/membership/register.php'            => 'membership/register.php',
    '/membership/dashboard'               => 'membership/dashboard/index.php',
    '/membership/dashboard/index.php'     => 'membership/dashboard/index.php',
    '/membership/dashboard/renewal'       => 'membership/dashboard/renewal.php',
    '/membership/dashboard/renewal.php'   => 'membership/dashboard/renewal.php',
    '/membership/dashboard/resources'     => 'membership/dashboard/resources.php',
    '/membership/dashboard/resources.php' => 'membership/dashboard/resources.php',
    '/membership/dashboard/status'        => 'membership/dashboard/status.php',
    '/membership/dashboard/status.php'    => 'membership/dashboard/status.php',
    '/membership/renewal'                 => 'membership/renewal.php',
    '/membership/renewal.php'             => 'membership/renewal.php',

    // ── Marketplace Redirect ──────────────────────────────────
    '/marketplace'                        => 'marketplace/index.php',
    '/marketplace/index.php'              => 'marketplace/index.php',
    '/vendor'                             => 'vendor/index.php',
    '/vendor/index.php'                   => 'vendor/index.php',

    // ── Auth ──────────────────────────────────────────────────
    '/auth'                               => 'auth/index.php',
    '/auth/index.php'                     => 'auth/index.php',
    '/auth/register'                      => 'auth/register.php',
    '/auth/register.php'                  => 'auth/register.php',
    '/auth/forgot-password'               => 'auth/forgot-password.php',
    '/auth/forgot-password.php'           => 'auth/forgot-password.php',
    '/auth/reset-password'                => 'auth/reset-password.php',
    '/auth/reset-password.php'            => 'auth/reset-password.php',

    // ── Admin CMS ─────────────────────────────────────────────
    '/admin'                              => 'admin/index.php',
    '/admin/index.php'                    => 'admin/index.php',
    '/admin/content'                      => 'admin/content.php',
    '/admin/content.php'                  => 'admin/content.php',
    '/admin/pages'                        => 'admin/pages.php',
    '/admin/pages.php'                    => 'admin/pages.php',
    '/admin/events'                       => 'admin/events.php',
    '/admin/events.php'                   => 'admin/events.php',
    '/admin/partners'                     => 'admin/partners.php',
    '/admin/partners.php'                 => 'admin/partners.php',
    '/admin/media'                        => 'admin/media.php',
    '/admin/media.php'                    => 'admin/media.php',
    '/admin/menus'                        => 'admin/menus.php',
    '/admin/menus.php'                    => 'admin/menus.php',
    '/admin/users'                        => 'admin/users.php',
    '/admin/users.php'                    => 'admin/users.php',
    '/admin/analytics'                    => 'admin/analytics.php',
    '/admin/analytics.php'                => 'admin/analytics.php',
    '/admin/customization'                => 'admin/customization.php',
    '/admin/customization.php'            => 'admin/customization.php',

    // ── Backend APIs (with & without .php) ───────────────────
    '/backend/api/auth'                   => 'backend/api/auth.php',
    '/backend/api/auth.php'               => 'backend/api/auth.php',
    '/backend/api/content'                => 'backend/api/content.php',
    '/backend/api/content.php'            => 'backend/api/content.php',
    '/backend/api/media'                  => 'backend/api/media.php',
    '/backend/api/media.php'              => 'backend/api/media.php',
    '/backend/api/menus'                  => 'backend/api/menus.php',
    '/backend/api/menus.php'              => 'backend/api/menus.php',
    '/backend/api/settings'               => 'backend/api/settings.php',
    '/backend/api/settings.php'           => 'backend/api/settings.php',
    '/backend/api/users'                  => 'backend/api/users.php',
    '/backend/api/users.php'              => 'backend/api/users.php',
];

$target = null;

if (isset($routes[$path])) {
    $target = $routes[$path];
} elseif (isset($routes['/' . $cleanPath])) {
    $target = $routes['/' . $cleanPath];
} elseif (!empty($cleanPath)) {
    // Dynamic file discovery
    $candidates = [
        $cleanPath,
        $cleanPath . '.php',
        $cleanPath . '/index.php',
    ];
    foreach ($candidates as $cand) {
        $full = dirname(__DIR__) . '/' . $cand;
        if (file_exists($full) && !is_dir($full) && str_ends_with($cand, '.php')) {
            $target = $cand;
            break;
        }
    }
}

// ── Execute PHP file if resolved ─────────────────────────────
if ($target) {
    $targetFile = dirname(__DIR__) . '/' . $target;
    if (file_exists($targetFile)) {
        chdir(dirname($targetFile));
        require $targetFile;
        exit;
    }
}

// ── Serve static assets ──────────────────────────────────────
if (!empty($cleanPath)) {
    $staticFile = dirname(__DIR__) . '/' . $cleanPath;
    if (file_exists($staticFile) && !is_dir($staticFile)) {
        $ext = strtolower(pathinfo($staticFile, PATHINFO_EXTENSION));
        if ($ext !== 'php') {
            $mimes = [
                'css'   => 'text/css',
                'js'    => 'application/javascript',
                'png'   => 'image/png',
                'jpg'   => 'image/jpeg',
                'jpeg'  => 'image/jpeg',
                'svg'   => 'image/svg+xml',
                'webp'  => 'image/webp',
                'gif'   => 'image/gif',
                'ico'   => 'image/x-icon',
                'pdf'   => 'application/pdf',
                'woff'  => 'font/woff',
                'woff2' => 'font/woff2',
                'ttf'   => 'font/ttf',
                'json'  => 'application/json',
            ];
            if (isset($mimes[$ext])) {
                header('Content-Type: ' . $mimes[$ext]);
            }
            readfile($staticFile);
            exit;
        }
    }
}

// ── Fallback to homepage ─────────────────────────────────────
chdir(dirname(__DIR__));
require dirname(__DIR__) . '/index.php';

