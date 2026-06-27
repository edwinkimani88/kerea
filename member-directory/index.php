<?php 
$base_url = "../";
$active_page = "membership";
include_once '../includes/head.php';
?>
<title>Member Directory | KEREA Network</title>

<?php include '../includes/header.php'; ?>

<main class="bg-slate-50 min-h-screen pt-24 pb-32">
    <!-- Hero Header -->
    <section class="max-w-7xl mx-auto px-6 mb-16">
        <div class="bg-slate-900 rounded-[3rem] p-12 md:p-20 relative overflow-hidden text-center md:text-left">
            <div class="absolute right-0 top-0 w-1/2 h-full bg-primary/10 rounded-full blur-[120px] -mr-20 -mt-20"></div>
            <div class="relative z-10 max-w-2xl">
                <span class="inline-block px-4 py-1.5 bg-primary/20 text-primary text-[10px] font-black uppercase tracking-[0.3em] rounded-full mb-6 italic">Network Hub</span>
                <h1 class="text-4xl md:text-6xl font-black text-white mb-6 leading-tight uppercase italic tracking-tighter">Member <br><span class="text-primary italic">Directory</span></h1>
                <p class="text-slate-400 text-lg font-medium leading-relaxed">Connecting verified renewable energy stakeholders, innovators, and market leaders across Kenya.</p>
            </div>
        </div>
    </section>

    <!-- Filters & Search -->
    <section class="max-w-7xl mx-auto px-6 mb-12">
        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/40 p-6 md:p-8 border border-slate-100 reveal-on-scroll">
            <div class="flex flex-col lg:flex-row gap-8 items-center justify-between">
                <!-- Search -->
                <div class="relative w-full lg:max-w-md">
                    <i data-lucide="search" class="absolute left-6 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                    <input type="text" placeholder="Search organization, ID or category..." class="w-full pl-16 pr-8 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none font-bold text-sm transition-all">
                </div>

                <!-- Alphabet Filter -->
                <div class="flex flex-wrap gap-2 justify-center">
                    <button class="w-10 h-10 rounded-xl bg-primary text-black font-black text-xs transition-all">All</button>
                    <?php foreach(range('A', 'Z') as $char): ?>
                    <button class="w-10 h-10 rounded-xl bg-slate-50 hover:bg-slate-200 text-slate-400 hover:text-black font-black text-xs transition-all"><?php echo $char; ?></button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Directory Grid -->
    <section class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <?php 
            $members = [
                [
                    "org" => "EED Advisory",
                    "cat" => "Full Corporate",
                    "id" => "KEREA-FC-2026-001",
                    "email" => "contact@eedadvisory.com",
                    "img" => "https://ui-avatars.com/api/?name=EED+Advisory&background=39DE4F&color=fff&size=128"
                ],
                [
                    "org" => "Green Tech Solutions Ltd",
                    "cat" => "Full Corporate",
                    "id" => "KEREA-FC-2026-002",
                    "email" => "sheel@eawel.com",
                    "img" => "https://ui-avatars.com/api/?name=Green+Tech&background=0f172a&color=fff&size=128"
                ],
                [
                    "org" => "Sunculture",
                    "cat" => "Full Corporate",
                    "id" => "KEREA-FC-2026-003",
                    "email" => "info@sunculture.io",
                    "img" => "https://ui-avatars.com/api/?name=Sunculture&background=F59E0B&color=fff&size=128"
                ],
                [
                    "org" => "Lomia Energy Limited",
                    "cat" => "Full Corporate",
                    "id" => "KEREA-FC-2026-004",
                    "email" => "info@lomiaenergy.com",
                    "img" => "https://ui-avatars.com/api/?name=Lomia+Energy&background=3b82f6&color=fff&size=128"
                ],
                [
                    "org" => "Techwin Limited",
                    "cat" => "Full Corporate",
                    "id" => "KEREA-FC-2026-005",
                    "email" => "info@techwin.co.ke",
                    "img" => "https://ui-avatars.com/api/?name=Techwin&background=6366f1&color=fff&size=128"
                ]
            ];

            foreach($members as $m):
            ?>
            <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500 reveal-on-scroll group">
                <div class="flex flex-col items-center text-center">
                    <div class="w-24 h-24 rounded-[2rem] overflow-hidden mb-8 border-4 border-slate-50 shadow-inner group-hover:rotate-6 transition-transform">
                        <img src="<?php echo $m['img']; ?>" alt="<?php echo $m['org']; ?>" class="w-full h-full object-cover">
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-primary mb-3 italic">Verified Member</span>
                    <h3 class="text-xl font-black text-black mb-1 uppercase tracking-tight leading-tight"><?php echo $m['org']; ?></h3>
                    <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-6"><?php echo $m['cat']; ?></p>
                    
                    <div class="w-full py-6 px-4 bg-slate-50 border border-slate-100 rounded-3xl space-y-3 mb-8">
                        <div class="flex justify-between items-center text-[9px] font-black uppercase tracking-widest">
                            <span class="text-slate-400">Hub ID:</span>
                            <span class="text-black italic"><?php echo $m['id']; ?></span>
                        </div>
                        <div class="flex justify-between items-center text-[9px] font-black uppercase tracking-widest">
                            <span class="text-slate-400">Email:</span>
                            <span class="text-black italic lowercase"><?php echo $m['email']; ?></span>
                        </div>
                    </div>

                    <a href="profile.php?id=<?php echo $m['id']; ?>" class="w-full py-4 bg-slate-950 text-white font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl hover:bg-primary hover:text-black transition-all shadow-lg group-hover:shadow-primary/20">
                        View Full Profile
                    </a>
                </div>
            </div>
            <?php endforeach; ?>

        </div>

        <div class="mt-20 flex justify-center reveal-on-scroll">
            <button class="flex items-center gap-4 px-10 py-5 bg-white border border-slate-100 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-primary transition-all">
                Load More Members <i data-lucide="refresh-cw" class="w-4 h-4"></i>
            </button>
        </div>
    </section>

    <!-- Join Banner -->
    <section class="max-w-7xl mx-auto px-6 mt-32">
        <div class="bg-primary p-12 md:p-20 rounded-[4rem] flex flex-col md:flex-row items-center justify-between gap-12 relative overflow-hidden">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_20%,rgba(255,255,255,0.2),transparent)]"></div>
            <div class="relative z-10 max-w-xl text-center md:text-left">
                <h2 class="text-4xl md:text-5xl font-black text-black mb-6 uppercase italic leading-tight">Get Your Business <br>Verified on Hub</h2>
                <p class="text-black/80 font-bold leading-relaxed mb-0">Join 450+ verified renewable energy stakeholders. Gain visibility and institutional authority.</p>
            </div>
            <a href="<?php echo $base_url; ?>membership/register.php" class="relative z-10 px-12 py-6 bg-black text-white font-black uppercase text-xs tracking-widest rounded-3xl hover:scale-105 active:scale-95 transition-all shadow-2xl">
                Register as Member <i data-lucide="award" class="w-5 h-5 inline ml-2"></i>
            </a>
        </div>
    </section>
</main>

<?php include '../includes/footer.php'; ?>
