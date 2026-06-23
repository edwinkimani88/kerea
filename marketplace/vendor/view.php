<?php 
$base_url = "../../";
$active_page = "marketplace";

include '../vendor_data.php';
$vendor_id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$vendor_id || !isset($vendors[$vendor_id])) {
    header("Location: ./");
    exit;
}

$v = $vendors[$vendor_id];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../../includes/head.php'; ?>
    <title><?php echo $v['name']; ?> | Steward Profile | KEREA</title>
</head>
<body class="bg-[#fcfcfc]">
    <?php include '../../includes/header.php'; ?>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Breadcrumbs -->
        <nav class="gsap-reveal flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.4em] text-slate-400 mb-20 px-4">
            <a href="../" class="hover:text-primary transition-colors">Marketplace</a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            <a href="./" class="hover:text-primary transition-colors">Steward Directory</a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            <span class="text-primary italic"><?php echo $v['name']; ?></span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            <!-- Sidebar Info -->
            <div class="gsap-reveal lg:col-span-4 space-y-10 lg:sticky lg:top-32 h-fit">
                <div class="bg-white p-12 rounded-[4rem] border border-slate-100 shadow-premium text-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-primary/5 opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                    <div class="w-44 h-44 bg-slate-900 rounded-[3.5rem] flex items-center justify-center text-8xl mx-auto mb-10 shadow-3xl relative z-10 text-primary group-hover:rotate-6 transition-transform duration-700 font-black">
                        <?php echo $v['icon']; ?>
                    </div>
                    <h1 class="text-4xl font-black text-slate-900 mb-8 tracking-tighter leading-none relative z-10 uppercase italic"><?php echo $v['name']; ?></h1>
                    
                    <button onclick="UI.toast('Compliance: Active. Verification #KRE-<?php echo strtoupper(substr($vendor_id, 0, 4)); ?>', 'success')" class="inline-flex items-center gap-3 px-6 py-3 bg-emerald-100 text-emerald-700 rounded-full text-[11px] font-black uppercase tracking-widest relative z-10 hover:bg-emerald-200 transition-colors shadow-sm">
                        <i data-lucide="shield-check" class="w-4 h-4"></i> Verified Elite 2026
                    </button>
                </div>

                <div class="bg-slate-900 text-white p-12 rounded-[4rem] space-y-10 shadow-premium relative overflow-hidden group">
                    <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-primary/20 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <h3 class="text-2xl font-black italic text-primary uppercase border-l-4 border-primary pl-6">Communication</h3>
                    <div class="space-y-10 relative z-10">
                        <div onclick="UI.toast('Connecting to secure merchant terminal...', 'info')" class="flex items-center gap-6 cursor-pointer group/item">
                            <div class="w-14 h-14 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center text-primary shadow-inner group-hover/item:bg-white group-hover/item:text-black transition-all"><i data-lucide="phone" class="w-7 h-7"></i></div>
                            <div>
                                <p class="text-[10px] text-slate-500 font-black uppercase tracking-[0.4em] mb-1">Direct Line</p>
                                <p class="font-black text-xl tracking-tight"><?php echo $v['phone'] ?? '0700 000 000'; ?></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6">
                            <div class="w-14 h-14 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center text-primary shadow-inner"><i data-lucide="map-pin" class="w-7 h-7"></i></div>
                            <div>
                                <p class="text-[10px] text-slate-500 font-black uppercase tracking-[0.4em] mb-1">HQ Operations</p>
                                <p class="font-black text-xl tracking-tight"><?php echo $v['location'] ?? 'Nairobi, KE'; ?></p>
                            </div>
                        </div>
                    </div>
                    <button onclick="VendorUI.openInquiry()" class="relative z-10 block w-full py-6 bg-primary text-black text-center font-black uppercase tracking-[0.4em] text-[11px] rounded-[2rem] hover:bg-white hover:scale-105 transition-all shadow-2xl shadow-primary/25">Send Deployment Inquiry</button>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-8 space-y-20">
                <div class="gsap-reveal bg-white p-16 rounded-[4.5rem] border border-slate-100 shadow-premium space-y-16">
                    <div class="space-y-10">
                        <div class="flex items-center gap-10">
                            <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase italic whitespace-nowrap">Organization Memo</h2>
                            <div class="h-1 bg-slate-50 flex-1 rounded-full"></div>
                        </div>
                        <p class="text-2xl text-slate-500 leading-relaxed font-bold italic max-w-4xl">
                            "<?php echo $v['description']; ?>"
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-16 pt-16 border-t-2 border-slate-50">
                        <div class="space-y-6">
                            <h4 class="text-[11px] font-black uppercase tracking-[0.5em] text-primary">Core Specialization</h4>
                            <div class="p-8 bg-slate-50 rounded-[2.5rem] border border-slate-100 italic font-black text-xl text-slate-800 shadow-inner">
                                <?php echo $v['specialization']; ?>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <h4 class="text-[11px] font-black uppercase tracking-[0.5em] text-primary">KEREA Integrity Score</h4>
                            <div class="p-8 bg-slate-900 rounded-[2.5rem] text-white shadow-2xl relative overflow-hidden">
                                <div class="absolute inset-0 bg-primary/10 opacity-50"></div>
                                <div class="relative z-10 flex items-center justify-between">
                                    <span class="text-4xl font-black">9.8</span>
                                    <div class="text-right">
                                        <p class="text-[10px] font-black uppercase tracking-widest text-primary">Platinum</p>
                                        <p class="text-[9px] font-bold text-slate-400">Class: Alpha-1</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inventory -->
                <div class="space-y-12">
                    <div class="gsap-reveal flex items-center justify-between px-8">
                        <h3 class="text-3xl font-black text-slate-900 tracking-tighter uppercase italic">Vetted Solutions Stockpile</h3>
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded-full bg-primary animate-pulse"></span>
                            <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Registry Sync v4.1</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 stagger-reveal">
                        <?php 
                        include '../products_data.php';
                        $count = 0;
                        foreach($products as $pid => $p):
                            if(strpos($p['distributor'], $v['name']) !== false):
                                $count++;
                        ?>
                        <div onclick="UI.toast('Redirecting to deep analysis for <?php echo $p['name']; ?>...', 'info'); location.href='../product/?id=<?php echo $pid; ?>'" class="bg-white p-10 rounded-[3.5rem] border border-slate-100 flex items-center gap-10 group hover:shadow-4xl hover:border-primary/30 transition-all duration-700 cursor-pointer relative overflow-hidden">
                            <div class="absolute -right-4 -bottom-4 opacity-[0.03] group-hover:rotate-12 transition-transform">
                                <i data-lucide="package" class="w-24 h-24"></i>
                            </div>
                            <div class="w-28 h-28 bg-slate-50 rounded-[2.5rem] overflow-hidden shrink-0 group-hover:scale-110 transition-all duration-700 p-4 border border-slate-100 shadow-inner">
                                <img src="<?php echo $base_url . $p['image']; ?>" 
                                     onerror="this.src='https://placehold.co/400x400/39DE4F/000000?text=UNIT'"
                                     class="w-full h-full object-contain">
                            </div>
                            <div class="flex-1 space-y-4 relative z-10">
                                <span class="text-[9px] font-black text-primary uppercase tracking-[0.3em]">Code: <?php echo strtoupper(substr($pid, 0, 6)); ?></span>
                                <h4 class="font-black text-xl text-slate-900 group-hover:text-primary transition leading-none"><?php echo $p['name']; ?></h4>
                                <div class="flex items-center gap-2 pt-2">
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-slate-900 transition-colors">Inspect Unit</span>
                                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300 group-hover:text-primary transition-all"></i>
                                </div>
                            </div>
                        </div>
                        <?php 
                            endif;
                        endforeach; 
                        
                        if($count == 0):
                        ?>
                        <div class="col-span-2 p-24 bg-slate-50 border-4 border-dashed border-slate-200 rounded-[4rem] text-center text-slate-400 font-black space-y-6 group">
                            <i data-lucide="package-search" class="w-16 h-16 mx-auto opacity-10 group-hover:scale-110 transition-transform"></i>
                            <div class="space-y-2">
                                <p class="text-xl italic uppercase tracking-tighter">Catalogue Secured</p>
                                <p class="text-[11px] font-bold uppercase tracking-widest opacity-60">High-volume inventory and institutional blueprints are exclusively available<br>via secure deployment inquiry.</p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Inquiry Modal -->
    <div id="inquiry-modal" class="modal-overlay hidden fixed inset-0 z-[100] items-center justify-center p-6 bg-slate-900/40 backdrop-blur-xl">
        <div class="bg-white rounded-[4rem] w-full max-w-2xl p-12 shadow-4xl space-y-10 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-3 bg-primary"></div>
            <div class="flex justify-between items-start">
                <div class="space-y-2">
                    <h3 class="text-4xl font-black italic uppercase tracking-tighter">Service Request</h3>
                    <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest">Routing to: <?php echo $v['name']; ?></p>
                </div>
                <button onclick="VendorUI.closeInquiry()" class="p-4 bg-slate-50 text-slate-400 hover:text-red-500 rounded-3xl transition-all"><i data-lucide="x" class="w-6 h-6"></i></button>
            </div>
            
            <form onsubmit="event.preventDefault(); VendorUI.submitInquiry();" class="space-y-8">
                <div class="grid grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] px-4">Contact Person</label>
                        <input type="text" required placeholder="Full Name" class="w-full px-8 py-5 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none focus:ring-4 focus:ring-primary/10 transition-all">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] px-4">Corporate Email</label>
                        <input type="email" required placeholder="name@domain.com" class="w-full px-8 py-5 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none focus:ring-4 focus:ring-primary/10 transition-all">
                    </div>
                </div>
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] px-4">Scope of Interest</label>
                    <textarea rows="4" required placeholder="Describe your project, volume requirements or technical specs needed..." class="w-full px-8 py-5 bg-slate-50 border border-slate-100 rounded-3xl text-sm font-bold outline-none focus:ring-4 focus:ring-primary/10 transition-all"></textarea>
                </div>
                <button type="submit" class="w-full py-6 bg-slate-900 text-white rounded-3xl font-black uppercase text-xs tracking-[0.5em] shadow-3xl hover:bg-primary hover:text-black transition-all hover:scale-[1.02]">Bridge Connection</button>
            </form>
        </div>
    </div>

    <?php include '../../includes/footer.php'; ?>
    
    <script>
        const VendorUI = {
            openInquiry: () => {
                const modal = document.getElementById('inquiry-modal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                gsap.from('#inquiry-modal > div', { scale: 0.9, opacity: 0, duration: 0.6, ease: "power4.out" });
            },
            closeInquiry: () => {
                const modal = document.getElementById('inquiry-modal');
                gsap.to('#inquiry-modal > div', { scale: 0.9, opacity: 0, duration: 0.4, onComplete: () => {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }});
            },
            submitInquiry: () => {
                UI.toast('Inquiry encrypted and dispatched to <?php echo $v['name']; ?>', 'success');
                VendorUI.closeInquiry();
            }
        };

        const UI = {
            toast: (msg, type) => {
                const t = document.createElement('div');
                t.className = `fixed bottom-10 right-10 z-[100] px-10 py-6 bg-white rounded-3xl shadow-4xl flex items-center gap-6 border border-slate-100`;
                t.innerHTML = `
                    <div class="w-12 h-12 ${type==='success'?'bg-primary':'bg-slate-900'} rounded-2xl flex items-center justify-center text-white">
                        <i data-lucide="${type==='success'?'check-circle':'info'}" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Merchant Intelligence</p>
                        <p class="text-sm font-black text-slate-900">${msg}</p>
                    </div>
                `;
                document.body.appendChild(t);
                lucide.createIcons();
                gsap.from(t, { x: 50, opacity: 0, duration: 0.6, ease: "power4.out" });
                setTimeout(() => {
                    gsap.to(t, { x: 50, opacity: 0, duration: 0.4, onComplete: () => t.remove() });
                }, 3500);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            gsap.registerPlugin(ScrollTrigger);
            gsap.utils.toArray('.gsap-reveal').forEach(el => {
                gsap.from(el, { opacity: 0, y: 50, duration: 1.2, ease: "expo.out", scrollTrigger: { trigger: el, start: "top 90%" } });
            });
            gsap.from('.stagger-reveal > div', { opacity: 0, scale: 0.95, stagger: 0.1, duration: 1.2, ease: "expo.out", scrollTrigger: { trigger: '.stagger-reveal', start: "top 85%" } });
        });
    </script>
</body>
</html>
