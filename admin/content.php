<?php include 'includes/header.php'; ?>

<div class="space-y-12">
    <div class="flex items-center justify-between">
        <div class="gsap-reveal">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Content Management</h2>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Publications, Standards & Media Hub</p>
        </div>
        <button onclick="UI.modal.open('upload-resource-modal')" class="gsap-reveal px-8 py-4 bg-primary text-black rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl flex items-center gap-3 hover:scale-105 transition-all">
            <i data-lucide="upload-cloud" class="w-4 h-4"></i> Upload Resource
        </button>
    </div>

    <!-- Content Categories -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Knowledge Hub -->
        <div class="gsap-reveal card-bg p-10 rounded-[3rem] shadow-premium space-y-6 group hover:border-primary/40 transition-all cursor-pointer" onclick="UI.toast('Opening Knowledge Hub manager...', 'info')">
            <div class="w-16 h-16 bg-slate-50 rounded-3xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-black transition-all">
                <i data-lucide="book-open" class="w-8 h-8"></i>
            </div>
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Knowledge Hub</h3>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-2 leading-relaxed">Policy Briefs, Research Reports & Sector Standards</p>
            </div>
            <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">12 active docs</span>
                <button onclick="event.stopPropagation(); UI.toast('Knowledge Hub management panel opened', 'success')" class="px-5 py-2.5 bg-slate-50 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-primary transition-all">Manage Hub</button>
            </div>
        </div>

        <!-- Events & Training -->
        <div class="gsap-reveal card-bg p-10 rounded-[3rem] shadow-premium space-y-6 group hover:border-accent/40 transition-all cursor-pointer" onclick="UI.modal.open('schedule-event-modal')">
            <div class="w-16 h-16 bg-slate-50 rounded-3xl flex items-center justify-center text-accent group-hover:bg-accent group-hover:text-black transition-all">
                <i data-lucide="calendar" class="w-8 h-8"></i>
            </div>
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Events Hub</h3>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-2 leading-relaxed">Conferences, Training Summits & Workshops</p>
            </div>
            <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">4 upcoming</span>
                <button onclick="event.stopPropagation(); UI.modal.open('schedule-event-modal')" class="px-5 py-2.5 bg-slate-50 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-accent transition-all">Schedule</button>
            </div>
        </div>

        <!-- Media & News -->
        <div class="gsap-reveal card-bg p-10 rounded-[3rem] shadow-premium space-y-6 group hover:border-blue-400/40 transition-all cursor-pointer" onclick="UI.modal.open('post-news-modal')">
            <div class="w-16 h-16 bg-slate-50 rounded-3xl flex items-center justify-center text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-all">
                <i data-lucide="newspaper" class="w-8 h-8"></i>
            </div>
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Member Media</h3>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-2 leading-relaxed">Press Releases, Success Stories & Blog Feed</p>
            </div>
            <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Global Syndicate</span>
                <button onclick="event.stopPropagation(); UI.modal.open('post-news-modal')" class="px-5 py-2.5 bg-slate-50 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-blue-100 transition-all">Post News</button>
            </div>
        </div>
    </div>

    <!-- Recent Uploads List (Mock) -->
    <div class="gsap-reveal card-bg rounded-[3rem] shadow-premium overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
            <h3 class="text-lg font-black">Recent Resource Library</h3>
            <div class="flex gap-2">
                <button onclick="UI.toast('Feed re-ordered by latest publish date', 'success')" class="px-4 py-2 border border-slate-100 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-white transition-all">Re-order Feed</button>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Resource Name</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Category</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Visibility</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Downloads</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <tr class="hover:bg-slate-50/50 transition-all group">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center text-red-500">
                                    <i data-lucide="file-text" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-black text-slate-800">KEREA Bio-Ethanol Standards 2026.pdf</h4>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase">Size: 4.2 MB · Added 1d ago</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                             <span class="px-3 py-1 bg-slate-900 text-white rounded-full text-[9px] font-black uppercase">Standards</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                                <span class="text-[10px] font-black text-emerald-600 uppercase">Public Access</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-sm font-bold text-slate-600">1,248</td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick="UI.toast('Opening Bio-Ethanol Standards 2026.pdf...', 'info')" class="p-2.5 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-primary transition-all shadow-sm">
                                    <i data-lucide="external-link" class="w-4 h-4"></i>
                                </button>
                                <button onclick="UI.toast('Access restricted to Members Only', 'warning')" class="p-2.5 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-amber-500 transition-all shadow-sm">
                                    <i data-lucide="lock" class="w-4 h-4"></i>
                                </button>
                                <button onclick="UI.toast('Resource removed from library', 'error')" class="p-2.5 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-red-500 transition-all shadow-sm">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 transition-all group">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-500">
                                    <i data-lucide="file-text" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-black text-slate-800">KEREA Annual Report 2025.pdf</h4>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase">Size: 12.8 MB · Added 3d ago</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                             <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-[9px] font-black uppercase">Reports</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                                <span class="text-[10px] font-black text-emerald-600 uppercase">Public Access</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-sm font-bold text-slate-600">892</td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick="UI.toast('Opening Annual Report 2025.pdf...', 'info')" class="p-2.5 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-primary transition-all shadow-sm">
                                    <i data-lucide="external-link" class="w-4 h-4"></i>
                                </button>
                                <button onclick="UI.toast('Restricting report access...', 'warning')" class="p-2.5 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-amber-500 transition-all shadow-sm">
                                    <i data-lucide="lock" class="w-4 h-4"></i>
                                </button>
                                <button onclick="UI.toast('Report removed from library', 'error')" class="p-2.5 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-red-500 transition-all shadow-sm">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Upload Resource Modal -->
<div id="upload-resource-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-xl bg-white rounded-[3rem] shadow-2xl p-10 space-y-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-2 bg-primary"></div>
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Upload Resource</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Knowledge Hub Integration</p>
            </div>
            <button onclick="UI.modal.close('upload-resource-modal')" class="p-2 bg-slate-50 text-slate-400 hover:text-red-500 rounded-xl transition-all">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="upload-resource-form" class="space-y-6">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Resource Title</label>
                <input type="text" required placeholder="e.g. KEREA Solar Standards 2026" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Category</label>
                    <select class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option>Standards</option>
                        <option>Reports</option>
                        <option>Policy Briefs</option>
                        <option>Training Materials</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Visibility</label>
                    <select class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option>Public Access</option>
                        <option>Members Only</option>
                        <option>Internal</option>
                    </select>
                </div>
            </div>
            <div class="p-8 bg-slate-50 rounded-3xl border border-dashed border-slate-200 text-center space-y-3 group cursor-pointer hover:border-primary transition-all">
                <i data-lucide="upload-cloud" class="w-10 h-10 text-slate-300 mx-auto group-hover:text-primary transition-colors"></i>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Drop file here or click to browse</p>
                <p class="text-[8px] text-slate-300 font-bold uppercase tracking-[0.2em]">PDF, DOCX, PNG (Max 20MB)</p>
            </div>
            <div class="flex gap-4 pt-2">
                <button type="button" onclick="UI.modal.close('upload-resource-modal')" class="flex-1 py-5 border border-slate-100 text-[10px] font-black uppercase text-slate-400 rounded-2xl hover:bg-slate-50 transition-all">Cancel</button>
                <button type="submit" class="flex-1 py-5 bg-primary text-black text-[10px] font-black uppercase rounded-2xl shadow-xl shadow-primary/20 hover:scale-105 transition-all">Publish Resource</button>
            </div>
        </form>
    </div>
</div>

<!-- Schedule Event Modal -->
<div id="schedule-event-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-lg bg-white rounded-[3rem] shadow-2xl p-10 space-y-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-2 bg-accent"></div>
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Schedule Event</h3>
                <p class="text-[10px] font-black text-accent uppercase tracking-widest">Events Hub Registration</p>
            </div>
            <button onclick="UI.modal.close('schedule-event-modal')" class="p-2 bg-slate-50 text-slate-400 hover:text-red-500 rounded-xl transition-all">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="schedule-event-form" class="space-y-6">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Event Title</label>
                <input type="text" required placeholder="e.g. KEREA Annual Summit 2026" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-accent/20 transition-all">
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Date</label>
                    <input type="date" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-accent/20 transition-all">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Event Type</label>
                    <select class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option>Conference</option>
                        <option>Training Workshop</option>
                        <option>Policy Summit</option>
                        <option>Expo</option>
                    </select>
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Venue / Location</label>
                <input type="text" required placeholder="e.g. KICC, Nairobi" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-accent/20 transition-all">
            </div>
            <div class="flex gap-4 pt-2">
                <button type="button" onclick="UI.modal.close('schedule-event-modal')" class="flex-1 py-5 border border-slate-100 text-[10px] font-black uppercase text-slate-400 rounded-2xl hover:bg-slate-50 transition-all">Discard</button>
                <button type="submit" class="flex-1 py-5 bg-accent text-black text-[10px] font-black uppercase rounded-2xl shadow-xl shadow-accent/20 hover:scale-105 transition-all">Add to Calendar</button>
            </div>
        </form>
    </div>
</div>

<!-- Post News Modal -->
<div id="post-news-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-lg bg-white rounded-[3rem] shadow-2xl p-10 space-y-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-2 bg-blue-500"></div>
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Post News Article</h3>
                <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest">Member Media Syndicate</p>
            </div>
            <button onclick="UI.modal.close('post-news-modal')" class="p-2 bg-slate-50 text-slate-400 hover:text-red-500 rounded-xl transition-all">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="post-news-form" class="space-y-6">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Headline</label>
                <input type="text" required placeholder="Article headline" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Summary / Excerpt</label>
                <textarea rows="3" required placeholder="Brief article summary shown in feeds..." class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all resize-none"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Tag</label>
                    <select class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option>Industry News</option>
                        <option>Press Release</option>
                        <option>Success Story</option>
                        <option>Policy Update</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Visibility</label>
                    <select class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option>Public</option>
                        <option>Members Only</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-4 pt-2">
                <button type="button" onclick="UI.modal.close('post-news-modal')" class="flex-1 py-5 border border-slate-100 text-[10px] font-black uppercase text-slate-400 rounded-2xl hover:bg-slate-50 transition-all">Discard</button>
                <button type="submit" class="flex-1 py-5 bg-blue-600 text-white text-[10px] font-black uppercase rounded-2xl shadow-xl shadow-blue-600/20 hover:scale-105 transition-all">Publish Article</button>
            </div>
        </form>
    </div>
</div>

<script>
// Handle Upload Resource form
document.getElementById('upload-resource-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = this.querySelector('[type="submit"]');
    btn.disabled = true; btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin mx-auto"></i>';
    lucide.createIcons();
    setTimeout(() => {
        UI.toast('Resource published to Knowledge Hub ✓', 'success');
        UI.modal.close('upload-resource-modal');
        btn.disabled = false; btn.innerHTML = 'Publish Resource';
    }, 1000);
});

// Handle Schedule Event form
document.getElementById('schedule-event-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = this.querySelector('[type="submit"]');
    btn.disabled = true; btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin mx-auto"></i>';
    lucide.createIcons();
    setTimeout(() => {
        UI.toast('Event added to KEREA calendar ✓', 'success');
        UI.modal.close('schedule-event-modal');
        btn.disabled = false; btn.innerHTML = 'Add to Calendar';
    }, 900);
});

// Handle Post News form
document.getElementById('post-news-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = this.querySelector('[type="submit"]');
    btn.disabled = true; btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin mx-auto"></i>';
    lucide.createIcons();
    setTimeout(() => {
        UI.toast('News article published to member media feed ✓', 'success');
        UI.modal.close('post-news-modal');
        btn.disabled = false; btn.innerHTML = 'Publish Article';
    }, 1000);
});
</script>

<?php include 'includes/footer.php'; ?>

