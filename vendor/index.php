<?php
/**
 * KEREA Vendor Portal — External Redirect
 * The Vendor Portal is hosted externally as part of the Marketplace.
 * This file redirects to the external marketplace vendor portal.
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

// Redirect to marketplace vendor portal
$vendorPortalUrl = rtrim($marketplaceUrl, '/') . '/vendor/';
header('HTTP/1.1 301 Moved Permanently');
header('Location: ' . $vendorPortalUrl);
exit;
