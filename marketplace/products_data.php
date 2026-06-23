<?php
$products_json = __DIR__ . '/products.json';
if (file_exists($products_json)) {
    $products = json_decode(file_get_contents($products_json), true);
} else {
    // Fallback if JSON is missing
    $products = [];
}
?>
