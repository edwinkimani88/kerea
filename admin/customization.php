<?php include 'includes/header.php'; ?>

<div class="space-y-12">
    <div class="flex items-center justify-between">
        <div class="gsap-reveal">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Appearance Hub</h2>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Global Branding & UI Configuration</p>
        </div>
        <button id="save-branding-btn" onclick="saveBranding()" class="gsap-reveal px-8 py-4 bg-primary text-black rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-primary/20 flex items-center gap-3 hover:scale-105 transition-all">
            <i data-lucide="save" class="w-4 h-4"></i> Save Global Changes
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Configuration Forms -->
        <div class="gsap-reveal lg:col-span-8 space-y-10">
            <!-- Branding Section -->
            <div class="card-bg p-10 rounded-[3rem] shadow-premium space-y-10">
                <div class="border-b border-slate-50 pb-6 flex items-center gap-4">
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                        <i data-lucide="palette" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-xl font-black">Brand Identity</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Primary Brand Color</label>
                        <div class="flex gap-4">
                            <input type="color" id="primary-color-picker" value="#39DE4F" oninput="syncColor('primary')" class="w-14 h-14 rounded-xl border-none cursor-pointer overflow-hidden p-0 bg-transparent">
                            <input type="text" id="primary-color-text" value="#39DE4F" oninput="syncColorText('primary')" class="flex-1 px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold uppercase outline-none focus:ring-2 focus:ring-primary/20">
                        </div>
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Accent UI Color</label>
                        <div class="flex gap-4">
                            <input type="color" id="accent-color-picker" value="#F59E0B" oninput="syncColor('accent')" class="w-14 h-14 rounded-xl border-none cursor-pointer overflow-hidden p-0 bg-transparent">
                            <input type="text" id="accent-color-text" value="#F59E0B" oninput="syncColorText('accent')" class="flex-1 px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold uppercase outline-none focus:ring-2 focus:ring-amber-500/20">
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Global Font Family</label>
                    <select id="font-family-select" onchange="UI.toast('Font changed to ' + this.value, 'info')" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold outline-none cursor-pointer hover:border-primary transition-colors">
                        <option value="Plus Jakarta Sans">Plus Jakarta Sans (KEREA Standard)</option>
                        <option value="Inter">Inter Responsive</option>
                        <option value="Outfit">Outfit Geometric</option>
                    </select>
                </div>
            </div>

            <!-- Header/Footer Section -->
            <div class="card-bg p-10 rounded-[3rem] shadow-premium space-y-10">
                <div class="border-b border-slate-50 pb-6 flex items-center gap-4">
                    <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                        <i data-lucide="layout" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-xl font-black">Structural Customization</h3>
                </div>

                <div class="space-y-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Header Navigation Style</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div id="nav-style-glass" onclick="setStyle('nav', 'glass')" class="nav-style-btn p-4 border-2 border-primary bg-primary/5 rounded-2xl cursor-pointer">
                                <p class="text-xs font-black text-slate-800">Glassmorphic Floating</p>
                                <p class="text-[9px] text-slate-400 uppercase mt-1">Recommended</p>
                            </div>
                            <div id="nav-style-static" onclick="setStyle('nav', 'static')" class="nav-style-btn p-4 border-2 border-slate-100 rounded-2xl cursor-pointer hover:bg-slate-50">
                                <p class="text-xs font-black text-slate-800">Static Solid</p>
                                <p class="text-[9px] text-slate-400 uppercase mt-1">Legacy Style</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Announcement Bar Text</label>
                            <input type="text" value="Kenya's Industry Peak Body · Est. 2002" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold focus:ring-2 focus:ring-primary/20 outline-none">
                        </div>
                        <div class="space-y-3 text-right">
                             <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Show Marketplace Counter</label>
                             <div class="flex items-center justify-end h-full">
                                  <div id="market-toggle" onclick="toggleSwitch('market')" class="w-14 h-8 bg-primary rounded-full relative p-1 cursor-pointer transition-all duration-300">
                                      <div id="market-toggle-thumb" class="w-6 h-6 bg-white rounded-full ml-auto shadow-sm transition-all duration-300"></div>
                                  </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Live Preview Sidebar -->
        <div class="gsap-reveal lg:col-span-4 space-y-10 focus:outline-none">
            <div class="card-bg p-8 rounded-[2.5rem] shadow-premium space-y-6">
                <div class="flex items-center justify-between">
                    <h3 class="font-black text-sm">Theme Preview</h3>
                    <span class="px-2 py-1 bg-emerald-50 text-emerald-600 rounded text-[9px] font-black uppercase">Live Mock</span>
                </div>
                <!-- Mockup -->
                <div class="w-full aspect-[4/3] bg-slate-100 rounded-[2rem] border border-slate-200 overflow-hidden relative">
                    <div class="h-4 bg-white border-b border-slate-200"></div>
                    <div class="flex h-full">
                        <div class="w-8 bg-white border-r border-slate-200 h-full"></div>
                        <div class="flex-1 p-3 space-y-2">
                             <div id="preview-primary-bar" class="w-1/2 h-2 bg-primary/20 rounded transition-colors"></div>
                             <div class="grid grid-cols-2 gap-2">
                                 <div class="h-10 bg-white rounded-lg border border-slate-200 flex flex-col justify-center items-center gap-1">
                                     <div id="preview-dot-1" class="w-4 h-1 bg-primary/30 rounded-full transition-colors"></div>
                                     <div class="w-6 h-0.5 bg-slate-100 rounded-full"></div>
                                 </div>
                                 <div class="h-10 bg-white rounded-lg border border-slate-200 flex flex-col justify-center items-center gap-1">
                                     <div id="preview-accent-dot" class="w-4 h-1 bg-amber-400 rounded-full transition-colors"></div>
                                     <div class="w-6 h-0.5 bg-slate-100 rounded-full"></div>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>
                <p class="text-[10px] text-slate-400 leading-relaxed italic text-center font-bold px-4">"Changes applied here will affect all public-facing KEREA web components instantly."</p>
            </div>

            <div class="bg-primary/5 border border-primary/10 p-8 rounded-[2.5rem] space-y-4 relative overflow-hidden group">
                <div class="absolute inset-0 bg-primary/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <i data-lucide="info" class="w-6 h-6 text-primary relative z-10"></i>
                <h4 class="text-sm font-black text-slate-800 relative z-10">Asset Management</h4>
                <p class="text-xs text-slate-500 leading-relaxed relative z-10">High-resolution logos (SVG/PNG) should be updated via the Server Assets folder for consistency.</p>
                <button onclick="UI.toast('Redirecting to Asset Management...', 'info')" class="w-full py-4 text-[10px] font-black uppercase tracking-widest text-primary bg-white border border-primary/20 rounded-xl hover:bg-primary hover:text-black transition-all relative z-10">Go to Asset Manager</button>
            </div>
        </div>
    </div>
</div>

<script>
function syncColor(type) {
    const val = document.getElementById(type + '-color-picker').value;
    document.getElementById(type + '-color-text').value = val.toUpperCase();
    updatePreview();
}

function syncColorText(type) {
    let val = document.getElementById(type + '-color-text').value;
    if (val.charAt(0) !== '#') val = '#' + val;
    if (val.length === 7) {
        document.getElementById(type + '-color-picker').value = val;
        updatePreview();
    }
}

function updatePreview() {
    const primary = document.getElementById('primary-color-picker').value;
    const accent = document.getElementById('accent-color-picker').value;
    
    const previewBar = document.getElementById('preview-primary-bar');
    const previewDot = document.getElementById('preview-dot-1');
    const previewAccent = document.getElementById('preview-accent-dot');
    
    if (previewBar) previewBar.style.backgroundColor = primary + '33'; // 20% alpha
    if (previewDot) previewDot.style.backgroundColor = primary + '4D'; // 30% alpha
    if (previewAccent) previewAccent.style.backgroundColor = accent;
}

function setStyle(type, style) {
    const glass = document.getElementById('nav-style-glass');
    const stat = document.getElementById('nav-style-static');
    
    if (style === 'glass') {
        glass.classList.add('border-primary', 'bg-primary/5');
        glass.classList.remove('border-slate-100', 'bg-white');
        stat.classList.remove('border-primary', 'bg-primary/5');
        stat.classList.add('border-slate-100');
    } else {
        stat.classList.add('border-primary', 'bg-primary/5');
        stat.classList.remove('border-slate-100', 'bg-white');
        glass.classList.remove('border-primary', 'bg-primary/5');
        glass.classList.add('border-slate-100');
    }
    UI.toast('Navigation style set to ' + style, 'info');
}

let marketActive = true;
function toggleSwitch(type) {
    marketActive = !marketActive;
    const box = document.getElementById('market-toggle');
    const thumb = document.getElementById('market-toggle-thumb');
    
    if (marketActive) {
        box.classList.remove('bg-slate-200');
        box.classList.add('bg-primary');
        thumb.classList.remove('ml-0');
        thumb.classList.add('ml-auto');
    } else {
        box.classList.remove('bg-primary');
        box.classList.add('bg-slate-200');
        thumb.classList.remove('ml-auto');
        thumb.classList.add('ml-0');
    }
    UI.toast('Marketplace counter ' + (marketActive ? 'enabled' : 'disabled'), 'info');
}

function saveBranding() {
    const btn = document.getElementById('save-branding-btn');
    const originalContent = btn.innerHTML;
    
    btn.disabled = true;
    btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i> Processing...';
    lucide.createIcons();
    
    setTimeout(() => {
        btn.innerHTML = '<i data-lucide="check" class="w-4 h-4"></i> Synchronizing...';
        lucide.createIcons();
        
        setTimeout(() => {
            UI.toast('Global branding synchronized successfully ✓', 'success');
            btn.innerHTML = originalContent;
            btn.disabled = false;
            lucide.createIcons();
            
            // Effect: Subtle "flash" of the preview
            gsap.fromTo('.lg\\:col-span-4 .card-bg', { scale: 1 }, { scale: 1.02, duration: 0.2, yoyo: true, repeat: 1 });
        }, 1000);
    }, 1500);
}

// Initial preview sync
document.addEventListener('DOMContentLoaded', updatePreview);
</script>

<?php include 'includes/footer.php'; ?>

