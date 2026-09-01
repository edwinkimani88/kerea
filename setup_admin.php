<?php
/**
 * KEREA — One-Time Admin Seeder
 * Run this ONCE to create the super admin account and seed roles.
 * DELETE this file immediately after running!
 *
 * Access: http://localhost/kerea/setup_admin.php?secret=kerea_setup_2026
 */
declare(strict_types=1);

define('SETUP_SECRET', 'kerea_setup_2026');

if (($_GET['secret'] ?? '') !== SETUP_SECRET) {
    http_response_code(403);
    die('<h2 style="font-family:sans-serif;color:red">Access Denied. Add ?secret=kerea_setup_2026 to the URL.</h2>');
}

require_once __DIR__ . '/backend/config/database.php';
require_once __DIR__ . '/backend/core/Database.php';

$log = [];
$ok  = true;

try {
    $db = Database::getInstance();
    $log[] = 'Connected to database successfully.';
} catch (Throwable $e) {
    die('<pre style="font-family:sans-serif;color:red">DB Connection failed: ' . htmlspecialchars($e->getMessage()) . '</pre>');
}

$roles = [
    [1, 'super_admin',     'Super Admin'],
    [2, 'admin',           'Admin'],
    [3, 'content_manager', 'Content Manager'],
    [4, 'member',          'Member'],
];

foreach ($roles as [$id, $name, $label]) {
    try {
        $db->query(
            'INSERT IGNORE INTO roles (id, name, label, created_at) VALUES (:id, :name, :label, NOW())',
            [':id' => $id, ':name' => $name, ':label' => $label]
        );
        $log[] = "Role seeded: {$name}";
    } catch (Throwable $e) {
        $log[] = "Role {$name}: " . $e->getMessage();
    }
}

$adminEmail    = 'admin@kerea.org';
$adminPassword = 'Admin@2026';
$passwordHash  = password_hash($adminPassword, PASSWORD_BCRYPT);

try {
    $pdo  = $db->pdo();
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
    $stmt->execute([':email' => $adminEmail]);
    $exists = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($exists) {
        $upd = $pdo->prepare("UPDATE users SET role_id = 1, status = 'active', password_hash = :ph WHERE email = :email");
        $upd->execute([':ph' => $passwordHash, ':email' => $adminEmail]);
        $log[] = "Existing user updated to super_admin + active.";
    } else {
        $ins = $pdo->prepare("INSERT INTO users (role_id, first_name, last_name, email, password_hash, status, created_at, updated_at) VALUES (1, 'Super', 'Admin', :email, :ph, 'active', NOW(), NOW())");
        $ins->execute([':email' => $adminEmail, ':ph' => $passwordHash]);
        $log[] = "Super admin user created.";
    }
} catch (Throwable $e) {
    $log[] = "User creation failed: " . $e->getMessage();
    $ok = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>KEREA Setup</title>
<style>
body{font-family:'Segoe UI',sans-serif;background:#0f0f0f;color:#eee;display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0}
.card{background:#1a1a1a;border:1px solid #333;border-radius:16px;padding:40px;max-width:540px;width:100%}
h1{color:#39DE4F;margin:0 0 8px}p.sub{color:#666;font-size:.85rem;margin:0 0 24px}
.log{background:#111;border-radius:8px;padding:16px;font-size:.8rem;line-height:1.8;color:#aaa;margin-bottom:20px}
.creds{background:#0d2d12;border:1px solid #39DE4F44;border-radius:12px;padding:20px;margin:20px 0}
.creds h3{color:#39DE4F;margin:0 0 14px;font-size:1rem}
.row{display:flex;justify-content:space-between;margin-bottom:8px;font-size:.9rem}
.key{color:#777}.val{font-family:monospace;font-weight:bold;color:#fff}
.warn{background:#2d1a00;border:1px solid #ff6b00;border-radius:10px;padding:14px 18px;font-size:.85rem;color:#ff9800;margin-top:16px}
a.btn{display:inline-block;margin-top:20px;padding:12px 28px;background:#39DE4F;color:#000;border-radius:10px;text-decoration:none;font-weight:bold}
</style>
</head>
<body>
<div class="card">
<h1>KEREA Admin Setup</h1>
<p class="sub">One-time initialization</p>
<div class="log"><?php foreach ($log as $l) echo htmlspecialchars($l) . '<br>'; ?></div>
<?php if ($ok): ?>
<div class="creds">
<h3>Login Credentials</h3>
<div class="row"><span class="key">URL</span><span class="val">http://localhost/kerea/auth/</span></div>
<div class="row"><span class="key">Email</span><span class="val">admin@kerea.org</span></div>
<div class="row"><span class="key">Password</span><span class="val">Admin@2026</span></div>
<div class="row"><span class="key">Role</span><span class="val">Super Admin</span></div>
</div>
<div class="warn"><strong>Security:</strong> Delete <code>setup_admin.php</code> after logging in!</div>
<a class="btn" href="/kerea/auth/">Go to Login &rarr;</a>
<?php endif; ?>
</div>
</body>
</html>
