<?php 
$base_url = "../../";
$active_page = "marketplace";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../../includes/head.php'; ?>
    <title>Steward Directory | KEREA Marketplace</title>
</head>
<body class="bg-[#fcfcfc]">
    <?php include '../../includes/header.php'; ?>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-20">
        <!-- Hero -->
        <section class="reveal-on-scroll flex flex-col md:flex-row justify-between items-end gap-10 border-b-4 border-slate-100 pb-20">
            <div class="space-y-6 max-w-3xl">
                <span class="text-primary font-black text-[11px] uppercase tracking-[0.5em] block">Certified SME Ecosystem</span>
                <h1 class="text-6xl sm:text-7xl font-black text-slate-900 tracking-tighter leading-none italic uppercase">Steward Directory.</h1>
                <p class="text-xl text-slate-500 font-bold leading-relaxed max-w-2xl">
                    Connect directly with compliant energy technology providers. Every organization listed here is a verified KEREA member in good standing.
                </p>
            </div>
             <div class="flex gap-4">
                <div class="px-8 py-6 bg-white border border-slate-100 rounded-3xl shadow-sm hidden lg:block">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Active Partners</p>
                    <h4 class="text-3xl font-black text-slate-900">42+</h4>
                </div>
            </div>
        </section>

        <!-- Vendor List -->
        <section class="stagger-reveal grid grid-cols-1 md:grid-cols-2 gap-12">
            <?php 
            include '../vendor_data.php';
            foreach($vendors as $slug => $v):
            ?>
            <div class="p-12 bg-white border border-slate-100 rounded-[3.5rem] shadow-premium hover:shadow-4xl hover:border-primary/30 transition-all duration-700 flex flex-col sm:flex-row gap-10 items-start group relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full blur-3xl -mr-10 -mt-10 group-hover:scale-150 transition-transform duration-1000"></div>
                
                <div class="w-24 h-24 rounded-[2rem] bg-slate-50 flex items-center justify-center text-5xl shrink-0 shadow-inner group-hover:bg-slate-900 group-hover:text-primary transition-all duration-500 relative z-10">
                    <?php echo $v['icon']; ?>
                </div>
                <div class="space-y-6 flex-1 relative z-10">
                    <div class="space-y-3">
                        <div class="flex items-center gap-4">
                            <span class="text-[9px] px-3 py-1.5 rounded-lg bg-slate-900 text-white font-black uppercase tracking-widest shadow-lg">Verified Tier 1</span>
                            <?php if(isset($v['verified']) && $v['verified']): ?>
                            <span class="text-[9px] text-emerald-600 font-black uppercase tracking-widest flex items-center gap-1.5"><i data-lucide="shield-check" class="w-3.5 h-3.5"></i> Compliant</span>
                            <?php endif; ?>
                        </div>
                        <h3 class="text-3xl font-black text-slate-900 group-hover:text-primary transition-colors"><?php echo $v['name']; ?></h3>
                        <p class="text-[11px] text-slate-400 flex items-center gap-2 font-black uppercase tracking-widest">
                            <i data-lucide="map-pin" class="w-4 h-4 text-primary"></i> <?php echo $v['location'] ?? 'National HQ'; ?>
                        </p>
                    </div>
                    <p class="text-sm text-slate-500 font-bold leading-relaxed"><?php echo $v['specialization']; ?></p>
                    <div class="flex justify-between items-center pt-10 border-t border-slate-50">
                        <div class="flex items-center gap-2 text-primary font-black uppercase text-[10px]">
                            <i data-lucide="award" class="w-10 h-1 bg-primary/10 rounded-full"></i>
                        </div>
                        <a href="view.php?id=<?php echo $slug; ?>" class="px-6 py-3 bg-slate-50 text-[10px] font-black text-slate-900 hover:bg-slate-900 hover:text-white transition-all rounded-xl flex items-center gap-2 uppercase tracking-widest">
                            View Profile <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </section>

        <!-- Partner Banner -->
        <section class="reveal-on-scroll relative bg-slate-900 rounded-[4rem] p-20 text-center text-white shadow-3xl overflow-hidden group">
            <div class="absolute inset-0 bg-primary/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <h2 class="text-4xl sm:text-5xl font-black mb-8 italic uppercase text-primary">Become a Verified Steward.</h2>
            <p class="text-slate-400 text-lg max-w-2xl mx-auto mb-12 font-bold leading-relaxed">Join the most prestigious network of renewable energy suppliers in East Africa and access verified institutional procurement channels.</p>
            <a href="../../contact/" class="inline-block px-12 py-6 bg-white text-black font-black uppercase tracking-[0.3em] text-xs rounded-2xl hover:bg-primary transition-all shadow-2xl">Apply for Verification</a>
        </section>
    </main>

    <?php include '../../includes/footer.php'; ?>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
             // Global animations handled in footer.php
        });
    </script>
</body>
</html>
