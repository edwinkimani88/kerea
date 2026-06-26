<?php 
$base_url = "../../";
$active_page = "marketplace";

include '../products_data.php';
$product_id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$product_id || !isset($products[$product_id])) {
    header("Location: ../");
    exit;
}

$p = $products[$product_id];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../../includes/head.php'; ?>
    <title><?php echo $p['name']; ?> | KEREA Marketplace</title>
    <style>
        .wishlist-active { color: #ef4444 !important; fill: #ef4444 !important; }
        .gallery-active { @apply border-primary shadow-lg ring-4 ring-primary/10; }
    </style>
</head>
<body class="bg-[#fcfcfc]">
    <?php include '../../includes/header.php'; ?>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Breadcrumbs -->
        <nav class="reveal-on-scroll flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.4em] text-slate-400 mb-16 px-4">
            <a href="../../marketplace/" class="hover:text-primary transition-colors">Registry</a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            <span class="text-slate-300"><?php echo $p['category']; ?></span>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            <span class="text-primary italic"><?php echo $p['name']; ?></span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-start">
            <!-- Image Gallery -->
            <div class="reveal-on-scroll space-y-10 lg:sticky lg:top-32">
                <div class="aspect-square bg-white rounded-[4rem] border border-slate-100 overflow-hidden shadow-4xl relative group">
                    <img id="main-product-img" src="<?php echo $base_url . $p['image']; ?>" 
                         onerror="this.src='https://placehold.co/800x800/39DE4F/000000?text=KEREA+ANALYSIS'"
                         class="w-full h-full object-contain p-20 group-hover:scale-105 transition-all duration-1000">
                    
                    <div class="absolute top-10 left-10 bg-slate-900 text-primary text-[11px] font-black uppercase px-6 py-3 rounded-full shadow-2xl tracking-[0.3em] backdrop-blur-2xl italic flex items-center gap-3 border border-white/5">
                        <i data-lucide="shield-check" class="w-4 h-4"></i> Certified Asset
                    </div>

                    <button onclick="ProductUI.toggleWishlist(this)" class="absolute top-10 right-10 w-16 h-16 bg-white/90 backdrop-blur-md rounded-3xl flex items-center justify-center shadow-3xl hover:scale-110 active:scale-95 transition-all group/heart">
                        <i data-lucide="heart" class="w-6 h-6 text-slate-400 group-hover/heart:text-red-500 transition-colors"></i>
                    </button>
                </div>
                
                <div class="flex gap-6 px-4">
                    <div onclick="ProductUI.swapImage(this, '<?php echo $base_url . $p['image']; ?>')" class="gallery-thumb gallery-active w-24 h-24 bg-white border border-slate-100 rounded-3xl p-4 shadow-sm cursor-pointer hover:border-primary transition-all">
                         <img src="<?php echo $base_url . $p['image']; ?>" class="w-full h-full object-contain">
                    </div>
                </div>
            </div>

            <!-- Configuration Options -->
            <div class="reveal-on-scroll space-y-16">
                <div class="space-y-8">
                    <div class="flex items-center gap-5">
                        <span class="px-5 py-2 bg-emerald-100 text-emerald-700 font-black text-[10px] uppercase tracking-[0.3em] rounded-full flex items-center gap-2">
                             <i data-lucide="check" class="w-4 h-4"></i> Tier 1 Verified
                        </span>
                        <div class="flex text-amber-400 gap-1"><i data-lucide="star" class="w-4 h-4 fill-amber-400"></i><i data-lucide="star" class="w-4 h-4 fill-amber-400"></i><i data-lucide="star" class="w-4 h-4 fill-amber-400"></i><i data-lucide="star" class="w-4 h-4 fill-amber-400"></i><i data-lucide="star" class="w-4 h-4 fill-amber-400"></i></div>
                    </div>
                    <h1 class="text-5xl sm:text-7xl font-black text-slate-900 tracking-tighter leading-[0.9] italic uppercase uppercase"><?php echo $p['name']; ?></h1>
                    <p class="text-xl text-slate-500 leading-relaxed font-bold border-l-8 border-primary/20 pl-10 max-w-2xl"><?php echo $p['description']; ?></p>
                </div>

                <div class="p-12 bg-slate-900 rounded-[4rem] space-y-12 shadow-premium text-white relative overflow-hidden group">
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-primary/20 rounded-full blur-[100px] transition-transform duration-1000 group-hover:scale-150"></div>
                    
                    <div class="flex items-center justify-between relative z-10">
                        <div class="space-y-2">
                            <p class="text-[11px] font-black text-slate-500 uppercase tracking-[0.4em]">Official Market Price</p>
                            <h4 class="text-5xl font-black text-primary tracking-tighter italic">
                                <?php echo $p['price'] > 0 ? 'KES ' . number_format($p['price']) : 'Escrow Quote Required'; ?>
                            </h4>
                        </div>
                        <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center text-slate-400 border border-white/10">
                            <i data-lucide="trending-up" class="w-8 h-8"></i>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-6 relative z-10">
                        <button onclick="ProductUI.openOrder()" class="flex-1 py-8 bg-primary text-black font-black rounded-[2rem] shadow-2xl shadow-primary/30 hover:bg-white hover:scale-[1.02] transition-all flex items-center justify-center gap-5 text-xs uppercase tracking-[0.3em]">
                            Initialize Purchase <i data-lucide="zap" class="w-6 h-6"></i>
                        </button>
                        <button onclick="ProductUI.share()" class="w-24 h-24 bg-white/5 border border-white/10 rounded-[2rem] flex items-center justify-center hover:bg-white hover:text-black transition-all group/share">
                            <i data-lucide="send" class="w-7 h-7 group-hover/share:-rotate-12 transition-transform"></i>
                        </button>
                    </div>
                    <div class="flex items-center justify-center gap-8 relative z-10 pt-4 opacity-40">
                         <span class="text-[9px] font-black uppercase tracking-widest flex items-center gap-2"><i data-lucide="shield" class="w-3.5 h-3.5"></i> Standards Met</span>
                         <span class="text-[9px] font-black uppercase tracking-widest flex items-center gap-2"><i data-lucide="lock" class="w-3.5 h-3.5"></i> Escrow Ready</span>
                    </div>
                </div>

                <!-- Specs Grid -->
                <div class="space-y-10">
                    <h3 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.6em] px-4 border-l-4 border-slate-100">Technical Analysis</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 stagger-reveal">
                        <?php foreach($p['specs'] as $key => $val): ?>
                        <div class="group p-10 bg-white border border-slate-100 rounded-[3rem] space-y-3 hover:border-primary/40 transition-all shadow-sm hover:shadow-2xl">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] group-hover:text-primary transition-colors"><?php echo $key; ?></span>
                            <p class="text-2xl font-black text-slate-900 leading-none"><?php echo $val; ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Supplier Profile -->
                <div onclick="UI.toast('Redirecting to Steward Profile for <?php echo $p['distributor']; ?>...', 'info'); setTimeout(()=>window.location.href='../../marketplace/vendor/view.php?id=sayona-africa', 500)" class="flex items-center gap-10 p-12 bg-white border border-slate-100 rounded-[4rem] shadow-premium group hover:border-primary/30 transition-all cursor-pointer">
                    <div class="w-24 h-24 bg-slate-900 rounded-[2.5rem] flex items-center justify-center shrink-0 shadow-3xl rotate-3 group-hover:rotate-0 transition-all duration-700">
                        <i data-lucide="briefcase" class="w-12 h-12 text-primary"></i>
                    </div>
                    <div class="flex-1 space-y-3">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em]">Official Steward</p>
                        <h4 class="font-black text-slate-900 text-3xl tracking-tighter italic uppercase"><?php echo $p['distributor']; ?></h4>
                        <div class="flex items-center gap-8">
                            <span class="text-[10px] font-black text-emerald-600 uppercase flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Accreditation: Platinum</span>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2"><i data-lucide="map-pin" class="w-3.5 h-3.5"></i> Regional Hub</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-slate-50 group-hover:bg-primary group-hover:text-black rounded-full flex items-center justify-center transition-all shadow-sm"><i data-lucide="chevron-right" class="w-8 h-8"></i></div>
                </div>
            </div>
        </div>
    </main>

    <!-- Order Modal -->
    <div id="order-modal" class="modal-overlay hidden fixed inset-0 z-[100] items-center justify-center p-6 bg-slate-900/60 backdrop-blur-2xl">
        <div class="bg-white rounded-[4rem] w-full max-w-2xl p-14 shadow-4xl space-y-10 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-3 bg-primary"></div>
            <div class="flex justify-between items-start">
                <div class="space-y-3">
                    <h3 class="text-4xl font-black italic uppercase tracking-tighter leading-none">Market Inquiry</h3>
                    <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest">Product SKU: KRE-<?php echo strtoupper(substr($product_id, 0, 8)); ?></p>
                </div>
                <button onclick="ProductUI.closeOrder()" class="p-4 bg-slate-50 text-slate-400 hover:text-red-500 rounded-3xl transition-all"><i data-lucide="x" class="w-7 h-7"></i></button>
            </div>
            
            <form onsubmit="event.preventDefault(); ProductUI.submitOrder();" class="space-y-8">
                <div class="grid grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] px-4">Organization</label>
                        <input type="text" required placeholder="Business Name" class="w-full px-8 py-5 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none focus:ring-4 focus:ring-primary/10 transition-all">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] px-4">Unit Quantity</label>
                        <input type="number" value="1" min="1" required class="w-full px-8 py-5 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none focus:ring-4 focus:ring-primary/10 transition-all">
                    </div>
                </div>
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.4em] px-4">Technical Requirements</label>
                    <textarea rows="4" placeholder="Mention any specific certifications or logistics requirements needed for this deployment..." class="w-full px-8 py-5 bg-slate-50 border border-slate-100 rounded-3xl text-sm font-bold outline-none focus:ring-4 focus:ring-primary/10 transition-all"></textarea>
                </div>
                <button type="submit" class="w-full py-7 bg-slate-900 text-white rounded-3xl font-black uppercase text-xs tracking-[0.5em] shadow-4xl hover:bg-primary hover:text-black transition-all hover:translate-y-[-4px]">Dispatch Quote Request</button>
            </form>
        </div>
    </div>

    <?php include '../../includes/footer.php'; ?>
    
    <script>
        const ProductUI = {
            swapImage: (thumb, src) => {
                document.querySelectorAll('.gallery-thumb').forEach(t => t.classList.remove('gallery-active'));
                thumb.classList.add('gallery-active');
                
                const main = document.getElementById('main-product-img');
                gsap.to(main, { opacity: 0, scale: 0.9, duration: 0.3, onComplete: () => {
                    main.src = src;
                    gsap.to(main, { opacity: 1, scale: 1, duration: 0.6, ease: "back.out(1.7)" });
                }});
            },
            toggleWishlist: (btn) => {
                const icon = btn.querySelector('i');
                icon.classList.toggle('wishlist-active');
                if(icon.classList.contains('wishlist-active')) {
                    UI.toast('Product saved to your verified collection', 'success');
                } else {
                    UI.toast('Product removed from collection', 'info');
                }
            },
            share: () => {
                UI.toast('Intel link copied to clipboard', 'success');
            },
            openOrder: () => {
                const modal = document.getElementById('order-modal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                gsap.from('#order-modal > div', { scale: 0.8, opacity: 0, duration: 0.7, ease: "expo.out" });
            },
            closeOrder: () => {
                const modal = document.getElementById('order-modal');
                gsap.to('#order-modal > div', { scale: 0.8, opacity: 0, duration: 0.4, onComplete: () => {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }});
            },
            submitOrder: () => {
                UI.toast('Inquiry encrypted and successfully dispatched', 'success');
                ProductUI.closeOrder();
            }
        };

        const UI = {
            toast: (msg, type) => {
                const t = document.createElement('div');
                t.className = `fixed bottom-10 right-10 z-[200] px-10 py-6 bg-white rounded-3xl shadow-4xl flex items-center gap-6 border border-slate-100`;
                t.innerHTML = `
                    <div class="w-14 h-14 ${type==='success'?'bg-primary':'bg-slate-900'} rounded-2xl flex items-center justify-center text-white">
                        <i data-lucide="${type==='success'?'check-circle':'info'}" class="w-7 h-7"></i>
                    </div>
                    <div>
                        <p class="text-[11px] font-black text-slate-300 uppercase tracking-widest">KEREA Intelligence</p>
                        <p class="text-base font-black text-slate-900 tracking-tight">${msg}</p>
                    </div>
                `;
                document.body.appendChild(t);
                lucide.createIcons();
                gsap.from(t, { x: 50, opacity: 0, duration: 0.8, ease: "power4.out" });
                setTimeout(() => {
                    gsap.to(t, { x: 50, opacity: 0, duration: 0.4, onComplete: () => t.remove() });
                }, 4000);
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            // Global animations handled in footer.php
        });
    </script>
</body>
</html>
