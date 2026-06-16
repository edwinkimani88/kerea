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
    <title><?php echo $v['name']; ?> | Vendor Profile | KEREA</title>
</head>
<body class="bg-slate-50">
    <?php include '../../includes/header.php'; ?>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-12">
            <a href="../" class="hover:text-primary">Marketplace</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <a href="./" class="hover:text-primary">Vendors</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-primary"><?php echo $v['name']; ?></span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Sidebar Info -->
            <div class="lg:col-span-4 space-y-8">
                <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm text-center">
                    <div class="w-32 h-32 bg-slate-50 rounded-4xl flex items-center justify-center text-7xl mx-auto mb-8 shadow-inner">
                        <?php echo $v['icon']; ?>
                    </div>
                    <h1 class="text-3xl font-black text-black mb-4"><?php echo $v['name']; ?></h1>
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-100">
                        <i data-lucide="shield-check" class="w-3 h-3"></i> Verified Member
                    </div>
                </div>

                <div class="bg-black text-white p-10 rounded-[3rem] space-y-8">
                    <h3 class="text-xl font-black">Contact Details</h3>
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center text-primary"><i data-lucide="phone" class="w-5 h-5"></i></div>
                            <div>
                                <p class="text-[9px] text-slate-500 font-black uppercase tracking-widest">Phone Number</p>
                                <p class="font-bold"><?php echo $v['phone'] ?? 'Contact Secretariat'; ?></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center text-primary"><i data-lucide="map-pin" class="w-5 h-5"></i></div>
                            <div>
                                <p class="text-[9px] text-slate-500 font-black uppercase tracking-widest">Office Location</p>
                                <p class="font-bold"><?php echo $v['location'] ?? 'National Office'; ?></p>
                            </div>
                        </div>
                    </div>
                    <a href="../../contact/" class="block w-full py-5 bg-primary text-black text-center font-black uppercase tracking-widest text-[10px] rounded-2xl hover:bg-white transition-all">Send Direct Message</a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-8 space-y-12">
                <div class="bg-white p-12 rounded-[3rem] border border-slate-100 shadow-sm space-y-10">
                    <div class="space-y-6">
                        <h2 class="text-4xl font-black text-black tracking-tight">Organization Profile</h2>
                        <p class="text-lg text-slate-500 leading-relaxed font-medium">
                            <?php echo $v['description']; ?>
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-10 border-t border-slate-50">
                        <div class="space-y-4">
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-primary">Core Specialization</h4>
                            <p class="text-slate-900 font-bold"><?php echo $v['specialization']; ?></p>
                        </div>
                        <div class="space-y-4">
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-primary">Membership Status</h4>
                            <p class="text-slate-900 font-bold">KEREA Corporate Member since <?php echo rand(2010, 2022); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Products by this vendor (Conceptual) -->
                <div class="space-y-8">
                    <h3 class="text-2xl font-black text-black px-6">Available Inventory</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <?php 
                        include '../products_data.php';
                        $count = 0;
                        foreach($products as $pid => $p):
                            if(strpos($p['distributor'], $v['name']) !== false):
                                $count++;
                        ?>
                        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 flex items-center gap-6 group hover:shadow-xl transition-all">
                            <div class="w-20 h-20 bg-slate-50 rounded-2xl overflow-hidden shrink-0">
                                <img src="<?php echo $base_url . $p['image']; ?>" class="w-full h-full object-contain">
                            </div>
                            <div class="flex-1">
                                <h4 class="font-black text-sm text-black group-hover:text-primary transition"><?php echo $p['name']; ?></h4>
                                <a href="../product/?id=<?php echo $pid; ?>" class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-2 block hover:text-black">View Specs <i data-lucide="chevron-right" class="w-3 h-3 inline"></i></a>
                            </div>
                        </div>
                        <?php 
                            endif;
                        endforeach; 
                        
                        if($count == 0):
                        ?>
                        <div class="col-span-2 p-10 bg-slate-100 rounded-[2rem] text-center text-slate-500 font-bold italic">
                            Inquire for full catalog and offline inventory.
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>
