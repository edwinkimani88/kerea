<?php 
$base_url = "../";
$active_page = "marketplace";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/head.php'; ?>
    <title>Renewable Marketplace | KEREA Peak Body</title>
    <style>
        .wishlist-active { color: #ef4444 !important; fill: #ef4444 !important; }
        .product-card { transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1); }
        .filter-active { @apply bg-primary text-black border-primary; }
    </style>
</head>
<body class="bg-[#fcfcfc]">
    <?php include '../includes/header.php'; ?>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-32">
        
        <!-- 1. MARKETPLACE HERO -->
        <section class="reveal-on-scroll relative bg-black min-h-[650px] rounded-[4rem] overflow-hidden flex flex-col justify-center px-10 sm:px-24 py-20 text-white shadow-2xl">
            <!-- Background Image -->
            <div class="absolute right-0 top-0 bottom-0 w-full lg:w-1/2 h-full opacity-30 lg:opacity-100">
                 <img src="https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=1200&q=80" alt="Solar Hardware" class="w-full h-full object-cover">
                 <div class="absolute inset-0 bg-gradient-to-r from-black via-black/80 lg:via-black/30 to-transparent"></div>
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>

            <div class="relative z-10 max-w-3xl space-y-12">
                <div class="inline-flex items-center gap-3 px-6 py-3 bg-white/5 border border-white/10 rounded-2xl text-primary text-[10px] font-black uppercase tracking-[0.4em] backdrop-blur-xl">
                    <i data-lucide="shield-check" class="w-4 h-4 text-primary"></i>
                    Certified Hardware Intelligence
                </div>
                
                <h1 class="text-7xl sm:text-8xl lg:text-9xl font-black tracking-tighter text-white leading-[0.9] italic">
                    KEREA<br><span class="text-primary not-italic stroke-text">Verified.</span>
                </h1>
                
                <p class="text-xl sm:text-2xl text-slate-400 leading-relaxed max-w-xl font-bold">Access the official registry of clean energy equipment vetted for the East African market.</p>

                <div class="flex flex-col sm:flex-row gap-5 pt-12 max-w-2xl">
                    <div class="relative flex-1 group">
                        <i data-lucide="search" class="absolute left-6 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-500 group-focus-within:text-primary transition-colors"></i>
                        <input 
                            type="text" 
                            id="market-search"
                            onkeyup="if(event.key === 'Enter') MarketUI.search(this.value)"
                            placeholder="Search certified equipment..." 
                            class="w-full text-base text-white bg-white/5 border border-white/10 rounded-[2rem] pl-16 pr-8 py-6 focus:outline-none focus:ring-4 focus:ring-primary/20 focus:bg-white/10 transition-all font-bold placeholder-slate-600"
                        >
                    </div>
                    <button onclick="MarketUI.search(document.getElementById('market-search').value)" class="px-12 py-6 bg-primary hover:bg-white text-black font-black text-xs uppercase tracking-[0.2em] rounded-[2rem] transition-all shadow-2xl shadow-primary/25">Explore</button>
                </div>

                <div class="flex flex-wrap items-center gap-x-12 gap-y-6 pt-16 border-t border-white/10 text-[10px] text-slate-500 font-black uppercase tracking-[0.4em]">
                    <span class="flex items-center gap-3"><i data-lucide="zap" class="w-4 h-4 text-primary"></i> Vetted OEM</span>
                    <span class="flex items-center gap-3"><i data-lucide="shield-alert" class="w-4 h-4 text-primary"></i> Standards Compliant</span>
                    <span class="flex items-center gap-3"><i data-lucide="refresh-cw" class="w-4 h-4 text-primary"></i> Live Registry</span>
                </div>
            </div>
        </section>

        <!-- 2. FILTERS bar -->
        <section class="reveal-on-scroll sticky top-24 z-30 bg-white/80 backdrop-blur-2xl border border-slate-100 rounded-[3rem] p-6 shadow-premium flex flex-wrap items-center justify-between gap-6 px-10">
            <div class="flex items-center gap-4 flex-wrap">
                <button onclick="MarketUI.filter('all')" class="cat-filter filter-active px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-slate-100 hover:bg-slate-50 transition-all">All Gears</button>
                <button onclick="MarketUI.filter('Solar')" class="cat-filter px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-slate-100 hover:bg-slate-50 transition-all">Solar Energy</button>
                <button onclick="MarketUI.filter('Cooking')" class="cat-filter px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-slate-100 hover:bg-slate-50 transition-all">Clean Cooking</button>
                <button onclick="MarketUI.filter('Biogas')" class="cat-filter px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-slate-100 hover:bg-slate-50 transition-all">Biogas</button>
            </div>
            <div class="flex items-center gap-6">
                <div class="hidden md:flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    <i data-lucide="layers" class="w-4 h-4"></i> Display:
                    <button onclick="MarketUI.setView('grid')" class="p-2 text-primary hover:bg-slate-50 rounded-lg transition-all"><i data-lucide="layout-grid" class="w-4 h-4"></i></button>
                    <button onclick="MarketUI.setView('list')" class="p-2 text-slate-300 hover:bg-slate-50 rounded-lg transition-all"><i data-lucide="list" class="w-4 h-4"></i></button>
                </div>
                <select onchange="MarketUI.sort(this.value)" class="bg-transparent text-[10px] font-black uppercase tracking-widest outline-none border-b-2 border-slate-100 pb-1 cursor-pointer">
                    <option value="featured">Featured First</option>
                    <option value="low">Price: Low to High</option>
                    <option value="high">Price: High to Low</option>
                </select>
            </div>
        </section>

        <!-- 3. PRODUCT GRID -->
        <section id="product-grid" class="stagger-reveal grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-12">
            <?php 
            include 'products_data.php';
            $placeholder = "https://placehold.co/600x600/39DE4F/000000?text=KEREA+VERIFIED";
            foreach($products as $slug => $p):
            ?>
            <div class="product-card group bg-white rounded-[3.5rem] overflow-hidden hover:shadow-4xl transition-all duration-700 flex flex-col h-full border border-slate-100/50" data-category="<?php echo $p['category']; ?>">
                <div class="relative aspect-[4/5] bg-slate-50 overflow-hidden shrink-0 block">
                    <a href="product/?id=<?php echo $slug; ?>" class="w-full h-full block">
                        <img src="<?php echo $base_url . $p['image']; ?>" 
                             onerror="this.src='<?php echo $placeholder; ?>'"
                             alt="<?php echo $p['name']; ?>" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000">
                    </a>
                    <div class="absolute top-8 right-8 flex flex-col gap-3">
                         <button onclick="MarketUI.toggleWishlist(this)" class="w-12 h-12 bg-white/90 backdrop-blur-md rounded-2xl flex items-center justify-center shadow-xl hover:scale-110 active:scale-95 transition-all">
                            <i data-lucide="heart" class="w-5 h-5 text-slate-400"></i>
                         </button>
                         <button onclick="MarketUI.quickView('<?php echo $slug; ?>')" class="w-12 h-12 bg-white/90 backdrop-blur-md rounded-2xl flex items-center justify-center shadow-xl hover:scale-110 active:scale-95 transition-all">
                            <i data-lucide="eye" class="w-5 h-5 text-slate-400"></i>
                         </button>
                    </div>
                </div>
                <div class="p-10 space-y-6 flex flex-col justify-between flex-1">
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-primary block mb-3"><?php echo $p['distributor']; ?></p>
                        <h3 class="font-black text-xl text-slate-900 group-hover:text-primary transition leading-tight"><?php echo $p['name']; ?></h3>
                    </div>
                    <div class="pt-8 border-t border-slate-50 flex items-center justify-between">
                        <div>
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest leading-none mb-1">MSRP</p>
                            <span class="text-2xl font-black text-slate-900"><?php echo $p['price'] > 0 ? 'KES ' . number_format($p['price']) : 'Get Quote'; ?></span>
                        </div>
                        <button onclick="MarketUI.order('<?php echo $p['name']; ?>')" class="w-16 h-16 bg-slate-900 text-white rounded-3xl hover:bg-primary hover:text-black transition-all flex items-center justify-center shadow-2xl">
                            <i data-lucide="zap" class="w-7 h-7"></i>
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </section>

    </main>

    <?php include '../includes/footer.php'; ?>
    
    <script>
        /**
         * Marketplace UI Interactions
         */
        const MarketUI = {
            search: (query) => {
                if(!query) return;
                const toast = UI.toast('Searching registry for "' + query + '"...', 'info');
                gsap.to('#product-grid', { opacity: 0.5, scale: 0.98, duration: 0.3, onComplete: () => {
                    gsap.to('#product-grid', { opacity: 1, scale: 1, duration: 0.5 });
                }});
            },
            
            filter: (cat) => {
                UI.toast('Filtering for ' + cat + ' equipment...', 'success');
                const cards = document.querySelectorAll('.product-card');
                
                cards.forEach(card => {
                    if (cat === 'all' || card.dataset.category.includes(cat)) {
                        gsap.to(card, { display: 'flex', opacity: 1, scale: 1, duration: 0.6, ease: "back.out(1.7)" });
                    } else {
                        gsap.to(card, { scale: 0.8, opacity: 0, duration: 0.4, onComplete: () => card.style.display = 'none' });
                    }
                });
            },

            sort: (val) => {
                UI.toast('Sorting by ' + val.replace('_', ' '), 'info');
                gsap.to('#product-grid', { y: 20, opacity: 0, duration: 0.3, onComplete: () => {
                    gsap.to('#product-grid', { y: 0, opacity: 1, duration: 0.6 });
                }});
            },

            toggleWishlist: (btn) => {
                const icon = btn.querySelector('i');
                icon.classList.toggle('wishlist-active');
                if(icon.classList.contains('wishlist-active')) {
                    UI.toast('Added to verified collection', 'success');
                    gsap.from(icon, { scale: 1.5, duration: 0.4, ease: "back.out" });
                } else {
                    UI.toast('Removed from collection', 'info');
                }
            },

            order: (name) => {
                UI.toast('Inquiry for ' + name + ' sent to KEREA Escrow', 'success');
            },

            quickView: (id) => {
                UI.toast('Loading quick view analysis...', 'info');
            }
        };

        // Reuse UI.toast logic or similar
        const UI = {
            toast: (msg, type) => {
                const t = document.createElement('div');
                t.className = `fixed bottom-10 right-10 z-[100] px-10 py-6 bg-white rounded-3xl shadow-4xl flex items-center gap-6 border border-slate-100`;
                t.innerHTML = `
                    <div class="w-12 h-12 ${type==='success'?'bg-primary':'bg-slate-900'} rounded-2xl flex items-center justify-center text-white">
                        <i data-lucide="${type==='success'?'check-circle':'info'}" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">KEREA Marketplace</p>
                        <p class="text-sm font-black text-slate-900">${msg}</p>
                    </div>
                `;
                document.body.appendChild(t);
                lucide.createIcons();
                gsap.from(t, { x: 50, opacity: 0, duration: 0.6, ease: "power4.out" });
                setTimeout(() => {
                    gsap.to(t, { x: 50, opacity: 0, duration: 0.4, onComplete: () => t.remove() });
                }, 3000);
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            // Global animations handled in footer.php
        });
    </script>
</body>
</html>
