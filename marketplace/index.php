<?php 
$base_url = "../";
$active_page = "marketplace";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/head.php'; ?>
    <title>Renewable Marketplace | Kerea Guaranteed Compliance</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-24">
        
        <!-- 1. MARKETPLACE HERO - High Legibility -->
        <section class="reveal-on-scroll relative bg-black min-h-[550px] rounded-[3rem] overflow-hidden flex flex-col justify-center px-10 sm:px-20 py-16 text-white shadow-3xl">
            <!-- Background Image -->
            <div class="absolute right-0 top-0 bottom-0 w-full lg:w-1/2 h-full opacity-40 lg:opacity-100">
                 <img src="https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=1200&q=80" alt="Solar Hardware" class="w-full h-full object-cover">
                 <div class="absolute inset-0 bg-gradient-to-r from-black via-black/80 lg:via-black/40 to-transparent"></div>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-black via-black/60 to-transparent"></div>

            <div class="relative z-10 max-w-2xl space-y-10">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-primary/10 border border-primary/20 rounded-xl text-primary text-[10px] font-black uppercase tracking-widest backdrop-blur-sm">
                    <i data-lucide="shield-check" class="w-4 h-4 text-primary"></i>
                    EPRA Certified Hardware Gateway
                </div>
                
                <h1 class="text-6xl sm:text-7xl font-black tracking-tighter text-white leading-[1.1]">
                    Quality <br />
                    <span class="text-primary">Clean Tech</span>
                </h1>
                
                <p class="text-lg sm:text-xl text-slate-400 leading-relaxed max-w-lg font-medium">Secured procurement for verified solar subsystems, induction cookstoves, and industrial energy storage.</p>

                <form class="flex flex-col sm:flex-row gap-4 max-w-xl">
                    <div class="relative flex-1">
                        <i data-lucide="search" class="absolute left-6 top-5.5 w-5 h-5 text-slate-500"></i>
                        <input 
                            type="text" 
                            placeholder="Find certified panels, stoves, meters..." 
                            class="w-full text-sm text-white bg-white/5 border border-white/10 rounded-2xl pl-16 pr-6 py-5.5 focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white/10 transition-all font-bold placeholder-slate-500"
                        >
                    </div>
                    <button class="px-10 py-5.5 bg-primary hover:bg-primary-dark text-black font-black text-xs uppercase tracking-widest rounded-2xl transition shadow-xl shadow-primary/20">Find Gear</button>
                </form>

                <div class="flex flex-wrap items-center gap-x-10 gap-y-4 pt-10 border-t border-white/10 text-[10px] text-slate-500 font-black uppercase tracking-[0.2em]">
                    <span class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-primary"></i> Vetted Vendors</span>
                    <span class="flex items-center gap-2"><i data-lucide="lock" class="w-4 h-4 text-primary"></i> Escrow Secured</span>
                    <span class="flex items-center gap-2"><i data-lucide="package" class="w-4 h-4 text-primary"></i> OEM Warranty</span>
                </div>
            </div>
        </section>

        <!-- 2. CATEGORIES BENTO - High Contrast -->
        <section class="space-y-12">
            <div class="reveal-on-scroll flex justify-between items-end border-b border-slate-100 pb-8">
                <div class="space-y-3">
                    <span class="text-[10px] uppercase font-black text-primary tracking-[0.4em] block">Technical Matrix</span>
                    <h2 class="text-4xl font-black text-black tracking-tight">Certified Tier Equipment</h2>
                </div>
            </div>

            <div class="stagger-reveal grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
                <?php 
                $cats = [
                    ['Solar Technology', '50+ Items', 'Panels, grid-tie units, controllers', 'sun'],
                    ['Clean Cooking', '18+ Items', 'Induction tables, electric cookers', 'flame'],
                    ['Biogas Energy', '12+ Items', 'Modular PVC digesters, farm manure', 'wind'],
                    ['Energy Storage', '15+ Items', 'Lithium arrays, deep cycle packs', 'battery']
                ];
                foreach($cats as $c):
                ?>
                <div class="group p-10 bg-white border border-slate-100 rounded-4xl hover:border-primary/40 transition-all duration-500 shadow-sm hover:shadow-3xl flex flex-col justify-between h-[300px]">
                    <div class="space-y-8">
                        <div class="w-16 h-16 bg-black rounded-3xl flex items-center justify-center text-primary shadow-xl group-hover:bg-primary group-hover:text-black transition-all">
                            <i data-lucide="<?php echo $c[3]; ?>" class="w-8 h-8"></i>
                        </div>
                        <div>
                            <h3 class="font-black text-2xl text-black tracking-tight leading-none"><?php echo $c[0]; ?></h3>
                            <p class="text-[11px] text-slate-500 mt-4 leading-relaxed font-bold uppercase tracking-widest"><?php echo $c[2]; ?></p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-8 border-t border-slate-50">
                        <span class="text-[11px] font-black text-slate-400 uppercase tracking-widest"><?php echo $c[1]; ?></span>
                        <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-black group-hover:bg-primary transition-all">
                            <i data-lucide="arrow-up-right" class="w-5 h-5"></i>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- 3. TRENDING HARDWARE (RESTORED CONTENT) -->
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-8 space-y-12">
                <div class="reveal-on-scroll border-b border-slate-100 pb-8">
                    <span class="text-[10px] uppercase font-black text-primary tracking-[0.4em] block">New Inventory</span>
                    <h2 class="text-4xl font-black text-black tracking-tight">Verified Hardware Sales</h2>
                </div>

                <div class="stagger-reveal grid grid-cols-1 sm:grid-cols-3 gap-8">
                    <?php 
                    $prods = [
                        ['Solar Module 450W', 'Solar PV', 18500, 22000, 'https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=600&q=80', true],
                        ['Induction Tablet', 'E-Cooking', 28000, null, 'https://images.unsplash.com/photo-1574269603917-389f5a6550bf?auto=format&fit=crop&w=600&q=80', false],
                        ['LiFePO4 5kWh Array', 'Storage', 135000, 150000, 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?auto=format&fit=crop&w=600&q=80', true]
                    ];
                    foreach($prods as $p):
                        $discount = $p[3] ? round((($p[3] - $p[2]) / $p[3]) * 100) : null;
                    ?>
                    <div class="group bg-white border border-slate-100 rounded-4xl overflow-hidden hover:shadow-2xl transition-all duration-500">
                        <div class="relative aspect-square bg-slate-50 overflow-hidden">
                            <img src="<?php echo $p[4]; ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            <?php if($discount): ?><span class="absolute top-6 left-6 bg-red-600 text-white text-[10px] font-black uppercase px-4 py-1.5 rounded-full shadow-lg">-<?php echo $discount; ?>%</span><?php endif; ?>
                            <?php if($p[5]): ?><span class="absolute bottom-6 left-6 bg-primary text-black text-[9px] font-black uppercase px-3 py-1 rounded-lg tracking-wider border border-black/10 shadow-lg">EPRA Approved</span><?php endif; ?>
                        </div>
                        <div class="p-8 space-y-8 flex flex-col justify-between">
                            <div>
                                <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 block"><?php echo $p[1]; ?></span>
                                <h3 class="font-black text-base text-black group-hover:text-primary transition mt-2 leading-tight"><?php echo $p[0]; ?></h3>
                            </div>
                            <div class="pt-8 border-t border-slate-50 flex items-center justify-between">
                                <span class="text-lg font-black text-black leading-none">KES <?php echo number_format($p[2]); ?></span>
                                <a href="product/" class="w-12 h-12 bg-black text-white rounded-xl hover:bg-primary hover:text-black transition flex items-center justify-center shadow-lg">
                                    <i data-lucide="chevron-right" class="w-6 h-6"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Deal of the Week - Updated Spotlight -->
            <div class="lg:col-span-4 bg-black p-10 rounded-[3rem] space-y-10 relative overflow-hidden shadow-3xl border border-white/5">
                <div class="absolute -right-24 -top-24 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
                <div class="flex justify-between items-center relative z-10">
                    <span class="text-[10px] font-black uppercase tracking-widest px-5 py-2 bg-primary text-black rounded-full shadow-2xl">Bundle Deal</span>
                    <div class="flex items-center gap-2 text-xs text-primary font-black">
                        <i data-lucide="zap" class="w-4 h-4 animate-pulse"></i> STOCK LOW
                    </div>
                </div>
                <div class="space-y-4 relative z-10">
                    <h3 class="text-3xl font-black text-white leading-tight">Solar Pumping <br />Hybrid Module</h3>
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Complete borehole extraction kit.</p>
                </div>
                <div class="aspect-video bg-white/5 rounded-3xl overflow-hidden relative z-10 group border border-white/10 shadow-inner">
                    <img src="https://images.unsplash.com/photo-1548543604-a87a9989fd0f?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-opacity duration-700">
                </div>
                <div class="flex items-end gap-3 relative z-10 border-b border-white/10 pb-8">
                    <span class="text-4xl font-black text-primary leading-none">KES 45k</span>
                    <span class="text-sm text-slate-600 line-through font-bold">KES 60k</span>
                </div>
                <button class="w-full py-6 bg-white text-black hover:bg-primary font-black text-[11px] uppercase tracking-[0.3em] rounded-2xl transition duration-500 shadow-2xl relative z-10">Claim This Offer</button>
            </div>
        </section>

        <!-- 4. VETTES VENDOR DIRECTORY (RESTORED CONTENT) -->
        <section class="space-y-12">
            <div class="reveal-on-scroll flex flex-col md:flex-row justify-between items-end gap-6 border-b border-slate-100 pb-8">
                <div class="space-y-3">
                    <span class="text-[10px] uppercase font-black text-primary tracking-[0.4em] block">SME Ecosystem</span>
                    <h2 class="text-4xl font-black text-black tracking-tight">Kerea Verified Manufacturers</h2>
                </div>
                <a href="vendor/" class="px-8 py-3 bg-slate-50 hover:bg-black hover:text-white text-black font-black text-[10px] uppercase tracking-widest rounded-xl transition-all border border-slate-200">View All Partners</a>
            </div>
            <div class="stagger-reveal grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Vendor 1 -->
                <div class="p-10 bg-white border border-slate-100 rounded-4xl shadow-sm hover:shadow-2xl hover:border-primary/20 transition-all flex flex-col sm:flex-row gap-8 items-start group">
                    <div class="w-20 h-20 rounded-3xl bg-slate-50 flex items-center justify-center text-5xl shrink-0 shadow-inner group-hover:bg-black group-hover:text-primary transition-all">☀️</div>
                    <div class="space-y-5 flex-1">
                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <span class="text-[9px] px-3 py-1 rounded bg-black text-primary font-black uppercase tracking-widest">Verified Tier 1</span>
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">EST. 2012</span>
                            </div>
                            <h3 class="text-2xl font-black text-black">Safi Solar Solutions</h3>
                            <p class="text-[11px] text-slate-400 flex items-center gap-2 font-black uppercase tracking-widest"><i data-lucide="map-pin" class="w-4 h-4 text-primary"></i> Nairobi Headquarters</p>
                        </div>
                        <p class="text-xs text-slate-500 font-bold leading-relaxed">EPRA Registered Commercial Installer. Specialists in Large-scale solar irrigation and agri-PV systems.</p>
                        <div class="flex justify-between items-center pt-8 border-t border-slate-50">
                            <div class="flex items-center gap-1">
                                <i data-lucide="star" class="w-4 h-4 fill-primary text-primary"></i>
                                <span class="text-xs text-black font-black">4.9 Performance Rating</span>
                            </div>
                            <a href="#" class="text-[10px] font-black text-black hover:text-primary transition-colors flex items-center gap-1 uppercase tracking-widest">Storefront <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Vendor 2 -->
                <div class="p-10 bg-white border border-slate-100 rounded-4xl shadow-sm hover:shadow-2xl hover:border-primary/20 transition-all flex flex-col sm:flex-row gap-8 items-start group">
                    <div class="w-20 h-20 rounded-3xl bg-slate-50 flex items-center justify-center text-5xl shrink-0 shadow-inner group-hover:bg-black group-hover:text-primary transition-all">🔋</div>
                    <div class="space-y-5 flex-1">
                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <span class="text-[9px] px-3 py-1 rounded bg-black text-primary font-black uppercase tracking-widest">Verified Tier 1</span>
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">EST. 2015</span>
                            </div>
                            <h3 class="text-2xl font-black text-black">Voltaic Kenya Hub</h3>
                            <p class="text-[11px] text-slate-400 flex items-center gap-2 font-black uppercase tracking-widest"><i data-lucide="map-pin" class="w-4 h-4 text-primary"></i> Mombasa Industrial Hub</p>
                        </div>
                        <p class="text-xs text-slate-500 font-bold leading-relaxed">Leading distributor of Tier 1 PERC modules and Lithium storage banks. 10-year local service warranty guaranteed.</p>
                        <div class="flex justify-between items-center pt-8 border-t border-slate-50">
                            <div class="flex items-center gap-1">
                                <i data-lucide="star" class="w-4 h-4 fill-primary text-primary"></i>
                                <span class="text-xs text-black font-black">4.8 Performance Rating</span>
                            </div>
                            <a href="#" class="text-[10px] font-black text-black hover:text-primary transition-colors flex items-center gap-1 uppercase tracking-widest">Storefront <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
