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
</head>
<body>
    <?php include '../../includes/header.php'; ?>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-12">
            <a href="../../marketplace/" class="hover:text-primary">Marketplace</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <a href="#" class="hover:text-primary"><?php echo $p['category']; ?></a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-primary"><?php echo $p['name']; ?></span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            <!-- Image Gallery -->
            <div class="space-y-6">
                <div class="aspect-square bg-white rounded-4xl border border-slate-100 overflow-hidden shadow-sm relative">
                    <img src="<?php echo $base_url . $p['image']; ?>" class="w-full h-full object-contain p-10">
                    <span class="absolute top-6 left-6 bg-emerald-700 text-white text-[9px] font-black uppercase px-3 py-1 rounded-full shadow-lg">Verified Compliance</span>
                </div>
            </div>

            <!-- Configuration Options -->
            <div class="space-y-10">
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-0.5 bg-accent/10 text-accent font-black text-[9px] uppercase tracking-widest rounded">Inventory Verified</span>
                        <div class="flex text-accent"><i data-lucide="star" class="w-3.5 h-3.5 fill-accent"></i><i data-lucide="star" class="w-3.5 h-3.5 fill-accent"></i><i data-lucide="star" class="w-3.5 h-3.5 fill-accent"></i><i data-lucide="star" class="w-3.5 h-3.5 fill-accent"></i><i data-lucide="star" class="w-3.5 h-3.5 fill-accent"></i></div>
                    </div>
                    <h1 class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tight leading-[1.1]"><?php echo $p['name']; ?></h1>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium"><?php echo $p['description']; ?></p>
                </div>

                <div class="p-8 bg-slate-50 rounded-4xl space-y-6">
                    <div class="flex items-baseline gap-4">
                        <?php if($p['price'] > 0): ?>
                        <span class="text-3xl font-black text-slate-900 tracking-tighter">KES <?php echo number_format($p['price']); ?></span>
                        <span class="text-[10px] font-black text-primary uppercase tracking-widest">Retail Pricing</span>
                        <?php else: ?>
                        <span class="text-3xl font-black text-slate-900 tracking-tighter">Quote on Request</span>
                        <?php endif; ?>
                    </div>
                    <div class="flex gap-4">
                        <a href="https://wa.me/254725280288" target="_blank" class="flex-1 py-4 bg-primary text-black font-black rounded-2xl shadow-xl shadow-primary/20 hover:bg-slate-900 hover:text-white transition-all flex items-center justify-center gap-2">
                            Secure Inquiry <i data-lucide="shield" class="w-4 h-4"></i>
                        </a>
                        <button class="w-14 h-14 bg-white border border-slate-200 rounded-2xl flex items-center justify-center hover:bg-slate-50 transition-colors">
                            <i data-lucide="heart" class="w-5 h-5 text-slate-400"></i>
                        </button>
                    </div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest text-center">Protected by KEREA Escrow & Standards</p>
                </div>

                <!-- Specs Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <?php foreach($p['specs'] as $key => $val): ?>
                    <div class="p-5 bg-white border border-slate-100 rounded-3xl space-y-1">
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest"><?php echo $key; ?></span>
                        <p class="text-sm font-black text-slate-900"><?php echo $val; ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Supplier Profile Small -->
                <div class="flex items-center gap-6 p-6 bg-white border border-slate-100 rounded-4xl shadow-sm">
                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center text-3xl shrink-0"><i data-lucide="store" class="w-8 h-8 text-primary"></i></div>
                    <div class="flex-1 space-y-1">
                        <h4 class="font-black text-slate-900 text-sm uppercase tracking-tight"><?php echo $p['distributor']; ?></h4>
                        <div class="flex items-center gap-4">
                            <span class="text-[9px] font-black text-primary bg-primary/10 px-2 py-0.5 rounded">Verified Vendor</span>
                            <span class="text-[9px] font-black text-slate-400"><i data-lucide="map-pin" class="w-3 h-3 inline"></i> Regional Distributor</span>
                        </div>
                    </div>
                    <a href="../../marketplace/vendor/" class="p-3 bg-slate-50 hover:bg-slate-100 rounded-xl transition-colors"><i data-lucide="arrow-right" class="w-4 h-4 text-primary"></i></a>
                </div>
            </div>
        </div>
    </main>


    <?php include '../../includes/footer.php'; ?>
</body>
</html>
