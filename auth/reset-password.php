<?php
/**
 * KEREA — Reset Password Page
 */
declare(strict_types=1);

require_once dirname(__DIR__) . '/backend/config/database.php';
require_once dirname(__DIR__) . '/backend/core/Database.php';
require_once dirname(__DIR__) . '/backend/core/Auth.php';
require_once dirname(__DIR__) . '/backend/core/Security.php';
require_once dirname(__DIR__) . '/includes/config.php';

Auth::startSession();

$token = Security::clean($_GET['token'] ?? '');
$db = Database::getInstance();
$isValidToken = false;

if ($token) {
    $row = $db->fetchOne(
        'SELECT * FROM password_resets WHERE token = :t AND used = 0 AND expires_at > NOW() LIMIT 1',
        [':t' => $token]
    );
    if ($row) {
        $isValidToken = true;
    }
}

$csrfToken = Auth::csrfToken();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password — <?php echo Security::esc($settings['site_name'] ?? 'KEREA'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <style>
        * { font-family: 'Inter', sans-serif; }
        :root { --primary: <?php echo Security::esc($settings['primary_color'] ?? '#39DE4F'); ?>; }
        .text-primary { color: var(--primary); }
        .bg-primary   { background-color: var(--primary); }
        .border-primary { border-color: var(--primary); }
    </style>
</head>
<body class="min-h-screen flex bg-slate-50 items-center justify-center p-6">
    <div class="w-full max-w-md bg-white p-10 rounded-[2.5rem] shadow-2xl border border-slate-100">
        <div class="flex items-center gap-3 mb-8 justify-center">
            <img src="<?php echo Security::esc($settings['logo_main'] ?? '/assets/kerea-logo-main.png'); ?>" alt="KEREA" class="h-10 w-auto">
            <span class="text-xl font-black">KEREA</span>
        </div>

        <div class="mb-8 text-center">
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Reset Password</h2>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-2">Enter your new secure password</p>
        </div>

        <div id="flash-error" class="hidden mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl flex items-start gap-3">
            <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 shrink-0 mt-0.5"></i>
            <p class="text-sm font-bold text-red-700"></p>
        </div>

        <div id="flash-success" class="hidden mb-6 p-4 bg-green-50 border border-green-100 rounded-2xl flex items-start gap-3">
            <i data-lucide="check-circle" class="w-5 h-5 text-green-600 shrink-0 mt-0.5"></i>
            <p class="text-sm font-bold text-green-700"></p>
        </div>

        <?php if ($isValidToken): ?>
        <form id="reset-form" class="space-y-6">
            <input type="hidden" name="csrf_token" value="<?php echo Security::esc($csrfToken); ?>">
            <input type="hidden" name="action" value="reset">
            <input type="hidden" name="token" value="<?php echo Security::esc($token); ?>">

            <div class="space-y-2">
                <label for="password" class="text-xs font-black text-slate-500 uppercase tracking-widest">New Password</label>
                <input id="password" type="password" name="password" required placeholder="8+ characters, letter & number"
                    class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold transition-all focus:outline-none focus:ring-2 focus:ring-primary/20">
            </div>

            <div class="space-y-2">
                <label for="confirm_password" class="text-xs font-black text-slate-500 uppercase tracking-widest">Confirm Password</label>
                <input id="confirm_password" type="password" name="confirm_password" required placeholder="Repeat new password"
                    class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold transition-all focus:outline-none focus:ring-2 focus:ring-primary/20">
            </div>

            <button id="submit-btn" type="submit"
                class="w-full py-4 bg-primary text-black font-black text-sm uppercase tracking-widest rounded-2xl shadow-lg shadow-primary/20 hover:opacity-90 transition-all flex items-center justify-center gap-2">
                <span>Update Password</span>
            </button>
        </form>
        <?php else: ?>
        <div class="text-center space-y-4 py-4">
            <i data-lucide="x-circle" class="w-12 h-12 text-red-500 mx-auto"></i>
            <p class="text-sm font-bold text-slate-600">The password reset link is invalid, expired, or has already been used.</p>
            <a href="/auth/forgot-password.php" class="inline-block px-6 py-3 bg-slate-100 hover:bg-slate-200 text-xs font-black uppercase tracking-widest rounded-xl transition-all">Request New Link</a>
        </div>
        <?php endif; ?>

        <div class="mt-8 text-center">
            <p class="text-sm text-slate-500 font-bold">
                <a href="/auth/" class="text-primary hover:underline font-black">Back to Login</a>
            </p>
        </div>
    </div>

<script>
lucide.createIcons();
const form = document.getElementById('reset-form');
if (form) {
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        const btn = document.getElementById('submit-btn');
        const errDiv = document.getElementById('flash-error');
        const successDiv = document.getElementById('flash-success');

        btn.disabled = true;
        btn.textContent = 'Updating...';
        errDiv.classList.add('hidden');
        successDiv.classList.add('hidden');

        try {
            const resp = await fetch('/backend/api/auth.php?action=reset', {
                method: 'POST',
                body: new FormData(this)
            });
            const data = await resp.json();
            if (data.success) {
                successDiv.classList.remove('hidden');
                successDiv.querySelector('p').textContent = data.message;
                setTimeout(() => {
                    window.location.href = '/auth/';
                }, 2000);
            } else {
                errDiv.classList.remove('hidden');
                errDiv.querySelector('p').textContent = data.message;
                btn.disabled = false;
                btn.textContent = 'Update Password';
            }
        } catch(err) {
            errDiv.classList.remove('hidden');
            errDiv.querySelector('p').textContent = 'Network error. Please try again.';
            btn.disabled = false;
            btn.textContent = 'Update Password';
        }
    });
}
</script>
</body>
</html>
