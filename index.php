<?php 
$base_url = "./";
$active_page = "home";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php'; ?>
    <title>Kenya Renewable Energy Association | KEREA Peak Body</title>
    <meta name="description" content="KEREA is Kenya's peak body for renewable energy — driving policy, standards, marketplace access and sector growth for clean energy businesses since 2002.">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>

        <!-- ═══ 1. HERO ═══════════════════════════════════════════════════════════ -->
        <section class="relative bg-slate-900 min-h-[88vh] flex items-center overflow-hidden">
            <!-- Background -->
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1466611653911-95081537e5b7?auto=format&fit=crop&w=1800&q=80"
                     alt="Renewable Energy Kenya"
                     class="w-full h-full object-cover opacity-25">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-900/80 to-slate-900/40"></div>
            </div>
            <!-- Decorative green gradient blob -->
            <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-primary/15 via-primary/5 to-transparent pointer-events-none"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full py-24">
                <div class="max-w-3xl space-y-10">
                    <div class="reveal-on-scroll flex items-center gap-3 px-5 py-2 rounded-full bg-primary/15 border border-primary/30 text-primary text-[10px] font-black uppercase tracking-[0.3em] w-fit">
                        <span class="w-2 h-2 rounded-full bg-primary animate-ping"></span>
                        Kenya's Industry Peak Body · Est. 2002
                    </div>

                    <h1 class="reveal-on-scroll text-5xl sm:text-7xl lg:text-8xl font-black tracking-tighter text-white leading-[1.05]">
                        Powering the<br />
                        <span class="text-primary">Green Future</span>
                    </h1>

                    <p class="reveal-on-scroll text-lg sm:text-xl text-slate-300 max-w-2xl leading-relaxed font-medium">
                        An independent non-profit association dedicated to facilitating the growth and development of renewable energy business in Kenya — through advocacy, standards, and marketplace security.
                    </p>

                    <div class="reveal-on-scroll flex flex-wrap gap-5 pt-4">
                        <a href="membership/" class="px-10 py-5 bg-primary hover:bg-primary-dark text-black font-black rounded-2xl text-sm transition-all shadow-xl shadow-primary/25 hover:-translate-y-1 inline-flex items-center gap-3">
                            Become a Member <i data-lucide="arrow-right" class="w-5 h-5"></i>
                        </a>
                        <a href="about/" class="px-10 py-5 bg-white/8 hover:bg-white/15 border border-white/20 text-white font-black rounded-2xl text-sm transition-all backdrop-blur-sm inline-flex items-center gap-3">
                            Who We Are
                        </a>
                    </div>

                    <!-- Stats Strip -->
                    <div class="stagger-reveal grid grid-cols-3 gap-8 pt-16 border-t border-white/10">
                        <div class="space-y-2">
                            <span class="text-white font-black text-4xl block tracking-tighter counter" data-target="450">0</span>
                            <span class="text-[10px] uppercase font-black text-primary tracking-[0.2em]">Active Members</span>
                        </div>
                        <div class="space-y-2">
                            <span class="text-white font-black text-4xl block tracking-tighter counter" data-target="22">0</span>
                            <span class="text-[10px] uppercase font-black text-primary tracking-[0.2em]">Years Active</span>
                        </div>
                        <div class="space-y-2">
                            <span class="text-white font-black text-4xl block tracking-tighter counter" data-target="8">0</span>
                            <span class="text-[10px] uppercase font-black text-primary tracking-[0.2em]">Active Projects</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══ 2. ABOUT KEREA ════════════════════════════════════════════════════ -->
        <section class="py-32 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
                    <!-- Text -->
                    <div class="space-y-10">
                        <div class="reveal-on-scroll space-y-4">
                            <span class="text-primary font-black text-[10px] uppercase tracking-[0.4em] block">About KEREA</span>
                            <h2 class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tight leading-tight">Who We Are<br>And What We Do</h2>
                        </div>
                        <div class="reveal-on-scroll space-y-6 text-slate-600 text-base leading-relaxed font-medium">
                            <p>
                                The Kenya Renewable Energy Association (KEREA) is an independent non-profit association dedicated to facilitating the growth and development of renewable energy business in Kenya.
                            </p>
                            <p>
                                KEREA was formed in August 2002 by members of the Renewable Energy Resources Technical Committee of the Kenya Bureau of Standards (KEBS) and is registered under Section 10 of the Societies Act.
                            </p>
                            <p>
                                Amongst its key roles are promoting the interests of members of the renewable energy industry among government, public sector, the general public and any other organizations that may impact on the development of the industry; and the creation of a forum for the dissemination and exchange of information and ideas on matters relating to renewable energy development and utilization in Kenya.
                            </p>
                        </div>
                        <div class="reveal-on-scroll flex flex-wrap gap-4 pt-4">
                            <a href="about/" class="px-8 py-4 bg-primary text-black font-black rounded-2xl text-sm uppercase tracking-widest hover:-translate-y-1 transition-all shadow-lg shadow-primary/20 inline-flex items-center gap-2">
                                Learn More <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                            <a href="member-directory/" class="px-8 py-4 bg-slate-100 text-slate-900 font-black rounded-2xl text-sm uppercase tracking-widest hover:bg-slate-200 transition-all inline-flex items-center gap-2">
                                Our Members
                            </a>
                        </div>
                    </div>
                    <!-- Image cluster -->
                    <div class="reveal-on-scroll grid grid-cols-2 gap-6">
                        <div class="space-y-6">
                            <div class="h-72 rounded-[2.5rem] overflow-hidden shadow-2xl border-4 border-white">
                                <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=400&q=80"
                                     class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" alt="Clean Energy">
                            </div>
                            <div class="h-36 bg-primary rounded-[2rem] p-8 flex items-end shadow-xl shadow-primary/20">
                                <span class="text-black font-black text-2xl leading-none tracking-tight">Since<br>2002</span>
                            </div>
                        </div>
                        <div class="space-y-6 pt-12">
                            <div class="h-36 bg-slate-900 rounded-[2rem] p-8 flex items-end shadow-xl">
                                <span class="text-white font-black text-2xl leading-none tracking-tight">Peak<br>Body</span>
                            </div>
                            <div class="h-72 rounded-[2.5rem] overflow-hidden shadow-2xl border-4 border-white">
                                <img src="https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=400&q=80"
                                     class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" alt="Solar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══ 3. WORKING GROUPS ═════════════════════════════════════════════════ -->
        <section class="py-32 bg-slate-50 border-y border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="reveal-on-scroll text-center max-w-3xl mx-auto mb-20 space-y-6">
                    <span class="text-primary font-black text-[10px] uppercase tracking-[0.4em] block">Collaborative Teams</span>
                    <h2 class="text-4xl sm:text-6xl font-black text-slate-900 tracking-tight leading-tight">KEREA Working Groups</h2>
                    <p class="text-slate-500 text-lg leading-relaxed font-medium">
                        Collaborative teams focused on advancing renewable energy solutions by addressing key areas such as policy advocacy, technology innovation, market development, and capacity building.
                    </p>
                </div>

                <div class="stagger-reveal grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    $groups = [
                        [
                            'name' => 'Advocacy',
                            'icon' => 'landmark',
                            'desc' => 'Advocate for favorable policies and regulatory frameworks that enable the growth of Kenya\'s renewable energy sector.',
                            'color' => 'bg-primary',
                            'text' => 'text-black',
                        ],
                        [
                            'name' => 'Solar Energy',
                            'icon' => 'sun',
                            'desc' => 'Promote the adoption of solar energy technologies across residential, commercial, and industrial sectors.',
                            'color' => 'bg-amber-400',
                            'text' => 'text-black',
                        ],
                        [
                            'name' => 'PURE',
                            'icon' => 'zap',
                            'desc' => 'Promote the Productive Use of Renewable Energy (PURE) in agriculture, SMEs, and various productive sectors.',
                            'color' => 'bg-primary',
                            'text' => 'text-black',
                        ],
                        [
                            'name' => 'Wind Energy',
                            'icon' => 'wind',
                            'desc' => 'Promote the development and expansion of the wind energy market in Kenya\'s favorable corridors.',
                            'color' => 'bg-slate-800',
                            'text' => 'text-white',
                        ],
                        [
                            'name' => 'Geothermal Energy',
                            'icon' => 'flame-kindling',
                            'desc' => 'Promote the utilization of geothermal resources, one of Kenya\'s most significant natural energy assets.',
                            'color' => 'bg-amber-400',
                            'text' => 'text-black',
                        ],
                        [
                            'name' => 'Bio Energy',
                            'icon' => 'leaf',
                            'desc' => 'Promote sustainable bioenergy practices and technologies, including biogas and biomass solutions.',
                            'color' => 'bg-primary',
                            'text' => 'text-black',
                        ],
                    ];
                    foreach($groups as $g):
                    ?>
                    <div class="group bg-white rounded-4xl border border-slate-100 p-10 hover:shadow-2xl hover:border-primary/30 transition-all duration-500 flex flex-col justify-between gap-10">
                        <div class="space-y-6">
                            <div class="w-14 h-14 <?php echo $g['color']; ?> rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                <i data-lucide="<?php echo $g['icon']; ?>" class="w-7 h-7 <?php echo $g['text']; ?>"></i>
                            </div>
                            <h3 class="text-xl font-black text-slate-900"><?php echo $g['name']; ?></h3>
                            <p class="text-slate-500 text-sm leading-relaxed"><?php echo $g['desc']; ?></p>
                        </div>
                        <a href="policy-advocacy/" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.25em] text-slate-400 group-hover:text-primary transition-all">
                            Read More <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- ═══ 4. OUR PROJECTS ═══════════════════════════════════════════════════ -->
        <section class="py-32 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="reveal-on-scroll flex flex-col lg:flex-row justify-between items-end gap-10 mb-20">
                    <div class="max-w-2xl space-y-6">
                        <span class="text-primary font-black text-[10px] uppercase tracking-[0.4em] block">Our Projects</span>
                        <h2 class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tight leading-tight">Key Past & Current Projects</h2>
                        <p class="text-slate-500 text-lg leading-relaxed font-medium">Below are some of our key past & current projects that are shaping the future of Kenya's Renewable Energy Sector.</p>
                    </div>
                    <a href="kenya-renewable-energy-association/" class="shrink-0 px-8 py-3 bg-slate-50 border border-slate-200 text-slate-900 font-black text-[10px] uppercase tracking-widest rounded-xl hover:bg-primary hover:text-black hover:border-primary transition-all">
                        All Projects
                    </a>
                </div>

                <div class="stagger-reveal grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <?php
                    $projects = [
                        [
                            'title' => 'Efficiency for Access',
                            'icon' => 'zap-off',
                            'desc' => 'Improving Appliance Standards for Greater Energy Adoption by Businesses and Households.',
                            'tag' => 'Standards',
                        ],
                        [
                            'title' => 'Scaling PURE',
                            'icon' => 'trending-up',
                            'desc' => 'Expanding Productive Use of Renewable Energy for players in Kenya\'s Business Sector.',
                            'tag' => 'Active',
                        ],
                        [
                            'title' => 'Digital & USSD Platform',
                            'icon' => 'smartphone',
                            'desc' => 'A Reliable User-Friendly USSD Service (*789*788#) Providing Access to Renewable Energy Solutions.',
                            'tag' => 'Innovation',
                        ],
                        [
                            'title' => 'Bioenergy Innovation Platform',
                            'icon' => 'leaf',
                            'desc' => 'Advancing Clean Energy for a Sustainable Future by Reducing Dependence on Fossil Fuels.',
                            'tag' => 'Active',
                        ],
                        [
                            'title' => 'Energy for All (EforA)',
                            'icon' => 'users',
                            'desc' => 'Strengthening Collaboration Among Kenya\'s Renewable Energy Players To Promote Energy-Efficient Appliances.',
                            'tag' => 'Collaboration',
                        ],
                        [
                            'title' => 'B2B & Access to Finance',
                            'icon' => 'handshake',
                            'desc' => 'Facilitating B2B linkages between Kenyan and Chinese renewable energy players to drive market expansion.',
                            'tag' => 'Finance',
                        ],
                        [
                            'title' => "Kenya's PURE Roadmap",
                            'icon' => 'map',
                            'desc' => 'Developed a strategic roadmap to guide the adoption of PURE technologies across various industries.',
                            'tag' => 'Policy',
                        ],
                        [
                            'title' => 'Baseline Study — PURE Kenya',
                            'icon' => 'bar-chart-2',
                            'desc' => 'KEREA Conducted a baseline study on the current state of renewable energy use in Kenya\'s business sector.',
                            'tag' => 'Research',
                        ],
                    ];
                    foreach($projects as $p):
                    ?>
                    <div class="group bg-slate-50 rounded-4xl border border-slate-100 p-8 hover:bg-white hover:shadow-2xl hover:border-primary/25 transition-all duration-500 flex flex-col justify-between gap-8">
                        <div class="space-y-5">
                            <div class="flex items-start justify-between">
                                <div class="w-12 h-12 bg-white rounded-2xl border border-slate-100 flex items-center justify-center shadow-sm group-hover:bg-primary group-hover:border-primary transition-all duration-300">
                                    <i data-lucide="<?php echo $p['icon']; ?>" class="w-5 h-5 text-slate-600 group-hover:text-black transition-colors"></i>
                                </div>
                                <span class="text-[8px] font-black uppercase tracking-[0.2em] px-3 py-1 bg-primary/10 text-primary rounded-full"><?php echo $p['tag']; ?></span>
                            </div>
                            <h3 class="text-base font-black text-slate-900 leading-tight"><?php echo $p['title']; ?></h3>
                            <p class="text-slate-500 text-xs leading-relaxed"><?php echo $p['desc']; ?></p>
                        </div>
                        <a href="#" class="inline-flex items-center gap-2 text-[9px] font-black uppercase tracking-[0.25em] text-slate-400 group-hover:text-primary transition-all">
                            Read More <i data-lucide="chevron-right" class="w-3 h-3"></i>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- ═══ 5. CORE PILLARS ═══════════════════════════════════════════════════ -->
        <section class="py-32 bg-slate-50 border-y border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="reveal-on-scroll text-center max-w-3xl mx-auto mb-20 space-y-6">
                    <span class="text-primary font-black text-[10px] uppercase tracking-[0.4em] block">Our Strategic Mandate</span>
                    <h2 class="text-4xl sm:text-6xl font-black text-slate-900 tracking-tight leading-tight">Driving Clean Energy Standards</h2>
                    <p class="text-slate-500 text-lg leading-relaxed font-medium">We represent the private sector to ensure quality, advocacy, and market growth across Kenya's energy landscape.</p>
                </div>

                <div class="stagger-reveal grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Policy -->
                    <div class="group p-12 bg-white rounded-4xl border border-slate-100 hover:border-primary/40 transition-all duration-500 hover:shadow-2xl">
                        <div class="w-16 h-16 bg-primary rounded-3xl flex items-center justify-center mb-10 shadow-lg shadow-primary/20 group-hover:scale-110 transition-transform duration-300">
                            <i data-lucide="landmark" class="w-8 h-8 text-black"></i>
                        </div>
                        <h3 class="text-2xl font-black text-slate-900 mb-6">Policy &<br>Advocacy</h3>
                        <p class="text-slate-500 text-sm leading-relaxed mb-8">Creating an enabling environment for private sector growth and investment in clean energy.</p>
                        <a href="policy-advocacy/" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-primary transition-all">Learn More <i data-lucide="chevron-right" class="w-4 h-4"></i></a>
                    </div>

                    <!-- Marketplace — Feature card -->
                    <div class="bg-slate-900 text-white rounded-4xl p-12 relative overflow-hidden flex flex-col justify-between group shadow-2xl">
                        <div class="absolute inset-0 bg-primary/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-primary rounded-3xl flex items-center justify-center mb-10 shadow-2xl shadow-primary/30">
                                <i data-lucide="shopping-bag" class="w-8 h-8 text-black"></i>
                            </div>
                            <h3 class="text-4xl font-black mb-6 leading-tight">Escrow<br>Marketplace</h3>
                            <p class="text-slate-400 text-sm leading-relaxed mb-10">Secure procurement for EPRA-certified renewable hardware. Compliant logistics and vetted vendors.</p>
                        </div>
                        <div class="relative z-10 space-y-6">
                            <div class="p-6 bg-white/5 rounded-3xl border border-white/10">
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-[9px] font-black uppercase tracking-widest text-primary">Market Security</span>
                                    <span class="text-[9px] font-black uppercase tracking-widest text-slate-500">100% Vetted</span>
                                </div>
                                <div class="w-full bg-white/10 h-1.5 rounded-full overflow-hidden">
                                    <div class="w-2/3 h-full bg-primary shadow-[0_0_12px_#39DE4F]"></div>
                                </div>
                            </div>
                            <a href="marketplace/" class="w-full py-5 bg-primary text-black font-black rounded-2xl text-xs uppercase tracking-[0.2em] flex items-center justify-center gap-3 hover:bg-white transition-all shadow-xl shadow-primary/20">
                                Enter Marketplace <i data-lucide="external-link" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Standards -->
                    <div class="group p-12 bg-white rounded-4xl border border-slate-100 hover:border-primary/40 transition-all duration-500 hover:shadow-2xl">
                        <div class="w-16 h-16 bg-primary rounded-3xl flex items-center justify-center mb-10 shadow-lg shadow-primary/20 group-hover:scale-110 transition-transform duration-300">
                            <i data-lucide="shield-check" class="w-8 h-8 text-black"></i>
                        </div>
                        <h3 class="text-2xl font-black text-slate-900 mb-6">Technical<br>Standards</h3>
                        <p class="text-slate-500 text-sm leading-relaxed mb-8">Promoting best practices and quality hardware frameworks for Kenyan consumers and businesses.</p>
                        <a href="standards/" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-primary transition-all">Learn More <i data-lucide="chevron-right" class="w-4 h-4"></i></a>
                    </div>
                </div>
            </div>
        </section>

<style>
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        display: flex;
        width: max-content;
        animation: marquee 40s linear infinite;
    }
    .animate-marquee:hover {
        animation-play-state: paused;
    }
</style>

        <!-- ═══ 6. PARTNERSHIPS - MOVING BELT ══════════════════════════════════════════ -->
        <section class="py-24 bg-white border-b border-slate-100 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 text-center">
                <div class="reveal-on-scroll space-y-4">
                    <span class="text-primary font-black text-[9px] uppercase tracking-[0.3em] block italic">Our Ecosystem</span>
                    <h3 class="text-2xl font-black text-slate-900 uppercase tracking-widest">Some of Our Members & Partners</h3>
                </div>
            </div>
            
            <div class="relative flex items-center group">
                <!-- Moving Belt -->
                <div class="animate-marquee flex gap-12 items-center">
                    <?php 
                    $partners = [
                        "ARIYA.jpg", "CAT.png", "CLIMACENTO.png", "D LIGHT.png", 
                        "EENOVATORS.jpg", "Koko.png", "Muresa.png", "Sentec.png", 
                        "biolite.jpg", "eed advisory.jpg", "mullard.png", "solar panda.jpg", 
                        "strathmore energy.png", "sun culture.png", "sun king.png", "wanergy.jpg"
                    ];
                    // Duplicate for seamless loop
                    $display_partners = array_merge($partners, $partners);
                    foreach($display_partners as $p): 
                    ?>
                    <div class="h-32 w-64 bg-white border border-slate-100 rounded-3xl flex items-center justify-center p-8 hover:border-primary/20 hover:shadow-xl transition-all duration-500 shrink-0">
                        <img src="assets/partners/<?php echo $p; ?>" alt="Partner" class="max-h-full max-w-full object-contain">
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Gradient Overlays for smooth entry/exit -->
                <div class="absolute left-0 top-0 w-40 h-full bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
                <div class="absolute right-0 top-0 w-40 h-full bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>
            </div>
        </section>

        <!-- ═══ 7. CTA — BECOME A MEMBER ══════════════════════════════════════════ -->
        <section class="py-8 px-4 sm:px-6 lg:px-8 bg-white pb-20">
            <div class="max-w-7xl mx-auto">
                <div class="bg-primary rounded-[3rem] p-16 sm:p-24 text-center relative overflow-hidden shadow-2xl shadow-primary/25">
                    <div class="absolute inset-0 opacity-[0.06] pointer-events-none" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 24px 24px;"></div>
                    <!-- Decorative blobs -->
                    <div class="absolute -top-20 -left-20 w-64 h-64 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
                    <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-black/10 rounded-full blur-3xl pointer-events-none"></div>

                    <div class="relative z-10 max-w-4xl mx-auto space-y-10">
                        <span class="inline-block text-[9px] font-black uppercase tracking-[0.4em] text-black/50 border border-black/20 px-5 py-2 rounded-full">Join the Movement</span>
                        <h2 class="text-4xl sm:text-6xl font-black text-black tracking-tighter leading-tight">
                            Become a Part of<br /><span class="text-slate-900/80">KEREA Today</span>
                        </h2>
                        <p class="text-black/65 text-lg sm:text-xl font-medium leading-relaxed max-w-2xl mx-auto">
                            Join Kenya's peak renewable energy body. Gain access to exclusive advocacy, marketplace listing, technical standards support, and a powerful network of energy sector leaders.
                        </p>
                        <div class="flex flex-col sm:flex-row justify-center gap-5 pt-4">
                            <a href="membership/" class="px-12 py-5 bg-black text-white font-black rounded-2xl text-sm uppercase tracking-widest hover:scale-105 transition-all shadow-2xl inline-flex items-center justify-center gap-3">
                                Become A Member <i data-lucide="user-plus" class="w-5 h-5"></i>
                            </a>
                            <a href="membership/register.php" class="px-12 py-5 bg-white/40 border border-black/10 text-black font-black rounded-2xl text-sm uppercase tracking-widest backdrop-blur-sm hover:bg-white transition-all inline-flex items-center justify-center gap-3">
                                Register <i data-lucide="arrow-right" class="w-5 h-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
