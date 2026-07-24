<?php
/**
 * KEREA — Media API
 * Upload, list, get, update, delete media files.
 */
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/backend/core/Database.php';
require_once dirname(__DIR__, 2) . '/backend/core/Auth.php';
require_once dirname(__DIR__, 2) . '/backend/core/Security.php';
require_once dirname(__DIR__, 2) . '/backend/models/Media.php';

header('Content-Type: application/json');
Auth::startSession();
Auth::requireRole('content_manager', BASE_URL . '/auth/');

$action = $_GET['action'] ?? $_POST['action'] ?? 'list';
$model  = new Media();

match ($action) {
    'upload' => handleUpload($model),
    'list'   => handleList($model),
    'get'    => handleGet($model),
    'update' => handleUpdate($model),
    'delete' => handleDelete($model),
    'stats'  => handleStats($model),
    default  => Security::jsonResponse(false, 'Unknown action.', [], 400),
};

function handleUpload(Media $model): never
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') Security::jsonResponse(false, 'Method not allowed.', [], 405);
    Auth::requireCsrf();

    if (!isset($_FILES['file']) || $_FILES['file']['error'] === UPLOAD_ERR_NO_FILE) {
        Security::jsonResponse(false, 'No file was uploaded.', [], 400);
    }

    $type = Security::clean($_POST['media_type'] ?? 'general');
    $meta = [
        'alt_text' => Security::clean($_POST['alt_text'] ?? ''),
        'caption'  => Security::clean($_POST['caption']  ?? ''),
    ];

    $result = $model->upload($_FILES['file'], $type, $meta);
    if ($result['success']) {
        Security::jsonResponse(true, $result['message'], ['media' => $result['media']]);
    }
    Security::jsonResponse(false, $result['message'], [], 422);
}

function handleList(Media $model): never
{
    $page   = Security::int($_GET['page'] ?? 1);
    $type   = Security::clean($_GET['media_type'] ?? '');
    $search = Security::clean($_GET['search'] ?? '');
    Security::jsonResponse(true, 'OK', $model->list($page, 40, $type, $search));
}

function handleGet(Media $model): never
{
    $id   = Security::int($_GET['id'] ?? 0);
    $item = $model->findById($id);
    if (!$item) Security::jsonResponse(false, 'Media not found.', [], 404);
    Security::jsonResponse(true, 'OK', $item);
}

function handleUpdate(Media $model): never
{
    Auth::requireCsrf();
    $id = Security::int($_POST['id'] ?? 0);
    if (!$id) Security::jsonResponse(false, 'Media ID required.', [], 400);
    $result = $model->update($id, $_POST);
    Security::jsonResponse($result['success'], 'Updated.');
}

function handleDelete(Media $model): never
{
    Auth::requireCsrf();
    $id = Security::int($_POST['id'] ?? $_GET['id'] ?? 0);
    if (!$id) Security::jsonResponse(false, 'Media ID required.', [], 400);
    $result = $model->delete($id);
    Security::jsonResponse($result['success'], $result['message']);
}

function handleStats(Media $model): never
{
    Security::jsonResponse(true, 'OK', $model->stats());
}
