<?php
$active_page = "membership_status";
$base_url = "../../";
include_once '../../includes/head.php';
?>
<title>Membership Status | KEREA</title>

<style>
    .dashboard-sidebar {
        @apply fixed left-0 top-0 h-screen w-72 bg-black text-white z-50 transition-transform duration-300;
    }
    .nav-link {
        @apply flex items-center gap-4 px-6 py-4 text-[11px] font-black uppercase tracking-widest text-slate-400 hover:text-primary hover:bg-white/5 transition-all;
    }
    .nav-link.active {
        @apply text-primary bg-primary/5 border-r-4 border-primary;
    }
    .status-card {
        @apply bg-white p-10 rounded-4xl border border-slate-100 shadow-sm transition-all hover:shadow-xl;
    }
</style>

<div class="flex">
    <!-- Sidebar (Same as Dashboard) -->
    <aside class="dashboard-sidebar hidden lg:block" data-lenis-prevent>
        <div class="p-8 border-b border-white/10">
            <a href="<?php echo $base_url; ?>" class="flex items-center gap-3">
                <img src="<?php echo $base_url; ?>assets/kerea-logo-main.png" alt="KEREA" class="h-10 w-auto invert">
                <span class="font-black text-xl tracking-tight text-white">KEREA</span>
            </a>
        </div>
        
        <nav class="py-10 space-y-2">
            <a href="index.php" class="nav-link">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Overview
            </a>
            <a href="status.php" class="nav-link active">
                <i data-lucide="shield-check" class="w-5 h-5"></i> My Status
            </a>
            <a href="renewal.php" class="nav-link">
                <i data-lucide="refresh-cw" class="w-5 h-5"></i> Renewal
            </a>
            <a href="resources.php" class="nav-link">
                <i data-lucide="library" class="w-5 h-5"></i> Resources
            </a>
            <a href="#" class="nav-link">
                <i data-lucide="file-text" class="w-5 h-5"></i> Documents
            </a>
            <a href="#" class="nav-link">
                <i data-lucide="bell" class="w-5 h-5"></i> Notifications
            </a>
            <a href="#" class="nav-link">
                <i data-lucide="settings" class="w-5 h-5"></i> Settings
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 h-screen overflow-y-auto bg-slate-50 lg:ml-72 custom-scrollbar">
        <header class="bg-white border-b border-slate-100 px-8 py-6 flex justify-between items-center">
            <h1 class="text-xl font-black text-black uppercase tracking-tight">Active Status & Credentials</h1>
            <div class="flex items-center gap-4">
                <span class="text-[10px] font-black uppercase text-slate-400">Current Level:</span>
                <span class="px-3 py-1 bg-primary text-black text-[10px] font-black uppercase rounded-full">Corporate</span>
            </div>
        </header>

        <div class="p-8">
            <div class="max-w-5xl mx-auto space-y-10">
                <!-- Main Status Card -->
                <div class="status-card border-l-[12px] border-green-500">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                        <div class="flex items-center gap-8">
                            <div class="w-24 h-24 bg-green-50 rounded-3xl flex items-center justify-center text-green-500 shrink-0">
                                <i data-lucide="verified" class="w-12 h-12"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <h2 class="text-3xl font-black text-black">Member Status: Approved</h2>
                                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-[10px] font-black uppercase">Verified</span>
                                </div>
                                <p class="text-slate-500 max-w-xl">Your organization has completed all compliance checks and is an active member in good standing. Your digital certificates and badges are ready for discharge.</p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-3 w-full md:w-auto">
                            <button class="px-8 py-4 bg-black text-white font-black uppercase text-[10px] tracking-widest rounded-2xl flex items-center justify-center gap-2 hover:bg-primary hover:text-black transition-all">
                                <i data-lucide="download" class="w-4 h-4"></i> Get Certificate
                            </button>
                            <button class="px-8 py-4 bg-slate-100 text-black font-black uppercase text-[10px] tracking-widest rounded-2xl flex items-center justify-center gap-2 hover:bg-slate-200 transition-all">
                                <i data-lucide="share-2" class="w-4 h-4"></i> Public Badge
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Status Showcase (Visualizing other states as requested) -->
                <div>
                    <h3 class="text-xl font-black text-black uppercase tracking-tight mb-6">Status Life Cycle</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <!-- Pending -->
                        <div class="bg-white p-8 rounded-4xl border border-slate-100 opacity-60 hover:opacity-100 transition-all cursor-help border-l-[8px] border-orange-400">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-14 h-14 bg-orange-50 text-orange-400 rounded-2xl flex items-center justify-center">
                                    <i data-lucide="clock" class="w-8 h-8"></i>
                                </div>
                                <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-[10px] font-black uppercase">Pending Review</span>
                            </div>
                            <h4 class="text-xl font-black text-black mb-4 uppercase tracking-tight">Application Under Review</h4>
                            <p class="text-sm text-slate-500 leading-relaxed mb-6">Our secretariat is currently verifying your business documents. This typically takes 5 working days.</p>
                            <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="w-1/2 h-full bg-orange-400"></div>
                            </div>
                        </div>

                        <!-- Rejected -->
                        <div class="bg-white p-8 rounded-4xl border border-slate-100 opacity-60 hover:opacity-100 transition-all cursor-help border-l-[8px] border-red-500">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-14 h-14 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center">
                                    <i data-lucide="alert-circle" class="w-8 h-8"></i>
                                </div>
                                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-[10px] font-black uppercase">Rejected</span>
                            </div>
                            <h4 class="text-xl font-black text-black mb-4 uppercase tracking-tight">Requirement Gap</h4>
                            <p class="text-sm text-slate-500 leading-relaxed mb-6">Your Tax Compliance Certificate has expired. Please upload a valid document to proceed.</p>
                            <button class="text-[10px] font-black text-red-500 uppercase tracking-widest hover:underline">Correct Documents Now</button>
                        </div>

                        <!-- Expired -->
                        <div class="bg-white p-8 rounded-4xl border border-slate-100 border-l-[8px] border-slate-400 group">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-14 h-14 bg-slate-50 text-slate-400 rounded-2xl flex items-center justify-center">
                                    <i data-lucide="calendar-x" class="w-8 h-8"></i>
                                </div>
                                <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-[10px] font-black uppercase">Expired</span>
                            </div>
                            <h4 class="text-xl font-black text-black mb-4 uppercase tracking-tight">Membership Expired</h4>
                            <p class="text-sm text-slate-500 leading-relaxed mb-6">Your access to the Marketplace and policy briefs has been limited. Renew to regain full access.</p>
                            <button class="px-6 py-3 bg-slate-500 text-white font-black uppercase text-[10px] tracking-widest rounded-xl group-hover:bg-primary group-hover:text-black transition-all">Start Renewal</button>
                        </div>

                        <!-- Approved (Display variant) -->
                        <div class="bg-white p-8 rounded-4xl border border-slate-100 border-l-[8px] border-primary">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-14 h-14 bg-primary/10 text-primary rounded-2xl flex items-center justify-center">
                                    <i data-lucide="shield-check" class="w-8 h-8"></i>
                                </div>
                                <span class="bg-primary text-black px-3 py-1 rounded-full text-[10px] font-black uppercase">Verified</span>
                            </div>
                            <h4 class="text-xl font-black text-black mb-4 uppercase tracking-tight">Institutionally Vetted</h4>
                            <p class="text-sm text-slate-500 leading-relaxed mb-6">Verified as a Tier 1 Energy Solutions Provider in the East African regional database.</p>
                            <div class="flex items-center gap-2">
                                <i data-lucide="star" class="w-4 h-4 text-primary fill-primary"></i>
                                <span class="text-[10px] font-black text-black uppercase tracking-widest">Premium Entity</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    lucide.createIcons();
</script>

<?php include_once '../../includes/footer.php'; ?>
