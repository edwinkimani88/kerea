<?php
$active_page = "vendor_products_create";
$base_url = "../../";
include_once '../../includes/head.php';
?>
<title>Add Product | Vendor Dashboard</title>

<style>
    .vendor-sidebar {
        @apply fixed left-0 top-0 h-screen w-72 bg-slate-950 text-white z-50;
    }
    .nav-link {
        @apply flex items-center gap-4 px-6 py-4 text-[11px] font-black uppercase tracking-widest text-slate-400 hover:text-primary hover:bg-white/5 transition-all;
    }
    .nav-link.active {
        @apply text-primary bg-primary/5 border-r-4 border-primary;
    }
    .form-step-dot {
        @apply w-10 h-10 rounded-2xl flex items-center justify-center font-black text-xs transition-all duration-300;
    }
    .step-active {
        @apply bg-primary text-black scale-110 shadow-lg shadow-primary/20;
    }
    .step-inactive {
        @apply bg-white border border-slate-200 text-slate-400;
    }
    .step-completed {
        @apply bg-green-500 text-white;
    }
</style>

<div class="flex">
    <!-- Sidebar -->
    <aside class="vendor-sidebar hidden lg:block">
        <div class="p-8 border-b border-white/5">
            <a href="<?php echo $base_url; ?>" class="flex items-center gap-3">
                <img src="<?php echo $base_url; ?>assets/kerea-logo-main.png" alt="KEREA" class="h-10 w-auto invert">
                <span class="font-black text-xl tracking-tight text-white uppercase italic">Merchant</span>
            </a>
        </div>
        <nav class="py-10 space-y-2">
            <a href="../dashboard.php?mode=approved" class="nav-link">
                <i data-lucide="grid-3x3" class="w-5 h-5"></i> Dashboard
            </a>
            <a href="index.php" class="nav-link active">
                <i data-lucide="package" class="w-5 h-5"></i> Products
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 h-screen overflow-y-auto bg-slate-50 lg:ml-72 pb-24 custom-scrollbar">
        <header class="bg-white border-b border-slate-100 px-8 py-6 sticky top-0 z-40">
            <div class="flex items-center gap-4">
                <a href="index.php" class="p-2 hover:bg-slate-100 rounded-xl transition-colors">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </a>
                <h1 class="text-xl font-black text-black uppercase tracking-tight">New Marketplace Listing</h1>
            </div>
        </header>

        <div class="p-8">
            <div class="max-w-4xl mx-auto">
                <!-- Step Indicator -->
                <div class="flex justify-between mb-16 relative">
                    <div class="absolute top-5 left-0 w-full h-[2px] bg-slate-200 -z-0"></div>
                    <?php 
                    $steps = ["Info", "Images", "Specs", "Price", "Category", "Preview"];
                    foreach($steps as $i => $step): $num = $i+1;
                    ?>
                    <div class="flex flex-col items-center gap-3 relative z-10" id="step-indicator-<?php echo $num; ?>">
                        <div class="form-step-dot <?php echo ($num==1) ? 'step-active' : 'step-inactive'; ?>"><?php echo $num; ?></div>
                        <span class="text-[9px] font-black uppercase tracking-widest hidden md:block"><?php echo $step; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Form Wizard -->
                <div class="bg-white rounded-4xl border border-slate-100 shadow-xl overflow-hidden min-h-[500px] flex flex-col">
                    <div id="create-wizard-content" class="p-8 md:p-12 flex-1">
                        
                        <!-- Step 1: Info -->
                        <div class="wizard-step" data-step="1">
                            <div class="mb-8">
                                <h2 class="text-2xl font-black text-black mb-2">Basic Information</h2>
                                <p class="text-xs text-slate-400">Give your product a clear, descriptive name.</p>
                            </div>
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500">Product Title</label>
                                    <input type="text" placeholder="e.g. Mono Crystaline Solar Panel 450W" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-primary focus:bg-white outline-none transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500">Product Description</label>
                                    <textarea placeholder="Describe the key features, technology, and benefits..." class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-primary focus:bg-white outline-none transition-all h-40"></textarea>
                                </div>
                                <div class="grid grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-500">Brand / Manufacturer</label>
                                        <input type="text" placeholder="Jinko, Longi, etc." class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-primary focus:bg-white outline-none transition-all">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-500">SKU Number</label>
                                        <input type="text" placeholder="SKU-XXX-001" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-primary focus:bg-white outline-none transition-all">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Images -->
                        <div class="wizard-step hidden" data-step="2">
                            <div class="mb-8">
                                <h2 class="text-2xl font-black text-black mb-2">Product Imagery</h2>
                                <p class="text-xs text-slate-400">Add up to 5 clear photos of the actual product.</p>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="aspect-square bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl flex flex-col items-center justify-center cursor-pointer hover:border-primary hover:bg-primary/5 transition-all group">
                                    <i data-lucide="plus" class="w-8 h-8 text-slate-300 group-hover:text-black"></i>
                                    <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 mt-2">Add Cover</span>
                                </div>
                                <?php for($i=1;$i<=3;$i++): ?>
                                <div class="aspect-square bg-slate-100/50 border border-slate-100 rounded-3xl flex items-center justify-center opacity-30">
                                    <i data-lucide="image" class="w-8 h-8 text-slate-300"></i>
                                </div>
                                <?php endfor; ?>
                            </div>
                            <div class="mt-8 p-6 bg-slate-50 rounded-2xl border border-slate-100">
                                <h4 class="text-[10px] font-black text-black uppercase tracking-widest mb-2">Photography Tips:</h4>
                                <ul class="text-[10px] text-slate-500 space-y-1">
                                    <li>- Use bright, natural lighting</li>
                                    <li>- Plain white or neutral background is preferred</li>
                                    <li>- Show the technical specification sticker on the back</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Step 3: Specs -->
                        <div class="wizard-step hidden" data-step="3">
                             <div class="mb-8">
                                <h2 class="text-2xl font-black text-black mb-2">Technical Specifications</h2>
                                <p class="text-xs text-slate-400">Help buyers understand the technical capability.</p>
                            </div>
                            <div class="space-y-4" id="spec-rows">
                                <div class="grid grid-cols-2 md:grid-cols-12 gap-4">
                                    <div class="md:col-span-5">
                                        <input type="text" placeholder="Attribute (e.g. Wattage)" class="w-full px-6 py-3 bg-slate-50 border border-slate-100 rounded-xl outline-none">
                                    </div>
                                    <div class="md:col-span-5">
                                        <input type="text" placeholder="Value (e.g. 450W)" class="w-full px-6 py-3 bg-slate-50 border border-slate-100 rounded-xl outline-none">
                                    </div>
                                    <div class="md:col-span-2 flex justify-end">
                                        <button class="p-3 text-red-400 hover:text-red-600"><i data-lucide="trash-2" class="w-5 h-5"></i></button>
                                    </div>
                                </div>
                            </div>
                            <button class="mt-6 flex items-center gap-2 text-[10px] font-black text-primary uppercase tracking-widest hover:underline">
                                <i data-lucide="plus-circle" class="w-4 h-4"></i> Add Another Specification
                            </button>
                        </div>

                        <!-- Step 4: Price -->
                        <div class="wizard-step hidden" data-step="4">
                             <div class="mb-8">
                                <h2 class="text-2xl font-black text-black mb-2">Pricing & Availability</h2>
                                <p class="text-xs text-slate-400">Set your competitive market price.</p>
                            </div>
                            <div class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-500">Consumer Price (KES)</label>
                                        <input type="number" placeholder="45,000" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xl font-black focus:ring-2 focus:ring-primary outline-none">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-500">Retail/Wholesale Price (Optional)</label>
                                        <input type="number" placeholder="42,000" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xl font-black focus:ring-2 focus:ring-primary outline-none">
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500">Current Stock Quantity</label>
                                    <input type="number" placeholder="50" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-primary outline-none">
                                </div>
                            </div>
                        </div>

                        <!-- Step 5: Category -->
                        <div class="wizard-step hidden" data-step="5">
                             <div class="mb-8">
                                <h2 class="text-2xl font-black text-black mb-2">Marketplace Category</h2>
                                <p class="text-xs text-slate-400">Where should your product appear?</p>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <?php 
                                $cats = ["Solar Panels", "Inverters", "Energy Storage", "Water Pumping", "Solar Lighting", "Solar Water Heating", "Accessories", "E-Mobility", "Bioenergy"];
                                foreach($cats as $c):
                                ?>
                                <label class="p-6 border border-slate-100 bg-slate-50 rounded-3xl cursor-pointer hover:bg-white hover:border-primary peer-checked:border-primary transition-all flex flex-col items-center gap-3 text-center">
                                    <input type="radio" name="product_cat" class="hidden peer">
                                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm">
                                         <i data-lucide="tag" class="w-4 h-4 text-slate-400"></i>
                                    </div>
                                    <span class="text-xs font-black uppercase tracking-tight text-slate-700"><?php echo $c; ?></span>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Step 6: Review -->
                        <div class="wizard-step hidden" data-step="6">
                             <div class="mb-8">
                                <h2 class="text-2xl font-black text-black mb-2">Final Review</h2>
                                <p class="text-xs text-slate-400">Check everything before publishing.</p>
                            </div>
                            <div class="space-y-8 bg-slate-50 p-8 rounded-4xl border border-slate-100">
                                <div class="flex gap-8 border-b border-slate-200 pb-8">
                                    <div class="w-32 h-32 bg-white rounded-3xl border border-slate-200 flex items-center justify-center shrink-0">
                                        <i data-lucide="image" class="w-10 h-10 text-slate-100"></i>
                                    </div>
                                    <div class="space-y-2">
                                        <h3 class="text-2xl font-black text-black">New Solar Product</h3>
                                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Lumi Energy • SKU Draft</p>
                                        <p class="text-sm font-black text-primary">KES 0.00</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <input type="checkbox" checked class="mt-1 w-5 h-5 accent-primary">
                                    <p class="text-xs text-slate-600 leading-relaxed">I certify that this product meets KEREA safety standards and all provided information is accurate.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Success Screen -->
                        <div id="product-success" class="hidden py-20 text-center animate-in fade-in zoom-in duration-700">
                            <div class="w-24 h-24 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-8 shadow-2xl shadow-green-500/30">
                                <i data-lucide="check" class="w-12 h-12 text-white"></i>
                            </div>
                            <h2 class="text-4xl font-black text-black mb-4">Product Published!</h2>
                            <p class="text-slate-500 mb-10 max-w-sm mx-auto">Your product is now visible on the public KEREA marketplace. No admin approval required.</p>
                            <div class="flex flex-wrap gap-4 justify-center">
                                <a href="<?php echo $base_url; ?>marketplace" class="px-8 py-4 bg-slate-100 text-black font-black uppercase text-xs tracking-widest rounded-2xl hover:bg-slate-200 transition-all flex items-center gap-2">
                                    View in Marketplace
                                </a>
                                <a href="index.php" class="px-8 py-4 bg-black text-white font-black uppercase text-xs tracking-widest rounded-2xl hover:bg-primary hover:text-black transition-all">
                                    Back to Catalog
                                </a>
                            </div>
                        </div>

                    </div>

                    <!-- Footer Nav -->
                    <div id="create-wizard-footer" class="p-8 bg-slate-50 border-t border-slate-100 flex justify-between items-center mt-auto">
                        <button id="step-prev" class="px-8 py-4 text-black font-black uppercase text-[10px] tracking-widest hover:bg-slate-200 rounded-2xl transition-all invisible">Back</button>
                        <button id="step-next" class="px-10 py-4 bg-primary text-black font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-black hover:text-white transition-all shadow-xl shadow-primary/20">Continue</button>
                        <button id="step-publish" class="hidden px-10 py-4 bg-black text-white font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-primary hover:text-black transition-all">Publish To Marketplace</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    let curStep = 1;
    const maxSteps = 6;

    const next = document.getElementById('step-next');
    const prev = document.getElementById('step-prev');
    const publish = document.getElementById('step-publish');
    const content = document.getElementById('create-wizard-content');
    const wizardFooter = document.getElementById('create-wizard-footer');
    const successS = document.getElementById('product-success');

    function updateWizard() {
        document.querySelectorAll('.wizard-step').forEach(s => {
            s.classList.add('hidden');
            if(s.dataset.step == curStep) s.classList.remove('hidden');
        });

        // Indicators
        for(let i=1; i<=maxSteps; i++) {
            const dot = document.querySelector(`#step-indicator-${i} .form-step-dot`);
            if(i < curStep) {
                dot.className = 'form-step-dot step-completed';
                dot.innerHTML = '<i data-lucide="check" class="w-5 h-5"></i>';
            } else if(i == curStep) {
                dot.className = 'form-step-dot step-active';
                dot.innerHTML = i;
            } else {
                dot.className = 'form-step-dot step-inactive';
                dot.innerHTML = i;
            }
        }
        lucide.createIcons();

        prev.classList.toggle('invisible', curStep == 1);
        if(curStep == maxSteps) {
            next.classList.add('hidden');
            publish.classList.remove('hidden');
        } else {
            next.classList.remove('hidden');
            publish.classList.add('hidden');
        }
    }

    next.addEventListener('click', () => {
        if(curStep < maxSteps) { curStep++; updateWizard(); }
    });
    prev.addEventListener('click', () => {
        if(curStep > 1) { curStep--; updateWizard(); }
    });
    publish.addEventListener('click', () => {
        document.querySelectorAll('.wizard-step').forEach(s => s.classList.add('hidden'));
        successS.classList.remove('hidden');
        wizardFooter.classList.add('hidden');
        // Completion state for all
        document.querySelectorAll('.form-step-dot').forEach(d => {
            d.className = 'form-step-dot step-completed';
            d.innerHTML = '<i data-lucide="check" class="w-5 h-5"></i>';
        });
        lucide.createIcons();
    });

    updateWizard();
</script>

<?php include_once '../../includes/footer.php'; ?>
