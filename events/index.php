<?php 
$base_url = "../";
$active_page = "about";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/head.php'; ?>
    <title>Institutional Profile | KEREA</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <!-- Hero -->
        <section class="bg-primary pt-24 pb-32 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-1/3 h-full bg-accent/5 skew-x-12 transform translate-x-20"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="max-w-2xl">
                    <span class="text-accent font-black text-[10px] uppercase tracking-[0.2em] block mb-6">Our Mandate</span>
                    <h1 class="text-4xl sm:text-6xl font-black text-white leading-tight mb-8">
                        The Peak Governance Body for <span class="text-gradient">Green Energy</span>
                    </h1>
                    <p class="text-emerald-100/60 text-lg leading-relaxed">
                        KEREA is a non-governmental, non-profit society representing national and international stakeholders across the renewable energy sector in Kenya.
                    </p>
                </div>
            </div>
        </section>

        <!-- Stats Strip -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20 mb-24">
            <div class="bg-white rounded-4xl shadow-2xl p-8 sm:p-12 grid grid-cols-1 md:grid-cols-3 gap-12 border border-slate-100">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-accent/10 rounded-xl flex items-center justify-center"><i data-lucide="history" class="w-5 h-5 text-accent"></i></div>
                        <h4 class="font-bold text-primary">Established 2004</h4>
                    </div>
                    <p class="text-slate-500 text-xs leading-relaxed">Over two decades of sector leadership and policy advocacy in East Africa.</p>
                </div>
                <div class="space-y-4 border-l border-slate-100 pl-0 md:pl-12">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-accent/10 rounded-xl flex items-center justify-center"><i data-lucide="users" class="w-5 h-5 text-accent"></i></div>
                        <h4 class="font-bold text-primary">450+ Corporate Members</h4>
                    </div>
                    <p class="text-slate-500 text-xs leading-relaxed">Representing manufacturers, distributors, and certified technical installers.</p>
                </div>
                <div class="space-y-4 border-l border-slate-100 pl-0 md:pl-12">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-accent/10 rounded-xl flex items-center justify-center"><i data-lucide="shield-check" class="w-5 h-5 text-accent"></i></div>
                        <h4 class="font-bold text-primary">Official Peak Body</h4>
                    </div>
                    <p class="text-slate-500 text-xs leading-relaxed">The primary private sector bridge to the Ministry of Energy and EPRA.</p>
                </div>
            </div>
        </section>

        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="space-y-8">
                    <h2 class="text-3xl sm:text-5xl font-black text-primary tracking-tight">Driving Global Standards in Local Markets</h2>
                    <p class="text-slate-600 text-base leading-relaxed font-medium">
                        KEREA's mission is to foster an enabling environment for the growth of the renewable energy sector. We achieve this through structured advocacy, market development, and promoting quality standards.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 ring-1 ring-slate-100 rounded-3xl p-8 bg-slate-50">
                        <div class="space-y-3">
                            <h4 class="font-black text-primary uppercase text-xs tracking-widest text-emerald-600">Our Vision</h4>
                            <p class="text-slate-600 text-[11px] leading-relaxed italic">"A sustainable future powered by renewable energy solutions that improve livelihoods."</p>
                        </div>
                        <div class="space-y-3">
                            <h4 class="font-black text-primary uppercase text-xs tracking-widest text-emerald-600">Our Mission</h4>
                            <p class="text-slate-600 text-[11px] leading-relaxed">"To foster growth through advocacy, partnerships, and standards promotion."</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-4">
                        <div class="h-64 rounded-3xl overflow-hidden shadow-lg"><img src="https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover grayscale"></div>
                        <div class="h-40 bg-accent rounded-3xl p-8 flex items-end"><span class="text-primary font-black text-xl leading-tight">Sector <br>Integrity</span></div>
                    </div>
                    <div class="space-y-4 pt-12">
                        <div class="h-40 bg-primary rounded-3xl p-8 flex items-end"><span class="text-white font-black text-xl leading-tight">Global <br>Alliances</span></div>
                        <div class="h-64 rounded-3xl overflow-hidden shadow-lg"><img src="https://images.unsplash.com/photo-1548543604-a87a9989fd0f?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover grayscale"></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
