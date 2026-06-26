<?php
$active_page = "vendor_account";
$base_url = "../";
session_start();
// After form submit, set session and redirect to dashboard (pending state)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['vendor_registered'] = true;
    $_SESSION['vendor_approved'] = false;
    header('Location: dashboard.php');
    exit;
}
include_once '../includes/head.php';
?>
<title>Vendor Registration | KEREA Marketplace</title>

<?php include_once '../includes/header.php'; ?>

<main class="bg-slate-900 min-h-screen py-24 relative overflow-hidden">
    <!-- Background Decor -->
    <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-primary/10 rounded-full blur-[150px] -mr-[400px] -mt-[400px]"></div>
    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-accent/5 rounded-full blur-[120px] -ml-[300px] -mb-[300px]"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-xl mx-auto">
            <div class="text-center mb-12">
                <span class="inline-block px-4 py-1.5 bg-primary/20 text-primary text-[10px] font-black uppercase tracking-[0.2em] rounded-full mb-6">Marketplace Merchant</span>
                <h1 class="text-4xl font-black text-white mb-4">Launch Your Store</h1>
                <p class="text-slate-400">Join the largest renewable energy marketplace in East Africa.</p>
            </div>

            <div class="bg-white/5 backdrop-blur-xl p-10 rounded-4xl border border-white/10 shadow-2xl">
                <form class="space-y-6" method="post" action="register.php">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Business Name</label>
                            <input type="text" placeholder="Lumi Energy" required class="w-full px-5 py-4 bg-white/5 border border-white/10 rounded-2xl text-white focus:ring-2 focus:ring-primary focus:bg-white/10 outline-none transition-all placeholder:text-white/20">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Company PIN</label>
                            <input type="text" placeholder="P051XXXXXX" required class="w-full px-5 py-4 bg-white/5 border border-white/10 rounded-2xl text-white focus:ring-2 focus:ring-primary focus:bg-white/10 outline-none transition-all placeholder:text-white/20">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Merchant Email</label>
                        <input type="email" placeholder="merchant@business.com" required class="w-full px-5 py-4 bg-white/5 border border-white/10 rounded-2xl text-white focus:ring-2 focus:ring-primary focus:bg-white/10 outline-none transition-all placeholder:text-white/20">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Password</label>
                        <input type="password" placeholder="••••••••" required class="w-full px-5 py-4 bg-white/5 border border-white/10 rounded-2xl text-white focus:ring-2 focus:ring-primary focus:bg-white/10 outline-none transition-all placeholder:text-white/20">
                    </div>

                    <div class="flex items-center gap-4 py-4">
                        <input type="checkbox" required class="w-5 h-5 accent-primary bg-white/5 border-white/10 rounded">
                        <p class="text-[11px] text-slate-400 leading-normal">I agree to the <a href="#" class="text-primary hover:underline">Seller Terms of Service</a> and KEREA's marketplace quality standards.</p>
                    </div>

                    <button type="submit" class="w-full py-5 bg-primary text-black font-black uppercase text-xs tracking-[0.2em] rounded-2xl hover:bg-white transition-all shadow-xl shadow-primary/20">
                        Create Vendor Account
                    </button>
                </form>

                <div class="mt-10 pt-10 border-t border-white/5 text-center">
                    <p class="text-xs text-slate-500">Already a vendor? <a href="<?php echo $base_url; ?>auth/" class="text-white hover:text-primary transition-colors font-bold ml-1">Sign In to Dashboard</a></p>
                </div>
            </div>
            
            <div class="mt-12 grid grid-cols-3 gap-4 text-center opacity-40 grayscale">
                <div class="space-y-2">
                    <div class="text-white font-black text-xl">500+</div>
                    <div class="text-[8px] font-black uppercase tracking-widest text-slate-400">Active Vendors</div>
                </div>
                <div class="space-y-2 border-x border-white/10">
                    <div class="text-white font-black text-xl">10K+</div>
                    <div class="text-[8px] font-black uppercase tracking-widest text-slate-400">Monthly Enquiries</div>
                </div>
                <div class="space-y-2">
                    <div class="text-white font-black text-xl">KES 1B+</div>
                    <div class="text-[8px] font-black uppercase tracking-widest text-slate-400">Gross Sales</div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once '../includes/footer.php'; ?>
