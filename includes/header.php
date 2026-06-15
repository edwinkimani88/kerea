<?php
if(!isset($base_url)) $base_url = "/";
if(!isset($active_page)) $active_page = "home";
?>

<!-- Premium Preloader - Using Logo Load -->
<div id="preloader">
    <div class="loader-content">
        <img src="<?php echo $base_url; ?>assets/Logo Load.png" alt="Kerea Loading" class="loader-logo">
        <div class="w-32 h-1 bg-slate-100 rounded-full overflow-hidden mt-4">
            <div id="preloader-bar" class="h-full bg-primary w-0 transition-all duration-700"></div>
        </div>
    </div>
</div>

<!-- Top Utility Bar - Stable & Legible -->
<div class="bg-black text-white py-2 px-4 sm:px-6 lg:px-8 text-[10px] sm:text-xs select-none">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="flex items-center gap-6">
            <span class="font-bold tracking-widest text-primary uppercase">Kerea Guaranteed Compliance</span>
            <div class="hidden sm:flex items-center gap-2 text-slate-300">
                <i data-lucide="map-pin" class="w-3 h-3 text-primary"></i>
                <span>Nairobi Secretariat Hub</span>
            </div>
        </div>
        <div class="flex items-center gap-6">
            <a href="mailto:membership@kerea.org" class="flex items-center gap-2 hover:text-primary transition-colors">
                <i data-lucide="mail" class="w-3 h-3 text-primary"></i>
                <span>membership@kerea.org</span>
            </a>
            <div class="hidden md:flex items-center gap-2">
                <i data-lucide="phone" class="w-3 h-3 text-primary"></i>
                <span>+254 (0) 20 2345678</span>
            </div>
        </div>
    </div>
</div>

<!-- Main Header - Static & High Legibility -->
<header id="main-nav" class="sticky top-0 z-50 w-full bg-white py-4 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <!-- Logo - Official KereaMain -->
            <a href="<?php echo $base_url; ?>" class="flex items-center gap-4 group">
                <img src="<?php echo $base_url; ?>assets/Kerea Logo Main.png" alt="KEREA" class="h-12 w-auto object-contain">
                <div class="hidden sm:flex flex-col border-l border-slate-200 pl-4">
                    <span class="text-xl font-black tracking-tight text-black leading-none">KEREA</span>
                    <span class="text-[10px] font-bold text-slate-500 tracking-widest uppercase mt-1">Industry Peak Body</span>
                </div>
            </a>

            <!-- Desktop Navigation - High Contrast -->
            <nav class="hidden xl:flex items-center gap-8">
                <a href="<?php echo $base_url; ?>" class="text-[11px] font-black uppercase tracking-widest transition-colors <?php echo ($active_page == 'home') ? 'text-primary' : 'text-black hover:text-primary'; ?>">Home</a>
                
                <div class="relative group">
                    <button class="text-[11px] font-black uppercase tracking-widest text-black hover:text-primary flex items-center gap-1 cursor-pointer transition-colors">
                        Institutional <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400 group-hover:rotate-180 transition-transform"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-4 w-64 bg-white border border-slate-100 rounded-2xl shadow-xl p-3 space-y-1 opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto transition-all duration-200">
                        <a href="<?php echo $base_url; ?>about/" class="block w-full text-left font-black text-[10px] uppercase tracking-widest p-3 rounded-xl text-black hover:bg-slate-50 hover:text-primary transition-all">About Us</a>
                        <a href="<?php echo $base_url; ?>leadership/" class="block w-full text-left font-black text-[10px] uppercase tracking-widest p-3 rounded-xl text-black hover:bg-slate-50 hover:text-primary transition-all">Executive Board</a>
                        <a href="<?php echo $base_url; ?>member-directory/" class="block w-full text-left font-black text-[10px] uppercase tracking-widest p-3 rounded-xl text-black hover:bg-slate-50 hover:text-primary transition-all">Member Directory</a>
                    </div>
                </div>

                <a href="<?php echo $base_url; ?>policy-advocacy/" class="text-[11px] font-black uppercase tracking-widest text-black hover:text-primary transition-colors">Policy Briefs</a>
                <a href="<?php echo $base_url; ?>marketplace/" class="px-6 py-2.5 bg-primary text-black text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-slate-900 hover:text-white transition-all shadow-lg shadow-primary/20 text-center">Marketplace</a>
                <a href="<?php echo $base_url; ?>contact/" class="text-[11px] font-black uppercase tracking-widest text-black hover:text-primary transition-colors"><?php echo ($active_page == 'contact') ? '<span class="text-primary">Contact</span>' : 'Contact'; ?></a>
            </nav>

            <div class="flex items-center gap-4">
                <a href="<?php echo $base_url; ?>auth/" class="hidden sm:flex items-center gap-2 px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest text-black bg-slate-100 hover:bg-primary hover:text-black transition-all border border-slate-200">
                    <i data-lucide="lock" class="w-4 h-4"></i> Sign In
                </a>
                <button id="mobile-menu-btn" class="xl:hidden p-3 rounded-xl bg-slate-100 text-black hover:bg-primary transition-all" aria-label="Menu">
                    <i data-lucide="menu" class="w-6 h-6" id="menu-icon-open"></i>
                    <i data-lucide="x" class="w-6 h-6 hidden" id="menu-icon-close"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Menu Panel -->
<div id="mobile-menu" class="fixed inset-0 z-40 hidden">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" id="mobile-menu-overlay"></div>
    <div class="absolute top-0 right-0 h-full w-80 max-w-[90vw] bg-white shadow-2xl flex flex-col overflow-y-auto">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <a href="<?php echo $base_url; ?>" class="flex items-center gap-3">
                <img src="<?php echo $base_url; ?>assets/Kerea Logo Main.png" alt="KEREA" class="h-9 w-auto">
                <span class="font-black text-lg tracking-tight text-black">KEREA</span>
            </a>
            <button id="mobile-menu-close" class="p-2 rounded-xl bg-slate-100 hover:bg-primary transition-all">
                <i data-lucide="x" class="w-5 h-5 text-black"></i>
            </button>
        </div>
        <nav class="flex-1 p-6 space-y-1">
            <a href="<?php echo $base_url; ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl font-black text-[11px] uppercase tracking-widest <?php echo $active_page=='home' ? 'bg-primary text-black' : 'text-slate-700 hover:bg-slate-50 hover:text-primary'; ?> transition-all">
                <i data-lucide="home" class="w-4 h-4"></i> Home
            </a>
            <a href="<?php echo $base_url; ?>about/" class="flex items-center gap-3 px-4 py-3 rounded-xl font-black text-[11px] uppercase tracking-widest <?php echo $active_page=='about' ? 'bg-primary text-black' : 'text-slate-700 hover:bg-slate-50 hover:text-primary'; ?> transition-all">
                <i data-lucide="info" class="w-4 h-4"></i> About Us
            </a>
            <a href="<?php echo $base_url; ?>member-directory/" class="flex items-center gap-3 px-4 py-3 rounded-xl font-black text-[11px] uppercase tracking-widest text-slate-700 hover:bg-slate-50 hover:text-primary transition-all">
                <i data-lucide="users" class="w-4 h-4"></i> Member Directory
            </a>
            <a href="<?php echo $base_url; ?>policy-advocacy/" class="flex items-center gap-3 px-4 py-3 rounded-xl font-black text-[11px] uppercase tracking-widest text-slate-700 hover:bg-slate-50 hover:text-primary transition-all">
                <i data-lucide="landmark" class="w-4 h-4"></i> Policy Briefs
            </a>
            <a href="<?php echo $base_url; ?>standards/" class="flex items-center gap-3 px-4 py-3 rounded-xl font-black text-[11px] uppercase tracking-widest text-slate-700 hover:bg-slate-50 hover:text-primary transition-all">
                <i data-lucide="shield-check" class="w-4 h-4"></i> Standards
            </a>
            <a href="<?php echo $base_url; ?>contact/" class="flex items-center gap-3 px-4 py-3 rounded-xl font-black text-[11px] uppercase tracking-widest <?php echo $active_page=='contact' ? 'bg-primary text-black' : 'text-slate-700 hover:bg-slate-50 hover:text-primary'; ?> transition-all">
                <i data-lucide="mail" class="w-4 h-4"></i> Contact
            </a>
        </nav>
        <div class="p-6 border-t border-slate-100 space-y-3">
            <a href="<?php echo $base_url; ?>marketplace/" class="w-full py-4 bg-primary text-black font-black text-[10px] uppercase tracking-widest rounded-xl flex items-center justify-center gap-2 shadow-lg shadow-primary/20 hover:bg-primary-dark transition-all">
                <i data-lucide="shopping-bag" class="w-4 h-4"></i> Marketplace
            </a>
            <a href="<?php echo $base_url; ?>auth/" class="w-full py-4 bg-slate-100 text-black font-black text-[10px] uppercase tracking-widest rounded-xl flex items-center justify-center gap-2 hover:bg-slate-200 transition-all">
                <i data-lucide="lock" class="w-4 h-4"></i> Sign In
            </a>
        </div>
    </div>
</div>

<script>
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
    const mobileMenuClose = document.getElementById('mobile-menu-close');

    function openMobileMenu() {
        mobileMenu.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeMobileMenu() {
        mobileMenu.classList.add('hidden');
        document.body.style.overflow = '';
    }

    if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', openMobileMenu);
    if (mobileMenuOverlay) mobileMenuOverlay.addEventListener('click', closeMobileMenu);
    if (mobileMenuClose) mobileMenuClose.addEventListener('click', closeMobileMenu);
</script>

<script>
    // Simple Preloader Logic — animations handled globally in footer.php
    window.addEventListener('load', () => {
        const bar = document.getElementById('preloader-bar');
        const preloader = document.getElementById('preloader');
        
        if(bar) bar.style.width = '100%';
        
        setTimeout(() => {
            if(preloader) {
                preloader.style.opacity = '0';
                preloader.style.transition = 'opacity 0.4s ease';
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 400);
            }
        }, 600);
    });
</script>
