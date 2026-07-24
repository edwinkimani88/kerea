<?php
/**
 * KEREA — Users API
 * Admin-only: list, create, update, delete, status, role, stats
 */
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/backend/core/Database.php';
require_once dirname(__DIR__, 2) . '/backend/core/Auth.php';
require_once dirname(__DIR__, 2) . '/backend/core/Security.php';
require_once dirname(__DIR__, 2) . '/backend/models/User.php';

header('Content-Type: application/json');
Auth::startSession();
Auth::requireRole('admin', BASE_URL . '/auth/');

$action = $_GET['action'] ?? $_POST['action'] ?? 'list';
$model  = new User();

match ($action) {
    'list'          => handleList($model),
    'get'           => handleGet($model),
    'create'        => handleCreate($model),
    'update'        => handleUpdate($model),
    'delete'        => handleDelete($model),
    'set_status'    => handleStatus($model),
    'assign_role'   => handleRole($model),
    'reset_password'=> handleResetPassword($model),
    'stats'         => handleStats($model),
    'roles'         => handleRoles($model),
    'activity'      => handleActivity(),
    default         => Security::jsonResponse(false, 'Unknown action.', [], 400),
};

function handleList(User $model): never
{
    $page   = Security::int($_GET['page'] ?? 1);
    $search = Security::clean($_GET['search'] ?? '');
    $role   = Security::clean($_GET['role']   ?? '');
    $status = Security::clean($_GET['status'] ?? '');
    Security::jsonResponse(true, 'OK', $model->list($page, 20, $search, $role, $status));
}

function handleGet(User $model): never
{
    $id   = Security::int($_GET['id'] ?? 0);
    $user = $model->findById($id);
    if (!$user) Security::jsonResponse(false, 'User not found.', [], 404);
    unset($user['password_hash']);
    Security::jsonResponse(true, 'OK', $user);
}

function handleCreate(User $model): never
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') Security::jsonResponse(false, 'Method not allowed.', [], 405);
    Auth::requireCsrf();

    $data = $_POST;
    // Admin-created users get immediate 'active' status
    $data['status'] = 'active';
    $result = $model->register($data);

    if (!$result['success']) {
        Security::jsonResponse(false, implode(' ', $result['errors'] ?? []), [], 422);
    }

    // If role is specified and admin, update it
    $roleId = Security::int($_POST['role_id'] ?? 4);
    if ($roleId !== 4 && $result['user_id']) {
        $model->assignRole($result['user_id'], $roleId);
        // Set active immediately
        $model->setStatus($result['user_id'], 'active');
    }

    Security::jsonResponse(true, 'User created successfully.', ['user_id' => $result['user_id']]);
}

function handleUpdate(User $model): never
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') Security::jsonResponse(false, 'Method not allowed.', [], 405);
    Auth::requireCsrf();

    $id = Security::int($_POST['id'] ?? 0);
    if (!$id) Security::jsonResponse(false, 'User ID required.', [], 400);

    $result = $model->update($id, $_POST);
    Security::jsonResponse($result['success'], 'User updated.', $result);
}

function handleDelete(User $model): never
{
    Auth::requireCsrf();
    Auth::requireRole('super_admin', BASE_URL . '/auth/');

    $id = Security::int($_POST['id'] ?? $_GET['id'] ?? 0);
    if (!$id) Security::jsonResponse(false, 'User ID required.', [], 400);
    if ($id === Auth::id()) Security::jsonResponse(false, 'You cannot delete your own account.', [], 403);

    $db = Database::getInstance();
    $db->delete('users', 'id = :id', [':id' => $id]);
    Auth::log('user.delete', 'user', $id, 'User account deleted');
    Security::jsonResponse(true, 'User deleted.');
}

function handleStatus(User $model): never
{
    Auth::requireCsrf();
    $id     = Security::int($_POST['id'] ?? 0);
    $status = Security::clean($_POST['status'] ?? '');
    $result = $model->setStatus($id, $status);
    Security::jsonResponse($result, $result ? "User {$status}." : 'Failed.');
}

function handleRole(User $model): never
{
    Auth::requireCsrf();
    $userId = Security::int($_POST['user_id'] ?? 0);
    $roleId = Security::int($_POST['role_id']  ?? 0);
    $result = $model->assignRole($userId, $roleId);
    Security::jsonResponse($result, $result ? 'Role assigned.' : 'Failed.');
}

function handleResetPassword(User $model): never
{
    Auth::requireCsrf();
    $id  = Security::int($_POST['id'] ?? 0);
    $pwd = $_POST['new_password'] ?? '';
    $result = $model->adminResetPassword($id, $pwd);
    if (!$result['success']) Security::jsonResponse(false, implode(' ', $result['errors'] ?? []));
    Security::jsonResponse(true, 'Password reset successfully.');
}

function handleStats(User $model): never
{
    Security::jsonResponse(true, 'OK', $model->stats());
}

function handleRoles(User $model): never
{
    Security::jsonResponse(true, 'OK', $model->getRoles());
}

function handleActivity(): never
{
    $db   = Database::getInstance();
    $page = Security::int($_GET['page'] ?? 1);
    $uid  = Security::int($_GET['user_id'] ?? 0);

    $where  = ['1=1'];
    $params = [];
    if ($uid) { $where[] = 'l.user_id = :uid'; $params[':uid'] = $uid; }

    $sql = 'SELECT l.*, u.first_name, u.last_name, u.email
              FROM activity_log l
              LEFT JOIN users u ON u.id = l.user_id
             WHERE ' . implode(' AND ', $where) . '
             ORDER BY l.created_at DESC';

    $result = $db->paginate($sql, $params, $page, 30);
    Security::jsonResponse(true, 'OK', $result);
}
