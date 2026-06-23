<?php include 'includes/header.php'; ?>

<div class="space-y-12">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div onclick="UI.toast('Detailed member audit initiated', 'info')" class="gsap-reveal card-bg p-8 rounded-[2.5rem] shadow-premium transition-all hover:border-primary cursor-pointer group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
                    <i data-lucide="users" class="w-7 h-7"></i>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">+12.5%</span>
                    <p class="text-[8px] font-bold text-slate-400 uppercase">Growth</p>
                </div>
            </div>
            <h3 class="text-4xl font-black tracking-tight">1,284</h3>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-2">Verified Members</p>
        </div>
        
        <div onclick="UI.toast('Inventory sync in progress...', 'info')" class="gsap-reveal card-bg p-8 rounded-[2.5rem] shadow-premium transition-all hover:border-accent cursor-pointer group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-accent/10 rounded-2xl flex items-center justify-center text-accent group-hover:scale-110 transition-transform">
                    <i data-lucide="shopping-bag" class="w-7 h-7"></i>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-black text-amber-500 uppercase tracking-widest">+42 units</span>
                    <p class="text-[8px] font-bold text-slate-400 uppercase">Weekly</p>
                </div>
            </div>
            <h3 class="text-4xl font-black tracking-tight">542</h3>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-2">Active Listings</p>
        </div>

        <div onclick="UI.toast('SLA Performance: Excellent', 'success')" class="gsap-reveal card-bg p-8 rounded-[2.5rem] shadow-premium transition-all hover:border-blue-400 cursor-pointer group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                    <i data-lucide="shield-check" class="w-7 h-7"></i>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-black text-blue-500 uppercase tracking-widest">98.2%</span>
                    <p class="text-[8px] font-bold text-slate-400 uppercase">SLA</p>
                </div>
            </div>
            <h3 class="text-4xl font-black tracking-tight">92%</h3>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-2">Compliance Rate</p>
        </div>

        <div onclick="UI.toast('Sector valuation updated live', 'info')" class="gsap-reveal card-bg p-8 rounded-[2.5rem] shadow-premium transition-all hover:border-purple-400 cursor-pointer group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 group-hover:scale-110 transition-transform">
                    <i data-lucide="zap" class="w-7 h-7"></i>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-black text-purple-500 uppercase tracking-widest">1.2M kWh</span>
                    <p class="text-[8px] font-bold text-slate-400 uppercase">Savings</p>
                </div>
            </div>
            <h3 class="text-4xl font-black tracking-tight">KSh 32M</h3>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-2">Total Sector Value</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Recent Activities Feed -->
        <div class="gsap-reveal lg:col-span-8 card-bg p-10 rounded-[3rem] shadow-premium space-y-8">
            <div class="flex items-center justify-between border-b border-slate-50 pb-6">
                <div>
                    <h3 class="text-2xl font-black tracking-tight italic uppercase">Intelligence Feed</h3>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Real-time marketplace movements</p>
                </div>
                <button onclick="UI.toast('Fetching latest marketplace events...', 'info'); location.reload();" class="px-5 py-2.5 bg-slate-50 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-primary transition-all flex items-center gap-2">
                    <i data-lucide="refresh-cw" class="w-3 h-3"></i> Sync Data
                </button>
            </div>
            
            <div class="space-y-6">
                <!-- Activity Item -->
                <div onclick="UI.toast('Viewing Vendor Details...', 'info')" class="flex items-start gap-6 p-6 rounded-[2rem] hover:bg-slate-50 transition-all group cursor-pointer border border-transparent hover:border-slate-100">
                    <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600 shrink-0 group-hover:rotate-12 transition-transform shadow-sm">
                        <i data-lucide="check-circle" class="w-6 h-6"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">New Vendor Approved</h4>
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest bg-slate-100 px-2 py-1 rounded">2 mins ago</span>
                        </div>
                        <p class="text-xs text-slate-500 mt-2 font-bold leading-relaxed">SolarLink Technologies has successfully completed KYC/KYB level 3 verification and is now active.</p>
                        <div class="mt-4 flex gap-3">
                            <span class="px-3 py-1 bg-slate-200/50 text-[8px] font-black uppercase text-slate-500 rounded-lg">Sector: Solar</span>
                            <span class="px-3 py-1 bg-emerald-50 text-[8px] font-black uppercase text-emerald-600 rounded-lg shadow-sm">Verified Elite</span>
                        </div>
                    </div>
                </div>

                <div onclick="UI.toast('Opening Investigation Module...', 'warning')" class="flex items-start gap-6 p-6 rounded-[2rem] hover:bg-amber-50 transition-all group border-l-4 border-amber-400 bg-amber-50/5 cursor-pointer border-y border-r border-transparent hover:border-amber-100">
                    <div class="w-12 h-12 bg-amber-100 rounded-2xl flex items-center justify-center text-amber-600 shrink-0 shadow-sm">
                        <i data-lucide="alert-circle" class="w-6 h-6 animate-pulse"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">Flagged Transaction</h4>
                            <span class="text-[9px] font-black text-amber-600 uppercase tracking-widest bg-amber-100 px-2 py-1 rounded">45 mins ago</span>
                        </div>
                        <p class="text-xs text-slate-500 mt-2 font-bold leading-relaxed">Potential escrow mismatch detected in biomass stove order #BK-9022 from Nakuru Hub.</p>
                        <button class="mt-4 text-[9px] font-black text-primary uppercase tracking-[0.2em] flex items-center gap-2 hover:translate-x-1 transition-transform">
                            Investigate Case <i data-lucide="arrow-right" class="w-3 h-3"></i>
                        </button>
                    </div>
                </div>

                <div onclick="UI.toast('Accessing Knowledge Hub...', 'info')" class="flex items-start gap-6 p-6 rounded-[2rem] hover:bg-blue-50 transition-all group cursor-pointer border border-transparent hover:border-blue-100">
                    <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 shrink-0 shadow-sm">
                        <i data-lucide="newspaper" class="w-6 h-6"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">New Publication Active</h4>
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest bg-slate-100 px-2 py-1 rounded">3h ago</span>
                        </div>
                        <p class="text-xs text-slate-500 mt-2 font-bold leading-relaxed">KEREA Standards 2026: Official Bio-Ethanol Fuel Certification guidelines are now live.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Marketplace Health -->
        <div class="gsap-reveal lg:col-span-4 space-y-10">
            <div class="bg-slate-900 p-10 rounded-[3rem] text-white shadow-2xl relative overflow-hidden group border border-white/5">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-primary/20 rounded-full blur-[100px] transition-transform duration-1000 group-hover:scale-150"></div>
                <h3 class="text-xl font-black mb-10 relative z-10 italic uppercase border-l-4 border-primary pl-6">Sector Health</h3>
                <div class="space-y-10 relative z-10">
                    <div class="space-y-4">
                        <div class="flex justify-between text-[11px] font-black uppercase tracking-[0.2em] text-slate-400">
                            <span>KYC verification rate</span>
                            <span class="text-primary">85%</span>
                        </div>
                        <div class="h-2 bg-white/5 rounded-full overflow-hidden p-0.5">
                            <div class="h-full bg-primary rounded-full shadow-[0_0_15px_rgba(57,222,79,0.5)]" style="width: 85%"></div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between text-[11px] font-black uppercase tracking-[0.2em] text-slate-400">
                            <span>Vendor Tier Status</span>
                            <span class="text-accent">92% Tier 1</span>
                        </div>
                        <div class="h-2 bg-white/5 rounded-full overflow-hidden p-0.5">
                            <div class="h-full bg-accent rounded-full shadow-[0_0_15px_rgba(245,158,11,0.5)]" style="width: 92%"></div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between text-[11px] font-black uppercase tracking-[0.2em] text-slate-400">
                            <span>Audit Completion</span>
                            <span class="text-blue-400">64%</span>
                        </div>
                        <div class="h-2 bg-white/5 rounded-full overflow-hidden p-0.5">
                            <div class="h-full bg-blue-400 rounded-full shadow-[0_0_15px_rgba(96,165,250,0.5)]" style="width: 64%"></div>
                        </div>
                    </div>
                </div>
                <button onclick="UI.toast('Generating comprehensive audit export...', 'warning')" class="w-full mt-12 py-6 bg-white/5 border border-white/10 rounded-[2rem] text-[10px] font-black uppercase tracking-[0.3em] hover:bg-white hover:text-black transition-all shadow-xl">Generate Audit Data</button>
            </div>

            <div class="card-bg p-10 rounded-[3rem] shadow-premium space-y-8">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-black italic uppercase tracking-tighter">Events</h3>
                    <i data-lucide="calendar" class="w-5 h-5 text-slate-300"></i>
                </div>
                <div class="space-y-6">
                    <div onclick="UI.toast('Event details: Nairobi KICC, Hall 4', 'info')" class="flex gap-6 items-center p-4 hover:bg-slate-50 rounded-2xl transition-all cursor-pointer group">
                        <div class="w-14 h-14 bg-slate-900 rounded-2xl flex flex-col items-center justify-center shrink-0 shadow-lg group-hover:rotate-6 transition-transform">
                            <span class="text-[9px] font-black uppercase text-primary leading-none mb-1">Jun</span>
                            <span class="text-lg font-black text-white">24</span>
                        </div>
                        <div>
                            <p class="text-[11px] font-black text-slate-800 uppercase tracking-tight">Solar Tech Expo 2026</p>
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">Nairobi Gateway</p>
                        </div>
                    </div>
                    <div onclick="UI.toast('Event details: Mombasa Trade Center', 'info')" class="flex gap-6 items-center p-4 hover:bg-slate-50 rounded-2xl transition-all cursor-pointer group">
                        <div class="w-14 h-14 bg-slate-100 border border-slate-200 rounded-2xl flex flex-col items-center justify-center shrink-0 group-hover:rotate-6 transition-transform">
                            <span class="text-[9px] font-black uppercase text-slate-400 leading-none mb-1">Jul</span>
                            <span class="text-lg font-black text-slate-800">12</span>
                        </div>
                        <div>
                            <p class="text-[11px] font-black text-slate-800 uppercase tracking-tight">Biomass Policy Summit</p>
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">Coast Region Hub</p>
                        </div>
                    </div>
                </div>
                <button onclick="UI.toast('Loading full calendar view...', 'info')" class="w-full py-4 text-[9px] font-black uppercase text-slate-400 tracking-[0.3em] hover:text-primary transition-colors">View All Events</button>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
