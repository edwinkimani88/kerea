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
    '' => 'index.php',
    '/about' => 'about/index.php',
    '/contact' => 'contact/index.php',
    '/standards' => 'standards/index.php',
    '/marketplace' => 'marketplace/index.php',
    '/policy-advocacy' => 'policy-advocacy/index.php',
    '/member-directory' => 'member-directory/index.php',
    '/marketplace/product' => 'marketplace/product/index.php',
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
