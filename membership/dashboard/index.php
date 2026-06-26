<?php
$active_page = "membership_dashboard";
$base_url = "../../";
include_once '../../includes/head.php';
?>
<title>Member Dashboard | KEREA</title>

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
    .stat-card {
        @apply bg-white p-8 rounded-4xl border border-slate-100 shadow-sm transition-all hover:shadow-xl hover:-translate-y-1;
    }
</style>

<div class="flex">
    <!-- Sidebar -->
    <aside class="dashboard-sidebar hidden lg:block" data-lenis-prevent>
        <div class="p-8 border-b border-white/10">
            <a href="<?php echo $base_url; ?>" class="flex items-center gap-3">
                <img src="<?php echo $base_url; ?>assets/kerea-logo-main.png" alt="KEREA" class="h-10 w-auto invert">
                <span class="font-black text-xl tracking-tight text-white">KEREA</span>
            </a>
        </div>
        
        <nav class="py-10 space-y-2">
            <a href="index.php" class="nav-link active">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Overview
            </a>
            <a href="status.php" class="nav-link">
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

        <div class="absolute bottom-0 w-full p-8 border-t border-white/10">
            <a href="<?php echo $base_url; ?>auth" class="flex items-center gap-4 text-[10px] font-black uppercase tracking-widest text-red-400 hover:text-red-300 transition-colors">
                <i data-lucide="log-out" class="w-5 h-5"></i> Sign Out
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 h-screen overflow-y-auto bg-slate-50 lg:ml-72 custom-scrollbar">
        <!-- Top Bar -->
        <header class="sticky top-0 bg-white/80 backdrop-blur-xl border-b border-slate-100 px-8 py-6 flex justify-between items-center z-40">
            <div class="flex items-center gap-4 lg:hidden">
                <button class="p-2 bg-slate-100 rounded-xl"><i data-lucide="menu"></i></button>
            </div>
            <div>
                <h1 class="text-xl font-black text-black uppercase tracking-tight">Dashboard Overview</h1>
            </div>
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-4 px-4 py-2 bg-slate-50 rounded-2xl border border-slate-100 sm:flex hidden">
                    <div class="w-8 h-8 rounded-xl bg-primary flex items-center justify-center font-black text-black text-xs">JD</div>
                    <div class="flex flex-col">
                        <span class="text-[10px] font-black text-black">John Doe</span>
                        <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest">Corporate Member</span>
                    </div>
                </div>
                <button class="relative p-3 bg-slate-50 rounded-xl hover:bg-slate-100 transition-colors">
                    <i data-lucide="bell" class="w-5 h-5 text-slate-600"></i>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
            </div>
        </header>

        <div class="p-8 space-y-10">
            <!-- Status Alert -->
            <div class="bg-gradient-to-r from-primary to-accent-light p-8 rounded-4xl shadow-xl shadow-primary/20 flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-48 h-48 bg-white/10 rounded-full -mr-24 -mt-24 blur-3xl group-hover:scale-125 transition-transform duration-700"></div>
                <div class="flex items-center gap-8 relative z-10">
                    <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center shadow-lg">
                        <i data-lucide="check-circle-2" class="w-10 h-10 text-primary"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-black text-black mb-2">Welcome back, John!</h2>
                        <p class="text-black/60 font-medium max-w-sm">Your membership is currently <span class="bg-black text-white px-2 py-0.5 rounded-full text-[10px] uppercase font-black ml-2 tracking-widest">Active & Verified</span></p>
                    </div>
                </div>
                <div class="flex items-center gap-4 relative z-10">
                    <a href="renewal.php" class="px-8 py-4 bg-black text-white font-black uppercase text-[10px] tracking-widest rounded-2xl hover:scale-105 active:scale-95 transition-all">
                        Renew Membership
                    </a>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
                <div class="stat-card">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center">
                            <i data-lucide="award" class="w-6 h-6"></i>
                        </div>
                        <span class="text-[9px] font-black text-blue-500 bg-blue-50 px-2 py-1 rounded-lg uppercase">Standard</span>
                    </div>
                    <h3 class="text-slate-400 font-bold text-[10px] uppercase tracking-widest mb-1">Membership Tier</h3>
                    <p class="text-2xl font-black text-black">Corporate</p>
                </div>

                <div class="stat-card">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-12 h-12 bg-purple-50 text-purple-500 rounded-2xl flex items-center justify-center">
                            <i data-lucide="calendar" class="w-6 h-6"></i>
                        </div>
                        <span class="text-[9px] font-black text-purple-500 bg-purple-50 px-2 py-1 rounded-lg uppercase">Valid</span>
                    </div>
                    <h3 class="text-slate-400 font-bold text-[10px] uppercase tracking-widest mb-1">Expiry Date</h3>
                    <p class="text-2xl font-black text-black">Dec 2026</p>
                </div>

                <div class="stat-card">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-12 h-12 bg-green-50 text-green-500 rounded-2xl flex items-center justify-center">
                            <i data-lucide="download-cloud" class="w-6 h-6"></i>
                        </div>
                        <span class="text-[9px] font-black text-green-500 bg-green-50 px-2 py-1 rounded-lg uppercase">New</span>
                    </div>
                    <h3 class="text-slate-400 font-bold text-[10px] uppercase tracking-widest mb-1">Resources</h3>
                    <p class="text-2xl font-black text-black">24 Files</p>
                </div>

                <div class="stat-card">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center">
                            <i data-lucide="zap" class="w-6 h-6"></i>
                        </div>
                        <span class="text-[9px] font-black text-orange-500 bg-orange-50 px-2 py-1 rounded-lg uppercase">Market</span>
                    </div>
                    <h3 class="text-slate-400 font-bold text-[10px] uppercase tracking-widest mb-1">Member Activity</h3>
                    <p class="text-2xl font-black text-black">High</p>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-10">
                <!-- Recent Activities -->
                <div class="xl:col-span-2 space-y-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-black text-black uppercase tracking-tight">Recent Activity</h3>
                        <a href="#" class="text-[10px] font-black text-primary uppercase tracking-widest hover:underline">View All</a>
                    </div>
                    <div class="bg-white rounded-4xl border border-slate-100 overflow-hidden shadow-sm">
                        <div class="divide-y divide-slate-100">
                            <?php 
                            $activities = [
                                ["icon" => "file-check", "color" => "text-green-500", "title" => "Compliance Document Verified", "time" => "2 hours ago", "desc" => "Certificate of Incorporation has been successfully verified by KEREA Secretariat."],
                                ["icon" => "download", "color" => "text-blue-500", "title" => "New Resource Available", "time" => "1 day ago", "desc" => "2024 Solar Policy Brief East Africa is now available for download."],
                                ["icon" => "credit-card", "color" => "text-purple-500", "title" => "Invoice Paid Successfully", "time" => "3 days ago", "desc" => "Annual membership fee of KES 50,000 has been processed."],
                                ["icon" => "user-plus", "color" => "text-orange-500", "title" => "Member Directory Updated", "time" => "1 week ago", "desc" => "Your profile information has been updated for the public directory."]
                            ];
                            foreach($activities as $act):
                            ?>
                            <div class="p-6 flex gap-6 hover:bg-slate-50 transition-colors">
                                <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center shrink-0">
                                    <i data-lucide="<?php echo $act['icon']; ?>" class="w-6 h-6 <?php echo $act['color']; ?>"></i>
                                </div>
                                <div class="space-y-1">
                                    <div class="flex justify-between items-center">
                                        <h4 class="font-black text-sm text-black"><?php echo $act['title']; ?></h4>
                                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest"><?php echo $act['time']; ?></span>
                                    </div>
                                    <p class="text-xs text-slate-500 leading-relaxed"><?php echo $act['desc']; ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Profile Summary -->
                <div class="space-y-6">
                    <h3 class="text-xl font-black text-black uppercase tracking-tight">Organization Profile</h3>
                    <div class="bg-white p-8 rounded-4xl border border-slate-100 shadow-sm text-center">
                        <div class="w-32 h-32 bg-slate-100 rounded-4xl mx-auto mb-6 flex items-center justify-center border-4 border-white shadow-lg overflow-hidden shrink-0">
                             <i data-lucide="factory" class="w-12 h-12 text-primary"></i>
                        </div>
                        <h4 class="text-xl font-black text-black mb-1">Energy Solutions Ltd</h4>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Private Limited Company</p>
                        
                        <div class="space-y-4 text-left border-t border-slate-50 pt-6">
                            <div class="flex items-center gap-3">
                                <i data-lucide="map-pin" class="w-4 h-4 text-primary"></i>
                                <span class="text-xs text-slate-600">Westlands Business Hub, Nairobi</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <i data-lucide="mail" class="w-4 h-4 text-primary"></i>
                                <span class="text-xs text-slate-600">info@energysolutions.com</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <i data-lucide="users" class="w-4 h-4 text-primary"></i>
                                <span class="text-xs text-slate-600">Contact: John Doe (MD)</span>
                            </div>
                        </div>

                        <a href="#" class="w-full mt-8 flex items-center justify-center gap-2 px-6 py-4 bg-slate-100 text-black font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-primary transition-all">
                            Edit Profile <i data-lucide="edit-3" class="w-4 h-4"></i>
                        </a>
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
