<?php
/**
 * KEREA — Authentication Core
 * Session management, CSRF, role-based access control.
 * PHP 8+ | Native sessions
 */
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/Security.php';

class Auth
{
    private static bool $sessionStarted = false;

    // ── Boot session safely ──────────────────────────────────
    public static function startSession(): void
    {
        if (self::$sessionStarted || session_status() === PHP_SESSION_ACTIVE) {
            self::$sessionStarted = true;
            return;
        }
        session_name(SESSION_NAME);
        session_set_cookie_params([
            'lifetime' => SESSION_LIFETIME,
            'path'     => '/',
            'secure'   => isset($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
        session_start();
        self::$sessionStarted = true;
    }

    // ── Check if a user is logged in ─────────────────────────
    public static function check(): bool
    {
        self::startSession();
        return !empty($_SESSION['user_id']) && !empty($_SESSION['user_role']);
    }

    // ── Get currently logged-in user data ────────────────────
    public static function user(): ?array
    {
        if (!self::check()) return null;
        return $_SESSION['user_data'] ?? null;
    }

    // ── Get current user ID ──────────────────────────────────
    public static function id(): ?int
    {
        return isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null;
    }

    // ── Get current user role name ───────────────────────────
    public static function role(): ?string
    {
        return $_SESSION['user_role'] ?? null;
    }

    // ── Role checks ──────────────────────────────────────────
    public static function isSuperAdmin(): bool { return self::role() === 'super_admin'; }
    public static function isAdmin(): bool      { return in_array(self::role(), ['super_admin','admin']); }
    public static function isContentManager(): bool { return in_array(self::role(), ['super_admin','admin','content_manager']); }
    public static function isMember(): bool     { return self::check(); }

    // ── Require authentication — redirect if not logged in ───
    public static function requireLogin(string $redirect = '/auth/'): void
    {
        self::startSession();
        if (!self::check()) {
            header('Location: ' . $redirect);
            exit;
        }
    }

    // ── Require a specific minimum role ──────────────────────
    public static function requireRole(string $minRole, string $redirect = '/auth/'): void
    {
        self::requireLogin($redirect);
        $hierarchy = ['member' => 1, 'content_manager' => 2, 'admin' => 3, 'super_admin' => 4];
        $current   = $hierarchy[self::role()] ?? 0;
        $required  = $hierarchy[$minRole] ?? 99;
        if ($current < $required) {
            http_response_code(403);
            die('Access Denied — Insufficient permissions.');
        }
    }

    // ── Log in a user (called after verifying credentials) ───
    public static function login(array $user): void
    {
        self::startSession();
        session_regenerate_id(true); // Prevent session fixation

        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_role'] = $user['role_name'];
        $_SESSION['user_data'] = [
            'id'           => $user['id'],
            'first_name'   => $user['first_name'],
            'last_name'    => $user['last_name'],
            'email'        => $user['email'],
            'role_name'    => $user['role_name'],
            'role_label'   => $user['role_label'],
            'avatar'       => $user['avatar'] ?? null,
            'organisation' => $user['organisation'] ?? '',
        ];

        // Update last_login in DB
        try {
            $db = Database::getInstance();
            $db->update('users', ['last_login' => date('Y-m-d H:i:s')], 'id = :id', [':id' => $user['id']]);
            $db->query(
                'UPDATE `users` SET `login_count` = `login_count` + 1 WHERE `id` = :id',
                [':id' => $user['id']]
            );
        } catch (Throwable) {}
    }

    // ── Log out the current user ─────────────────────────────
    public static function logout(): void
    {
        self::startSession();
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $p = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
        }
        session_destroy();
    }

    // ────────────────────────────────────────────────────────
    // CSRF Protection
    // ────────────────────────────────────────────────────────

    // ── Generate CSRF token (once per session) ───────────────
    public static function csrfToken(): string
    {
        self::startSession();
        if (empty($_SESSION[CSRF_TOKEN_KEY])) {
            $_SESSION[CSRF_TOKEN_KEY] = Security::generateToken(32);
        }
        return $_SESSION[CSRF_TOKEN_KEY];
    }

    // ── Render a hidden CSRF input field ─────────────────────
    public static function csrfField(): string
    {
        $token = self::csrfToken();
        return '<input type="hidden" name="csrf_token" value="' . Security::esc($token) . '">';
    }

    // ── Validate CSRF token from POST ────────────────────────
    public static function validateCsrf(): bool
    {
        self::startSession();
        $submitted = $_POST['csrf_token'] ?? '';
        $expected  = $_SESSION[CSRF_TOKEN_KEY] ?? '';
        return !empty($expected) && hash_equals($expected, $submitted);
    }

    // ── Require valid CSRF or abort ──────────────────────────
    public static function requireCsrf(): void
    {
        if (!self::validateCsrf()) {
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid security token. Please refresh and try again.']);
            exit;
        }
    }

    // ────────────────────────────────────────────────────────
    // Activity Logging
    // ────────────────────────────────────────────────────────
    public static function log(string $action, string $entityType = '', ?int $entityId = null, string $description = ''): void
    {
        try {
            $db = Database::getInstance();
            $db->insert('activity_log', [
                'user_id'     => self::id(),
                'action'      => $action,
                'entity_type' => $entityType,
                'entity_id'   => $entityId,
                'description' => $description,
                'ip_address'  => Security::clientIp(),
            ]);
        } catch (Throwable) {}
    }
}
