<?php
/**
 * KEREA — Member Portal Account Registration Page
 * Allows new members and professionals to create a portal user account.
 */
declare(strict_types=1);

require_once dirname(__DIR__) . '/backend/config/database.php';
require_once dirname(__DIR__) . '/backend/core/Database.php';
require_once dirname(__DIR__) . '/backend/core/Auth.php';
require_once dirname(__DIR__) . '/backend/core/Security.php';
require_once dirname(__DIR__) . '/includes/config.php';

Auth::startSession();

$baseUrl = get_base_url();

// Already logged in → redirect to appropriate dashboard
if (Auth::check()) {
    $role = Auth::role();
    $redirect = in_array($role, ['super_admin','admin','content_manager']) ? $baseUrl . 'admin/' : $baseUrl . 'membership/dashboard/';
    header('Location: ' . $redirect);
    exit;
}

$csrfToken = Auth::csrfToken();
$error     = '';
$success   = '';

if (!empty($_SESSION['flash_success'])) { $success = $_SESSION['flash_success']; unset($_SESSION['flash_success']); }
if (!empty($_SESSION['flash_error']))   { $error   = $_SESSION['flash_error'];   unset($_SESSION['flash_error']); }
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account — <?php echo Security::esc($settings['site_name'] ?? 'KEREA'); ?></title>
    <meta name="description" content="Create a KEREA member portal account to access industry insights, member directories, publications, and events.">
    <meta name="robots" content="noindex, nofollow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
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
<body class="min-h-screen flex bg-slate-50">
    <!-- Left Panel: Branding & Value Proposition -->
    <div class="hidden lg:flex lg:w-5/12 auth-bg items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-black/95 via-black/80 to-transparent z-0"></div>
        <div class="relative z-10 text-white max-w-md px-12 py-16 space-y-8">
            <div class="flex items-center gap-4">
                <img src="<?php echo Security::esc($settings['logo_load'] ?? '/assets/logo-load.png'); ?>" alt="KEREA" class="h-14 w-auto">
                <div class="border-l border-white/20 pl-4">
                    <h1 class="text-2xl font-black tracking-tight">KEREA</h1>
                    <p class="text-[10px] font-bold text-primary uppercase tracking-widest mt-0.5">Member Portal</p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 bg-primary/20 text-primary text-[10px] font-black uppercase tracking-[0.2em] rounded-full">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                    Professional & Corporate Access
                </div>
                <h2 class="text-3xl font-black leading-tight text-white">Join the Renewable Energy Community</h2>
                <p class="text-slate-300 text-sm leading-relaxed">
                    Create your account to unlock technical publications, access the directory of certified practitioners, receive policy updates, and participate in exclusive industry webinars.
                </p>
            </div>

            <div class="space-y-3 pt-2">
                <div class="flex items-center gap-3 bg-white/5 border border-white/10 rounded-2xl p-4">
                    <div class="w-10 h-10 rounded-xl bg-primary/20 text-primary flex items-center justify-center shrink-0">
                        <i data-lucide="book-open" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white">Industry Knowledge Hub</p>
                        <p class="text-xs text-slate-400">Reports, tariff guidelines, and technical papers</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 bg-white/5 border border-white/10 rounded-2xl p-4">
                    <div class="w-10 h-10 rounded-xl bg-primary/20 text-primary flex items-center justify-center shrink-0">
                        <i data-lucide="users" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white">B2B Networking</p>
                        <p class="text-xs text-slate-400">Connect directly with accredited RE installers & EPCs</p>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/10 pt-6">
                <p class="text-xs text-slate-400">
                    Applying for official Association Membership accreditation? 
                    <a href="<?php echo $baseUrl; ?>membership/register.php" class="text-primary hover:underline font-bold block mt-1">
                        Go to Full Membership Application Wizard →
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- Right Panel: Registration Form -->
    <div class="w-full lg:w-7/12 flex items-center justify-center px-6 py-12 overflow-y-auto">
        <div class="w-full max-w-xl">
            <!-- Mobile Logo Header -->
            <div class="lg:hidden flex items-center gap-3 mb-8">
                <img src="<?php echo Security::esc($settings['logo_main'] ?? '/assets/kerea-logo-main.png'); ?>" alt="KEREA" class="h-10 w-auto">
                <span class="text-xl font-black">KEREA</span>
            </div>

            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Create Account</h2>
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Join the KEREA Portal</p>
                    </div>
                    <a href="<?php echo $baseUrl; ?>auth/" class="hidden sm:inline-flex items-center gap-1.5 text-xs font-black text-slate-500 hover:text-primary transition-colors">
                        Already registered? <span class="text-primary underline">Sign In</span>
                    </a>
                </div>
            </div>

            <!-- Flash Error Alert -->
            <div id="flash-error" class="<?php echo $error ? '' : 'hidden'; ?> mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl flex items-start gap-3">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 shrink-0 mt-0.5"></i>
                <p class="text-sm font-bold text-red-700"><?php echo Security::esc($error); ?></p>
            </div>

            <!-- Flash Success Alert -->
            <div id="flash-success" class="<?php echo $success ? '' : 'hidden'; ?> mb-6 p-4 bg-green-50 border border-green-100 rounded-2xl flex items-start gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 text-green-600 shrink-0 mt-0.5"></i>
                <p class="text-sm font-bold text-green-700"><?php echo Security::esc($success); ?></p>
            </div>

            <!-- Registration Form -->
            <form id="register-form" class="space-y-5 bg-white p-8 sm:p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                <input type="hidden" name="csrf_token" value="<?php echo Security::esc($csrfToken); ?>">
                <input type="hidden" name="action" value="register">

                <!-- Names (Grid) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="first_name" class="text-xs font-black text-slate-600 uppercase tracking-wider">First Name *</label>
                        <div class="relative">
                            <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                            <input id="first_name" type="text" name="first_name" required placeholder="John"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold transition-all focus:bg-white">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="last_name" class="text-xs font-black text-slate-600 uppercase tracking-wider">Last Name *</label>
                        <div class="relative">
                            <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                            <input id="last_name" type="text" name="last_name" required placeholder="Doe"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold transition-all focus:bg-white">
                        </div>
                    </div>
                </div>

                <!-- Email & Phone (Grid) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="email" class="text-xs font-black text-slate-600 uppercase tracking-wider">Email Address *</label>
                        <div class="relative">
                            <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                            <input id="email" type="email" name="email" required autocomplete="email" placeholder="you@company.com"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold transition-all focus:bg-white">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="phone" class="text-xs font-black text-slate-600 uppercase tracking-wider">Phone Number</label>
                        <div class="relative">
                            <i data-lucide="phone" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                            <input id="phone" type="tel" name="phone" placeholder="+254 700 000 000"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold transition-all focus:bg-white">
                        </div>
                    </div>
                </div>

                <!-- Organization & Role (Grid) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="organisation" class="text-xs font-black text-slate-600 uppercase tracking-wider">Organisation / Company</label>
                        <div class="relative">
                            <i data-lucide="building-2" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                            <input id="organisation" type="text" name="organisation" placeholder="SolarTech Ltd"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold transition-all focus:bg-white">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="job_title" class="text-xs font-black text-slate-600 uppercase tracking-wider">Job Title / Role</label>
                        <div class="relative">
                            <i data-lucide="briefcase" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                            <input id="job_title" type="text" name="job_title" placeholder="Managing Director"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold transition-all focus:bg-white">
                        </div>
                    </div>
                </div>

                <!-- Passwords (Grid) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="password" class="text-xs font-black text-slate-600 uppercase tracking-wider">Password *</label>
                        <div class="relative">
                            <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                            <input id="password" type="password" name="password" required minlength="8" autocomplete="new-password"
                                placeholder="Min. 8 characters"
                                class="w-full pl-11 pr-11 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold transition-all focus:bg-white">
                            <button type="button" id="toggle-pw" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors">
                                <i data-lucide="eye" class="w-4 h-4" id="pw-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="confirm_password" class="text-xs font-black text-slate-600 uppercase tracking-wider">Confirm Password *</label>
                        <div class="relative">
                            <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                            <input id="confirm_password" type="password" name="confirm_password" required minlength="8" autocomplete="new-password"
                                placeholder="Repeat password"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold transition-all focus:bg-white">
                        </div>
                    </div>
                </div>

                <!-- Terms Checkbox -->
                <div class="pt-2">
                    <label class="flex items-start gap-3 cursor-pointer select-none">
                        <input type="checkbox" required name="agree_terms" class="mt-1 w-4 h-4 text-primary rounded border-slate-300 focus:ring-primary">
                        <span class="text-xs font-bold text-slate-500 leading-relaxed">
                            I agree to KEREA's <a href="<?php echo $baseUrl; ?>standards/" target="_blank" class="text-slate-800 underline hover:text-primary">Code of Conduct</a> and member platform terms.
                        </span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button id="register-btn" type="submit"
                    class="w-full py-4 bg-primary text-black font-black text-sm uppercase tracking-widest rounded-2xl shadow-lg shadow-primary/20 hover:opacity-90 active:scale-[0.99] transition-all flex items-center justify-center gap-2">
                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                    <span>Create My Account</span>
                </button>
            </form>

            <div class="mt-8 text-center space-y-3">
                <p class="text-sm text-slate-500 font-bold">
                    Already have an account?
                    <a href="<?php echo $baseUrl; ?>auth/" class="text-primary hover:underline font-black">Sign In</a>
                </p>
                <p class="text-xs text-slate-400 font-bold">
                    Looking for corporate membership accreditation?
                    <a href="<?php echo $baseUrl; ?>membership/register.php" class="text-slate-600 hover:text-primary underline">
                        Full Membership Application
                    </a>
                </p>
                <p class="text-xs text-slate-400 font-bold pt-2">
                    <a href="<?php echo $baseUrl; ?>" class="text-slate-400 hover:text-primary transition-colors">← Back to Website</a>
                </p>
            </div>
        </div>
    </div>

<script>
lucide.createIcons();

// Toggle password visibility
const toggleBtn = document.getElementById('toggle-pw');
if (toggleBtn) {
    toggleBtn.addEventListener('click', function() {
        const pw  = document.getElementById('password');
        const cpw = document.getElementById('confirm_password');
        const eye = document.getElementById('pw-eye');
        if (pw.type === 'password') {
            pw.type = 'text';
            cpw.type = 'text';
            eye.setAttribute('data-lucide', 'eye-off');
        } else {
            pw.type = 'password';
            cpw.type = 'password';
            eye.setAttribute('data-lucide', 'eye');
        }
        lucide.createIcons();
    });
}

// Handle registration via AJAX
document.getElementById('register-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('register-btn');
    const form = this;

    const pw = document.getElementById('password').value;
    const cpw = document.getElementById('confirm_password').value;
    const errDiv = document.getElementById('flash-error');
    const succDiv = document.getElementById('flash-success');

    if (pw !== cpw) {
        if (errDiv) {
            errDiv.classList.remove('hidden');
            errDiv.querySelector('p').textContent = 'Passwords do not match. Please verify and try again.';
        }
        return;
    }

    btn.disabled = true;
    btn.innerHTML = '<svg class="animate-spin w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Creating Account…';

    try {
        const resp = await fetch('<?php echo $baseUrl; ?>backend/api/auth.php?action=register', {
            method: 'POST',
            body: new FormData(form),
        });
        const data = await resp.json();

        if (data.success) {
            btn.innerHTML = '✓ Account Created!';
            if (succDiv) {
                succDiv.classList.remove('hidden');
                succDiv.querySelector('p').textContent = data.message || 'Account created successfully!';
            }
            if (errDiv) errDiv.classList.add('hidden');
            setTimeout(() => {
                window.location.href = data.data?.redirect || '<?php echo $baseUrl; ?>auth/';
            }, 1200);
        } else {
            if (errDiv) {
                errDiv.classList.remove('hidden');
                errDiv.querySelector('p').textContent = data.message || 'Registration failed.';
            }
            if (succDiv) succDiv.classList.add('hidden');
            btn.disabled = false;
            btn.innerHTML = '<i data-lucide="user-plus" class="w-4 h-4"></i> <span>Create My Account</span>';
            lucide.createIcons();
        }
    } catch (err) {
        btn.disabled = false;
        btn.innerHTML = '<i data-lucide="user-plus" class="w-4 h-4"></i> <span>Create My Account</span>';
        lucide.createIcons();
        if (errDiv) {
            errDiv.classList.remove('hidden');
            errDiv.querySelector('p').textContent = 'An error occurred during registration. Please try again.';
        }
        console.error('Registration error:', err);
    }
});
</script>
</body>
</html>
