<?php include 'includes/header.php'; ?>

<div class="space-y-10">
    <div class="flex items-center justify-between">
        <div class="gsap-reveal">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Marketplace Appearance</h2>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Global Styles, Branding & Hero Management</p>
        </div>
        <div class="flex gap-4">
             <button onclick="UI.toast('All changes discarded', 'warning')" class="gsap-reveal px-6 py-3 border border-slate-100 rounded-2xl text-[10px] font-black uppercase text-slate-400 hover:bg-slate-50 transition-all">Discard</button>
             <button onclick="UI.toast('Branding changes deployed globally!', 'success')" class="gsap-reveal px-8 py-4 bg-primary text-black rounded-2xl text-[10px] font-black uppercase tracking-widest hover:scale-105 transition-all shadow-xl shadow-primary/20">Deploy Styling Changes</button>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-10">
        <!-- Main Column: Visual Components -->
        <div class="xl:col-span-2 space-y-10">
            
            <!-- Branding & Logo -->
            <div class="gsap-reveal card-bg p-10 rounded-[3rem] shadow-premium space-y-8 relative overflow-hidden">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-black text-black uppercase tracking-tight">Core Branding</h3>
                    <i data-lucide="palette" class="w-6 h-6 text-slate-200"></i>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-6">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Main Marketplace Logo (PNG)</label>
                            <div class="p-8 bg-slate-50 border-2 border-dashed border-slate-200 rounded-4xl text-center group cursor-pointer hover:border-primary transition-all">
                                <img src="../assets/kerea-logo-main.png" class="h-16 mx-auto mb-4 opacity-50 group-hover:opacity-100 transition-all">
                                <p class="text-[9px] font-black text-slate-400 uppercase">Change Marketplace Logo</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Favicon (ICO/PNG)</label>
                            <div class="flex items-center gap-6 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                <div class="w-10 h-10 bg-white rounded-lg p-2 shadow-sm"><img src="../assets/kerea-logo-main.png" class="w-full h-full"></div>
                                <button class="text-[9px] font-black text-primary uppercase tracking-widest">Replace Favicon</button>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Dashboard Branding (Sidebar Logo)</label>
                            <div class="p-8 bg-slate-900 border-2 border-dashed border-slate-800 rounded-4xl text-center group cursor-pointer hover:border-primary transition-all">
                                <img src="../assets/kerea-logo-main.png" class="h-16 mx-auto mb-4 invert opacity-50 group-hover:opacity-100 transition-all">
                                <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Update Dark Version Logo</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Homepage Hero Slider -->
            <div class="gsap-reveal card-bg p-10 rounded-[3rem] shadow-premium space-y-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-black text-black uppercase tracking-tight">Homepage Hero Carousel</h3>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mt-1">High-Impact Visual Sequence Management</p>
                    </div>
                    <button class="p-3 bg-slate-50 text-slate-400 hover:text-black rounded-2xl transition-all"><i data-lucide="plus"></i></button>
                </div>

                <div class="space-y-4">
                    <!-- Slide 1 -->
                    <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100 flex items-center gap-8 group">
                        <div class="w-40 h-24 bg-slate-200 rounded-2xl shrink-0 overflow-hidden relative shadow-lg">
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all">
                                 <button class="p-2 bg-white rounded-lg text-black"><i data-lucide="edit-2" class="w-4 h-4"></i></button>
                            </div>
                        </div>
                        <div class="flex-1 space-y-2">
                            <p class="text-xs font-black text-black uppercase">Powering the Transition</p>
                            <p class="text-[10px] text-slate-400 line-clamp-1">Explore our 2024 Marketplace for the latest in solar & bio-energy.</p>
                        </div>
                        <div class="flex items-center gap-2">
                             <input type="checkbox" checked class="w-4 h-4 accent-primary">
                             <button class="p-2 text-slate-300 hover:text-red-500 transition-colors"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100 flex items-center gap-8 group">
                        <div class="w-40 h-24 bg-slate-200 rounded-2xl shrink-0 overflow-hidden relative shadow-lg">
                             <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all">
                                 <button class="p-2 bg-white rounded-lg text-black"><i data-lucide="edit-2" class="w-4 h-4"></i></button>
                            </div>
                        </div>
                        <div class="flex-1 space-y-2">
                            <p class="text-xs font-black text-black uppercase">Institutional Grade Inverters</p>
                            <p class="text-[10px] text-slate-400 line-clamp-1">Heavy-duty power solutions for commercial and industrial use cases.</p>
                        </div>
                        <div class="flex items-center gap-2">
                             <input type="checkbox" checked class="w-4 h-4 accent-primary">
                             <button class="p-2 text-slate-300 hover:text-red-500 transition-colors"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar: Global Colors & Theme -->
        <div class="space-y-10">
            
            <div class="gsap-reveal card-bg p-10 rounded-[3rem] shadow-premium space-y-10">
                <h3 class="text-xl font-black text-black uppercase tracking-tight">Theme DNA</h3>
                
                <div class="space-y-6">
                    <!-- Brand Colors -->
                    <div class="space-y-4">
                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Global Brand Colors</p>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                <span class="text-[10px] font-black text-slate-600 uppercase">Primary Hue</span>
                                <div class="flex items-center gap-3">
                                    <span class="text-[10px] font-bold font-mono">#B8FF01</span>
                                    <input type="color" value="#B8FF01" class="w-8 h-8 rounded-lg border-none bg-transparent cursor-pointer">
                                </div>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                <span class="text-[10px] font-black text-slate-600 uppercase">Accent Static</span>
                                <div class="flex items-center gap-3">
                                    <span class="text-[10px] font-bold font-mono">#0F172A</span>
                                    <input type="color" value="#0F172A" class="w-8 h-8 rounded-lg border-none bg-transparent cursor-pointer">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Layout Colors -->
                    <div class="space-y-4 pt-6 border-t border-slate-50">
                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Structure & Layout</p>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                <span class="text-[10px] font-black text-slate-600 uppercase">Header Background</span>
                                <input type="color" value="#FFFFFF" class="w-8 h-8 rounded-lg border-none bg-transparent cursor-pointer">
                            </div>
                            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                <span class="text-[10px] font-black text-slate-600 uppercase">Footer Foundation</span>
                                <input type="color" value="#000000" class="w-8 h-8 rounded-lg border-none bg-transparent cursor-pointer">
                            </div>
                        </div>
                    </div>

                    <!-- Custom CSS -->
                    <div class="pt-6 border-t border-slate-50 space-y-3">
                        <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest px-2">Custom CSS Injector</label>
                        <textarea class="w-full p-4 bg-slate-900 text-primary font-mono text-[10px] rounded-2xl h-32 focus:ring-1 focus:ring-primary outline-none" placeholder="/* Custom Brand Overrides */"></textarea>
                    </div>
                </div>
            </div>

            <!-- UI Presets -->
            <div class="gsap-reveal card-bg p-8 rounded-[2.5rem] shadow-premium">
                <h4 class="text-xs font-black uppercase tracking-widest text-black mb-6">Interface Radius</h4>
                <div class="flex gap-4">
                    <button class="flex-1 p-4 border-2 border-primary bg-primary/5 rounded-xl text-[10px] font-black uppercase">Round (4xl)</button>
                    <button class="flex-1 p-4 border border-slate-100 rounded-xl text-[10px] font-black uppercase opacity-40">Sharp (sm)</button>
                    <button class="flex-1 p-4 border border-slate-100 rounded-xl text-[10px] font-black uppercase opacity-40">Modern (2xl)</button>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
