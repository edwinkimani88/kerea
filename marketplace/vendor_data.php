<?php
$vendors_json = __DIR__ . '/vendors.json';
if (file_exists($vendors_json)) {
    $vendors = json_decode(file_get_contents($vendors_json), true);
} else {
    // Fallback if JSON is missing
    $vendors = [];
}
?>
