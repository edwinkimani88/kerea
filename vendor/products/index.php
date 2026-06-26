<?php
$active_page = "vendor_products";
$base_url = "../../";
$dashboard_layout = true;
include_once '../../includes/head.php';
?>
<title>Product Management | Vendor Dashboard</title>

<style>
    .vendor-sidebar {
        @apply fixed left-0 top-0 h-screen w-72 bg-slate-950 text-white z-50 transition-transform duration-300;
    }
    .nav-link {
        @apply flex items-center gap-4 px-6 py-4 text-[11px] font-black uppercase tracking-widest text-slate-400 hover:text-primary hover:bg-white/5 transition-all;
    }
    .nav-link.active {
        @apply text-primary bg-primary/5 border-r-4 border-primary;
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
            <a href="#" class="nav-link">
                <i data-lucide="shopping-cart" class="w-5 h-5"></i> Orders
            </a>
            <a href="#" class="nav-link">
                <i data-lucide="bar-chart-3" class="w-5 h-5"></i> Analytics
            </a>
            <a href="../kyc.php" class="nav-link">
                <i data-lucide="shield-check" class="w-5 h-5"></i> KYC Status
            </a>
            <a href="#" class="nav-link">
                <i data-lucide="settings" class="w-5 h-5"></i> Settings
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 min-h-screen bg-slate-50 lg:ml-72 custom-scrollbar">
        <header class="bg-white/80 backdrop-blur-xl border-b border-slate-100 px-8 py-6 flex flex-col sm:flex-row justify-between items-center gap-4 sticky top-0 z-40">
            <div class="flex items-center gap-4">
                <a href="../dashboard.php?mode=approved" class="p-2 hover:bg-slate-100 rounded-xl transition-colors lg:hidden">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </a>
                <h1 class="text-xl font-black text-black uppercase tracking-tight">Product Catalog</h1>
            </div>
            <a href="create.php" class="w-full sm:w-auto px-8 py-4 bg-primary text-black font-black uppercase text-[10px] tracking-widest rounded-2xl flex items-center justify-center gap-3 hover:bg-black hover:text-white transition-all shadow-xl shadow-primary/20">
                <i data-lucide="plus" class="w-4 h-4"></i> Add New Product
            </a>
        </header>

        <div class="p-8">
            <!-- Toolbar -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                <div class="flex flex-wrap gap-2">
                    <button class="px-5 py-2.5 bg-black text-white text-[10px] font-black uppercase tracking-widest rounded-xl">All Products (42)</button>
                    <button class="px-5 py-2.5 bg-white text-slate-500 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-slate-100 transition-all border border-slate-100">Published (38)</button>
                    <button class="px-5 py-2.5 bg-white text-slate-500 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-slate-100 transition-all border border-slate-100">Drafts (4)</button>
                    <button class="px-5 py-2.5 bg-white text-slate-500 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-slate-100 transition-all border border-slate-100">Archived</button>
                </div>
                <div class="relative w-full md:w-64">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    <input type="text" placeholder="Search by SKU or Name..." class="w-full pl-11 pr-4 py-3 bg-white border border-slate-100 rounded-2xl text-xs focus:ring-2 focus:ring-primary outline-none transition-all">
                </div>
            </div>

            <!-- Products Table with Horizontal Scroll -->
            <div class="bg-white rounded-4xl border border-slate-100 overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[1000px]">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-500">Product Info</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-500">Category</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-500">Inventory</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-500">Price</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-500">Status</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-500 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <?php 
                            $products = [
                                ["name" => "Lumi Power Panel 450W", "sku" => "LP-SOL-450", "cat" => "Solar Panels", "stock" => 124, "price" => "KES 45,000", "status" => "Published"],
                                ["name" => "Gel Deep Cycle Battery 200Ah", "sku" => "BAT-GEL-200", "cat" => "Energy Storage", "stock" => 15, "price" => "KES 32,500", "status" => "Published"],
                                ["name" => "Hybrid Inverter 5KW Single Phase", "sku" => "INV-HYB-5K", "cat" => "Inverters", "stock" => 2, "price" => "KES 142,000", "status" => "Pending Review"],
                                ["name" => "MC4 Connectors (Pair)", "sku" => "ACC-MC4-P", "cat" => "Accessories", "stock" => 540, "price" => "KES 450", "status" => "Published"],
                                ["name" => "Solar Water Pump 2HP", "sku" => "PMP-SOL-2H", "cat" => "Water Systems", "stock" => 0, "price" => "KES 89,000", "status" => "Out of Stock"]
                            ];
                            foreach($products as $p):
                            ?>
                            <tr class="hover:bg-slate-50 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center shrink-0 border border-slate-100 overflow-hidden group-hover:scale-105 transition-transform">
                                            <i data-lucide="image" class="w-6 h-6 text-slate-200"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-black"><?php echo $p['name']; ?></p>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">SKU: <?php echo $p['sku']; ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-2">
                                        <select class="text-[10px] font-black uppercase text-slate-600 bg-slate-50 px-3 py-1.5 rounded-lg border-none focus:ring-1 focus:ring-primary cursor-pointer transition-all">
                                            <option <?php echo ($p['cat'] == 'Solar Panels') ? 'selected' : ''; ?>>Solar Panels</option>
                                            <option <?php echo ($p['cat'] == 'Energy Storage') ? 'selected' : ''; ?>>Energy Storage</option>
                                            <option <?php echo ($p['cat'] == 'Inverters') ? 'selected' : ''; ?>>Inverters</option>
                                            <option <?php echo ($p['cat'] == 'Accessories') ? 'selected' : ''; ?>>Accessories</option>
                                            <option <?php echo ($p['cat'] == 'Water Systems') ? 'selected' : ''; ?>>Water Systems</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-black <?php echo ($p['stock'] < 10) ? 'text-red-500' : 'text-black'; ?>"><?php echo $p['stock']; ?> Units</span>
                                        <div class="w-24 h-1 bg-slate-100 rounded-full mt-2 overflow-hidden">
                                            <div class="h-full bg-primary" style="width: <?php echo min(100, ($p['stock']/200)*100); ?>%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-sm font-black text-black"><?php echo $p['price']; ?></span>
                                </td>
                                <td class="px-8 py-6">
                                    <?php 
                                    $s_class = "bg-green-50 text-green-600";
                                    if($p['status'] == 'Pending Review') $s_class = "bg-orange-50 text-orange-600";
                                    if($p['status'] == 'Out of Stock') $s_class = "bg-red-50 text-red-600";
                                    ?>
                                    <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest <?php echo $s_class; ?>">
                                        <?php echo $p['status']; ?>
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button class="p-2.5 bg-slate-50 text-slate-400 hover:text-black hover:bg-primary transition-all rounded-xl" title="Quick Edit">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </button>
                                        <button class="p-2.5 bg-slate-50 text-slate-400 hover:text-red-500 hover:bg-red-50 transition-all rounded-xl" title="Delete">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                        <button class="p-2.5 bg-slate-50 text-slate-400 hover:text-black hover:bg-slate-200 transition-all rounded-xl">
                                            <i data-lucide="more-vertical" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="p-8 border-t border-slate-50 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Showing 1 to 5 of 42 products</p>
                    <div class="flex gap-2">
                        <button class="w-10 h-10 border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:bg-slate-50"><i data-lucide="chevron-left" class="w-4 h-4"></i></button>
                        <button class="w-10 h-10 bg-black text-white rounded-xl flex items-center justify-center text-xs font-black">1</button>
                        <button class="w-10 h-10 border border-slate-100 rounded-xl flex items-center justify-center text-xs font-black text-slate-600 hover:bg-slate-50">2</button>
                        <button class="w-10 h-10 border border-slate-100 rounded-xl flex items-center justify-center text-xs font-black text-slate-600 hover:bg-slate-50">3</button>
                        <button class="w-10 h-10 border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 hover:bg-slate-50"><i data-lucide="chevron-right" class="w-4 h-4"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    lucide.createIcons();
    
    // Simulate Category assignment logic
    document.querySelectorAll('select').forEach(sel => {
        sel.addEventListener('change', function() {
            // Toast notification mock
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-10 right-10 bg-black text-white px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-2xl z-[9999] animate-bounce';
            toast.innerHTML = 'Category Updated Successfully';
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        });
    });
</script>

<?php include_once '../../includes/footer.php'; ?>
