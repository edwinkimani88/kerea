<?php 
$base_url = "../";
$active_page = "standards";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/head.php'; ?>
    <title>Technical Standards | KEREA Kenya</title>
    <meta name="description" content="KEREA promotes and enforces technical standards for renewable energy hardware across Kenya, ensuring quality and consumer protection.">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <!-- Hero - Green primary, not black -->
        <section class="relative bg-primary pt-32 pb-48 overflow-hidden">
            <div class="absolute inset-0 opacity-[0.08] pointer-events-none" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 32px 32px;"></div>
            <div class="absolute right-0 top-0 w-1/3 h-full bg-black/10 skew-x-12 transform translate-x-20 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-black/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="max-w-3xl space-y-10">
                    <span class="reveal-on-scroll text-black/60 font-black text-[10px] uppercase tracking-[0.4em] block">Sector Governance</span>
                    <h1 class="reveal-on-scroll text-6xl sm:text-7xl lg:text-8xl font-black text-black leading-tight tracking-tighter">
                        Technical <span class="text-slate-800">Standards</span> &amp; Quality
                    </h1>
                    <p class="reveal-on-scroll text-black/70 text-xl sm:text-2xl leading-relaxed font-medium">
                        Promoting best practices, product quality, and compliance frameworks that protect Kenya's renewable energy consumers and businesses.
                    </p>
                </div>
            </div>
        </section>

        <!-- Stats Card -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-20 mb-32">
            <div class="reveal-on-scroll bg-white rounded-[3rem] shadow-2xl p-12 sm:p-20 grid grid-cols-1 md:grid-cols-3 gap-20 border border-slate-100">
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-black rounded-2xl flex items-center justify-center shadow-xl">
                            <i data-lucide="shield-check" class="w-7 h-7 text-primary"></i>
                        </div>
                        <h4 class="font-black text-black uppercase tracking-[0.2em] text-xs">KEBS Aligned</h4>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">All standards promoted are harmonised with Kenya Bureau of Standards frameworks.</p>
                </div>
                <div class="space-y-6 md:border-l md:border-slate-100 md:pl-20">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-black rounded-2xl flex items-center justify-center shadow-xl">
                            <i data-lucide="award" class="w-7 h-7 text-primary"></i>
                        </div>
                        <h4 class="font-black text-black uppercase tracking-[0.2em] text-xs">EPRA Certified</h4>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">Only EPRA-registered and verified products are eligible for KEREA marketplace listing.</p>
                </div>
                <div class="space-y-6 md:border-l md:border-slate-100 md:pl-20">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-black rounded-2xl flex items-center justify-center shadow-xl">
                            <i data-lucide="globe" class="w-7 h-7 text-primary"></i>
                        </div>
                        <h4 class="font-black text-black uppercase tracking-[0.2em] text-xs">IEC Harmonised</h4>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">International Electrotechnical Commission standards localised for the East African market.</p>
                </div>
            </div>
        </section>

        <!-- Core Standards Grid -->
        <section class="py-32 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="reveal-on-scroll flex flex-col lg:flex-row justify-between items-end gap-10 mb-20">
                    <div class="max-w-3xl space-y-6">
                        <span class="text-primary font-black text-[10px] uppercase tracking-[0.4em] block">Framework Overview</span>
                        <h2 class="text-4xl sm:text-6xl font-black text-black tracking-tight leading-tight">Standards We Champion</h2>
                        <p class="text-slate-500 text-lg leading-relaxed font-medium">From solar photovoltaic systems to clean cooking appliances, KEREA enforces quality parameters across every technology segment.</p>
                    </div>
                </div>

                <div class="stagger-reveal grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    $standards = [
                        ['Solar PV Systems', 'sun', 'IEC 61215, IEC 61730 and KS 1738 compliance for all photovoltaic modules sold in Kenya, covering performance and safety testing.'],
                        ['Solar Water Heating', 'thermometer-sun', 'KS 1648 standards for flat-plate and evacuated tube collectors, ensuring durability in Kenyan climatic conditions.'],
                        ['Clean Cookstoves', 'flame', 'ISO 19867 standards for clean cooking performance, thermal efficiency and indoor air quality benchmarks.'],
                        ['Biogas Systems', 'wind', 'Quality requirements for modular biogas digesters including material specs, gas-tightness, and safety valve requirements.'],
                        ['Energy Storage', 'battery-charging', 'IEC 62619 safety standards for lithium battery systems plus local requirements for off-grid and hybrid installations.'],
                        ['Metering & Monitoring', 'gauge', 'EPRA metering code compliance and remote monitoring interoperability standards for certified installations.'],
                    ];
                    foreach($standards as $s):
                    ?>
                    <div class="group p-12 bg-slate-50 rounded-4xl border border-slate-100 hover:border-primary/40 transition-all duration-500 hover:bg-white hover:shadow-2xl relative overflow-hidden">
                        <div class="w-16 h-16 bg-black rounded-3xl flex items-center justify-center mb-10 shadow-xl group-hover:rotate-6 transition-transform">
                            <i data-lucide="<?php echo $s[1]; ?>" class="w-8 h-8 text-primary"></i>
                        </div>
                        <h3 class="text-2xl font-black text-black mb-6"><?php echo $s[0]; ?></h3>
                        <p class="text-slate-500 text-sm leading-relaxed mb-8"><?php echo $s[2]; ?></p>
                        <a href="#" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-black group-hover:text-primary transition-all">View Framework <i data-lucide="chevron-right" class="w-4 h-4"></i></a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Vision & Mission - Restored -->
        <section class="py-32 bg-slate-50 border-y border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-32 items-center">
                <div class="space-y-12">
                    <h2 class="reveal-on-scroll text-4xl sm:text-6xl font-black text-black tracking-tighter leading-tight">Driving Global Standards in Local Markets</h2>
                    <div class="reveal-on-scroll space-y-8">
                        <p class="text-slate-600 text-lg leading-relaxed font-medium">
                            KEREA's mission is to foster an enabling environment for the growth of the renewable energy sector. We achieve this through structured advocacy, market development, and quality standards enforcement.
                        </p>
                        <p class="text-slate-500 text-base leading-relaxed">
                            Our technical standards committee works directly with KEBS, EPRA, and international bodies to ensure that Kenyan consumers access only certified, quality hardware.
                        </p>
                    </div>
                    <div class="stagger-reveal grid grid-cols-1 sm:grid-cols-2 gap-10 p-12 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm">
                        <div class="space-y-4">
                            <h4 class="font-black text-primary uppercase text-[10px] tracking-[0.3em]">Our Vision</h4>
                            <p class="text-black text-sm leading-relaxed font-black italic">"A sustainable future powered by quality-certified renewable energy for every household."</p>
                        </div>
                        <div class="space-y-4">
                            <h4 class="font-black text-primary uppercase text-[10px] tracking-[0.3em]">Our Mission</h4>
                            <p class="text-black text-sm leading-relaxed font-bold">"To accelerate energy transition through excellence in standards, advocacy and market governance."</p>
                        </div>
                    </div>
                </div>
                <!-- Image cluster -->
                <div class="reveal-on-scroll grid grid-cols-2 gap-8">
                    <div class="space-y-8">
                        <div class="h-96 rounded-[3rem] overflow-hidden shadow-2xl border-4 border-white">
                            <img src="https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700">
                        </div>
                        <div class="h-40 bg-primary rounded-[2.5rem] p-10 flex items-end shadow-xl">
                            <span class="text-black font-black text-3xl leading-none tracking-tight">Market<br>Integrity</span>
                        </div>
                    </div>
                    <div class="space-y-8 pt-16">
                        <div class="h-40 bg-black rounded-[2.5rem] p-10 flex items-end shadow-xl border border-white/10">
                            <span class="text-white font-black text-3xl leading-none tracking-tight">Global<br>Alliances</span>
                        </div>
                        <div class="h-96 rounded-[3rem] overflow-hidden shadow-2xl border-4 border-white">
                            <img src="https://images.unsplash.com/photo-1548543604-a87a9989fd0f?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
