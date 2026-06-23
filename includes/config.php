<?php
// Configuration Loader
function get_settings() {
    $settings_file = __DIR__ . '/../settings.json';
    if (file_exists($settings_file)) {
        $json = file_get_contents($settings_file);
        return json_decode($json, true);
    }
    // Default fallback settings
    return [
        "site_name" => "KEREA",
        "primary_color" => "#39DE4F",
        "accent_color" => "#F59E0B",
        "hero_bg_color" => "#000000",
        "hero_title" => "Quality Clean Tech",
        "hero_subtitle" => "Secured procurement for verified solar subsystems, induction cookstoves, and industrial energy storage.",
        "footer_bg_color" => "#0a0a0a",
        "announcement_text" => "Kerea Guaranteed Compliance",
        "header_bg" => "white",
        "text_color" => "#0f172a"
    ];
}

$settings = get_settings();
?>
