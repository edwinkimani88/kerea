<?php 
$base_url = "../";
$active_page = "about";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/head.php'; ?>
    <title>About KEREA | Kenya Renewable Energy Association</title>
    <meta name="description" content="KEREA is Kenya's peak renewable energy body, formed in 2002 to facilitate growth and development of renewable energy business in Kenya.">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <!-- Hero - Green primary, not black -->
        <section class="relative bg-primary pt-32 pb-48 overflow-hidden">
            <div class="absolute inset-0 opacity-[0.08] pointer-events-none" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 32px 32px;"></div>
            <div class="absolute right-0 top-0 w-1/2 h-full overflow-hidden pointer-events-none">
                <div class="absolute right-0 top-0 w-full h-full bg-gradient-to-l from-black/20 to-transparent"></div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="max-w-3xl space-y-8">
                    <span class="reveal-on-scroll text-black/60 font-black text-[10px] uppercase tracking-[0.4em] block">About KEREA</span>
                    <h1 class="reveal-on-scroll text-5xl sm:text-7xl lg:text-8xl font-black text-black leading-tight tracking-tighter">
                        Who We Are<br>And What We Do
                    </h1>
                    <p class="reveal-on-scroll text-black/70 text-xl sm:text-2xl leading-relaxed font-medium max-w-2xl">
                        An independent non-profit association dedicated to facilitating the growth and development of renewable energy business in Kenya since 2002.
                    </p>
                </div>
            </div>
        </section>

        <!-- Stats Card -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-20 mb-32">
            <div class="reveal-on-scroll bg-white rounded-[3rem] shadow-2xl p-12 sm:p-20 grid grid-cols-1 md:grid-cols-3 gap-16 border border-slate-100">
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center shadow-lg shadow-primary/20">
                            <i data-lucide="history" class="w-7 h-7 text-black"></i>
                        </div>
                        <h4 class="font-black text-slate-900 uppercase tracking-[0.15em] text-xs">Since 2002</h4>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">Over two decades of sector leadership, policy governance, and industry development in East Africa.</p>
                </div>
                <div class="space-y-6 md:border-l md:border-slate-100 md:pl-16">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center shadow-lg shadow-primary/20">
                            <i data-lucide="users" class="w-7 h-7 text-black"></i>
                        </div>
                        <h4 class="font-black text-slate-900 uppercase tracking-[0.15em] text-xs">450+ Members</h4>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">Representing the entire value chain — from manufacturers and distributors to EPC installers.</p>
                </div>
                <div class="space-y-6 md:border-l md:border-slate-100 md:pl-16">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center shadow-lg shadow-primary/20">
                            <i data-lucide="shield-check" class="w-7 h-7 text-black"></i>
                        </div>
                        <h4 class="font-black text-slate-900 uppercase tracking-[0.15em] text-xs">Peak Body</h4>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">The official private sector bridge for public-private dialogue with the Ministry of Energy and EPRA.</p>
                </div>
            </div>
        </section>

        <!-- Full Bio + Image Cluster -->
        <section class="py-32 bg-white border-b border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-32 items-start">
                <div class="space-y-12">
                    <h2 class="reveal-on-scroll text-4xl sm:text-5xl font-black text-slate-900 tracking-tighter leading-tight">National Energy Integration &amp; Vision</h2>
                    <div class="reveal-on-scroll space-y-6 text-slate-600 leading-relaxed font-medium">
                        <p class="text-lg">
                            The Kenya Renewable Energy Association (KEREA) is an independent non-profit association dedicated to facilitating the growth and development of renewable energy business in Kenya.
                        </p>
                        <p>
                            KEREA was formed in August 2002 by members of the Renewable Energy Resources Technical Committee of the Kenya Bureau of Standards (KEBS) and is registered under Section 10 of the Societies Act.
                        </p>
                        <p>
                            Amongst its key roles are promoting the interests of members of the renewable energy industry among government, public sector, the general public and any other organizations that may impact on the development of the industry; and the creation of a forum for the dissemination and exchange of information and ideas on matters relating to renewable energy development and utilization in Kenya.
                        </p>
                    </div>

                    <div class="stagger-reveal grid grid-cols-1 sm:grid-cols-2 gap-8 p-12 bg-primary/8 rounded-[2.5rem] border border-primary/15">
                        <div class="space-y-4">
                            <h4 class="font-black text-primary uppercase text-[10px] tracking-[0.3em]">Our Vision</h4>
                            <p class="text-slate-900 text-sm leading-relaxed font-bold italic">"A sustainable future powered by clean energy for every household and industry in Kenya."</p>
                        </div>
                        <div class="space-y-4">
                            <h4 class="font-black text-primary uppercase text-[10px] tracking-[0.3em]">Our Mission</h4>
                            <p class="text-slate-900 text-sm leading-relaxed font-bold">"To accelerate energy transition through excellence in standards, advocacy, and market development."</p>
                        </div>
                    </div>

                    <div class="reveal-on-scroll flex flex-wrap gap-4">
                        <a href="../member-directory/" class="px-8 py-4 bg-primary text-black font-black rounded-2xl text-sm uppercase tracking-widest hover:-translate-y-1 transition-all shadow-lg shadow-primary/20 inline-flex items-center gap-2">
                            Join KEREA <i data-lucide="user-plus" class="w-4 h-4"></i>
                        </a>
                        <a href="../contact/" class="px-8 py-4 bg-slate-100 text-slate-900 font-black rounded-2xl text-sm uppercase tracking-widest hover:bg-slate-200 transition-all inline-flex items-center gap-2">
                            Contact Us
                        </a>
                    </div>
                </div>

                <!-- Image cluster -->
                <div class="reveal-on-scroll grid grid-cols-2 gap-8 sticky top-32">
                    <div class="space-y-8">
                        <div class="h-96 rounded-[3rem] overflow-hidden shadow-2xl border-4 border-white">
                            <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=400&q=80"
                                 class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" alt="Clean Energy">
                        </div>
                        <div class="h-40 bg-primary rounded-[2.5rem] p-10 flex items-end shadow-xl shadow-primary/25">
                            <span class="text-black font-black text-3xl leading-none tracking-tight">Market<br>Unity</span>
                        </div>
                    </div>
                    <div class="space-y-8 pt-16">
                        <div class="h-40 bg-slate-900 rounded-[2.5rem] p-10 flex items-end shadow-xl">
                            <span class="text-white font-black text-3xl leading-none tracking-tight">Policy<br>Hub</span>
                        </div>
                        <div class="h-96 rounded-[3rem] overflow-hidden shadow-2xl border-4 border-white">
                            <img src="https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=400&q=80"
                                 class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" alt="Solar">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Working Groups Teaser -->
        <section class="py-32 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="reveal-on-scroll text-center max-w-3xl mx-auto mb-20 space-y-6">
                    <span class="text-primary font-black text-[10px] uppercase tracking-[0.4em] block">Collaborative Teams</span>
                    <h2 class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tight leading-tight">KEREA Working Groups</h2>
                    <p class="text-slate-500 text-lg leading-relaxed font-medium">
                        Our working groups bring together experts, businesses, and stakeholders to drive impactful initiatives across Kenya's energy landscape.
                    </p>
                </div>
                <div class="stagger-reveal grid grid-cols-2 sm:grid-cols-3 gap-6">
                    <?php
                    $groups = [
                        ['Advocacy', 'landmark', 'Advocate for favorable policies and regulatory frameworks.'],
                        ['Solar Energy', 'sun', 'Promote the adoption of solar energy technologies.'],
                        ['PURE', 'zap', 'Promote Productive Use of Renewable Energy across sectors.'],
                        ['Wind Energy', 'wind', 'Promote development of the wind energy market.'],
                        ['Geothermal', 'flame-kindling', 'Promote utilization of geothermal resources.'],
                        ['Bio Energy', 'leaf', 'Promote sustainable bioenergy practices and technologies.'],
                    ];
                    foreach($groups as $g):
                    ?>
                    <div class="group bg-white rounded-4xl border border-slate-100 p-8 hover:border-primary/30 hover:shadow-xl transition-all duration-500 flex flex-col gap-5">
                        <div class="w-12 h-12 bg-primary rounded-2xl flex items-center justify-center shadow-md shadow-primary/20">
                            <i data-lucide="<?php echo $g[1]; ?>" class="w-6 h-6 text-black"></i>
                        </div>
                        <h3 class="font-black text-slate-900 text-base"><?php echo $g[0]; ?></h3>
                        <p class="text-slate-500 text-xs leading-relaxed"><?php echo $g[2]; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
