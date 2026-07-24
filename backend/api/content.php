<?php
/**
 * KEREA — Content API
 * RESTful-style CRUD for all content types.
 * GET    ?type=news&action=list|get|featured|recent
 * POST   ?type=news&action=create|update|delete|toggle
 */
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/backend/core/Database.php';
require_once dirname(__DIR__, 2) . '/backend/core/Auth.php';
require_once dirname(__DIR__, 2) . '/backend/core/Security.php';
require_once dirname(__DIR__, 2) . '/backend/models/Content.php';
require_once dirname(__DIR__, 2) . '/backend/models/Media.php';

header('Content-Type: application/json');
Auth::startSession();

$action = $_GET['action'] ?? $_POST['action'] ?? 'list';
$type   = Security::clean($_GET['type'] ?? $_POST['type'] ?? 'news');
$model  = new Content();

// Public actions (no login required)
$publicActions = ['list','get','featured','recent'];
if (!in_array($action, $publicActions)) {
    Auth::requireRole('content_manager', BASE_URL . '/auth/');
}

match ($action) {
    'list'     => handleList($model, $type),
    'get'      => handleGet($model, $type),
    'featured' => handleFeatured($model, $type),
    'recent'   => handleRecent($model, $type),
    'create'   => handleCreate($model, $type),
    'update'   => handleUpdate($model, $type),
    'delete'   => handleDelete($model, $type),
    'toggle'   => handleToggle($model, $type),
    'stats'    => handleStats($model),
    default    => Security::jsonResponse(false, 'Unknown action.', [], 400),
};

function handleList(Content $model, string $type): never
{
    $page     = Security::int($_GET['page'] ?? 1);
    $perPage  = Security::int($_GET['per_page'] ?? 20);
    $search   = Security::clean($_GET['search']   ?? '');
    $status   = Security::clean($_GET['status']   ?? '');
    $category = Security::clean($_GET['category'] ?? '');
    $result   = $model->list($type, $page, $perPage, $search, $status, $category);
    Security::jsonResponse(true, 'OK', $result);
}

function handleGet(Content $model, string $type): never
{
    $id   = Security::int($_GET['id'] ?? 0);
    $slug = Security::clean($_GET['slug'] ?? '');

    if ($slug) {
        $item = $model->findBySlug($type, $slug);
        if ($item) $model->incrementViews($type, $item['id']);
    } elseif ($id) {
        $item = $model->findById($type, $id);
    } else {
        Security::jsonResponse(false, 'ID or slug required.', [], 400);
    }

    if (!$item) Security::jsonResponse(false, 'Item not found.', [], 404);
    Security::jsonResponse(true, 'OK', $item);
}

function handleFeatured(Content $model, string $type): never
{
    $limit  = Security::int($_GET['limit'] ?? 6);
    $result = $model->featured($type, $limit);
    Security::jsonResponse(true, 'OK', $result);
}

function handleRecent(Content $model, string $type): never
{
    $limit  = Security::int($_GET['limit'] ?? 5);
    $result = $model->recent($type, $limit);
    Security::jsonResponse(true, 'OK', $result);
}

function handleCreate(Content $model, string $type): never
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') Security::jsonResponse(false, 'Method not allowed.', [], 405);
    Auth::requireCsrf();

    $data = $_POST;
    unset($data['csrf_token'], $data['action'], $data['type']);

    // Handle image upload if present
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $mediaModel = new Media();
        $upload = $mediaModel->upload($_FILES['image'], 'images');
        if ($upload['success']) $data['image_id'] = $upload['media']['id'];
    }
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $mediaModel = new Media();
        $upload = $mediaModel->upload($_FILES['file'], 'documents');
        if ($upload['success']) $data['file_id'] = $upload['media']['id'];
    }

    $result = $model->create($type, $data);
    Security::jsonResponse($result['success'], $result['success'] ? 'Created successfully.' : 'Creation failed.', $result);
}

function handleUpdate(Content $model, string $type): never
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') Security::jsonResponse(false, 'Method not allowed.', [], 405);
    Auth::requireCsrf();

    $id = Security::int($_POST['id'] ?? 0);
    if (!$id) Security::jsonResponse(false, 'Item ID is required.', [], 400);

    $data = $_POST;
    unset($data['csrf_token'], $data['action'], $data['type'], $data['id']);

    // Handle image upload if present
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $mediaModel = new Media();
        $upload = $mediaModel->upload($_FILES['image'], 'images');
        if ($upload['success']) $data['image_id'] = $upload['media']['id'];
    }

    $result = $model->update($type, $id, $data);
    Security::jsonResponse($result['success'], 'Updated successfully.', $result);
}

function handleDelete(Content $model, string $type): never
{
    Auth::requireCsrf();
    Auth::requireRole('admin', BASE_URL . '/auth/');
    $id = Security::int($_POST['id'] ?? $_GET['id'] ?? 0);
    if (!$id) Security::jsonResponse(false, 'Item ID is required.', [], 400);

    $result = $model->delete($type, $id);
    Security::jsonResponse($result['success'], $result['success'] ? 'Deleted.' : 'Item not found.', $result);
}

function handleToggle(Content $model, string $type): never
{
    Auth::requireCsrf();
    $id    = Security::int($_POST['id'] ?? 0);
    $field = Security::clean($_POST['field'] ?? 'featured');
    if (!$id) Security::jsonResponse(false, 'Item ID is required.', [], 400);

    $result = $model->toggle($type, $id, $field);
    Security::jsonResponse($result['success'], 'Toggled.', $result);
}

function handleStats(Content $model): never
{
    Auth::requireRole('content_manager', BASE_URL . '/auth/');
    $stats = $model->dashboardStats();
    Security::jsonResponse(true, 'OK', $stats);
}
