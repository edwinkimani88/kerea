<?php
/**
 * Vercel PHP Router
 * This file handles routing for Vercel deployment while keeping the root
 * structure intact for local XAMPP development.
 */

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Normalize path (remove trailing slash)
$path = rtrim($path, '/');
if (empty($path)) $path = '';

// Mapping URLs to their respective files
$routes = [
    // Homepage
    ''                              => 'index.php',

    // Core public pages
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

    // Membership portal
    '/membership'                   => 'membership/index.php',
    '/membership/index.php'         => 'membership/index.php',
    '/membership/register'          => 'membership/register.php',
    '/membership/register.php'      => 'membership/register.php',
    '/membership/dashboard'         => 'membership/dashboard/index.php',
    '/membership/dashboard/index.php' => 'membership/dashboard/index.php',
    '/membership/dashboard/renewal' => 'membership/dashboard/renewal.php',
    '/membership/dashboard/renewal.php' => 'membership/dashboard/renewal.php',
    '/membership/dashboard/resources' => 'membership/dashboard/resources.php',
    '/membership/dashboard/resources.php' => 'membership/dashboard/resources.php',
    '/membership/dashboard/status'  => 'membership/dashboard/status.php',
    '/membership/dashboard/status.php' => 'membership/dashboard/status.php',

    // Vendor portal
    '/vendor'                       => 'vendor/dashboard.php',
    '/vendor/index.php'             => 'vendor/dashboard.php',
    '/vendor/dashboard'             => 'vendor/dashboard.php',
    '/vendor/dashboard.php'         => 'vendor/dashboard.php',
    '/vendor/register'              => 'vendor/register.php',
    '/vendor/register.php'          => 'vendor/register.php',
    '/vendor/kyc'                   => 'vendor/kyc.php',
    '/vendor/kyc.php'               => 'vendor/kyc.php',
    '/vendor/products'              => 'vendor/products/index.php',
    '/vendor/products/index.php'    => 'vendor/products/index.php',
    '/vendor/products/create'       => 'vendor/products/create.php',
    '/vendor/products/create.php'   => 'vendor/products/create.php',

    // Marketplace
    '/marketplace'                  => 'marketplace/index.php',
    '/marketplace/index.php'        => 'marketplace/index.php',
    '/marketplace/product'          => 'marketplace/product/index.php',
    '/marketplace/product/index.php' => 'marketplace/product/index.php',
    '/marketplace/vendor'           => 'marketplace/vendor/index.php',
    '/marketplace/vendor/index.php' => 'marketplace/vendor/index.php',

    // Auth
    '/auth'                         => 'auth/index.php',
    '/auth/index.php'               => 'auth/index.php',

    // Admin
    '/admin'                        => 'admin/index.php',
    '/admin/index.php'              => 'admin/index.php',
    '/admin/vendors'                => 'admin/vendors.php',
    '/admin/vendors.php'            => 'admin/vendors.php',
    '/admin/products'               => 'admin/products.php',
    '/admin/products.php'           => 'admin/products.php',
    '/admin/analytics'              => 'admin/analytics.php',
    '/admin/analytics.php'          => 'admin/analytics.php',
    '/admin/content'                => 'admin/content.php',
    '/admin/content.php'            => 'admin/content.php',
    '/admin/support'                => 'admin/support.php',
    '/admin/support.php'            => 'admin/support.php',
    '/admin/customization'          => 'admin/customization.php',
    '/admin/customization.php'      => 'admin/customization.php',
    '/admin/categories'             => 'admin/categories.php',
    '/admin/categories.php'         => 'admin/categories.php',
    '/admin/marketplace-settings'   => 'admin/marketplace-settings.php',
    '/admin/marketplace-settings.php' => 'admin/marketplace-settings.php',
];

if (isset($routes[$path])) {
    $file = __DIR__ . '/../' . $routes[$path];
    if (file_exists($file)) {
        // Change directory to the file's parent so internal includes work
        chdir(dirname($file));
        require $file;
        exit;
    }
}

// Serve static files if they exist (though Vercel usually handles this via routes)
$publicFile = __DIR__ . '/../' . ltrim($path, '/');
if (!empty($path) && file_exists($publicFile) && !is_dir($publicFile)) {
    $ext = pathinfo($publicFile, PATHINFO_EXTENSION);
    if ($ext !== 'php') {
        // Simple mime type detection for common assets
        $mimes = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'svg' => 'image/svg+xml',
        ];
        if (isset($mimes[$ext])) header("Content-Type: " . $mimes[$ext]);
        readfile($publicFile);
        exit;
    }
}

// Default fallback to homepage
chdir(__DIR__ . '/..');
require __DIR__ . '/../index.php';
