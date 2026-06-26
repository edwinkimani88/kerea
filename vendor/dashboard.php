<?php
$active_page = "vendor_dashboard";
$base_url = "../";
$dashboard_layout = true;
include_once '../includes/head.php';

/**
 * Auth Guard: Check if user is registered.
 * Uses a simple session flag. If not set, treat as unregistered.
 * In production, replace this with a real DB session check.
 */
session_start();
$is_registered = isset($_SESSION['vendor_registered']) && $_SESSION['vendor_registered'] === true;

// Allow demo mode override via URL (remove in production)
if (isset($_GET['mode'])) {
    if ($_GET['mode'] === 'approved') {
        $_SESSION['vendor_registered'] = true;
        $_SESSION['vendor_approved'] = true;
        $is_registered = true;
    } elseif ($_GET['mode'] === 'pending') {
        $_SESSION['vendor_registered'] = true;
        $_SESSION['vendor_approved'] = false;
        $is_registered = true;
    } elseif ($_GET['mode'] === 'logout') {
        session_destroy();
        header('Location: register.php');
        exit;
    }
}

// If not registered, the dashboard renders in a preview/locked state
// All action buttons will point to register.php
$is_approved = $is_registered && isset($_SESSION['vendor_approved']) && $_SESSION['vendor_approved'] === true;
$mode = $is_approved ? 'approved' : ($is_registered ? 'pending' : 'unregistered');

// If not registered, any POST request or action-click redirects to register
if (!$is_registered && $_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Location: register.php');
    exit;
}
?>
<title>Vendor Dashboard | KEREA Marketplace</title>

<style>
    .vendor-sidebar {
        @apply fixed left-0 top-0 h-screen w-72 bg-slate-950 text-white z-50 transition-transform duration-300;
    }
    .nav-link {
        @apply flex items-center gap-4 px-6 py-4 text-[11px] font-black uppercase tracking-widest text-slate-400 hover:text-primary hover:bg-white/5 transition-all;
    }
    .nav-link.active {
        @apply text-primary bg-primary/5 border-r-4 border-primary;
    }
    .locked-feature {
        @apply relative cursor-not-allowed grayscale pointer-events-none;
    }
    .lock-overlay {
        @apply absolute inset-0 bg-slate-50/10 backdrop-blur-[2px] z-20 flex flex-col items-center justify-center rounded-4xl;
        background-image: radial-gradient(circle at center, transparent 30%, rgba(248, 250, 252, 0.4) 100%);
    }
    .stat-card {
        @apply bg-white p-8 rounded-4xl border border-slate-100 shadow-sm transition-all hover:shadow-xl relative overflow-hidden;
    }
    /* Custom Scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        @apply bg-slate-200 rounded-full;
    }
</style>

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="vendor-sidebar hidden lg:block" data-lenis-prevent>
        <div class="p-8 border-b border-white/5">
            <a href="<?php echo $base_url; ?>" class="flex items-center gap-3 font-bold text-white">
                <div class="w-10 h-10 bg-primary/20 rounded-xl flex items-center justify-center">
                    <i data-lucide="zap" class="w-6 h-6 text-primary"></i>
                </div>
                <span class="font-black text-xl tracking-tight uppercase italic">Merchant</span>
            </a>
        </div>
        
        <nav class="py-10 space-y-2">
            <a href="dashboard.php" class="nav-link active">
                <i data-lucide="grid-3x3" class="w-5 h-5"></i> Dashboard
            </a>
            
            <a href="<?php echo $is_approved ? 'products/index.php' : 'register.php'; ?>" class="nav-link <?php echo !$is_approved ? 'opacity-50' : ''; ?>">
                <i data-lucide="package" class="w-5 h-5"></i> Products
                <?php if(!$is_approved): ?><i data-lucide="lock" class="w-3 h-3 ml-auto opacity-40"></i><?php endif; ?>
            </a>
            
            <a href="<?php echo $is_approved ? '#' : 'register.php'; ?>" class="nav-link <?php echo !$is_approved ? 'opacity-50' : ''; ?>">
                <i data-lucide="shopping-cart" class="w-5 h-5"></i> Orders
                <?php if(!$is_approved): ?><i data-lucide="lock" class="w-3 h-3 ml-auto opacity-40"></i><?php endif; ?>
            </a>

            <a href="<?php echo $is_approved ? '#' : 'register.php'; ?>" class="nav-link <?php echo !$is_approved ? 'opacity-50' : ''; ?>">
                <i data-lucide="bar-chart-3" class="w-5 h-5"></i> Analytics
                <?php if(!$is_approved): ?><i data-lucide="lock" class="w-3 h-3 ml-auto opacity-40"></i><?php endif; ?>
            </a>

            <a href="<?php echo $is_registered ? 'kyc.php' : 'register.php'; ?>" class="nav-link <?php echo !$is_registered ? 'opacity-50' : ''; ?>">
                <i data-lucide="shield-check" class="w-5 h-5"></i> KYC Status
                <?php if(!$is_registered): ?><i data-lucide="lock" class="w-3 h-3 ml-auto opacity-40"></i><?php endif; ?>
            </a>

            <a href="<?php echo $is_registered ? '#' : 'register.php'; ?>" class="nav-link <?php echo !$is_registered ? 'opacity-50' : ''; ?>">
                <i data-lucide="message-square" class="w-5 h-5"></i> Messages
                <?php if(!$is_registered): ?><i data-lucide="lock" class="w-3 h-3 ml-auto opacity-40"></i><?php endif; ?>
            </a>

            <a href="<?php echo $is_registered ? '#' : 'register.php'; ?>" class="nav-link <?php echo !$is_registered ? 'opacity-50' : ''; ?>">
                <i data-lucide="settings" class="w-5 h-5"></i> Settings
                <?php if(!$is_registered): ?><i data-lucide="lock" class="w-3 h-3 ml-auto opacity-40"></i><?php endif; ?>
            </a>
        </nav>

        <div class="absolute bottom-0 w-full p-8 space-y-4">
            <!-- State Toggle (Demo Only - Remove in Production) -->
            <div class="p-4 bg-white/5 rounded-2xl border border-white/10">
                <p class="text-[8px] font-black text-slate-500 uppercase tracking-widest mb-3 text-center italic">Preview Mode</p>
                <div class="grid grid-cols-3 gap-1.5">
                    <a href="dashboard.php?mode=logout" class="px-2 py-2 text-center text-[7px] font-black uppercase rounded-lg <?php echo $mode=='unregistered' ? 'bg-primary text-black' : 'bg-slate-800 text-slate-400'; ?>">Guest</a>
                    <a href="dashboard.php?mode=pending" class="px-2 py-2 text-center text-[7px] font-black uppercase rounded-lg <?php echo $mode=='pending' ? 'bg-primary text-black' : 'bg-slate-800 text-slate-400'; ?>">Review</a>
                    <a href="dashboard.php?mode=approved" class="px-2 py-2 text-center text-[7px] font-black uppercase rounded-lg <?php echo $mode=='approved' ? 'bg-primary text-black' : 'bg-slate-800 text-slate-400'; ?>">Active</a>
                </div>
            </div>

            <a href="<?php echo $base_url; ?>vendor/dashboard.php?mode=logout" class="flex items-center gap-4 text-[10px] font-black uppercase tracking-widest text-red-400 hover:text-red-300 transition-colors group">
                <i data-lucide="log-out" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i> Exit Dashboard
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 min-h-screen bg-slate-50 lg:ml-72 relative overflow-y-auto">
        
        <!-- Header -->
        <header class="sticky top-0 bg-white/90 backdrop-blur-xl border-b border-slate-100 px-8 py-6 flex justify-between items-center z-40">
            <div>
                <h1 class="text-xl font-black text-black uppercase tracking-tight">Merchant Hub</h1>
            </div>
            
            <div class="flex items-center gap-6">
                <!-- Status Badge -->
                <?php if($mode == 'unregistered'): ?>
                    <span class="hidden sm:flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-slate-200">
                        <span class="w-2 h-2 bg-slate-400 rounded-full"></span> Not Registered
                    </span>
                <?php elseif($mode == 'pending'): ?>
                    <span class="hidden sm:flex items-center gap-2 px-4 py-2 bg-orange-50 text-orange-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-orange-100">
                        <span class="w-2 h-2 bg-orange-400 rounded-full animate-pulse"></span> KYC Pending Verification
                    </span>
                <?php else: ?>
                    <span class="hidden sm:flex items-center gap-2 px-4 py-2 bg-green-50 text-green-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-green-100">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span> Verified Merchant
                    </span>
                <?php endif; ?>

                <?php if($is_registered): ?>
                <div class="flex items-center gap-4 pl-6 border-l border-slate-100">
                    <div class="w-10 h-10 rounded-2xl bg-slate-900 flex items-center justify-center text-primary font-black uppercase italic">LE</div>
                    <div class="hidden md:block">
                        <p class="text-[10px] font-black text-black uppercase">Lumi Energy Ltd</p>
                        <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest">Global Merchant #4402</p>
                    </div>
                </div>
                <?php else: ?>
                <a href="register.php" class="flex items-center gap-2 px-5 py-2.5 bg-primary text-black font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-slate-900 hover:text-primary transition-all">
                    <i data-lucide="user-plus" class="w-4 h-4"></i> Register Now
                </a>
                <?php endif; ?>
            </div>
        </header>

        <!-- Main Body -->
        <div class="p-8 space-y-10">
            
            <?php if($mode == 'unregistered'): ?>
                <!-- Registration CTA Banner -->
                <div class="bg-slate-900 p-10 rounded-4xl text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-96 h-96 bg-primary/20 rounded-full blur-3xl -mr-48 -mt-48"></div>
                    <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-2xl -ml-32 -mb-32"></div>
                    <div class="max-w-2xl relative z-10">
                        <span class="inline-block px-4 py-1.5 bg-primary/20 text-primary text-[10px] font-black uppercase tracking-[0.2em] rounded-full mb-6">Marketplace Merchant</span>
                        <h2 class="text-4xl font-black mb-4">Create Your Vendor Account</h2>
                        <p class="text-slate-400 text-lg leading-relaxed mb-8 italic">Register to unlock your Merchant Hub — manage listings, track orders, view analytics, and grow your business across East Africa.</p>
                        <div class="flex flex-wrap gap-4">
                            <a href="register.php" class="px-8 py-4 bg-primary text-black font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-white transition-all shadow-xl shadow-primary/20">
                                <i data-lucide="user-plus" class="w-4 h-4 inline mr-2"></i> Register as Vendor
                            </a>
                            <a href="<?php echo $base_url; ?>auth" class="px-8 py-4 border border-white/20 text-white font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-white/5 transition-all">
                                Already have an account? Sign In
                            </a>
                        </div>
                    </div>
                </div>
            <?php elseif($mode == 'pending'): ?>
                <!-- Pending Banner -->
                <div class="bg-slate-900 p-10 rounded-4xl text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-96 h-96 bg-primary/20 rounded-full blur-3xl -mr-48 -mt-48"></div>
                    <div class="max-w-2xl relative z-10">
                        <h2 class="text-4xl font-black mb-4">Account Restricted</h2>
                        <p class="text-slate-400 text-lg leading-relaxed mb-8 italic">"Your KYC documents are currently under review. Once approved by an administrator, product management and marketplace publishing will become available."</p>
                        <div class="flex flex-wrap gap-4">
                            <a href="kyc.php" class="px-8 py-4 bg-primary text-black font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-white transition-all">
                                Update KYC Documents
                            </a>
                            <button class="px-8 py-4 border border-white/20 text-white font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-white/5 transition-all">
                                Request Priority Review
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Analytics / Widgets -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
                <!-- Stat Card 1 -->
                <div class="stat-card">
                    <?php if($mode != 'approved'): ?>
                        <div class="lock-overlay"><i data-lucide="lock" class="w-6 h-6 text-slate-300"></i></div>
                    <?php endif; ?>
                    <h3 class="text-slate-400 font-bold text-[10px] uppercase tracking-widest mb-4">Marketplace Views</h3>
                    <div class="flex items-end justify-between">
                        <span class="text-4xl font-black text-black">12.4K</span>
                        <span class="text-green-500 font-black text-[10px] bg-green-50 px-2 py-1 rounded-lg">+14.2%</span>
                    </div>
                </div>

                <!-- Stat Card 2 -->
                <div class="stat-card">
                    <?php if($mode != 'approved'): ?>
                        <div class="lock-overlay"><i data-lucide="lock" class="w-6 h-6 text-slate-300"></i></div>
                    <?php endif; ?>
                    <h3 class="text-slate-400 font-bold text-[10px] uppercase tracking-widest mb-4">Pending Orders</h3>
                    <div class="flex items-end justify-between">
                        <span class="text-4xl font-black text-black">08</span>
                        <span class="text-blue-500 font-black text-[10px] bg-blue-50 px-2 py-1 rounded-lg">Active</span>
                    </div>
                </div>

                <!-- Stat Card 3 -->
                <div class="stat-card">
                    <?php if($mode != 'approved'): ?>
                        <div class="lock-overlay"><i data-lucide="lock" class="w-6 h-6 text-slate-300"></i></div>
                    <?php endif; ?>
                    <h3 class="text-slate-400 font-bold text-[10px] uppercase tracking-widest mb-4">Total Revenue</h3>
                    <div class="flex items-end justify-between">
                        <span class="text-4xl font-black text-black">1.2M</span>
                        <span class="text-slate-400 font-black text-[10px] bg-slate-50 px-2 py-1 rounded-lg">KES</span>
                    </div>
                </div>

                <!-- Stat Card 4 -->
                <div class="stat-card">
                    <?php if($mode != 'approved'): ?>
                        <div class="lock-overlay"><i data-lucide="lock" class="w-6 h-6 text-slate-300"></i></div>
                    <?php endif; ?>
                    <h3 class="text-slate-400 font-bold text-[10px] uppercase tracking-widest mb-4">Product Health</h3>
                    <div class="flex items-end justify-between">
                        <span class="text-4xl font-black text-black">98%</span>
                        <span class="text-primary font-black text-[10px] bg-primary/10 px-2 py-1 rounded-lg uppercase">Optimized</span>
                    </div>
                </div>
            </div>

            <!-- Charts and Tables Area -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-10">
                <!-- Large Section -->
                <div class="xl:col-span-2 space-y-10">
                    <!-- Recent Activity -->
                    <div class="space-y-6 relative">
                        <?php if($mode != 'approved'): ?>
                            <div class="lock-overlay"><i data-lucide="lock" class="w-8 h-8 text-slate-300"></i></div>
                        <?php endif; ?>
                         <div class="flex justify-between items-center">
                             <h3 class="text-xl font-black text-black uppercase tracking-tight">Recent Activity</h3>
                         </div>
                         <div class="bg-white rounded-4xl border border-slate-100 overflow-hidden shadow-sm">
                             <div class="divide-y divide-slate-100">
                                 <?php 
                                 $activities = [
                                     ["icon" => "tag", "title" => "New Product Published", "time" => "2 hours ago", "desc" => "Lumi Power Panel 450W is now visible in the marketplace."],
                                     ["icon" => "shopping-cart", "title" => "New Order Received", "time" => "5 hours ago", "desc" => "Customer #2839 purchased 10 units of Battery Inverter."],
                                     ["icon" => "star", "title" => "5 Star Review Received", "time" => "1 day ago", "desc" => "Exceptional service and product quality by GreatLakes Solars."]
                                 ];
                                 foreach($activities as $act):
                                 ?>
                                 <div class="p-6 flex gap-6">
                                     <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center shrink-0">
                                         <i data-lucide="<?php echo $act['icon']; ?>" class="w-5 h-5 text-slate-400"></i>
                                     </div>
                                     <div class="space-y-1">
                                         <h4 class="font-black text-sm text-black"><?php echo $act['title']; ?></h4>
                                         <p class="text-[10px] text-slate-400 font-medium uppercase tracking-widest mb-1"><?php echo $act['time']; ?></p>
                                         <p class="text-xs text-slate-500"><?php echo $act['desc']; ?></p>
                                     </div>
                                 </div>
                                 <?php endforeach; ?>
                             </div>
                         </div>
                    </div>

                    <!-- Products Grid Preview -->
                    <div class="space-y-6 relative">
                        <?php if($mode != 'approved'): ?>
                            <div class="lock-overlay"><i data-lucide="lock" class="w-8 h-8 text-slate-300"></i></div>
                        <?php endif; ?>
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-black text-black uppercase tracking-tight">Managed Products</h3>
                            <a href="<?php echo $is_approved ? 'products/index.php' : 'register.php'; ?>" class="text-[10px] font-black text-primary uppercase tracking-widest">Manage All</a>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php 
                            $demo_imgs = ["LP-SOL-450", "BAT-GEL-200"];
                            for($i=0; $i<2; $i++): 
                                $pname = ($i == 0) ? "Solar Panel Max Gen 450W" : "Gel Deep Cycle Battery 200Ah";
                            ?>
                            <div class="bg-white p-6 rounded-4xl border border-slate-100 flex gap-6 hover:shadow-xl transition-all cursor-pointer group">
                                <div class="w-24 h-24 bg-slate-50 rounded-3xl flex items-center justify-center object-contain border border-slate-50 overflow-hidden relative">
                                    <div class="absolute inset-0 bg-primary/5 group-hover:scale-110 transition-transform"></div>
                                    <i data-lucide="package" class="w-10 h-10 text-primary opacity-20"></i>
                                </div>
                                <div class="flex flex-col justify-center gap-1.5">
                                    <span class="text-[8px] font-black uppercase text-green-500 bg-green-50 px-2 py-0.5 rounded-full w-fit">Live in Market</span>
                                    <h4 class="font-black text-black text-sm"><?php echo $pname; ?></h4>
                                    <p class="text-lg font-black text-black tracking-tight">KSh <?php echo ($i==0)?"45,000":"32,500"; ?></p>
                                </div>
                            </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar Widgets -->
                <div class="space-y-10">
                    <!-- Marketplace Insights -->
                    <div class="bg-slate-950 p-8 rounded-4xl text-white relative overflow-hidden">
                        <?php if($mode != 'approved'): ?>
                            <div class="lock-overlay bg-black/40"><i data-lucide="lock" class="w-8 h-8 text-white/20"></i></div>
                        <?php endif; ?>
                        <h4 class="text-xs font-black uppercase tracking-widest text-primary mb-6">Marketplace Insights</h4>
                        <div class="space-y-6">
                            <div>
                                <div class="flex justify-between text-[10px] font-black uppercase mb-3">
                                    <span class="text-slate-400">Profile Engagement</span>
                                    <span>84%</span>
                                </div>
                                <div class="w-full h-1 bg-white/5 rounded-full overflow-hidden">
                                    <div class="w-[84%] h-full bg-primary"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-[10px] font-black uppercase mb-3">
                                    <span class="text-slate-400">Order Growth</span>
                                    <span class="text-primary">+12%</span>
                                </div>
                                <div class="flex gap-1 h-12 items-end">
                                    <div class="flex-1 bg-white/10 rounded-t-sm h-[40%]"></div>
                                    <div class="flex-1 bg-white/10 rounded-t-sm h-[60%]"></div>
                                    <div class="flex-1 bg-white/10 rounded-t-sm h-[50%]"></div>
                                    <div class="flex-1 bg-primary rounded-t-sm h-[90%]"></div>
                                    <div class="flex-1 bg-white/10 rounded-t-sm h-full"></div>
                                </div>
                            </div>
                        </div>
                        <button class="w-full mt-8 py-4 bg-white/5 border border-white/10 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-white/10 transition-colors">
                            Full Analytics Report
                        </button>
                    </div>

                    <!-- Enquiries -->
                    <div class="bg-white p-8 rounded-4xl border border-slate-100 shadow-sm relative overflow-hidden">
                         <?php if($mode != 'approved'): ?>
                            <div class="lock-overlay"><i data-lucide="lock" class="w-8 h-8 text-slate-300"></i></div>
                         <?php endif; ?>
                         <h4 class="text-xs font-black uppercase tracking-widest text-black mb-6">Customer Enquiries</h4>
                         <div class="space-y-6">
                             <div class="flex gap-4 p-4 bg-slate-50 rounded-2xl border border-transparent hover:border-primary/20 transition-all cursor-pointer">
                                 <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center font-black text-xs border border-slate-100 shrink-0">AK</div>
                                 <div class="space-y-1">
                                     <p class="text-[11px] font-black text-black">Amina Kamau</p>
                                     <p class="text-[9px] text-slate-500 line-clamp-1 italic">"Do you offer installation services for..."</p>
                                 </div>
                             </div>
                             <div class="flex gap-4 p-4 bg-slate-50 rounded-2xl border border-transparent hover:border-primary/20 transition-all cursor-pointer">
                                 <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center font-black text-xs border border-slate-100 shrink-0">OM</div>
                                 <div class="space-y-1">
                                     <p class="text-[11px] font-black text-black">Otieno Mark</p>
                                     <p class="text-[9px] text-slate-500 line-clamp-1 italic">"I'm interested in wholesale pricing for..."</p>
                                 </div>
                             </div>
                         </div>
                    </div>
                </div>
            </div>

        </div>

        <?php if($mode != 'approved'): ?>
            <!-- Floating Banner to remind user -->
            <div class="fixed bottom-10 left-1/2 -translate-x-1/2 z-50 animate-bounce">
                <div class="bg-primary text-black px-8 py-4 rounded-full font-black uppercase text-[10px] tracking-widest shadow-2xl flex items-center gap-3">
                    <?php if($mode == 'unregistered'): ?>
                    <i data-lucide="user-plus" class="w-4 h-4"></i> 
                    <a href="register.php" class="hover:underline">Register to Unlock Full Access</a>
                    <?php else: ?>
                    <i data-lucide="lock" class="w-4 h-4"></i> Account Restricted - Under Review
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

    </main>
</div>

<script>
    lucide.createIcons();
    
    // Simple state indicator for demonstration
    if(window.location.search.includes('mode=approved')) {
         console.log("Approved Mode Active");
    }
</script>

<?php include_once '../includes/footer.php'; ?>
