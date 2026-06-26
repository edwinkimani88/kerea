<?php include 'includes/header.php'; ?>

<div class="space-y-10">
    <div class="flex items-center justify-between">
        <div class="gsap-reveal">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Marketplace Categories</h2>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Taxonomy & Product Organization Manager</p>
        </div>
        <button onclick="UI.modal.open('add-category-modal')" class="gsap-reveal px-8 py-4 bg-primary text-black rounded-2xl text-xs font-black uppercase tracking-widest hover:scale-105 transition-all shadow-xl shadow-primary/20 flex items-center gap-3">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Add New Category
        </button>
    </div>

    <!-- Category Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 gsap-reveal">
        <?php 
        $categories = [
            ["name" => "Solar Panels", "products" => 142, "icon" => "sun", "color" => "text-yellow-500", "bg" => "bg-yellow-50"],
            ["name" => "Energy Storage", "products" => 85, "icon" => "battery-charging", "color" => "text-green-500", "bg" => "bg-green-50"],
            ["name" => "Inverters", "products" => 64, "icon" => "zap", "color" => "text-blue-500", "bg" => "bg-blue-50"],
            ["name" => "Wind Energy", "products" => 12, "icon" => "wind", "color" => "text-cyan-500", "bg" => "bg-cyan-50"],
            ["name" => "Bio-Digesters", "products" => 34, "icon" => "flame", "color" => "text-orange-500", "bg" => "bg-orange-50"],
            ["name" => "Accessories", "products" => 210, "icon" => "layers", "color" => "text-slate-500", "bg" => "bg-slate-50"]
        ];
        foreach($categories as $cat):
        ?>
        <div class="card-bg p-8 rounded-4xl border border-slate-100 shadow-sm hover:shadow-xl transition-all group relative overflow-hidden">
            <div class="absolute -right-4 -top-4 opacity-5 group-hover:rotate-12 transition-transform">
                <i data-lucide="<?php echo $cat['icon']; ?>" class="w-32 h-32"></i>
            </div>
            <div class="flex items-start justify-between mb-8 relative z-10">
                <div class="w-16 h-16 <?php echo $cat['bg']; ?> <?php echo $cat['color']; ?> rounded-2xl flex items-center justify-center">
                    <i data-lucide="<?php echo $cat['icon']; ?>" class="w-8 h-8"></i>
                </div>
                <div class="flex gap-2">
                    <button onclick="UI.modal.open('edit-category-modal')" class="p-2.5 bg-slate-50 text-slate-400 hover:text-primary rounded-xl transition-all">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                    </button>
                    <button class="p-2.5 bg-slate-50 text-slate-400 hover:text-red-500 rounded-xl transition-all">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
            <div class="relative z-10">
                <h3 class="text-xl font-black text-black mb-1"><?php echo $cat['name']; ?></h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest"><?php echo $cat['products']; ?> Active Listings</p>
            </div>
            <div class="mt-8 flex justify-between items-center pt-6 border-t border-slate-50">
                <a href="products.php?category=<?php echo $cat['name']; ?>" class="text-[10px] font-black text-primary uppercase tracking-widest hover:underline">Manage Products</a>
                <div class="flex -space-x-2">
                    <div class="w-6 h-6 rounded-full bg-slate-200 border-2 border-white"></div>
                    <div class="w-6 h-6 rounded-full bg-slate-300 border-2 border-white"></div>
                    <div class="w-6 h-6 rounded-full bg-slate-400 border-2 border-white"></div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Add Category Modal -->
<div id="add-category-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-xl bg-white rounded-[3.5rem] shadow-2xl p-10 space-y-8 relative">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Add New Category</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Marketplace Expansion</p>
            </div>
            <button onclick="UI.modal.close('add-category-modal')" class="p-3 bg-slate-50 text-slate-400 hover:text-red-500 rounded-2xl transition-all">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>
        <form class="space-y-6" onsubmit="event.preventDefault(); UI.toast('Category created successfully', 'success'); UI.modal.close('add-category-modal')">
            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 px-2">Category Name</label>
                <input type="text" placeholder="e.g. E-Mobility" required class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:ring-4 focus:ring-primary/10 outline-none transition-all">
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 px-2">Assigned Icon</label>
                    <select class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option>Sun (Solar)</option>
                        <option>Battery</option>
                        <option>Wind</option>
                        <option>Flame</option>
                        <option>Box</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 px-2">Base Color</label>
                    <select class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option>Emerald Green</option>
                        <option>Amber Orange</option>
                        <option>Royal Blue</option>
                        <option>Slate Grey</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="w-full py-6 bg-black text-white text-[11px] font-black uppercase tracking-widest rounded-3xl hover:bg-primary hover:text-black transition-all shadow-xl shadow-black/10 mt-4">
                Confirm & Create Category
            </button>
        </form>
    </div>
</div>

<!-- Edit Category Modal -->
<div id="edit-category-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-xl bg-white rounded-[3.5rem] shadow-2xl p-10 space-y-8 relative">
        <div class="flex justify-between items-center">
            <h3 class="text-2xl font-black text-slate-800 tracking-tight">Edit Category</h3>
            <button onclick="UI.modal.close('edit-category-modal')" class="p-3 bg-slate-50 text-slate-400 hover:text-red-500 rounded-2xl transition-all">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>
        <form class="space-y-6" onsubmit="event.preventDefault(); UI.toast('Category updated successfully', 'success'); UI.modal.close('edit-category-modal')">
            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 px-2">Category Name</label>
                <input type="text" value="Solar Panels" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:ring-4 focus:ring-primary/10 outline-none transition-all">
            </div>
            <button type="submit" class="w-full py-6 bg-primary text-black text-[11px] font-black uppercase tracking-widest rounded-3xl hover:bg-black hover:text-white transition-all shadow-xl shadow-primary/20 mt-4">
                Save Adjustments
            </button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
