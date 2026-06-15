<?php 
$base_url = "../";
$active_page = "policy";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/head.php'; ?>
    <title>Policy & Advocacy | KEREA Peak Body</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <section class="bg-[#112a1d] pt-32 pb-48 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=1600&q=80')] bg-cover bg-center"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="max-w-3xl">
                    <span class="text-accent font-black text-[10px] uppercase tracking-[0.2em] block mb-6">Legislative Influence</span>
                    <h1 class="text-4xl sm:text-6xl font-black text-white leading-tight mb-8">
                        Championing an <span class="text-gradient">Enabling Regulatory</span> Environment
                    </h1>
                    <p class="text-emerald-100/60 text-lg sm:text-xl leading-relaxed font-medium">
                        KEREA is the strategic bridge for public-private dialogue, ensuring that renewable energy policies in Kenya are data-driven, inclusive, and industrially scalable.
                    </p>
                </div>
            </div>
        </section>

        <!-- Briefs Grid -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-20 mb-24">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Brief 1 -->
                <div class="bg-white p-10 rounded-4xl shadow-2xl border border-slate-100 space-y-6 group hover:-translate-y-2 transition-all">
                    <div class="w-12 h-12 bg-primary rounded-2xl flex items-center justify-center text-accent group-hover:rotate-6 transition-transform shadow-lg"><i data-lucide="file-text" class="w-6 h-6"></i></div>
                    <div class="space-y-4">
                        <span class="text-[9px] font-black uppercase tracking-widest text-emerald-600">June 2026</span>
                        <h3 class="text-xl font-black text-primary">Grid-Tie & Net Metering Update</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">Analyzing the latest EPRA guidelines for small-scale solar exporters. Key focus on compensation rates and safety verification protocols.</p>
                    </div>
                    <a href="#" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-wider text-primary hover:text-accent transition">Download PDF <i data-lucide="download" class="w-4 h-4"></i></a>
                </div>

                <!-- Brief 2 -->
                <div class="bg-white p-10 rounded-4xl shadow-2xl border border-slate-100 space-y-6 group hover:-translate-y-2 transition-all">
                    <div class="w-12 h-12 bg-primary rounded-2xl flex items-center justify-center text-accent group-hover:rotate-6 transition-transform shadow-lg"><i data-lucide="gavel" class="w-6 h-6"></i></div>
                    <div class="space-y-4">
                        <span class="text-[9px] font-black uppercase tracking-widest text-emerald-600">May 2026</span>
                        <h3 class="text-xl font-black text-primary">KRA Solar Tax Exemptions</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">Position paper on the retention of VAT exemptions for deep-cycle batteries and specialized solar water pumping components.</p>
                    </div>
                    <a href="#" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-wider text-primary hover:text-accent transition">View Position <i data-lucide="external-link" class="w-4 h-4"></i></a>
                </div>

                <!-- Brief 3 -->
                <div class="bg-white p-10 rounded-4xl shadow-2xl border border-slate-100 space-y-6 group hover:-translate-y-2 transition-all">
                    <div class="w-12 h-12 bg-primary rounded-2xl flex items-center justify-center text-accent group-hover:rotate-6 transition-transform shadow-lg"><i data-lucide="landmark" class="w-6 h-6"></i></div>
                    <div class="space-y-4">
                        <span class="text-[9px] font-black uppercase tracking-widest text-emerald-600">April 2026</span>
                        <h3 class="text-xl font-black text-primary">Clean Cooking Strategy 2028</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">Detailed analysis of the National Clean Cooking Strategy and its implications for SME manufacturers and tech distributors.</p>
                    </div>
                    <a href="#" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-wider text-primary hover:text-accent transition">Download Brief <i data-lucide="download" class="w-4 h-4"></i></a>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
            <div class="bg-slate-50 rounded-4xl p-12 sm:p-20 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center border border-slate-200">
                <div class="space-y-8">
                    <h2 class="text-3xl sm:text-5xl font-black text-primary tracking-tight leading-tight">Contribute to the <br>National Dialogue</h2>
                    <p class="text-slate-500 text-base leading-relaxed font-medium">As a KEREA member, you have a direct seat at the table. Our technical sub-committees regularly review guidelines that impact your operations.</p>
                    <a href="../contact/" class="px-8 py-4 bg-primary text-white font-black rounded-2xl text-xs uppercase tracking-widest inline-block hover:shadow-xl transition-all">Join a Committee</a>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-8 bg-white rounded-3xl border border-slate-100 flex flex-col items-center text-center space-y-4">
                        <span class="text-3xl font-black text-accent tracking-tighter">15+</span>
                        <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">Position Papers 2025</span>
                    </div>
                    <div class="p-8 bg-white rounded-3xl border border-slate-100 flex flex-col items-center text-center space-y-4">
                        <span class="text-3xl font-black text-accent tracking-tighter">100%</span>
                        <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">Commitment to Sector</span>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
