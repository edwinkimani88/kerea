<?php
$active_page = "membership_renewal";
$base_url = "../../";
include_once '../../includes/head.php';
?>
<title>Renew Membership | KEREA</title>

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
    .renewal-card {
        @apply bg-white p-8 md:p-12 rounded-4xl border border-slate-100 shadow-xl;
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
            <a href="renewal.php" class="nav-link active">
                <i data-lucide="refresh-cw" class="w-5 h-5"></i> Renewal
            </a>
            <a href="resources.php" class="nav-link">
                <i data-lucide="library" class="w-5 h-5"></i> Resources
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 h-screen overflow-y-auto bg-slate-50 lg:ml-72 custom-scrollbar">
        <header class="bg-white border-b border-slate-100 px-8 py-6">
            <h1 class="text-xl font-black text-black uppercase tracking-tight">Membership Renewal</h1>
        </header>

        <div class="p-8">
            <div class="max-w-4xl mx-auto">
                
                <div id="renewal-form" class="renewal-card relative">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <!-- Details -->
                        <div class="space-y-8">
                            <div>
                                <h2 class="text-3xl font-black text-black mb-4">Renew Your Engagement</h2>
                                <p class="text-slate-500 leading-relaxed">Maintain your exclusive access to the KEREA marketplace, policy advocacy boards, and global networking events.</p>
                            </div>

                            <div class="space-y-4 pt-6 border-t border-slate-50">
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Current Tier</span>
                                    <span class="text-sm font-black text-black">Corporate</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Renewal Date</span>
                                    <span class="text-sm font-black text-black">31 Dec 2024</span>
                                </div>
                                <div class="flex items-center justify-between border-t border-slate-100 pt-4">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Renewal Fee</span>
                                    <span class="text-2xl font-black text-primary">KES 50,000</span>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <h3 class="text-[10px] font-black uppercase tracking-widest text-black">Checklist for 2025</h3>
                                <div class="space-y-3">
                                    <label class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl cursor-pointer hover:bg-slate-100 transition-all">
                                        <input type="checkbox" checked disabled class="w-4 h-4 accent-primary">
                                        <span class="text-[11px] font-medium text-slate-700">Valid Certificate of Incorporation</span>
                                    </label>
                                    <label class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl cursor-pointer hover:bg-slate-100 transition-all">
                                        <input type="checkbox" checked disabled class="w-4 h-4 accent-primary">
                                        <span class="text-[11px] font-medium text-slate-700">Updated Company Profile</span>
                                    </label>
                                    <label class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl cursor-pointer hover:bg-slate-100 transition-all">
                                        <input type="checkbox" checked disabled class="w-4 h-4 accent-primary">
                                        <span class="text-[11px] font-medium text-slate-700">Valid Tax Compliance</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Action -->
                        <div class="bg-slate-50 p-8 rounded-4xl border border-slate-200/50 flex flex-col justify-between">
                            <div class="space-y-6">
                                <div class="p-6 bg-white rounded-3xl text-center">
                                    <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                        <i data-lucide="credit-card" class="w-8 h-8 text-primary"></i>
                                    </div>
                                    <h4 class="font-black text-black uppercase tracking-tight">Fast Payment</h4>
                                    <p class="text-[10px] text-slate-400 uppercase tracking-widest mt-1">Processed securely via DPO Group</p>
                                </div>
                                <div class="space-y-4">
                                    <button onclick="simulateRenewal()" id="renew-cta" class="w-full py-5 bg-black text-white font-black uppercase text-xs tracking-[0.2em] rounded-2xl hover:bg-primary hover:text-black transition-all shadow-xl shadow-black/10 flex items-center justify-center gap-3">
                                        Proceed to Payment
                                    </button>
                                    <p class="text-[9px] text-center text-slate-400 leading-relaxed font-medium uppercase px-4">
                                        By clicking proceed, you will be redirected to our secure payment gateway to complete your transaction.
                                    </p>
                                </div>
                            </div>
                            <div class="mt-8 flex items-center justify-center gap-6 opacity-30 grayscale scale-75">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/2560px-Visa_Inc._logo.svg.png" class="h-4 w-auto">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png" class="h-6 w-auto">
                                <img src="https://mpesa.co.ke/wp-content/uploads/2021/04/M-PESA-LOGO-1.png" class="h-8 w-auto">
                            </div>
                        </div>
                    </div>

                    <!-- Overlay for Success -->
                    <div id="renewal-success" class="hidden absolute inset-0 bg-white rounded-4xl z-20 flex flex-col items-center justify-center text-center p-12">
                        <div class="w-24 h-24 bg-green-500 rounded-full flex items-center justify-center mb-8 shadow-2xl shadow-green-500/30">
                            <i data-lucide="check" class="w-12 h-12 text-white"></i>
                        </div>
                        <h2 class="text-4xl font-black text-black mb-4">Renewal Confirmed!</h2>
                        <p class="text-slate-500 mb-10 max-w-sm">Thank you for your continued support. Your membership has been extended to 31 December 2025. Your receipt is now available for download.</p>
                        <div class="flex flex-wrap gap-4 justify-center">
                            <a href="#" class="px-8 py-4 bg-slate-100 text-black font-black uppercase text-xs tracking-widest rounded-2xl hover:bg-slate-200 transition-all flex items-center gap-2">
                                <i data-lucide="file-text" class="w-4 h-4"></i> Receipt
                            </a>
                            <a href="index.php" class="px-8 py-4 bg-black text-white font-black uppercase text-xs tracking-widest rounded-2xl hover:bg-primary hover:text-black transition-all">
                                Back to Dashboard
                            </a>
                        </div>
                    </div>

                    <!-- Processing State -->
                    <div id="renewal-loading" class="hidden absolute inset-0 bg-white/80 backdrop-blur-sm rounded-4xl z-10 flex flex-col items-center justify-center text-center p-12">
                        <div class="w-16 h-16 border-4 border-primary border-t-transparent rounded-full animate-spin mb-6"></div>
                        <h3 class="text-xl font-black text-black uppercase tracking-tight">Processing Payment...</h3>
                        <p class="text-sm text-slate-500">Please do not refresh the page.</p>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

<script>
    function simulateRenewal() {
        const loading = document.getElementById('renewal-loading');
        const success = document.getElementById('renewal-success');
        
        loading.classList.remove('hidden');
        
        setTimeout(() => {
            loading.classList.add('hidden');
            success.classList.remove('hidden');
            lucide.createIcons();
        }, 3000);
    }
    lucide.createIcons();
</script>

<?php include_once '../../includes/footer.php'; ?>
