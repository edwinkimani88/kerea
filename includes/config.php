<?php
/**
 * KEREA — Frontend Config Bridge
 * Reads site settings from MySQL database.
 * Falls back to defaults if DB is unavailable (e.g. installer not run yet).
 *
 * This file replaces the old settings.json approach.
 */

if (!function_exists('get_base_url')) {
    function get_base_url(): string
    {
        $docRoot = isset($_SERVER['DOCUMENT_ROOT']) ? str_replace('\\', '/', rtrim($_SERVER['DOCUMENT_ROOT'], '/\\')) : '';
        $appRoot = str_replace('\\', '/', dirname(__DIR__));
        if (!empty($docRoot) && str_starts_with(strtolower($appRoot), strtolower($docRoot))) {
            $rel = substr($appRoot, strlen($docRoot));
            return rtrim(str_replace('\\', '/', $rel), '/') . '/';
        }
        return '/';
    }
}

if (!function_exists('get_settings')) {

    function get_settings(): array
    {
        // ── Default fallback settings ─────────────────────────
        $defaults = [
            'site_name'          => 'KEREA',
            'site_tagline'       => 'Kenya Renewable Energy Association',
            'primary_color'      => '#39DE4F',
            'accent_color'       => '#F59E0B',
            'hero_bg_color'      => '#000000',
            'hero_title'         => 'Leading the Renewable Energy Transition in East Africa',
            'hero_subtitle'      => 'KEREA is the peak industry body championing sustainable energy standards, policy advocacy, and member empowerment across East Africa.',
            'hero_cta_text'      => 'Join KEREA Today',
            'hero_cta_url'       => '/membership/',
            'footer_bg_color'    => '#0a0a0a',
            'announcement_text'  => 'Kerea Guaranteed Compliance',
            'header_bg'          => 'white',
            'text_color'         => '#0f172a',
            'header_email'       => 'info@kerea.org',
            'header_phone'       => '(+254) 740 541 896',
            'contact_address'    => 'Keri Road, Nairobi West, Nairobi',
            'contact_email'      => 'info@kerea.org',
            'contact_phone'      => '(+254) 740 541 896',
            'logo_main'          => '/assets/kerea-logo-main.png',
            'logo_load'          => '/assets/logo-load.png',
            'social_facebook'    => 'https://www.facebook.com/KEREAKENYA/',
            'social_twitter'     => 'https://x.com/KereaInfo',
            'social_linkedin'    => 'https://www.linkedin.com/company/kenya-renewable-energy-association/?originalSubdomain=ke',
            'social_youtube'     => '#',
            'nav_style'          => 'static',
            'show_market_counter'=> true,
            'footer_text'        => 'The primary representative body for all sustainable energy practitioners and corporate stakeholders across East Africa.',
            'meta_description'   => 'KEREA - Kenya Renewable Energy Association. The peak industry body for renewable energy in East Africa.',
            'marketplace_url'    => 'https://marketplace.kerea.org/',
            'google_analytics'   => '',
        ];

        // ── Try to load from database ─────────────────────────
        try {
            $backendConfig = __DIR__ . '/../backend/config/database.php';
            $backendCore   = __DIR__ . '/../backend/core/Database.php';
            $backendModel  = __DIR__ . '/../backend/models/Setting.php';

            if (
                file_exists($backendConfig) &&
                file_exists($backendCore) &&
                file_exists($backendModel)
            ) {
                require_once $backendConfig;
                require_once $backendCore;
                require_once $backendModel;

                $settingModel = new Setting();
                $dbSettings   = $settingModel->all();

                if (!empty($dbSettings)) {
                    // Merge DB settings over defaults
                    $merged = array_merge($defaults, $dbSettings);

                    // Convert boolean strings
                    foreach (['show_market_counter'] as $boolKey) {
                        if (isset($merged[$boolKey])) {
                            $merged[$boolKey] = in_array($merged[$boolKey], ['1', 'true', true], true);
                        }
                    }

                    return $merged;
                }
            }
        } catch (Throwable $e) {
            // DB not available — silently fall back to defaults
            error_log('[KEREA] Config bridge DB error: ' . $e->getMessage());
        }

        // ── Fall back to legacy settings.json if present ──────
        $settingsFile = __DIR__ . '/../settings.json';
        if (file_exists($settingsFile)) {
            $json = file_get_contents($settingsFile);
            $fromFile = json_decode($json, true);
            if (is_array($fromFile)) {
                return array_merge($defaults, $fromFile);
            }
        }

        return $defaults;
    }
}

$settings = get_settings();
