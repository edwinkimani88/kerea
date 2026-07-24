<?php
/**
 * KEREA — Menus API
 * Admin-only: list, get_items, save_item, delete_item, reorder
 */
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/backend/core/Database.php';
require_once dirname(__DIR__, 2) . '/backend/core/Auth.php';
require_once dirname(__DIR__, 2) . '/backend/core/Security.php';
require_once dirname(__DIR__, 2) . '/backend/models/Menu.php';

header('Content-Type: application/json');
Auth::startSession();
Auth::requireRole('admin', BASE_URL . '/auth/');

$action = $_GET['action'] ?? $_POST['action'] ?? 'list';
$model  = new Menu();

match ($action) {
    'list'        => handleList($model),
    'get_items'   => handleGetItems($model),
    'save_item'   => handleSaveItem($model),
    'delete_item' => handleDeleteItem($model),
    'reorder'     => handleReorder($model),
    default       => Security::jsonResponse(false, 'Unknown action.', [], 400),
};

function handleList(Menu $model): never
{
    Security::jsonResponse(true, 'OK', $model->listMenus());
}

function handleGetItems(Menu $model): never
{
    $menuId = Security::int($_GET['menu_id'] ?? 0);
    if (!$menuId) Security::jsonResponse(false, 'Menu ID is required.', [], 400);
    Security::jsonResponse(true, 'OK', $model->getItems($menuId));
}

function handleSaveItem(Menu $model): never
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') Security::jsonResponse(false, 'Method not allowed.', [], 405);
    Auth::requireCsrf();

    $result = $model->saveItem($_POST);
    Security::jsonResponse($result['success'], $result['success'] ? 'Menu item saved.' : ($result['message'] ?? 'Failed to save item.'), $result);
}

function handleDeleteItem(Menu $model): never
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') Security::jsonResponse(false, 'Method not allowed.', [], 405);
    Auth::requireCsrf();

    $id = Security::int($_POST['id'] ?? 0);
    if (!$id) Security::jsonResponse(false, 'Menu item ID required.', [], 400);

    $success = $model->deleteItem($id);
    Security::jsonResponse($success, $success ? 'Menu item deleted.' : 'Failed to delete menu item.');
}

function handleReorder(Menu $model): never
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') Security::jsonResponse(false, 'Method not allowed.', [], 405);
    Auth::requireCsrf();

    $orders = json_decode($_POST['orders'] ?? '[]', true);
    if (empty($orders)) {
        Security::jsonResponse(false, 'Invalid order data.', [], 400);
    }

    $success = $model->updateSort($orders);
    Security::jsonResponse($success, $success ? 'Order updated.' : 'Failed to update order.');
}
