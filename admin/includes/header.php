<?php
/**
 * KEREA — Admin Header (with Auth Guard)
 * All admin pages include this. Redirects to /auth/ if not logged in.
 */
declare(strict_types=1);

// Bootstrap backend
require_once dirname(__DIR__, 2) . '/backend/config/database.php';
require_once dirname(__DIR__, 2) . '/backend/core/Database.php';
require_once dirname(__DIR__, 2) . '/backend/core/Auth.php';
require_once dirname(__DIR__, 2) . '/backend/core/Security.php';
require_once dirname(__DIR__, 2) . '/backend/models/Setting.php';

// Start session & enforce login
Auth::startSession();
Auth::requireRole('content_manager', '/auth/');

// Load settings from DB
$settingModel = new Setting();
$settings     = $settingModel->all();
$currentUser  = Auth::user();

// Get current page for active nav state
$currentFile = basename($_SERVER['PHP_SELF'], '.php');

// CSRF token for all forms on admin pages
$csrfToken = Auth::csrfToken();

// Nav items configuration
$navItems = [
    ['file' => 'index',         'icon' => 'layout-dashboard', 'label' => 'Dashboard',    'role' => 'content_manager'],
    ['file' => 'content',       'icon' => 'file-text',        'label' => 'Content',       'role' => 'content_manager'],
    ['file' => 'pages',         'icon' => 'layout',           'label' => 'Pages',         'role' => 'content_manager'],
    ['file' => 'events',        'icon' => 'calendar',         'label' => 'Events',        'role' => 'content_manager'],
    ['file' => 'partners',      'icon' => 'handshake',        'label' => 'Partners',      'role' => 'content_manager'],
    ['file' => 'media',         'icon' => 'image',            'label' => 'Media',         'role' => 'content_manager'],
    ['file' => 'menus',         'icon' => 'menu',             'label' => 'Menus',         'role' => 'admin'],
    ['file' => 'users',         'icon' => 'users',            'label' => 'Users',         'role' => 'admin'],
    ['file' => 'analytics',     'icon' => 'bar-chart-2',      'label' => 'Analytics',     'role' => 'admin'],
    ['file' => 'customization', 'icon' => 'settings',         'label' => 'Settings',      'role' => 'admin'],
];

$roleHierarchy = ['member' => 1, 'content_manager' => 2, 'admin' => 3, 'super_admin' => 4];
$currentLevel  = $roleHierarchy[Auth::role()] ?? 0;

function canAccess(string $requiredRole, array $hierarchy, int $currentLevel): bool {
    return $currentLevel >= ($hierarchy[$requiredRole] ?? 99);
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo Security::esc($settings['site_name'] ?? 'KEREA'); ?> — Admin CMS</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <style>
        * { font-family: 'Inter', sans-serif; }
        :root {
            --primary: <?php echo Security::esc($settings['primary_color'] ?? '#39DE4F'); ?>;
            --accent:  <?php echo Security::esc($settings['accent_color']  ?? '#F59E0B'); ?>;
        }
        .text-primary   { color: var(--primary) !important; }
        .bg-primary     { background-color: var(--primary) !important; }
        .border-primary { border-color: var(--primary) !important; }
        .text-accent    { color: var(--accent) !important; }
        .bg-accent      { background-color: var(--accent) !important; }
        .shadow-premium { box-shadow: 0 4px 40px rgba(0,0,0,0.06), 0 1px 3px rgba(0,0,0,0.04); }
        .card-bg        { background: #fff; border: 1px solid #f1f5f9; }
        .sidebar-item.active { background: var(--primary); color: #000 !important; font-weight: 900; }
        .sidebar-item:not(.active):hover { background: #f8fafc; color: #000; }
        .modal-overlay  { position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 9999; display: flex; align-items: center; justify-content: center; }
        .modal-overlay.hidden { display: none; }
        /* Toast notifications */
        #toast-container { position: fixed; top: 1.5rem; right: 1.5rem; z-index: 99999; display: flex; flex-direction: column; gap: 0.75rem; pointer-events: none; }
        .toast { pointer-events: all; display: flex; align-items: center; gap: 0.75rem; padding: 1rem 1.25rem; border-radius: 1rem; font-size: 0.75rem; font-weight: 700; box-shadow: 0 8px 30px rgba(0,0,0,0.15); min-width: 280px; transition: all 0.3s ease; }
        .toast-success { background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; }
        .toast-error   { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }
        .toast-warning { background: #fffbeb; border: 1px solid #fde68a; color: #92400e; }
        .toast-info    { background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; }
        .gsap-reveal   { opacity: 0; transform: translateY(20px); }
        /* Table styling */
        table th { font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em; color: #94a3b8; }
        table td { font-size: 13px; }
        /* Form focus */
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px rgba(57,222,79,0.12);
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex">

<!-- Toast Container -->
<div id="toast-container"></div>

<!-- Sidebar -->
<aside id="sidebar" class="fixed left-0 top-0 h-screen w-64 bg-white border-r border-slate-100 shadow-xl z-40 flex flex-col">
    <!-- Logo -->
    <div class="p-6 border-b border-slate-100">
        <a href="/admin/" class="flex items-center gap-3">
            <img src="<?php echo Security::esc($settings['logo_main'] ?? '/assets/kerea-logo-main.png'); ?>" alt="KEREA" class="h-8 w-auto">
            <div>
                <span class="text-base font-black tracking-tight text-slate-900 block">KEREA</span>
                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Admin CMS</span>
            </div>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto p-4 space-y-1">
        <?php foreach ($navItems as $item): ?>
            <?php if (!canAccess($item['role'], $roleHierarchy, $currentLevel)) continue; ?>
            <a href="/admin/<?php echo $item['file']; ?>.php"
               class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black uppercase tracking-widest text-slate-600 transition-all
                      <?php echo $currentFile === $item['file'] ? 'active' : ''; ?>">
                <i data-lucide="<?php echo Security::esc($item['icon']); ?>" class="w-4 h-4 shrink-0"></i>
                <?php echo Security::esc($item['label']); ?>
            </a>
        <?php endforeach; ?>

        <div class="pt-4 border-t border-slate-100 mt-4">
            <a href="/" target="_blank"
               class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black uppercase tracking-widest text-slate-500 transition-all">
                <i data-lucide="external-link" class="w-4 h-4 shrink-0"></i>
                View Website
            </a>
        </div>
    </nav>

    <!-- User Info & Logout -->
    <div class="p-4 border-t border-slate-100 bg-slate-50/50">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center text-black font-black text-sm shrink-0">
                <?php echo strtoupper(substr($currentUser['first_name'] ?? 'A', 0, 1)); ?>
            </div>
            <div class="min-w-0">
                <p class="text-xs font-black text-slate-800 truncate">
                    <?php echo Security::esc(($currentUser['first_name'] ?? '') . ' ' . ($currentUser['last_name'] ?? '')); ?>
                </p>
                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest truncate">
                    <?php echo Security::esc($currentUser['role_label'] ?? $currentUser['role_name'] ?? 'Admin'); ?>
                </p>
            </div>
        </div>
        <button onclick="handleLogout()" class="w-full flex items-center justify-center gap-2 px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-500 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-all">
            <i data-lucide="log-out" class="w-3.5 h-3.5"></i> Sign Out
        </button>
    </div>
</aside>

<!-- Mobile Sidebar Backdrop -->
<div id="sidebar-backdrop" class="fixed inset-0 bg-black/40 z-30 hidden lg:hidden" onclick="toggleSidebar()"></div>

<!-- Main Content Area -->
<div class="ml-64 flex-1 flex flex-col min-h-screen">
    <!-- Top Bar -->
    <header class="sticky top-0 z-20 bg-white border-b border-slate-100 shadow-sm">
        <div class="flex items-center justify-between px-8 py-4">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-xl bg-slate-100 hover:bg-primary transition-all">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
                <div>
                    <h1 class="text-lg font-black text-slate-900 capitalize"><?php echo Security::esc(str_replace(['_','-'], ' ', $currentFile)); ?></h1>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                        <?php echo Security::esc($settings['site_name'] ?? 'KEREA'); ?> Admin Panel
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="hidden sm:inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-700 rounded-full text-[9px] font-black uppercase tracking-widest border border-emerald-100">
                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                    DB Connected
                </span>
                <a href="/admin/customization.php" class="p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-500 hover:bg-primary hover:text-black hover:border-primary transition-all">
                    <i data-lucide="settings" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- Page Content Injected Here -->
    <main class="flex-1 p-8">
