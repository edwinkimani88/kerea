<?php include 'includes/header.php'; ?>

<div class="space-y-10">
    <div class="flex items-center justify-between">
        <div class="gsap-reveal">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Marketplace Oversight</h2>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Product Inventory & Vetting System</p>
        </div>
        <button onclick="UI.modal.open('add-product-modal')" class="gsap-reveal px-8 py-4 bg-primary text-black rounded-2xl text-xs font-black uppercase tracking-widest hover:scale-105 transition-all shadow-xl shadow-primary/20 flex items-center gap-3">
            <i data-lucide="package-plus" class="w-4 h-4"></i> Add New Product Listing
        </button>
    </div>

    <!-- Inventory Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div class="gsap-reveal card-bg p-8 rounded-[2.5rem] shadow-premium space-y-4 hover:border-primary transition-all cursor-pointer group">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total SKU Count</p>
            <div class="flex items-end justify-between leading-none">
                <span class="text-4xl font-black group-hover:text-primary transition-colors">542</span>
                <span class="text-xs font-bold text-emerald-500">+12%</span>
            </div>
        </div>
        <div class="gsap-reveal card-bg p-8 rounded-[2.5rem] shadow-premium space-y-4 hover:border-red-400 transition-all cursor-pointer group">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest text-red-500">Out of Stock</p>
            <div class="flex items-end justify-between leading-none text-red-500">
                <span class="text-4xl font-black transition-colors">8</span>
                <i data-lucide="alert-circle" class="w-6 h-6 animate-pulse"></i>
            </div>
        </div>
        <div class="gsap-reveal card-bg p-8 rounded-[2.5rem] shadow-premium space-y-4 hover:border-amber-400 transition-all cursor-pointer group">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pending Vetting</p>
            <div class="flex items-end justify-between leading-none text-amber-500">
                <span class="text-4xl font-black transition-colors">15</span>
                <i data-lucide="clock" class="w-6 h-6"></i>
            </div>
        </div>
        <div class="gsap-reveal card-bg p-8 rounded-[2.5rem] shadow-premium space-y-4 hover:border-primary transition-all cursor-pointer group">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Growth Factor</p>
            <div class="flex items-end justify-between leading-none text-primary">
                <span class="text-4xl font-black transition-colors">24%</span>
                <i data-lucide="trending-up" class="w-6 h-6"></i>
            </div>
        </div>
    </div>

    <!-- Product Grid/Table -->
    <div class="gsap-reveal card-bg rounded-[3rem] shadow-premium overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex flex-wrap items-center justify-between gap-6">
            <div class="relative w-full md:w-96">
                <i data-lucide="search" class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                <input id="product-search" type="text" placeholder="Filter by product name, brand or serial..." class="w-full pl-14 pr-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
            </div>
            <div class="flex gap-3">
                <button onclick="UI.toast('Opening Bulk Import wizard...', 'info')" class="px-5 py-3 border border-slate-100 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Bulk CSV Import</button>
                <button onclick="UI.toast('Redirecting to Category Manager...', 'info')" class="px-5 py-3 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-black transition-all">Category Manager</button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Product Info</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Category</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Stock Status</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Inventory Value</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <tr class="product-row hover:bg-slate-50/50 transition-all group" data-name="sayona spc-100 epc sayona africa electric cooking">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-6">
                                <div class="w-16 h-16 rounded-2xl bg-white border border-slate-100 p-2 shadow-sm shrink-0 group-hover:scale-110 transition-transform">
                                    <img src="../assets/Sayona Sayona SPC-100.png" class="w-full h-full object-contain" alt="EPC">
                                </div>
                                <div>
                                    <h4 class="text-sm font-black text-slate-800">Sayona SPC-100 EPC</h4>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Brand: Sayona Africa</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                             <span class="px-3 py-1 bg-amber-50 text-amber-600 rounded-full text-[9px] font-black uppercase">Electric Cooking</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-1 bg-emerald-500 rounded-full"></div>
                                <span class="text-[10px] font-black text-emerald-500 uppercase">In Stock (124)</span>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-black text-slate-800">KSh 7,127</p>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick="UI.modal.open('edit-product-modal')" class="p-2.5 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-primary transition-all shadow-sm">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </button>
                                <button onclick="UI.toast('Product unlisted from marketplace', 'warning')" class="p-2.5 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-red-500 hover:border-red-200 transition-all shadow-sm">
                                    <i data-lucide="eye-off" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="product-row hover:bg-slate-50/50 transition-all group border-l-4 border-red-500 bg-red-50/5" data-name="moto smart gel stove moto safe bio-ethanol">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-6">
                                <div class="w-16 h-16 rounded-2xl bg-white border border-slate-100 p-2 shadow-sm shrink-0">
                                    <img src="../assets/Moto Smart Stove.png" class="w-full h-full object-contain filter grayscale" alt="Stove">
                                </div>
                                <div>
                                    <h4 class="text-sm font-black text-slate-800">Moto Smart Gel Stove</h4>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Brand: Moto Safe</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                             <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[9px] font-black uppercase">Bio-Ethanol</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-1 bg-red-400 rounded-full"></div>
                                <span class="text-[10px] font-black text-red-500 uppercase tracking-widest">Out of Stock</span>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-sm font-black text-slate-800">KSh 1,500</p>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <button onclick="UI.toast('Restock request sent to Moto Safe', 'success')" class="px-4 py-2 bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-primary hover:text-black transition-all shadow-lg">Restock</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="bg-slate-50 p-8 flex justify-between items-center px-10">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">System synchronized with KEREA Master Inventory v3.0</p>
            <div class="flex gap-4">
                <button onclick="UI.toast('Generating PDF Inventory Report...', 'info')" class="px-6 py-3 bg-white border border-slate-100 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-900 hover:text-white transition-all shadow-sm">Inventory Log</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div id="add-product-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-2xl bg-white rounded-[3.5rem] shadow-2xl p-12 space-y-10 relative">
        <div class="absolute top-0 right-0 p-12 opacity-5">
            <i data-lucide="package" class="w-40 h-40"></i>
        </div>
        <div class="flex justify-between items-center relative z-10">
            <div>
                <h3 class="text-3xl font-black text-slate-800 tracking-tight italic uppercase">List New Product</h3>
                <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest mt-1">Marketplace Standards Integration</p>
            </div>
            <button onclick="UI.modal.close('add-product-modal')" class="p-4 bg-slate-50 text-slate-400 hover:text-red-500 rounded-2xl transition-all">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <form id="add-product-form" class="space-y-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest px-2">Official Name</label>
                    <input type="text" required placeholder="Product model name" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none focus:ring-4 focus:ring-primary/10 transition-all">
                </div>
                <div class="space-y-3">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest px-2">Brand / Manufacturer</label>
                    <input type="text" required placeholder="e.g. Sayona" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none focus:ring-4 focus:ring-primary/10 transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest px-2">Sector Category</label>
                    <select class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option>Solar Home Systems</option>
                        <option>Clean Cooking</option>
                        <option>Bio-Digesters</option>
                        <option>Industrial Wind</option>
                    </select>
                </div>
                <div class="space-y-3">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest px-2">KSh Base Price</label>
                    <input type="number" required placeholder="0.00" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none focus:ring-4 focus:ring-primary/10 transition-all">
                </div>
            </div>

            <div class="p-10 bg-slate-50 rounded-[2.5rem] border-2 border-dashed border-slate-200 text-center space-y-4 group cursor-pointer hover:border-primary transition-all">
                <i data-lucide="image-plus" class="w-12 h-12 text-slate-200 mx-auto group-hover:text-primary transition-colors"></i>
                <div>
                    <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest">Hi-Res Product Images</p>
                    <p class="text-[9px] text-slate-300 font-bold uppercase tracking-widest mt-1">Transparent Background Preferred (PNG)</p>
                </div>
            </div>

            <div class="flex gap-6 pt-6">
                <button type="button" onclick="UI.modal.close('add-product-modal')" class="flex-1 py-6 border-2 border-slate-50 text-[11px] font-black uppercase tracking-widest text-slate-300 rounded-[2rem] hover:bg-slate-50 transition-all">Discard Draft</button>
                <button type="submit" class="flex-1 py-6 bg-primary text-black text-[11px] font-black uppercase tracking-widest rounded-[2rem] shadow-2xl shadow-primary/30 hover:scale-105 transition-all">Deploy to Market</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Product Modal -->
<div id="edit-product-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-xl bg-white rounded-[3rem] shadow-2xl p-10 space-y-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-2 bg-primary"></div>
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Edit Product Listing</h3>
                <p class="text-[10px] font-black text-primary uppercase tracking-widest">Inventory Record Update</p>
            </div>
            <button onclick="UI.modal.close('edit-product-modal')" class="p-2 bg-slate-50 text-slate-400 hover:text-red-500 rounded-xl transition-all">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="edit-product-form" class="space-y-6">
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Product Name</label>
                    <input type="text" value="Sayona SPC-100 EPC" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Brand</label>
                    <input type="text" value="Sayona Africa" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Category</label>
                    <select class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option selected>Electric Cooking</option>
                        <option>Solar Home Systems</option>
                        <option>Bio-Ethanol</option>
                        <option>Industrial Wind</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">KSh Price</label>
                    <input type="number" value="7127" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Stock Quantity</label>
                <input type="number" value="124" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
            </div>
            <div class="flex gap-4 pt-4">
                <button type="button" onclick="UI.modal.close('edit-product-modal')" class="flex-1 py-5 border border-slate-100 text-[10px] font-black uppercase text-slate-400 rounded-2xl hover:bg-slate-50 transition-all">Cancel</button>
                <button type="submit" class="flex-1 py-5 bg-primary text-black text-[10px] font-black uppercase rounded-2xl shadow-xl shadow-primary/20 hover:scale-105 transition-all">Update Listing</button>
            </div>
        </form>
    </div>
</div>

<script>
// Live product search
document.getElementById('product-search')?.addEventListener('keyup', function() {
    const query = this.value.toLowerCase();
    const rows = document.querySelectorAll('.product-row');
    let visible = 0;
    rows.forEach(row => {
        const name = (row.dataset.name || '').toLowerCase();
        if (!query || name.includes(query)) {
            row.classList.remove('hidden');
            visible++;
        } else {
            row.classList.add('hidden');
        }
    });

    const empty = document.getElementById('product-empty-state');
    if (empty) empty.classList.toggle('hidden', visible > 0);
});

// Edit product form submit
document.getElementById('edit-product-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = this.querySelector('[type="submit"]');
    btn.disabled = true;
    btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin mx-auto"></i>';
    lucide.createIcons();
    setTimeout(() => {
        UI.toast('Product listing updated successfully ✓', 'success');
        UI.modal.close('edit-product-modal');
        btn.disabled = false;
        btn.innerHTML = 'Update Listing';
    }, 900);
});

// Add product form submit
document.getElementById('add-product-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = this.querySelector('[type="submit"]');
    btn.disabled = true;
    btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin mx-auto"></i>';
    lucide.createIcons();
    setTimeout(() => {
        UI.toast('New product deployed to marketplace! ✓', 'success');
        UI.modal.close('add-product-modal');
        btn.disabled = false;
        btn.innerHTML = 'Deploy to Market';
    }, 1100);
});
</script>

<?php include 'includes/footer.php'; ?>

