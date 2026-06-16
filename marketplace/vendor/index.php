<?php 
$base_url = "../../";
$active_page = "marketplace";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../../includes/head.php'; ?>
    <title>Verified Vendor Directory | KEREA Marketplace</title>
</head>
<body>
    <?php include '../../includes/header.php'; ?>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-16">
        <!-- Hero -->
        <section class="reveal-on-scroll border-b border-slate-100 pb-12">
            <span class="text-[10px] uppercase font-black text-primary tracking-[0.4em] block mb-4">SME Ecosystem</span>
            <h1 class="text-5xl font-black text-black tracking-tight mb-6">Kerea Verified Manufacturers & Distributors</h1>
            <p class="text-lg text-slate-500 max-w-2xl font-medium leading-relaxed">
                Connect directly with certified energy technology providers. All vendors listed here have undergone KEREA's compliance and standards verification process.
            </p>
        </section>

        <!-- Vendor List -->
        <section class="stagger-reveal grid grid-cols-1 md:grid-cols-2 gap-10">
            <?php 
            include '../vendor_data.php';
            foreach($vendors as $slug => $v):
            ?>
            <div class="p-10 bg-white border border-slate-100 rounded-4xl shadow-sm hover:shadow-2xl hover:border-primary/20 transition-all flex flex-col sm:flex-row gap-8 items-start group">
                <div class="w-20 h-20 rounded-3xl bg-slate-50 flex items-center justify-center text-5xl shrink-0 shadow-inner group-hover:bg-black group-hover:text-primary transition-all">
                    <?php echo $v['icon']; ?>
                </div>
                <div class="space-y-5 flex-1">
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <span class="text-[9px] px-3 py-1 rounded bg-black text-primary font-black uppercase tracking-widest">Verified Tier 1</span>
                            <?php if(isset($v['verified']) && $v['verified']): ?>
                            <span class="text-[9px] text-emerald-600 font-bold uppercase tracking-widest flex items-center gap-1"><i data-lucide="check-circle" class="w-3 h-3"></i> Compliant</span>
                            <?php endif; ?>
                        </div>
                        <h3 class="text-2xl font-black text-black"><?php echo $v['name']; ?></h3>
                        <p class="text-[11px] text-slate-400 flex items-center gap-2 font-black uppercase tracking-widest">
                            <i data-lucide="map-pin" class="w-4 h-4 text-primary"></i> <?php echo $v['location'] ?? 'National Coverage'; ?>
                        </p>
                    </div>
                    <p class="text-xs text-slate-500 font-bold leading-relaxed"><?php echo $v['specialization']; ?></p>
                    <div class="flex justify-between items-center pt-8 border-t border-slate-50">
                        <div class="flex items-center gap-1">
                            <i data-lucide="star" class="w-4 h-4 fill-primary text-primary"></i>
                            <span class="text-xs text-black font-black">Official Partner</span>
                        </div>
                        <a href="view.php?id=<?php echo $slug; ?>" class="text-[10px] font-black text-black hover:text-primary transition-colors flex items-center gap-1 uppercase tracking-widest">
                            View Profile <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </section>

        <!-- Partner Banner -->
        <section class="bg-black rounded-[3rem] p-12 text-center text-white">
            <h2 class="text-3xl font-black mb-6">Become a Verified Vendor</h2>
            <p class="text-slate-400 max-w-xl mx-auto mb-10 font-bold">List your clean energy hardware on Kenya's largest institutional procurement gateway and gain access to thousands of verified buyers.</p>
            <a href="../../contact/" class="inline-block px-10 py-5 bg-primary text-black font-black uppercase tracking-widest text-xs rounded-2xl hover:bg-white transition">Apply for Membership</a>
        </section>
    </main>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>
