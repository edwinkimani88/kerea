<?php
$active_page = "membership_resources";
$base_url = "../../";
include_once '../../includes/head.php';
?>
<title>Member Resources | KEREA</title>

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
    .resource-card {
        @apply bg-white p-6 rounded-4xl border border-slate-100 shadow-sm transition-all hover:shadow-xl hover:-translate-y-2 group;
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
            <a href="index.php" class="nav-link">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Overview
            </a>
            <a href="status.php" class="nav-link">
                <i data-lucide="shield-check" class="w-5 h-5"></i> My Status
            </a>
            <a href="renewal.php" class="nav-link">
                <i data-lucide="refresh-cw" class="w-5 h-5"></i> Renewal
            </a>
            <a href="resources.php" class="nav-link active">
                <i data-lucide="library" class="w-5 h-5"></i> Resources
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 h-screen overflow-y-auto bg-slate-50 lg:ml-72 custom-scrollbar">
        <header class="bg-white border-b border-slate-100 px-8 py-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-xl font-black text-black uppercase tracking-tight">Knowledge Hub & Resources</h1>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Exclusive repository for KEREA Members</p>
            </div>
            <div class="flex gap-2 w-full md:w-auto">
                <div class="relative flex-1 md:w-64">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    <input type="text" placeholder="Search resources..." class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-primary focus:bg-white outline-none transition-all text-xs">
                </div>
            </div>
        </header>

        <div class="p-8">
            <!-- Filter Tabs -->
            <div class="flex flex-wrap gap-4 mb-10">
                <button class="px-6 py-3 bg-black text-white font-black text-[10px] uppercase tracking-widest rounded-xl shadow-lg shadow-black/20">All Files</button>
                <button class="px-6 py-3 bg-white text-slate-500 font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-primary hover:text-black transition-all">Policy Briefs</button>
                <button class="px-6 py-3 bg-white text-slate-500 font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-primary hover:text-black transition-all">Training Materials</button>
                <button class="px-6 py-3 bg-white text-slate-500 font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-primary hover:text-black transition-all">Legal Templates</button>
                <button class="px-6 py-3 bg-white text-slate-500 font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-primary hover:text-black transition-all">Event Reports</button>
            </div>

            <!-- Resources Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                <?php 
                $resources = [
                    ["cat" => "Policy", "title" => "2024 Energy Act Analysis", "desc" => "Comprehensive breakdown of new regulatory requirements for renewable developers.", "date" => "June 2024", "type" => "PDF"],
                    ["cat" => "Legal", "title" => "Standard PPA Template", "desc" => "Standardized Power Purchase Agreement template vetted for the Kenyan market.", "date" => "May 2024", "type" => "DOCX"],
                    ["cat" => "Training", "title" => "Solar PV Advanced Design", "desc" => "Advanced course materials for Tier 2 solar installation certification.", "date" => "April 2024", "type" => "VIDEO"],
                    ["cat" => "Market", "title" => "Q1 2024 Market Insights", "desc" => "Exclusive data on solar importation and mini-grid deployment trends.", "date" => "March 2024", "type" => "PDF"],
                    ["cat" => "Advocacy", "title" => "VAT Exemption Guidelines", "desc" => "Step-by-step guide for claiming tax exemptions on renewable equipment.", "date" => "Feb 2024", "type" => "PDF"],
                    ["cat" => "Technical", "title" => "Battery Storage Standards", "desc" => "Draft standards for Lithium-Ion storage systems in residential use.", "date" => "Jan 2024", "type" => "PDF"]
                ];
                foreach($resources as $res):
                ?>
                <div class="resource-card">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 bg-slate-50 group-hover:bg-primary/20 transition-colors rounded-2xl flex items-center justify-center">
                            <?php 
                            $icon = "file-text";
                            if($res['type'] == 'VIDEO') $icon = "play-circle";
                            if($res['type'] == 'DOCX') $icon = "file-edit-3";
                            ?>
                            <i data-lucide="<?php echo $icon; ?>" class="w-6 h-6 text-slate-600 group-hover:text-black transition-colors"></i>
                        </div>
                        <span class="text-[9px] font-black uppercase text-primary tracking-widest bg-primary/5 px-2 py-1 rounded-lg"><?php echo $res['cat']; ?></span>
                    </div>
                    <h4 class="text-lg font-black text-black mb-3 leading-tight"><?php echo $res['title']; ?></h4>
                    <p class="text-xs text-slate-500 leading-relaxed mb-6 line-clamp-2"><?php echo $res['desc']; ?></p>
                    
                    <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black uppercase text-slate-400">Added Date</span>
                            <span class="text-[10px] font-bold text-black uppercase"><?php echo $res['date']; ?></span>
                        </div>
                        <button class="px-5 py-2.5 bg-slate-100 text-black font-black uppercase text-[10px] tracking-widest rounded-xl hover:bg-black hover:text-white transition-all flex items-center gap-2">
                             Download <i data-lucide="download" class="w-3 h-3"></i>
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Publication Section -->
            <div class="mt-20">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-black text-black uppercase tracking-tight">KEREA Publications</h3>
                </div>
                <div class="bg-slate-900 rounded-4xl p-10 flex flex-col md:flex-row items-center gap-12 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-primary/10 blur-3xl -mr-32 -mt-32"></div>
                    <div class="w-full md:w-48 h-64 bg-white rounded-2xl shadow-2xl flex items-center justify-center shrink-0 border-8 border-slate-800 rotate-2">
                        <div class="text-center p-6">
                            <img src="<?php echo $base_url; ?>assets/kerea-logo-main.png" class="w-16 h-auto mx-auto mb-4 opacity-50">
                            <span class="text-[10px] font-black uppercase text-slate-300 block">Annual Review</span>
                            <span class="text-2xl font-black text-slate-900 block mt-2">2024</span>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <span class="px-4 py-1.5 bg-primary text-black text-[10px] font-black uppercase tracking-widest rounded-full">New Release</span>
                        <h4 class="text-3xl font-black text-white leading-tight">The State of Kenyan Renewable Energy <br><span class="text-primary italic">2024 Annual Report</span></h4>
                        <p class="text-slate-400 max-w-2xl text-sm leading-relaxed">The flagship publication providing data-driven insights into the sector's performance, hurdles, and breakthroughs over the past 12 months. Available exclusively to KEREA members.</p>
                        <button class="px-8 py-4 bg-primary text-black font-black uppercase text-xs tracking-widest rounded-2xl hover:bg-white transition-all">
                            Unlock Full Report
                        </button>
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
