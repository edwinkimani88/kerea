<?php
/**
 * KEREA — Forgot Password Page
 */
declare(strict_types=1);

require_once dirname(__DIR__) . '/backend/config/database.php';
require_once dirname(__DIR__) . '/backend/core/Database.php';
require_once dirname(__DIR__) . '/backend/core/Auth.php';
require_once dirname(__DIR__) . '/backend/core/Security.php';
require_once dirname(__DIR__) . '/includes/config.php';

Auth::startSession();

if (Auth::check()) {
    $role = Auth::role();
    $redirect = in_array($role, ['super_admin','admin','content_manager']) ? '/admin/' : '/portal/';
    header('Location: ' . $redirect);
    exit;
}

$csrfToken = Auth::csrfToken();
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password — <?php echo Security::esc($settings['site_name'] ?? 'KEREA'); ?></title>
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
        .auth-bg {
            background: #000;
            background-image: radial-gradient(var(--primary) 1px, transparent 1px);
            background-size: 40px 40px;
        }
    </style>
</head>
<body class="min-h-screen flex bg-slate-50 items-center justify-center p-6">
    <div class="w-full max-w-md bg-white p-10 rounded-[2.5rem] shadow-2xl border border-slate-100">
        <div class="flex items-center gap-3 mb-8 justify-center">
            <img src="<?php echo Security::esc($settings['logo_main'] ?? '/assets/kerea-logo-main.png'); ?>" alt="KEREA" class="h-10 w-auto">
            <span class="text-xl font-black">KEREA</span>
        </div>

        <div class="mb-8 text-center">
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Forgot Password?</h2>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-2">Enter email to request reset link</p>
        </div>

        <div id="flash-error" class="hidden mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl flex items-start gap-3">
            <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 shrink-0 mt-0.5"></i>
            <p class="text-sm font-bold text-red-700"></p>
        </div>

        <div id="flash-success" class="hidden mb-6 p-4 bg-green-50 border border-green-100 rounded-2xl flex items-start gap-3">
            <i data-lucide="check-circle" class="w-5 h-5 text-green-600 shrink-0 mt-0.5"></i>
            <p class="text-sm font-bold text-green-700"></p>
        </div>

        <form id="forgot-form" class="space-y-6">
            <input type="hidden" name="csrf_token" value="<?php echo Security::esc($csrfToken); ?>">
            <input type="hidden" name="action" value="forgot">

            <div class="space-y-2">
                <label for="email" class="text-xs font-black text-slate-500 uppercase tracking-widest">Email Address</label>
                <div class="relative">
                    <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    <input id="email" type="email" name="email" required placeholder="you@organisation.com"
                        class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold transition-all focus:outline-none focus:ring-2 focus:ring-primary/20">
                </div>
            </div>

            <button id="submit-btn" type="submit"
                class="w-full py-4 bg-primary text-black font-black text-sm uppercase tracking-widest rounded-2xl shadow-lg shadow-primary/20 hover:opacity-90 transition-all flex items-center justify-center gap-2">
                <span>Send Reset Link</span>
            </button>
        </form>

        <div class="mt-8 text-center space-y-2">
            <p class="text-sm text-slate-500 font-bold">
                <a href="/auth/" class="text-primary hover:underline font-black">Back to Login</a>
            </p>
        </div>
    </div>

<script>
lucide.createIcons();
document.getElementById('forgot-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('submit-btn');
    const errDiv = document.getElementById('flash-error');
    const successDiv = document.getElementById('flash-success');

    btn.disabled = true;
    btn.textContent = 'Sending...';
    errDiv.classList.add('hidden');
    successDiv.classList.add('hidden');

    try {
        const resp = await fetch('/backend/api/auth.php?action=forgot', {
            method: 'POST',
            body: new FormData(this)
        });
        const data = await resp.json();
        if (data.success) {
            successDiv.classList.remove('hidden');
            successDiv.querySelector('p').textContent = data.message;
            this.reset();
        } else {
            errDiv.classList.remove('hidden');
            errDiv.querySelector('p').textContent = data.message;
        }
    } catch(err) {
        errDiv.classList.remove('hidden');
        errDiv.querySelector('p').textContent = 'Network error. Please try again.';
    } finally {
        btn.disabled = false;
        btn.textContent = 'Send Reset Link';
    }
});
</script>
</body>
</html>
