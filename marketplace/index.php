<?php
/**
 * KEREA Marketplace — External Redirect
 * The KEREA Marketplace is hosted at https://marketplace.kerea.org/
 * This file performs a permanent 301 redirect.
 */

// Load settings to get configured marketplace URL
$settingsFile = dirname(__DIR__) . '/includes/config.php';
$marketplaceUrl = 'https://marketplace.kerea.org/';

if (file_exists($settingsFile)) {
    include_once $settingsFile;
    if (isset($settings['marketplace_url']) && filter_var($settings['marketplace_url'], FILTER_VALIDATE_URL)) {
        $marketplaceUrl = $settings['marketplace_url'];
    }
}

// 301 Permanent Redirect
header('HTTP/1.1 301 Moved Permanently');
header('Location: ' . $marketplaceUrl);
exit;
