<?php
/**
 * KEREA — Settings API
 * GET  ?action=get        → return all settings as JSON
 * POST ?action=save       → save settings (multipart/form-data for logo upload)
 */
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/backend/core/Database.php';
require_once dirname(__DIR__, 2) . '/backend/core/Auth.php';
require_once dirname(__DIR__, 2) . '/backend/core/Security.php';
require_once dirname(__DIR__, 2) . '/backend/core/Uploader.php';
require_once dirname(__DIR__, 2) . '/backend/models/Setting.php';

header('Content-Type: application/json');
Auth::startSession();
Auth::requireRole('content_manager', BASE_URL . '/auth/');

$action = $_GET['action'] ?? $_POST['action'] ?? 'get';
$model  = new Setting();

match ($action) {
    'get'  => handleGet($model),
    'save' => handleSave($model),
    default => Security::jsonResponse(false, 'Unknown action.', [], 400),
};

// ── Get all settings ─────────────────────────────────────────
function handleGet(Setting $model): never
{
    Security::jsonResponse(true, 'OK', $model->all());
}

// ── Save settings ─────────────────────────────────────────────
function handleSave(Setting $model): never
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') Security::jsonResponse(false, 'Method not allowed.', [], 405);
    Auth::requireCsrf();

    // Text / color / boolean fields that are safe to save
    $allowedFields = [
        'site_name','site_tagline','primary_color','accent_color','footer_bg_color',
        'font_family','nav_style','announcement_text','header_email','header_phone',
        'contact_email','contact_phone','contact_address','social_facebook',
        'social_twitter','social_linkedin','social_youtube','footer_text',
        'hero_title','hero_subtitle','hero_cta_text','hero_cta_url',
        'marketplace_url','show_market_counter','meta_description','google_analytics',
        'smtp_host','smtp_port','smtp_user','smtp_pass','smtp_from','smtp_from_name',
    ];

    $toSave = [];
    foreach ($allowedFields as $field) {
        if (array_key_exists($field, $_POST)) {
            $toSave[$field] = $_POST[$field];
        }
    }

    // Handle logo uploads
    $assets_dir = dirname(__DIR__, 2) . '/assets/';
    if (!is_dir($assets_dir)) mkdir($assets_dir, 0755, true);

    foreach (['logo_main','logo_load'] as $logoField) {
        if (isset($_FILES[$logoField]) && $_FILES[$logoField]['error'] === UPLOAD_ERR_OK) {
            $result = Uploader::upload($_FILES[$logoField], 'logos', ['image']);
            if ($result['success']) {
                // Also copy to /assets/ for legacy paths
                $destName = $logoField . '_' . time() . '.' . pathinfo($result['file']['filename'], PATHINFO_EXTENSION);
                copy($result['file']['file_path'], $assets_dir . $destName);
                $toSave[$logoField] = '/assets/' . $destName;
            }
        }
    }

    if (empty($toSave)) {
        Security::jsonResponse(false, 'No valid settings to save.');
    }

    $result = $model->saveMultiple($toSave);

    if ($result['success']) {
        Security::jsonResponse(true, 'Settings saved successfully. Changes are live.', ['saved' => $result['saved']]);
    } else {
        Security::jsonResponse(false, 'Some settings could not be saved.', $result);
    }
}
