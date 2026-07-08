<?php
if (!function_exists('get_settings')) {
    function get_settings() {
        $settings_file = __DIR__ . '/../settings.json';
        if (file_exists($settings_file)) {
            $json = file_get_contents($settings_file);
            $settings = json_decode($json, true);
        } else {
            $settings = [];
        }
        
        // Default fallback settings
        $defaults = [
            "site_name" => "KEREA",
            "primary_color" => "#39DE4F",
            "accent_color" => "#F59E0B",
            "hero_bg_color" => "#000000",
            "hero_title" => "Quality Clean Tech",
            "hero_subtitle" => "Secured procurement for verified solar subsystems, induction cookstoves, and industrial energy storage.",
            "footer_bg_color" => "#0a0a0a",
            "announcement_text" => "Kerea Guaranteed Compliance",
            "header_bg" => "white",
            "text_color" => "#0f172a",
            "header_email" => "info@kerea.org",
            "header_phone" => "(+254) 740 541 896",
            "contact_address" => "Keri Road, Nairobi West, Nairobi",
            "contact_email" => "info@kerea.org",
            "contact_phone" => "(+254) 740 541 896",
            "logo_main" => "/assets/kerea-logo-main.png",
            "logo_load" => "/assets/logo-load.png",
            "social_facebook" => "#",
            "social_twitter" => "#",
            "social_linkedin" => "#",
            "nav_style" => "static",
            "show_market_counter" => true,
            "footer_text" => "The primary representative body for all sustainable energy practitioners and corporate stakeholders across East Africa."
        ];
        
        return array_merge($defaults, (array)$settings);
    }
}

$settings = get_settings();

