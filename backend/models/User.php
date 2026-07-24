<?php
/**
 * KEREA — User Model
 * Registration, login, profile, role management, user CRUD.
 */
declare(strict_types=1);

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Security.php';
require_once __DIR__ . '/../core/Auth.php';

class User
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // ── Authenticate user by email + password ────────────────
    public function authenticate(string $email, string $password): array|false
    {
        $email = strtolower(trim($email));
        $row   = $this->db->fetchOne(
            'SELECT u.*, r.name AS role_name, r.label AS role_label
               FROM users u
               JOIN roles r ON r.id = u.role_id
              WHERE u.email = :email AND u.status = "active"
              LIMIT 1',
            [':email' => $email]
        );

        if (!$row) return false;
        if (!Security::verifyPassword($password, $row['password_hash'])) return false;

        return $row;
    }

    // ── Register a new member ────────────────────────────────
    public function register(array $data): array
    {
        // Validate required fields
        $errors = [];
        if (!Security::validateLength($data['first_name'] ?? '', 2, 100)) $errors[] = 'First name must be 2–100 characters.';
        if (!Security::validateLength($data['last_name']  ?? '', 2, 100)) $errors[] = 'Last name must be 2–100 characters.';
        if (!Security::validateEmail($data['email'] ?? ''))                $errors[] = 'Valid email address required.';
        if (!Security::validatePassword($data['password'] ?? ''))          $errors[] = 'Password must be 8+ chars with uppercase, lowercase, and a number.';
        if (($data['password'] ?? '') !== ($data['confirm_password'] ?? '')) $errors[] = 'Passwords do not match.';

        if ($errors) return ['success' => false, 'errors' => $errors];

        // Check duplicate email
        $exists = $this->db->fetchColumn('SELECT COUNT(*) FROM users WHERE email = :e', [':e' => strtolower($data['email'])]);
        if ($exists > 0) return ['success' => false, 'errors' => ['An account with this email already exists.']];

        // Insert user
        $userId = $this->db->insert('users', [
            'role_id'       => 4, // member
            'first_name'    => Security::clean($data['first_name']),
            'last_name'     => Security::clean($data['last_name']),
            'email'         => strtolower(trim($data['email'])),
            'phone'         => Security::clean($data['phone'] ?? ''),
            'password_hash' => Security::hashPassword($data['password']),
            'organisation'  => Security::clean($data['organisation'] ?? ''),
            'job_title'     => Security::clean($data['job_title'] ?? ''),
            'status'        => 'pending',
        ]);

        Auth::log('user.register', 'user', $userId, 'New member registration: ' . $data['email']);

        return ['success' => true, 'user_id' => $userId];
    }

    // ── Get a user by ID ─────────────────────────────────────
    public function findById(int $id): array|false
    {
        return $this->db->fetchOne(
            'SELECT u.*, r.name AS role_name, r.label AS role_label
               FROM users u JOIN roles r ON r.id = u.role_id
              WHERE u.id = :id LIMIT 1',
            [':id' => $id]
        );
    }

    // ── Get a user by email ──────────────────────────────────
    public function findByEmail(string $email): array|false
    {
        return $this->db->fetchOne(
            'SELECT u.*, r.name AS role_name, r.label AS role_label
               FROM users u JOIN roles r ON r.id = u.role_id
              WHERE u.email = :email LIMIT 1',
            [':email' => strtolower(trim($email))]
        );
    }

    // ── List all users with pagination ───────────────────────
    public function list(int $page = 1, int $perPage = 20, string $search = '', string $role = '', string $status = ''): array
    {
        $where  = ['1=1'];
        $params = [];

        if ($search) {
            $where[] = '(u.first_name LIKE :s OR u.last_name LIKE :s OR u.email LIKE :s OR u.organisation LIKE :s)';
            $params[':s'] = '%' . $search . '%';
        }
        if ($role) {
            $where[] = 'r.name = :role';
            $params[':role'] = $role;
        }
        if ($status) {
            $where[] = 'u.status = :status';
            $params[':status'] = $status;
        }

        $sql = 'SELECT u.id, u.first_name, u.last_name, u.email, u.phone, u.organisation,
                       u.status, u.created_at, u.last_login, u.login_count,
                       r.name AS role_name, r.label AS role_label
                  FROM users u JOIN roles r ON r.id = u.role_id
                 WHERE ' . implode(' AND ', $where) . '
                 ORDER BY u.created_at DESC';

        return $this->db->paginate($sql, $params, $page, $perPage);
    }

    // ── Update a user profile ────────────────────────────────
    public function update(int $id, array $data): array
    {
        $allowed = ['first_name','last_name','phone','organisation','job_title','bio','avatar'];
        $update  = [];
        foreach ($allowed as $field) {
            if (isset($data[$field])) {
                $update[$field] = Security::clean($data[$field]);
            }
        }
        if (empty($update)) return ['success' => false, 'errors' => ['Nothing to update.']];

        $this->db->update('users', $update, 'id = :id', [':id' => $id]);
        Auth::log('user.update', 'user', $id, 'Profile updated');
        return ['success' => true];
    }

    // ── Change password ──────────────────────────────────────
    public function changePassword(int $userId, string $currentPassword, string $newPassword, string $confirmPassword): array
    {
        $user = $this->findById($userId);
        if (!$user || !Security::verifyPassword($currentPassword, $user['password_hash'])) {
            return ['success' => false, 'errors' => ['Current password is incorrect.']];
        }
        if (!Security::validatePassword($newPassword)) {
            return ['success' => false, 'errors' => ['New password must be 8+ chars with uppercase, lowercase, and a number.']];
        }
        if ($newPassword !== $confirmPassword) {
            return ['success' => false, 'errors' => ['Passwords do not match.']];
        }

        $this->db->update('users', ['password_hash' => Security::hashPassword($newPassword)], 'id = :id', [':id' => $userId]);
        Auth::log('user.password_change', 'user', $userId, 'Password changed');
        return ['success' => true];
    }

    // ── Admin: set user status ───────────────────────────────
    public function setStatus(int $id, string $status): bool
    {
        if (!in_array($status, ['active','suspended','pending'])) return false;
        $rows = $this->db->update('users', ['status' => $status], 'id = :id', [':id' => $id]);
        Auth::log("user.{$status}", 'user', $id, "User status set to {$status}");
        return $rows > 0;
    }

    // ── Admin: assign role ───────────────────────────────────
    public function assignRole(int $userId, int $roleId): bool
    {
        $validRole = $this->db->fetchColumn('SELECT COUNT(*) FROM roles WHERE id = :id', [':id' => $roleId]);
        if (!$validRole) return false;
        $rows = $this->db->update('users', ['role_id' => $roleId], 'id = :id', [':id' => $userId]);
        Auth::log('user.role_change', 'user', $userId, "Role changed to role_id={$roleId}");
        return $rows > 0;
    }

    // ── Admin: reset password for a user ─────────────────────
    public function adminResetPassword(int $userId, string $newPassword): array
    {
        if (!Security::validatePassword($newPassword)) {
            return ['success' => false, 'errors' => ['Password must be 8+ chars with uppercase, lowercase, and a number.']];
        }
        $this->db->update('users', ['password_hash' => Security::hashPassword($newPassword)], 'id = :id', [':id' => $userId]);
        Auth::log('user.admin_reset_password', 'user', $userId, 'Admin reset password');
        return ['success' => true];
    }

    // ── Create password reset token ──────────────────────────
    public function createResetToken(string $email): string|false
    {
        $user = $this->findByEmail($email);
        if (!$user) return false;

        $token = Security::generateToken(32);
        // Invalidate old tokens
        $this->db->query('DELETE FROM password_resets WHERE user_id = :uid', [':uid' => $user['id']]);
        // Insert new
        $this->db->insert('password_resets', [
            'user_id'    => $user['id'],
            'token'      => $token,
            'expires_at' => date('Y-m-d H:i:s', strtotime('+1 hour')),
        ]);

        return $token;
    }

    // ── Validate and consume a password reset token ──────────
    public function resetPasswordWithToken(string $token, string $newPassword, string $confirm): array
    {
        $row = $this->db->fetchOne(
            'SELECT * FROM password_resets WHERE token = :t AND used = 0 AND expires_at > NOW() LIMIT 1',
            [':t' => $token]
        );
        if (!$row) return ['success' => false, 'errors' => ['Invalid or expired reset link.']];
        if (!Security::validatePassword($newPassword)) return ['success' => false, 'errors' => ['Password must be 8+ chars with uppercase, lowercase, and a number.']];
        if ($newPassword !== $confirm) return ['success' => false, 'errors' => ['Passwords do not match.']];

        $this->db->update('users', ['password_hash' => Security::hashPassword($newPassword)], 'id = :id', [':id' => $row['user_id']]);
        $this->db->update('password_resets', ['used' => 1], 'id = :id', [':id' => $row['id']]);
        Auth::log('user.password_reset', 'user', $row['user_id'], 'Password reset via token');
        return ['success' => true];
    }

    // ── Get all roles ────────────────────────────────────────
    public function getRoles(): array
    {
        return $this->db->fetchAll('SELECT * FROM roles ORDER BY id');
    }

    // ── Dashboard stats ──────────────────────────────────────
    public function stats(): array
    {
        return [
            'total'     => (int)$this->db->fetchColumn('SELECT COUNT(*) FROM users'),
            'active'    => (int)$this->db->fetchColumn('SELECT COUNT(*) FROM users WHERE status = "active"'),
            'pending'   => (int)$this->db->fetchColumn('SELECT COUNT(*) FROM users WHERE status = "pending"'),
            'suspended' => (int)$this->db->fetchColumn('SELECT COUNT(*) FROM users WHERE status = "suspended"'),
            'this_month'=> (int)$this->db->fetchColumn('SELECT COUNT(*) FROM users WHERE MONTH(created_at)=MONTH(NOW()) AND YEAR(created_at)=YEAR(NOW())'),
        ];
    }
}
