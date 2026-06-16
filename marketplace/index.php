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

        <!-- 3. ELECTRIC COOKING SECTION -->
        <section class="space-y-12">
            <div class="reveal-on-scroll border-b border-slate-100 pb-8">
                <span class="text-[10px] uppercase font-black text-primary tracking-[0.4em] block">Category 01</span>
                <h2 class="text-4xl font-black text-black tracking-tight">Electric Cooking (EPCs & Induction)</h2>
            </div>

            <div class="stagger-reveal grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <?php 
                $electric = [
                    ['Sayona SPC-100 EPC', '6L | 1000W | Sauté Mode', 7127, 'assets/Sayona Sayona SPC-100.png', 'Nagoya Holdings'],
                    ['Tefal All-in-One EPC', '6L | 1000W | 16 Options', 8500, 'assets/Tefal Electric Pressure.png', 'Mwangaza Light'],
                    ['Sayona SPC 4413 EPC', '6L | 1000W | 8 Options', 8301, 'assets/SPC 4413 EPC - Sayonna.png', 'Nagoya Holdings'],
                    ['Sayona SPC 4572 EPC', '8L | 1200W | 16 Options', 10571, 'assets/Sayonna SPC 4572 EPC.png', 'Nagoya Holdings'],
                    ['Quooker Digi EPC', '6L | 1000W | 16 Options', 11600, 'assets/Quooker Digi EPC.png', 'Nyalore Impact'],
                    ['Sayona SPC 4567 (Cooker & Air Fryer)', '6L | Air Fryer 1500W', 11683, 'assets/Sayonna SPC 4567 pressure cooker & Air Fryer.png', 'Nagoya Holdings'],
                    ['PawaPot JD-29ED EPC', '6L | 1000W | 17 Menus', 12100, 'assets/PawaPot JD-29ED EPC.png', 'SCODE Ltd'],
                    ['Ramtons RM/582 EPC', '6L | 1100W | 12 Recipes', 11900, 'assets/Ramtons RM 582 EPC.png', 'Hypermart Ltd'],
                    ['Ramtons RM/782 EPC', '8L | 1100W | 12 Recipes', 15900, 'assets/Ramtons RM 782 EPC.png', 'Hypermart Ltd'],
                    ['Sayona SPC 4328 (Cooker & Air Fryer)', '6L | 1500W | 29 Presets', 15592, 'assets/Sayonna SPC 4328 Electric Pressure Cooker & Air Fryer.png', 'Nagoya Holdings'],
                    ['Ramtons RM/381 Single Induction', '2000W | Crystal Glass | Timer', 9900, 'assets/Ramtons RM 381 Induction cooker.png', 'Hypermart Ltd'],
                    ['Ramtons RM/773 Double Induction', '2000W | Double Burner | Safety Lock', 14990, 'assets/Ramtons RM 773 Induction cooker.png', 'Hypermart Ltd'],
                    ['ECook Double Induction', '2000W | 7 Menu Functions', 28000, 'assets/ECook Induction cooker.png', 'Mwangaza Light']
                ];
                foreach($electric as $p):
                ?>
                <div class="group bg-white border border-slate-100 rounded-4xl overflow-hidden hover:shadow-2xl transition-all duration-500 flex flex-col h-full">
                    <div class="relative aspect-square bg-slate-50 overflow-hidden shrink-0">
                        <img src="<?php echo $base_url . $p[3]; ?>" alt="<?php echo $p[0]; ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <span class="absolute bottom-4 left-4 bg-primary text-black text-[8px] font-black uppercase px-2 py-1 rounded-md tracking-wider border border-black/5 shadow-sm">Verified Gear</span>
                    </div>
                    <div class="p-6 space-y-4 flex flex-col justify-between flex-1">
                        <div>
                            <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 block"><?php echo $p[4]; ?></span>
                            <h3 class="font-black text-sm text-black group-hover:text-primary transition mt-1 leading-tight"><?php echo $p[0]; ?></h3>
                            <p class="text-[10px] text-slate-500 mt-2 font-medium"><?php echo $p[1]; ?></p>
                        </div>
                        <div class="pt-4 border-t border-slate-50 flex items-center justify-between">
                            <span class="text-base font-black text-black">KES <?php echo number_format($p[2]); ?></span>
                            <a href="product/" class="w-10 h-10 bg-black text-white rounded-xl hover:bg-primary hover:text-black transition flex items-center justify-center">
                                <i data-lucide="chevron-right" class="w-5 h-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- 4. BIO-ETHANOL & GEL STOVES -->
        <section class="space-y-12">
            <div class="reveal-on-scroll border-b border-slate-100 pb-8">
                <span class="text-[10px] uppercase font-black text-primary tracking-[0.4em] block">Category 02</span>
                <h2 class="text-4xl font-black text-black tracking-tight">Bio-Ethanol & Gel Stoves</h2>
            </div>

            <div class="stagger-reveal grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php 
                $ethanol = [
                    ['Moto Safe Double Burner', 'Iron Construction | Manual', 2500, 'assets/Moto Safe Bio Ethanol Stove.png', 'PharmChem Labs'],
                    ['Moto Safe Single Burner', 'Iron Construction | Manual', 2000, 'assets/Moto Safe Bio Ethanol Stove sINGLE BURNER.png', 'PharmChem Labs'],
                    ['Moto Smart Gel Stove (M)', 'Pure Aluminium | Portable', 1500, 'assets/Moto Smart Stove.png', 'SilverTech'],
                    ['Moto Smart Gel Stove (L)', 'Heavy-Duty Build', 3500, 'assets/Moto Smart Stove.png', 'SilverTech']
                ];
                foreach($ethanol as $p):
                ?>
                <div class="group bg-white border border-slate-100 rounded-4xl overflow-hidden hover:shadow-2xl transition-all duration-500">
                    <div class="relative aspect-square bg-slate-50 overflow-hidden">
                        <img src="<?php echo $base_url . $p[3]; ?>" alt="<?php echo $p[0]; ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 block"><?php echo $p[4]; ?></span>
                            <h3 class="font-black text-sm text-black group-hover:text-primary transition mt-1 leading-tight"><?php echo $p[0]; ?></h3>
                            <p class="text-[10px] text-slate-500 mt-2 font-medium"><?php echo $p[1]; ?></p>
                        </div>
                        <div class="pt-4 border-t border-slate-50 flex items-center justify-between">
                            <span class="text-base font-black text-black">KES <?php echo number_format($p[2]); ?></span>
                            <a href="product/" class="w-10 h-10 bg-black text-white rounded-xl hover:bg-primary hover:text-black transition flex items-center justify-center">
                                <i data-lucide="chevron-right" class="w-5 h-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Fuels and Refills -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pt-8">
                <div class="p-8 bg-slate-50 rounded-[30px] border border-slate-100 flex items-center gap-6 group hover:bg-white hover:shadow-xl transition-all">
                    <img src="<?php echo $base_url; ?>assets/Moto Safe Bio Ethanol Fuel.png" class="w-20 h-20 object-contain">
                    <div>
                        <h4 class="font-black text-black text-sm">Bio Ethanol Liquid</h4>
                        <p class="text-[10px] text-slate-500 font-bold uppercase mt-1">KES 200 / Litre</p>
                    </div>
                </div>
                <div class="p-8 bg-slate-50 rounded-[30px] border border-slate-100 flex items-center gap-6 group hover:bg-white hover:shadow-xl transition-all">
                    <img src="<?php echo $base_url; ?>assets/Moto Safe Fuel Gel.png" class="w-20 h-20 object-contain">
                    <div>
                        <h4 class="font-black text-black text-sm">Moto Safe Fuel Gel</h4>
                        <p class="text-[10px] text-slate-500 font-bold uppercase mt-1">From KES 180 / Litre</p>
                    </div>
                </div>
                <div class="p-8 bg-slate-50 rounded-[30px] border border-slate-100 flex items-center gap-6 group hover:bg-white hover:shadow-xl transition-all">
                    <img src="<?php echo $base_url; ?>assets/Moto Smart Gel Fuel (Low smoke).png" class="w-20 h-20 object-contain">
                    <div>
                        <h4 class="font-black text-black text-sm">Low Smoke Smart Gel</h4>
                        <p class="text-[10px] text-slate-500 font-bold uppercase mt-1">KES 160 / Litre</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. BIO-DIGESTERS -->
        <section class="space-y-12">
            <div class="reveal-on-scroll border-b border-slate-100 pb-8">
                <span class="text-[10px] uppercase font-black text-primary tracking-[0.4em] block">Category 03</span>
                <h2 class="text-4xl font-black text-black tracking-tight">Bio-Digester Systems</h2>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <!-- Fixed Dome -->
                <div class="group bg-white border border-slate-100 rounded-[3rem] overflow-hidden flex flex-col md:flex-row shadow-sm hover:shadow-3xl transition-all">
                    <div class="w-full md:w-2/5 aspect-square bg-slate-100 overflow-hidden">
                        <img src="<?php echo $base_url; ?>assets/Biodigester Dome.png" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-10 flex-1 flex flex-col justify-between">
                        <div class="space-y-4">
                            <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Masonry Construction</span>
                            <h3 class="text-3xl font-black text-black leading-tight">Fixed Dome Biodigester</h3>
                            <p class="text-xs text-slate-500 leading-relaxed font-bold">Built-to-last underground system. Zero maintenance, delivers continuous clean gas and bio-slurry fertilizer.</p>
                        </div>
                        <div class="pt-8 flex items-center justify-between">
                            <span class="text-xs font-black text-black uppercase tracking-widest">Quote on Assessment</span>
                            <a href="../contact/" class="px-6 py-3 bg-black text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-primary hover:text-black transition">Book Survey</a>
                        </div>
                    </div>
                </div>

                <!-- Prefabricated -->
                <div class="group bg-white border border-slate-100 rounded-[3rem] overflow-hidden flex flex-col md:flex-row shadow-sm hover:shadow-3xl transition-all">
                    <div class="w-full md:w-2/5 aspect-square bg-slate-100 overflow-hidden">
                        <img src="<?php echo $base_url; ?>assets/Prefabricated Biodigester.png" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-10 flex-1 flex flex-col justify-between">
                        <div class="space-y-4">
                            <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest">Portable HDPE</span>
                            <h3 class="text-3xl font-black text-black leading-tight">Prefabricated Biodigester</h3>
                            <p class="text-xs text-slate-500 leading-relaxed font-bold">Ready-to-use modern setup. Lightweight, portable, and starts producing fuel immediately.</p>
                        </div>
                        <div class="pt-8 flex items-center justify-between">
                            <span class="text-xs font-black text-black uppercase tracking-widest">Quick Installation</span>
                            <a href="../contact/" class="px-6 py-3 bg-black text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-primary hover:text-black transition">Inquire Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-10 bg-black rounded-[3rem] text-center space-y-6">
                <p class="text-slate-400 text-sm font-bold">Biogas systems require a physical site survey prior to installation.</p>
                <div class="flex flex-wrap justify-center gap-6">
                    <div class="px-8 py-4 bg-white/5 border border-white/10 rounded-2xl text-white font-black text-xs uppercase tracking-widest">
                        Dial <span class="text-primary">*789*788#</span>
                    </div>
                    <a href="https://abc.kenyabiogas.com/companies/" target="_blank" class="px-8 py-4 bg-primary text-black rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-white transition">Visit ABC Kenya</a>
                </div>
            </div>
        </section>

        <!-- 6. IMPROVED COOKSTOVES (ICS) -->
        <section class="space-y-12 pb-24">
            <div class="reveal-on-scroll border-b border-slate-100 pb-8">
                <span class="text-[10px] uppercase font-black text-primary tracking-[0.4em] block">Category 04</span>
                <h2 class="text-4xl font-black text-black tracking-tight">Improved Cookstoves (ICS)</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Portable Jiko -->
                <div class="group bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all">
                    <div class="aspect-square rounded-[2rem] overflow-hidden mb-8">
                        <img src="<?php echo $base_url; ?>assets/Portable Jikosasa Stove.png" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <h3 class="text-xl font-black text-black mb-3">Portable Jiko Kisasa</h3>
                    <p class="text-xs text-slate-500 font-bold leading-relaxed mb-8">Traditional ceramic liner in durable metal housing. Perfect for small to medium households.</p>
                    <div class="flex justify-between items-center pt-6 border-t border-slate-50">
                        <span class="text-[10px] font-black uppercase text-slate-400">Available</span>
                        <a href="../contact/" class="text-[10px] font-black uppercase text-primary hover:text-black transition">Inquire <i data-lucide="arrow-right" class="w-3 h-3 inline"></i></a>
                    </div>
                </div>

                <!-- Fixed Jiko -->
                <div class="group bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all">
                    <div class="aspect-square rounded-[2rem] overflow-hidden mb-8">
                        <img src="<?php echo $base_url; ?>assets/Fixed Jikosasa Stove.png" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <h3 class="text-xl font-black text-black mb-3">Fixed Jiko Kisasa</h3>
                    <p class="text-xs text-slate-500 font-bold leading-relaxed mb-8">Stationary brick/clay installation. Customizable with multiple burners for efficiency.</p>
                    <div class="flex justify-between items-center pt-6 border-t border-slate-50">
                        <span class="text-[10px] font-black uppercase text-slate-400">Custom Built</span>
                        <a href="../contact/" class="text-[10px] font-black uppercase text-primary hover:text-black transition">Inquire <i data-lucide="arrow-right" class="w-3 h-3 inline"></i></a>
                    </div>
                </div>

                <!-- Institutional -->
                <div class="group bg-black p-10 rounded-[3rem] border border-white/10 shadow-3xl text-white flex flex-col justify-center">
                    <div class="space-y-6">
                        <i data-lucide="shovels" class="w-12 h-12 text-primary"></i>
                        <h3 class="text-2xl font-black text-white">Institutional Cookstoves</h3>
                        <p class="text-xs text-slate-400 font-bold leading-relaxed">High-capacity iron installations for schools, hospitals, and community centers.</p>
                        <div class="pt-6 border-t border-white/10">
                            <a href="../contact/" class="inline-flex items-center gap-2 text-[10px] font-black uppercase text-primary tracking-widest">Connect with Artisan <i data-lucide="external-link" class="w-4 h-4"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Eco Impact Banner -->
            <div class="relative rounded-[3rem] overflow-hidden bg-emerald-950 p-12 text-center text-white">
                <div class="absolute inset-0 opacity-10">
                    <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1200" class="w-full h-full object-cover">
                </div>
                <div class="relative z-10 max-w-3xl mx-auto space-y-8">
                    <h3 class="text-3xl font-black">1 Million+ Clean Cookstoves Deployed</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                        <div>
                            <p class="text-3xl font-black text-primary">$50M+</p>
                            <p class="text-[9px] font-black uppercase tracking-widest text-emerald-300">Fuel Savings</p>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-primary">800k+</p>
                            <p class="text-[9px] font-black uppercase tracking-widest text-emerald-300">Tonnes CO2 Offset</p>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-primary">12k+</p>
                            <p class="text-[9px] font-black uppercase tracking-widest text-emerald-300">Local Jobs Created</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
