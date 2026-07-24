<?php
/**
 * KEREA — Login Page
 * Full authentication with real DB backend.
 */
declare(strict_types=1);

require_once dirname(__DIR__) . '/backend/config/database.php';
require_once dirname(__DIR__) . '/backend/core/Database.php';
require_once dirname(__DIR__) . '/backend/core/Auth.php';
require_once dirname(__DIR__) . '/backend/core/Security.php';
require_once dirname(__DIR__) . '/includes/config.php';

Auth::startSession();

// Already logged in → redirect to appropriate dashboard
if (Auth::check()) {
    $role = Auth::role();
    $redirect = in_array($role, ['super_admin','admin','content_manager']) ? '/admin/' : '/membership/dashboard/';
    header('Location: ' . $redirect);
    exit;
}

$csrfToken = Auth::csrfToken();
$error     = '';
$success   = '';

// Flash messages from session
if (!empty($_SESSION['flash_success'])) { $success = $_SESSION['flash_success']; unset($_SESSION['flash_success']); }
if (!empty($_SESSION['flash_error']))   { $error   = $_SESSION['flash_error'];   unset($_SESSION['flash_error']); }
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — <?php echo Security::esc($settings['site_name'] ?? 'KEREA'); ?></title>
    <meta name="description" content="Sign in to your KEREA member account to access the member portal and resources.">
    <meta name="robots" content="noindex, nofollow">
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
        .focus\:ring-primary:focus { --tw-ring-color: var(--primary); }
        .auth-bg {
            background: #000;
            background-image: radial-gradient(var(--primary) 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: 1;
        }
        .glass-card {
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(20px);
        }
        input:focus { outline: none; box-shadow: 0 0 0 3px rgba(57,222,79,0.15); border-color: var(--primary); }
    </style>
</head>
<body class="min-h-screen flex">
    <!-- Left Panel: Branding -->
    <div class="hidden lg:flex lg:w-1/2 auth-bg items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-black/90 via-black/70 to-transparent z-0"></div>
        <div class="relative z-10 text-white max-w-md px-12 space-y-8">
            <div class="flex items-center gap-4">
                <img src="<?php echo Security::esc($settings['logo_load'] ?? '/assets/logo-load.png'); ?>" alt="KEREA" class="h-16 w-auto">
                <div class="border-l border-white/20 pl-4">
                    <h1 class="text-3xl font-black tracking-tight">KEREA</h1>
                    <p class="text-xs font-bold text-primary uppercase tracking-widest mt-1">Member Portal</p>
                </div>
            </div>
            <div class="space-y-4">
                <h2 class="text-4xl font-black leading-tight">Kenya's Renewable Energy Industry Hub</h2>
                <p class="text-slate-300 text-sm leading-relaxed">
                    Access your member dashboard, download exclusive publications, register for events, and connect with the renewable energy community.
                </p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white/5 border border-white/10 rounded-2xl p-4">
                    <p class="text-2xl font-black text-primary">1,200+</p>
                    <p class="text-xs text-slate-400 uppercase tracking-widest mt-1">Active Members</p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl p-4">
                    <p class="text-2xl font-black text-primary">50+</p>
                    <p class="text-xs text-slate-400 uppercase tracking-widest mt-1">Publications</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Panel: Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-slate-50 px-6 py-12">
        <div class="w-full max-w-md">
            <!-- Logo (mobile) -->
            <div class="lg:hidden flex items-center gap-3 mb-10">
                <img src="<?php echo Security::esc($settings['logo_main'] ?? '/assets/kerea-logo-main.png'); ?>" alt="KEREA" class="h-10 w-auto">
                <span class="text-xl font-black">KEREA</span>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Welcome back</h2>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-2">Sign in to your account</p>
            </div>

            <!-- Flash Messages -->
            <?php if ($error): ?>
            <div id="flash-error" class="mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl flex items-start gap-3">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 shrink-0 mt-0.5"></i>
                <p class="text-sm font-bold text-red-700"><?php echo Security::esc($error); ?></p>
            </div>
            <?php endif; ?>
            <?php if ($success): ?>
            <div class="mb-6 p-4 bg-green-50 border border-green-100 rounded-2xl flex items-start gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 text-green-600 shrink-0 mt-0.5"></i>
                <p class="text-sm font-bold text-green-700"><?php echo Security::esc($success); ?></p>
            </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form id="login-form" class="space-y-5">
                <input type="hidden" name="csrf_token" value="<?php echo Security::esc($csrfToken); ?>">
                <input type="hidden" name="action" value="login">

                <div class="space-y-2">
                    <label for="email" class="text-xs font-black text-slate-500 uppercase tracking-widest">Email Address</label>
                    <div class="relative">
                        <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input id="email" type="email" name="email" required autocomplete="email"
                            placeholder="you@organisation.com"
                            class="w-full pl-12 pr-4 py-4 bg-white border border-slate-200 rounded-2xl text-sm font-bold transition-all">
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <label for="password" class="text-xs font-black text-slate-500 uppercase tracking-widest">Password</label>
                        <a href="/auth/forgot-password.php" class="text-xs font-bold text-primary hover:underline">Forgot password?</a>
                    </div>
                    <div class="relative">
                        <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="Your password"
                            class="w-full pl-12 pr-12 py-4 bg-white border border-slate-200 rounded-2xl text-sm font-bold transition-all">
                        <button type="button" id="toggle-pw" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors">
                            <i data-lucide="eye" class="w-4 h-4" id="pw-eye"></i>
                        </button>
                    </div>
                </div>

                <button id="login-btn" type="submit"
                    class="w-full py-4 bg-primary text-black font-black text-sm uppercase tracking-widest rounded-2xl shadow-lg shadow-primary/20 hover:opacity-90 transition-all flex items-center justify-center gap-2">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                    <span>Sign In</span>
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-slate-500 font-bold">Not a member yet?
                    <a href="/auth/register.php" class="text-primary hover:underline font-black">Join KEREA</a>
                </p>
                <p class="text-sm text-slate-500 font-bold mt-2">
                    <a href="/" class="text-slate-400 hover:text-primary transition-colors">← Back to Website</a>
                </p>
            </div>
        </div>
    </div>

<script>
lucide.createIcons();

// Toggle password visibility
document.getElementById('toggle-pw').addEventListener('click', function() {
    const pw  = document.getElementById('password');
    const eye = document.getElementById('pw-eye');
    if (pw.type === 'password') {
        pw.type = 'text';
        eye.setAttribute('data-lucide', 'eye-off');
    } else {
        pw.type = 'password';
        eye.setAttribute('data-lucide', 'eye');
    }
    lucide.createIcons();
});

// Handle form submit via AJAX
document.getElementById('login-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn  = document.getElementById('login-btn');
    const form = this;

    btn.disabled = true;
    btn.innerHTML = '<svg class="animate-spin w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Signing in…';

    const errDiv = document.getElementById('flash-error');

    try {
        const resp = await fetch('/backend/api/auth.php?action=login', {
            method: 'POST',
            body:   new FormData(form),
        });
        const data = await resp.json();

        if (data.success) {
            btn.innerHTML = '✓ Redirecting…';
            window.location.href = data.data?.redirect || '/admin/';
        } else {
            if (errDiv) {
                errDiv.classList.remove('hidden');
                errDiv.querySelector('p').textContent = data.message || 'Login failed.';
            } else {
                const div = document.createElement('div');
                div.id = 'flash-error';
                div.className = 'mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl flex items-start gap-3';
                div.innerHTML = `<svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg><p class="text-sm font-bold text-red-700">${data.message}</p>`;
                form.parentNode.insertBefore(div, form);
            }
            btn.disabled = false;
            btn.innerHTML = '<i data-lucide="log-in" class="w-4 h-4"></i> <span>Sign In</span>';
            lucide.createIcons();
        }
    } catch (err) {
        btn.disabled = false;
        btn.innerHTML = '<i data-lucide="log-in" class="w-4 h-4"></i> <span>Sign In</span>';
        lucide.createIcons();
        console.error('Login error:', err);
    }
});
</script>
</body>
</html>
