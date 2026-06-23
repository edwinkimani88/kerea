<?php include 'includes/header.php'; ?>

<div class="space-y-12">
    <div class="flex items-center justify-between">
        <div class="gsap-reveal">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Support Desk</h2>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Vendor Disputes & Member Assistance</p>
        </div>
        <div class="flex gap-4 gsap-reveal">
             <div class="px-6 py-3 bg-white border border-slate-100 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-400 shadow-sm">
                Active Tickets: 8
             </div>
             <button class="px-8 py-4 bg-slate-900 text-white rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl">New Urgent Alert</button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Tickets List -->
        <div class="gsap-reveal lg:col-span-8 card-bg rounded-[3rem] shadow-premium overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
                <div class="flex gap-4">
                    <button id="filter-all" onclick="filterTickets('all')" class="px-4 py-2 bg-primary text-black text-[9px] font-black uppercase tracking-widest rounded-xl transition-all">All Tickets</button>
                    <button id="filter-pending" onclick="filterTickets('pending')" class="px-4 py-2 text-slate-400 text-[9px] font-black uppercase tracking-widest hover:text-primary transition-all">Pending (4)</button>
                    <button id="filter-escalated" onclick="filterTickets('escalated')" class="px-4 py-2 text-slate-400 text-[9px] font-black uppercase tracking-widest hover:text-primary transition-all">Escalated (2)</button>
                </div>
                <div class="relative">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-slate-400"></i>
                    <input type="text" placeholder="Search tickets..." class="pl-10 pr-4 py-2 bg-white border border-slate-100 rounded-xl text-xs font-bold focus:outline-none">
                </div>
            </div>

            <div class="divide-y divide-slate-50">
                <!-- Ticket 1 -->
                <div class="p-8 ticket-item hover:bg-slate-50/50 transition-all group cursor-pointer" data-status="escalated" onclick="UI.modal.open('ticket-detail-modal')">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-4">
                            <span class="text-[10px] font-black text-primary uppercase tracking-[0.2em]">#TK-9022</span>
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                            <span class="text-[9px] font-black text-red-500 uppercase tracking-widest">Urgent Escalation</span>
                        </div>
                        <span class="text-[9px] font-bold text-slate-400 uppercase">Received: 12m ago</span>
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-base font-black text-slate-800">Escrow verification mismatch for order #1229</h4>
                        <p class="text-xs text-slate-500 line-clamp-1">Vendor "SolarLink" claims delivery but buyer "EcoFarm Ltd" reports missing battery units...</p>
                    </div>
                    <div class="mt-6 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 font-black text-[10px]">SM</div>
                            <span class="text-xs font-bold text-slate-600">Serah Mukami (SolarLink)</span>
                        </div>
                        <button onclick="event.stopPropagation(); UI.toast('Agent assigned to ticket #TK-9022', 'success')" class="px-4 py-2 bg-slate-50 border border-slate-100 text-[9px] font-black uppercase tracking-widest rounded-lg hover:bg-primary transition-all">Assign Agent</button>
                    </div>
                </div>

                <!-- Ticket 2 -->
                <div class="p-8 ticket-item hover:bg-slate-50/50 transition-all group cursor-pointer" data-status="pending" onclick="UI.modal.open('ticket-detail-modal')">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-4">
                            <span class="text-[10px] font-black text-primary uppercase tracking-[0.2em]">#TK-8811</span>
                            <span class="text-[9px] font-black text-emerald-500 uppercase tracking-widest">New Question</span>
                        </div>
                        <span class="text-[9px] font-bold text-slate-400 uppercase">Received: 4h ago</span>
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-base font-black text-slate-800">Inquiry about Tier-1 Certification Benefits</h4>
                        <p class="text-xs text-slate-500 line-clamp-1">New applicant "WindPeak Africa" is requesting a detailed breakdown of tax incentives...</p>
                    </div>
                    <div class="mt-6 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 font-black text-[10px]">JO</div>
                            <span class="text-xs font-bold text-slate-600">John Oketch</span>
                        </div>
                        <button onclick="event.stopPropagation(); UI.modal.open('ticket-detail-modal')" class="px-4 py-2 bg-slate-50 border border-slate-100 text-[9px] font-black uppercase tracking-widest rounded-lg hover:bg-primary transition-all">View Inquiry</button>
                    </div>
                </div>
            </div>
            
            <div class="p-8 bg-slate-50 text-center">
                <button onclick="UI.toast('Loading older support tickets...', 'info')" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] hover:text-primary transition-all">Load Archive</button>
            </div>
        </div>

        <!-- Support Stats Sidebar -->
        <div class="gsap-reveal lg:col-span-4 space-y-10">
            <div class="card-bg p-8 rounded-[2.5rem] shadow-premium space-y-8">
                <h3 class="text-lg font-black">Performance SLA</h3>
                <div class="space-y-6">
                    <div class="space-y-2">
                        <div class="flex justify-between text-[10px] font-black uppercase tracking-widest text-slate-400">
                            <span>Response Time</span>
                            <span class="text-emerald-500">Avg 42m</span>
                        </div>
                        <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-500" style="width: 82%"></div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between text-[10px] font-black uppercase tracking-widest text-slate-400">
                            <span>Resolution Rate</span>
                            <span class="text-primary">94%</span>
                        </div>
                        <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-primary" style="width: 94%"></div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between text-[10px] font-black uppercase tracking-widest text-slate-400">
                            <span>Member Satisfaction</span>
                            <span class="text-blue-500">4.8/5.0</span>
                        </div>
                        <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-500" style="width: 88%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-dark p-8 rounded-[2.5rem] text-white shadow-2xl space-y-6">
                <div class="w-12 h-12 bg-primary/20 rounded-xl flex items-center justify-center text-primary mb-4">
                    <i data-lucide="help-circle" class="w-6 h-6"></i>
                </div>
                <h3 class="text-xl font-black">Need Direct Help?</h3>
                <p class="text-xs text-slate-400 leading-relaxed">The KEREA Secretariat tech team is available for internal escalations via secure tunnel.</p>
                <button class="w-full py-4 bg-white/5 border border-white/10 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-primary hover:text-black transition-all">Chat with Tech Sec</button>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<!-- Ticket Detail Modal -->
<div id="ticket-detail-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-2xl bg-white rounded-[3rem] shadow-2xl p-12 space-y-8">
        <div class="flex justify-between items-start">
            <div>
                <div class="flex items-center gap-4 mb-3">
                    <span class="text-[11px] font-black text-primary uppercase tracking-[0.2em]">#TK-9022</span>
                    <span class="px-2 py-1 bg-red-100 text-red-600 rounded-lg text-[9px] font-black uppercase">Urgent Escalation</span>
                </div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Escrow Verification Mismatch</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Order #1229 · SolarLink Technologies</p>
            </div>
            <button onclick="UI.modal.close('ticket-detail-modal')" class="p-3 bg-slate-50 text-slate-400 hover:text-red-500 rounded-2xl transition-all">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <div class="p-6 bg-slate-50 rounded-2xl space-y-3">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Complaint Summary</p>
            <p class="text-sm font-bold text-slate-700 leading-relaxed">Vendor "SolarLink Technologies" claims delivery was completed for order #1229 (24 Li-Ion battery units, KSh 312,000). Buyer "EcoFarm Ltd" (Nakuru) reports receiving only 18 units. Photographic evidence pending submission.</p>
        </div>

        <div class="grid grid-cols-2 gap-8">
            <div class="space-y-4">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Filed By</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center font-black text-blue-600 text-xs">SM</div>
                    <div>
                        <p class="text-sm font-black text-slate-800">Serah Mukami</p>
                        <p class="text-[9px] font-bold text-slate-400 uppercase">SolarLink Technologies</p>
                    </div>
                </div>
            </div>
            <div class="space-y-4">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Priority</p>
                <span class="inline-flex items-center gap-2 px-3 py-2 bg-red-50 text-red-600 rounded-xl text-[10px] font-black uppercase">
                    <i data-lucide="alert-triangle" class="w-4 h-4"></i> P1 Urgent
                </span>
            </div>
        </div>

        <form id="ticket-response-form" class="space-y-6">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Admin Response</label>
                <textarea rows="3" required placeholder="Type your official resolution or request for evidence..." class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all resize-none"></textarea>
            </div>
            <div class="flex gap-4">
                <button type="button" onclick="UI.toast('Ticket escalated to KEREA Secretariat', 'warning'); UI.modal.close('ticket-detail-modal')" class="flex-1 py-4 bg-amber-50 text-amber-600 text-[10px] font-black uppercase rounded-2xl transition-all hover:bg-amber-600 hover:text-white">Escalate to Sec</button>
                <button type="submit" class="flex-1 py-4 bg-primary text-black text-[10px] font-black uppercase rounded-2xl shadow-xl shadow-primary/20 hover:scale-105 transition-all">Send Response</button>
            </div>
        </form>
    </div>
</div>

<script>
function filterTickets(status) {
    const tickets = document.querySelectorAll('.ticket-item');
    tickets.forEach(t => {
        const ts = t.dataset.status;
        t.classList.toggle('hidden', status !== 'all' && ts !== status);
    });
    // Reset all filter button states
    ['all','pending','escalated'].forEach(s => {
        const btn = document.getElementById('filter-'+s);
        if (btn) {
            btn.className = s === status
                ? 'px-4 py-2 bg-primary text-black text-[9px] font-black uppercase tracking-widest rounded-xl transition-all'
                : 'px-4 py-2 text-slate-400 text-[9px] font-black uppercase tracking-widest hover:text-primary transition-all';
        }
    });
    const count = status === 'all' ? 2 : document.querySelectorAll(`.ticket-item[data-status="${status}"]:not(.hidden)`).length;
    UI.toast(`Showing ${count} ${status === 'all' ? 'all' : status} ticket(s)`, 'info');
}

document.getElementById('ticket-response-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = this.querySelector('[type="submit"]');
    btn.disabled = true;
    btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin mx-auto"></i>';
    lucide.createIcons();
    setTimeout(() => {
        UI.toast('Response dispatched to all parties ✓', 'success');
        UI.modal.close('ticket-detail-modal');
        btn.disabled = false;
        btn.innerHTML = 'Send Response';
    }, 1000);
});
</script>
