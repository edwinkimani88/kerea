<?php
include_once __DIR__ . '/../../includes/config.php';
// Use absolute paths for Vercel router compatibility
$base_url = "/"; 
$admin_base = "/admin/";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KEREA Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="<?php echo $admin_base; ?>js/themes.js"></script>
    <script src="<?php echo $admin_base; ?>js/ui.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: 'var(--primary)',
                        accent: 'var(--accent)',
                        dark: 'var(--bg-main)',
                        'base-100': 'var(--bg-main)',
                        'base-200': 'var(--sidebar-bg)',
                        'base-content': 'var(--text-main)',
                        'base-muted': 'var(--text-muted)'
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    boxShadow: {
                        'premium': '0 10px 30px -10px rgba(0,0,0,0.05)',
                        'premium-hover': '0 20px 40px -15px rgba(0,0,0,0.1)',
                    }
                }
            }
        }
    </script>
    <style>
        :root {
            --primary: #39DE4F;
            --accent: #F59E0B;
            --bg-main: #f8fafc;
            --sidebar-bg: #ffffff;
            --topbar-bg: #ffffff;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #f1f5f9;
            --sidebar-text: #475569;
            --sidebar-active-bg: rgba(57, 222, 79, 0.1);
            --sidebar-active-text: #39DE4F;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--bg-main); 
            color: var(--text-main);
            transition: background-color 0.4s ease, color 0.4s ease;
        }
        
        .sidebar-bg { background-color: var(--sidebar-bg); border-right: 1px solid var(--border); }
        .topbar-bg { background-color: var(--topbar-bg); border-bottom: 1px solid var(--border); }
        .card-bg { background-color: var(--card-bg); border: 1px solid var(--border); }
        .content-bg { background-color: var(--bg-main); transition: background-color 0.4s ease; }
        .sidebar-link { color: var(--sidebar-text); }
        .sidebar-link:hover { background-color: var(--sidebar-active-bg); color: var(--sidebar-active-text); }
        .sidebar-link.active { background-color: var(--sidebar-active-bg); color: var(--sidebar-active-text); border-right: 4px solid var(--primary); }
        
        /* Typography overrides for themes */
        h1, h2, h3, h4, h5, h6 { color: var(--text-main); }
        p, span, label { color: var(--text-muted); }
        .text-main { color: var(--text-main) !important; }
        .text-muted { color: var(--text-muted) !important; }
        
        button.bg-primary, .btn-primary { color: var(--btn-text) !important; }
        
        /* Premium Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        
        .gsap-reveal { opacity: 0; transform: translateY(20px); }

        /* Modal Overlay */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(8px);
            z-index: 100;
        }
    </style>
</head>
<body class="flex min-h-screen opacity-0" id="body-main">
    <!-- Sidebar -->
    <aside class="w-72 sidebar-bg flex flex-col shrink-0 z-30 relative shadow-premium">
        <div class="p-8 border-b border-slate-100 flex items-center gap-4">
            <div class="w-10 h-10 bg-primary rounded-2xl flex items-center justify-center text-white shadow-lg shadow-primary/20 rotate-3 group-hover:rotate-0 transition-transform overflow-hidden">
                <img src="<?php echo $base_url; ?>assets/kerea-logo-main.png" alt="K" class="w-6 h-6 object-contain pointer-events-none">
            </div>
            <div>
                <span class="font-black text-xl tracking-tight block">KEREA</span>
                <span class="text-[8px] font-black uppercase tracking-[0.2em] text-primary">Intelligence Dash</span>
            </div>
        </div>
        <nav class="flex-1 p-6 space-y-2">
            <a href="<?php echo $admin_base; ?>index.php" class="sidebar-link flex items-center gap-4 px-5 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all hover:translate-x-2">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard
            </a>
            <a href="<?php echo $admin_base; ?>customization.php" class="sidebar-link flex items-center gap-4 px-5 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all hover:translate-x-2">
                <i data-lucide="palette" class="w-5 h-5"></i> Appearance
            </a>
            <a href="<?php echo $admin_base; ?>vendors.php" class="sidebar-link flex items-center gap-4 px-5 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all hover:translate-x-2">
                <i data-lucide="users" class="w-5 h-5"></i> Vendors
            </a>
            <a href="<?php echo $admin_base; ?>products.php" class="sidebar-link flex items-center gap-4 px-5 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all hover:translate-x-2">
                <i data-lucide="shopping-bag" class="w-5 h-5"></i> Marketplace
            </a>
            <a href="<?php echo $admin_base; ?>analytics.php" class="sidebar-link flex items-center gap-4 px-5 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all hover:translate-x-2">
                <i data-lucide="pie-chart" class="w-5 h-5"></i> Sector Analytics
            </a>
            <a href="<?php echo $admin_base; ?>content.php" class="sidebar-link flex items-center gap-4 px-5 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all hover:translate-x-2">
                <i data-lucide="file-text" class="w-5 h-5"></i> Knowledge Hub
            </a>
            <a href="<?php echo $admin_base; ?>support.php" class="sidebar-link flex items-center gap-4 px-5 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all hover:translate-x-2">
                <i data-lucide="message-square" class="w-5 h-5"></i> Support Desk
            </a>

            <!-- Portals Divider -->
            <div class="pt-4 pb-2 px-2">
                <p class="text-[8px] font-black uppercase tracking-[0.3em] text-slate-300">Member Portals</p>
            </div>
            <a href="<?php echo $base_url; ?>membership" class="sidebar-link flex items-center gap-4 px-5 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all hover:translate-x-2">
                <i data-lucide="award" class="w-5 h-5"></i> Membership
            </a>
            <a href="<?php echo $base_url; ?>vendor" class="sidebar-link flex items-center gap-4 px-5 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all hover:translate-x-2">
                <i data-lucide="store" class="w-5 h-5"></i> Vendor Portal
            </a>
        </nav>
        <div class="p-6 border-t border-slate-100">
            <div class="bg-primary/5 rounded-3xl p-6 space-y-4">
                <p class="text-[9px] font-black text-primary uppercase tracking-[0.2em]">Compliance Score</p>
                <div class="flex items-center justify-between">
                    <span class="text-2xl font-black">94.8%</span>
                    <i data-lucide="shield-check" class="w-6 h-6 text-primary"></i>
                </div>
                <div class="w-full h-1 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-primary w-[94.8%]"></div>
                </div>
            </div>
            <a href="<?php echo $base_url; ?>" class="flex items-center gap-3 px-5 py-4 mt-4 rounded-2xl text-[10px] font-black uppercase tracking-widest text-[#a8a8a8] hover:text-primary transition-all">
                <i data-lucide="external-link" class="w-4 h-4"></i> View Website
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-hidden relative">
        <!-- Top Nav -->
        <header class="h-24 topbar-bg flex items-center justify-between px-10 shrink-0 z-20">
            <div class="flex items-center gap-4">
                <h1 class="text-2xl font-black tracking-tight" id="page-title">Management</h1>
                <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-[10px] font-black uppercase tracking-widest">v2.4 Pro</span>
            </div>
            
            <div class="flex items-center gap-8">
                <!-- Theme Switcher -->
                <div class="relative">
                    <button onclick="UI.toggleDropdown('theme-dropdown')" class="flex items-center gap-3 px-5 py-3 bg-slate-50 border border-slate-100 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-white hover:shadow-premium transition-all">
                        <i data-lucide="palette" class="w-4 h-4 text-primary"></i> 
                        Change Theme
                        <i data-lucide="chevron-down" class="w-3 h-3"></i>
                    </button>
                    <div id="theme-dropdown" class="absolute top-full right-0 mt-3 w-64 bg-white border border-slate-100 rounded-[2rem] shadow-2xl p-4 hidden z-50">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-4 px-3">Professional Presets</p>
                        <div class="grid grid-cols-1 gap-1">
                            <?php 
                            $themes = [
                                'kerea-green' => ['KEREA Green', '#39DE4F'],
                                'midnight-blue' => ['Midnight Blue', '#0f172a'],
                                'carbon-dark' => ['Carbon Dark', '#121212'],
                                'forest-premium' => ['Forest Premium', '#14532d'],
                                'earth-tone' => ['Earth Tone', '#44403c'],
                                'modern-light' => ['Modern Light', '#ffffff'],
                                'ocean-blue' => ['Ocean Blue', '#0c4a6e'],
                                'executive-dark' => ['Executive Dark', '#09090b'],
                                'warm-sunset' => ['Warm Sunset', '#7c2d12'],
                                'sapphire-pro' => ['Sapphire Pro', '#1e3a8a']
                            ];
                            foreach($themes as $id => $info):
                            ?>
                            <button onclick="applyTheme('<?php echo $id; ?>'); UI.toast('Theme changed to <?php echo $info[0]; ?>', 'success'); UI.toggleDropdown('theme-dropdown');" class="flex items-center justify-between w-full p-3 rounded-xl hover:bg-slate-50 text-[10px] font-bold text-slate-600 transition-all text-left">
                                <?php echo $info[0]; ?> <div class="w-3 h-3 rounded-full border border-slate-100" style="background-color: <?php echo $info[1]; ?>"></div>
                            </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <div onclick="UI.toggleDropdown('notif-dropdown')" class="relative p-3 bg-slate-50 rounded-2xl border border-slate-100 hover:bg-white transition-all cursor-pointer group">
                        <i data-lucide="bell" class="w-5 h-5 text-slate-400 group-hover:text-primary transition-colors"></i>
                        <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                        
                        <!-- Notifications Dropdown -->
                        <div id="notif-dropdown" class="absolute top-full right-0 mt-3 w-80 bg-white border border-slate-100 rounded-[2rem] shadow-2xl p-6 hidden">
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Recent Alerts</h4>
                            <div class="space-y-4">
                                <div class="flex gap-4 p-3 hover:bg-slate-50 rounded-2xl transition-all">
                                    <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center shrink-0">
                                        <i data-lucide="check-circle" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-[11px] font-black text-slate-800">Vendor Verified</p>
                                        <p class="text-[9px] text-slate-500 font-bold">SolarLink completed KYC</p>
                                    </div>
                                </div>
                                <div class="flex gap-4 p-3 hover:bg-slate-50 rounded-2xl transition-all">
                                    <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center shrink-0">
                                        <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-[11px] font-black text-slate-800">Stock Alert</p>
                                        <p class="text-[9px] text-slate-500 font-bold">Moto Stoves low in stock</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div onclick="UI.toggleDropdown('user-dropdown')" class="flex items-center gap-4 bg-slate-50 p-2 pr-5 rounded-2xl border border-slate-100 hover:shadow-premium transition-all cursor-pointer relative">
                        <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-white font-black text-xs shadow-lg shadow-primary/20">
                            AD
                        </div>
                        <div class="hidden sm:block">
                            <p class="text-xs font-black text-slate-800 leading-none">Admin User</p>
                            <p class="text-[9px] font-bold text-slate-400 uppercase mt-1 tracking-widest">Secretariat</p>
                        </div>

                        <!-- User Dropdown -->
                        <div id="user-dropdown" class="absolute top-full right-0 mt-3 w-64 bg-white border border-slate-100 rounded-[2rem] shadow-2xl p-6 hidden">
                            <div class="pb-4 mb-4 border-b border-slate-100">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Signed in as</p>
                                <p class="text-xs font-black text-slate-800">admin@kerea.org</p>
                            </div>
                            <div class="space-y-2">
                                <a href="#" class="flex items-center gap-3 p-3 hover:bg-slate-50 rounded-xl transition-all text-[10px] font-black uppercase tracking-widest text-slate-600">
                                    <i data-lucide="user" class="w-4 h-4"></i> Profile
                                </a>
                                <a href="#" class="flex items-center gap-3 p-3 hover:bg-slate-50 rounded-xl transition-all text-[10px] font-black uppercase tracking-widest text-slate-600">
                                    <i data-lucide="settings" class="w-4 h-4"></i> Settings
                                </a>
                                <div class="pt-2">
                                    <a href="<?php echo $base_url; ?>auth/" class="flex items-center gap-3 p-3 bg-red-50 text-red-600 rounded-xl transition-all text-[10px] font-black uppercase tracking-widest">
                                        <i data-lucide="log-out" class="w-4 h-4"></i> Sign Out
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <script>
            // Page fade-in on load (runs immediately after GSAP is available)
            window.addEventListener('load', () => {
                gsap.to('#body-main', { opacity: 1, duration: 0.8, ease: "power2.out" });
            });
        </script>

        <!-- Dynamic Content Area -->
        <div class="flex-1 overflow-y-auto p-10 space-y-12 content-bg">

