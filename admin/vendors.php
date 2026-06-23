<?php include 'includes/header.php'; ?>

<div class="space-y-10">
    <div class="flex items-center justify-between">
        <div class="gsap-reveal">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Vendor Management</h2>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Review, Verify and Moderate Marketplace Participants</p>
        </div>
        <div class="flex gap-4 gsap-reveal">
             <div class="px-6 py-3 bg-white border border-slate-100 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-400 shadow-sm flex items-center gap-2">
                <i data-lucide="users" class="w-4 h-4 text-primary"></i> Total Vendors: 42
             </div>
             <button onclick="UI.modal.open('add-vendor-modal')" class="px-8 py-4 bg-primary text-black rounded-2xl text-xs font-black uppercase tracking-widest hover:scale-105 transition-all shadow-xl shadow-primary/20 flex items-center gap-3">
                <i data-lucide="plus" class="w-4 h-4"></i> Onboard New Vendor
             </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div onclick="filterByStatus('all')" class="gsap-reveal card-bg p-8 rounded-[2.5rem] shadow-premium flex items-center gap-6 group cursor-pointer hover:border-primary transition-all">
            <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                <i data-lucide="shield-check" class="w-8 h-8"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Verified Partners</p>
                <h4 class="text-3xl font-black">28</h4>
            </div>
        </div>
        <div onclick="filterByStatus('pending')" class="gsap-reveal card-bg p-8 rounded-[2.5rem] shadow-premium flex items-center gap-6 border-l-4 border-amber-400 group cursor-pointer hover:border-amber-400 transition-all">
            <div class="w-16 h-16 bg-amber-100 rounded-2xl flex items-center justify-center text-amber-600 group-hover:scale-110 transition-transform">
                <i data-lucide="clock" class="w-8 h-8"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pending Review</p>
                <h4 class="text-3xl font-black">14</h4>
            </div>
        </div>
        <div onclick="filterByStatus('flagged')" class="gsap-reveal card-bg p-8 rounded-[2.5rem] shadow-premium flex items-center gap-6 border-l-4 border-red-400 group cursor-pointer hover:border-red-400 transition-all">
            <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center text-red-600 group-hover:scale-110 transition-transform">
                <i data-lucide="alert-triangle" class="w-8 h-8"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Flagged Accounts</p>
                <h4 class="text-3xl font-black">2</h4>
            </div>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="gsap-reveal card-bg p-6 rounded-3xl shadow-premium flex flex-wrap items-center justify-between gap-6">
        <div class="relative flex-1 min-w-[300px]">
            <i data-lucide="search" class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
            <input id="vendor-search" type="text" onkeyup="filterVendors()" placeholder="Search by name, sector or location..." class="w-full pl-14 pr-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
        </div>
        <div class="flex gap-3">
            <select id="sector-filter" onchange="filterVendors()" class="px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-600 outline-none hover:border-primary transition-colors cursor-pointer">
                <option value="">All Sectors</option>
                <option value="solar">Solar Energy</option>
                <option value="bio">Bio Energy</option>
                <option value="wind">Wind Energy</option>
                <option value="cooking">Clean Cooking</option>
            </select>
            <button onclick="exportVendors()" class="px-6 py-4 border border-slate-100 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-400 hover:bg-slate-50 transition-all flex items-center gap-2">
                <i data-lucide="download" class="w-3.5 h-3.5"></i> Export Data
            </button>
        </div>
    </div>

    <!-- Vendor Table -->
    <div class="gsap-reveal card-bg rounded-[3rem] shadow-premium overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Vendor Identity</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Main Sector</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Compliance</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Specialization</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Actions</th>
                </tr>
            </thead>
            <tbody id="vendor-table-body" class="divide-y divide-slate-50">
                <!-- Row 1: Verified -->
                <tr class="vendor-row hover:bg-slate-50/50 transition-all group" data-name="solarlink technologies" data-sector="solar" data-status="verified">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary font-black text-xs group-hover:rotate-6 transition-transform">SL</div>
                            <div>
                                <h4 class="text-sm font-black text-slate-800">SolarLink Technologies</h4>
                                <p class="text-[10px] font-bold text-slate-400 uppercase">Nairobi, Kenya</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[9px] font-black uppercase shadow-sm">Solar Energy</span>
                    </td>
                    <td class="px-8 py-6">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-100 text-emerald-600 rounded-full text-[9px] font-black uppercase">
                            <i data-lucide="check-circle" class="w-3 h-3"></i> Verified Elite
                        </span>
                    </td>
                    <td class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest italic">EPC & Distribution</td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button onclick="UI.toast('Vendor credentials re-verified ✓', 'success')" title="Re-verify" class="p-2.5 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-emerald-500 hover:border-emerald-200 transition-all shadow-sm">
                                <i data-lucide="shield-check" class="w-4 h-4"></i>
                            </button>
                            <button onclick="UI.toast('SolarLink flagged for investigation', 'warning')" title="Flag" class="p-2.5 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-red-500 hover:border-red-200 transition-all shadow-sm">
                                <i data-lucide="flag" class="w-4 h-4"></i>
                            </button>
                            <button onclick="openEditVendor('SolarLink Technologies','Solar Energy','EPC & Distribution','Nairobi, Kenya')" title="Edit" class="p-2.5 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-primary transition-all shadow-sm">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Row 2: Pending -->
                <tr class="vendor-row hover:bg-slate-50/50 transition-all group border-l-4 border-amber-400 bg-amber-50/10 text-amber-900" data-name="biogas kenya solutions" data-sector="bio" data-status="pending">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-amber-200 flex items-center justify-center text-amber-700 font-black text-xs">BK</div>
                            <div>
                                <h4 class="text-sm font-black">Biogas Kenya Solutions</h4>
                                <p class="text-[10px] font-bold opacity-60 uppercase">Mombasa Branch</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[9px] font-black uppercase shadow-sm">Bio Energy</span>
                    </td>
                    <td class="px-8 py-6">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-[9px] font-black uppercase">
                            <i data-lucide="clock" class="w-3 h-3"></i> Pending Review
                        </span>
                    </td>
                    <td class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Digestor Systems</td>
                    <td class="px-8 py-6 text-right">
                        <button onclick="UI.modal.open('review-kyc-modal')" class="px-4 py-2 bg-amber-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:scale-105 transition-all shadow-lg shadow-amber-500/20">Review KYC</button>
                    </td>
                </tr>

                <!-- Row 3: Verified -->
                <tr class="vendor-row hover:bg-slate-50/50 transition-all group" data-name="windpeak africa" data-sector="wind" data-status="verified">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 font-black text-xs group-hover:rotate-6 transition-transform">WP</div>
                            <div>
                                <h4 class="text-sm font-black text-slate-800">WindPeak Africa</h4>
                                <p class="text-[10px] font-bold text-slate-400 uppercase">Nakuru Hub</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[9px] font-black uppercase shadow-sm">Wind Energy</span>
                    </td>
                    <td class="px-8 py-6">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-100 text-emerald-600 rounded-full text-[9px] font-black uppercase">
                            <i data-lucide="check-circle" class="w-3 h-3"></i> Verified Elite
                        </span>
                    </td>
                    <td class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Wind Turbine EPC</td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button onclick="UI.toast('WindPeak Africa credentials re-verified ✓', 'success')" title="Re-verify" class="p-2.5 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-emerald-500 hover:border-emerald-200 transition-all shadow-sm">
                                <i data-lucide="shield-check" class="w-4 h-4"></i>
                            </button>
                            <button onclick="UI.toast('WindPeak flagged for review', 'warning')" title="Flag" class="p-2.5 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-red-500 hover:border-red-200 transition-all shadow-sm">
                                <i data-lucide="flag" class="w-4 h-4"></i>
                            </button>
                            <button onclick="openEditVendor('WindPeak Africa','Wind Energy','Wind Turbine EPC','Nakuru Hub')" title="Edit" class="p-2.5 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-primary transition-all shadow-sm">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Row 4: Flagged -->
                <tr class="vendor-row hover:bg-slate-50/50 transition-all group border-l-4 border-red-500 bg-red-50/10" data-name="ecoflame cookstoves" data-sector="cooking" data-status="flagged">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center text-red-600 font-black text-xs">EC</div>
                            <div>
                                <h4 class="text-sm font-black text-slate-800">EcoFlame Cookstoves</h4>
                                <p class="text-[10px] font-bold text-slate-400 uppercase">Kisumu, Kenya</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1 bg-orange-50 text-orange-600 rounded-full text-[9px] font-black uppercase shadow-sm">Clean Cooking</span>
                    </td>
                    <td class="px-8 py-6">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-100 text-red-600 rounded-full text-[9px] font-black uppercase">
                            <i data-lucide="alert-triangle" class="w-3 h-3"></i> Flagged
                        </span>
                    </td>
                    <td class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Ethanol Stoves</td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex gap-2">
                            <button onclick="UI.toast('Flag cleared. Initiating reinstatement review...', 'info')" class="px-4 py-2 bg-slate-100 text-slate-600 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-primary hover:text-black transition-all">Clear Flag</button>
                            <button onclick="UI.toast('EcoFlame account suspended', 'error')" class="px-4 py-2 bg-red-100 text-red-600 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-red-600 hover:text-white transition-all">Suspend</button>
                        </div>
                    </td>
                </tr>

                <!-- Empty state -->
                <tr id="vendor-empty-state" class="hidden">
                    <td colspan="5" class="px-8 py-16 text-center">
                        <i data-lucide="search-x" class="w-10 h-10 text-slate-200 mx-auto mb-4"></i>
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest">No vendors match your search</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="bg-slate-50 p-6 flex justify-between items-center px-10">
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest" id="vendor-count-label">Showing 4 of 42 Professionals</span>
            <div class="flex gap-2">
                <button onclick="UI.toast('Previous page loaded', 'info')" class="p-2 bg-white border border-slate-100 rounded-lg text-slate-400 hover:text-primary transition-colors"><i data-lucide="chevron-left" class="w-4 h-4"></i></button>
                <button onclick="UI.toast('Next page loaded', 'info')" class="p-2 bg-white border border-slate-100 rounded-lg text-slate-400 hover:text-primary transition-colors"><i data-lucide="chevron-right" class="w-4 h-4"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- Add Vendor Modal -->
<div id="add-vendor-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-xl bg-white rounded-[3rem] shadow-2xl p-10 space-y-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-2 bg-primary"></div>
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Onboard Vendor</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Level 1 Integration</p>
            </div>
            <button onclick="UI.modal.close('add-vendor-modal')" class="p-2 bg-slate-50 text-slate-400 hover:text-red-500 rounded-xl transition-all">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        
        <form id="add-vendor-form" class="space-y-6">
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Organization Name</label>
                    <input type="text" required placeholder="e.g. Solar Ltd" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Main Sector</label>
                    <select class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option>Solar Energy</option>
                        <option>Bio Energy</option>
                        <option>Wind Energy</option>
                        <option>Clean Cooking</option>
                    </select>
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">KRA PIN / Registration Number</label>
                <input type="text" required placeholder="P05-xxxxxxxx" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
            </div>
            <div class="p-6 bg-slate-50 rounded-3xl border border-dashed border-slate-200 text-center space-y-3 group cursor-pointer hover:border-primary transition-all">
                <i data-lucide="upload-cloud" class="w-8 h-8 text-slate-300 mx-auto group-hover:text-primary transition-colors"></i>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Upload Compliance Certificates</p>
                <p class="text-[8px] text-slate-300 font-bold uppercase tracking-[0.2em]">PDF, JPG (Max 5MB)</p>
            </div>
            <div class="flex gap-4 pt-4">
                <button type="button" onclick="UI.modal.close('add-vendor-modal')" class="flex-1 py-5 border border-slate-100 text-[10px] font-black uppercase text-slate-400 rounded-2xl hover:bg-slate-50 transition-all">Cancel</button>
                <button type="submit" class="flex-1 py-5 bg-primary text-black text-[10px] font-black uppercase rounded-2xl shadow-xl shadow-primary/20 hover:scale-105 transition-all">Submit for Review</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Vendor Modal -->
<div id="edit-vendor-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-xl bg-white rounded-[3rem] shadow-2xl p-10 space-y-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-2 bg-primary"></div>
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Edit Vendor Record</h3>
                <p id="edit-vendor-subtitle" class="text-[10px] font-black text-primary uppercase tracking-widest">Updating Profile</p>
            </div>
            <button onclick="UI.modal.close('edit-vendor-modal')" class="p-2 bg-slate-50 text-slate-400 hover:text-red-500 rounded-xl transition-all">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="edit-vendor-form" class="space-y-6">
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Organization Name</label>
                    <input id="edit-vendor-name" type="text" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Main Sector</label>
                    <input id="edit-vendor-sector" type="text" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Specialization</label>
                <input id="edit-vendor-spec" type="text" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Headquarters Location</label>
                <input id="edit-vendor-location" type="text" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
            </div>
            <div class="flex gap-4 pt-4">
                <button type="button" onclick="UI.modal.close('edit-vendor-modal')" class="flex-1 py-5 border border-slate-100 text-[10px] font-black uppercase text-slate-400 rounded-2xl hover:bg-slate-50 transition-all">Discard</button>
                <button type="submit" class="flex-1 py-5 bg-primary text-black text-[10px] font-black uppercase rounded-2xl shadow-xl shadow-primary/20 hover:scale-105 transition-all">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- Review KYC Modal -->
<div id="review-kyc-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-2xl bg-white rounded-[3rem] shadow-2xl p-12 space-y-10">
        <div class="flex justify-between items-start">
            <div class="flex items-center gap-6">
                <div class="w-20 h-20 bg-amber-100 text-amber-600 rounded-3xl flex items-center justify-center text-3xl font-black">BK</div>
                <div>
                    <h3 class="text-3xl font-black text-slate-800 tracking-tight">Biogas Kenya Solutions</h3>
                    <p class="text-[11px] font-black text-amber-600 uppercase tracking-widest">KYC Pending - Submission #49021</p>
                </div>
            </div>
            <button onclick="UI.modal.close('review-kyc-modal')" class="p-3 bg-slate-50 text-slate-400 hover:text-red-500 rounded-2xl transition-all">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <div class="grid grid-cols-2 gap-10">
            <div class="space-y-6">
                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-l-4 border-primary pl-4">Business Data</h4>
                <div class="space-y-4">
                    <div>
                        <p class="text-[9px] font-black text-slate-300 uppercase">Director</p>
                        <p class="text-sm font-bold text-slate-700">James Mwangi Omondi</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-slate-300 uppercase">Registered</p>
                        <p class="text-sm font-bold text-slate-700">12th August 2021</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-slate-300 uppercase">KRA PIN</p>
                        <p class="text-sm font-bold text-slate-700">P051234567P</p>
                    </div>
                </div>
            </div>
            <div class="space-y-6">
                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-l-4 border-primary pl-4">Documents</h4>
                <div class="space-y-3">
                    <div class="p-3 bg-slate-50 rounded-xl flex items-center justify-between group cursor-pointer hover:bg-white border border-transparent hover:border-slate-100 transition-all" onclick="UI.toast('Opening KRA_Cert.pdf...', 'info')">
                        <div class="flex items-center gap-3">
                            <i data-lucide="file-text" class="w-4 h-4 text-blue-500"></i>
                            <span class="text-[9px] font-black uppercase text-slate-500">KRA_Cert.pdf</span>
                        </div>
                        <i data-lucide="external-link" class="w-3 h-3 text-slate-300 group-hover:text-primary"></i>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl flex items-center justify-between group cursor-pointer hover:bg-white border border-transparent hover:border-slate-100 transition-all" onclick="UI.toast('Opening CR12_Official.pdf...', 'info')">
                        <div class="flex items-center gap-3">
                            <i data-lucide="file-text" class="w-4 h-4 text-blue-500"></i>
                            <span class="text-[9px] font-black uppercase text-slate-500">CR12_Official.pdf</span>
                        </div>
                        <i data-lucide="external-link" class="w-3 h-3 text-slate-300 group-hover:text-primary"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-4 pt-6 border-t border-slate-50">
            <button onclick="UI.toast('KYC Rejected. Vendor notified via email.', 'error'); UI.modal.close('review-kyc-modal')" class="flex-1 py-5 bg-red-50 text-red-600 text-[10px] font-black uppercase rounded-2xl hover:bg-red-600 hover:text-white transition-all">Reject Submission</button>
            <button onclick="UI.toast('Biogas Kenya Solutions verified and enabled! 🎉', 'success'); UI.modal.close('review-kyc-modal')" class="flex-1 py-5 bg-primary text-black text-[10px] font-black uppercase rounded-2xl shadow-xl shadow-primary/20 hover:scale-105 transition-all">Approve & Enable</button>
        </div>
    </div>
</div>

<script>
function openEditVendor(name, sector, spec, location) {
    document.getElementById('edit-vendor-name').value = name;
    document.getElementById('edit-vendor-sector').value = sector;
    document.getElementById('edit-vendor-spec').value = spec;
    document.getElementById('edit-vendor-location').value = location;
    document.getElementById('edit-vendor-subtitle').innerText = 'Editing: ' + name;
    UI.modal.open('edit-vendor-modal');
}

function filterVendors() {
    const search = document.getElementById('vendor-search').value.toLowerCase();
    const sector = document.getElementById('sector-filter').value.toLowerCase();
    const rows = document.querySelectorAll('.vendor-row');
    let visibleCount = 0;

    rows.forEach(row => {
        const name = row.dataset.name || '';
        const rowSector = row.dataset.sector || '';
        const matchesSearch = !search || name.includes(search);
        const matchesSector = !sector || rowSector.includes(sector);

        if (matchesSearch && matchesSector) {
            row.classList.remove('hidden');
            visibleCount++;
        } else {
            row.classList.add('hidden');
        }
    });

    const emptyState = document.getElementById('vendor-empty-state');
    const countLabel = document.getElementById('vendor-count-label');
    if (visibleCount === 0) {
        emptyState.classList.remove('hidden');
        countLabel.innerText = 'No vendors match your filters';
    } else {
        emptyState.classList.add('hidden');
        countLabel.innerText = `Showing ${visibleCount} of 42 Professionals`;
    }
    lucide.createIcons();
}

function filterByStatus(status) {
    const rows = document.querySelectorAll('.vendor-row');
    let visibleCount = 0;
    rows.forEach(row => {
        const rowStatus = row.dataset.status || '';
        if (status === 'all' || rowStatus === status) {
            row.classList.remove('hidden');
            visibleCount++;
        } else {
            row.classList.add('hidden');
        }
    });
    const emptyState = document.getElementById('vendor-empty-state');
    const countLabel = document.getElementById('vendor-count-label');
    if (visibleCount === 0) {
        emptyState.classList.remove('hidden');
    } else {
        emptyState.classList.add('hidden');
    }
    countLabel.innerText = `Showing ${visibleCount} of 42 Professionals`;
    const statusLabel = status === 'all' ? 'All Vendors' : status.charAt(0).toUpperCase() + status.slice(1) + ' Vendors';
    UI.toast(`Filtered: ${statusLabel} (${visibleCount} shown)`, 'info');
}

function exportVendors() {
    UI.toast('Generating vendor export report...', 'warning');
    setTimeout(() => UI.toast('Export ready: vendors_2026-06-23.csv', 'success'), 1500);
}

// Handle add vendor form submission
document.getElementById('add-vendor-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = this.querySelector('[type="submit"]');
    btn.disabled = true;
    btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin mx-auto"></i>';
    lucide.createIcons();
    setTimeout(() => {
        UI.toast('Vendor onboarding request submitted! Review pending.', 'success');
        UI.modal.close('add-vendor-modal');
        btn.disabled = false;
        btn.innerHTML = 'Submit for Review';
    }, 1200);
});

// Handle edit vendor form submission
document.getElementById('edit-vendor-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = this.querySelector('[type="submit"]');
    btn.disabled = true;
    btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin mx-auto"></i>';
    lucide.createIcons();
    setTimeout(() => {
        UI.toast('Vendor record updated successfully ✓', 'success');
        UI.modal.close('edit-vendor-modal');
        btn.disabled = false;
        btn.innerHTML = 'Save Changes';
    }, 900);
});
</script>

<?php include 'includes/footer.php'; ?>
