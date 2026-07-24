<?php
include 'includes/header.php';
?>

<div class="space-y-12">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
        <div class="gsap-reveal">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">System Audit & Analytics</h2>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Live Audit Trails & Platform Operations Intelligence</p>
        </div>
        <div class="flex gap-4 gsap-reveal">
             <button onclick="downloadReport()" class="px-6 py-3 bg-white border border-slate-100 rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-400 shadow-sm hover:bg-slate-900 hover:text-white transition-all flex items-center gap-2">
                <i data-lucide="download" class="w-3.5 h-3.5"></i> Export Audit Log
             </button>
        </div>
    </div>

    <!-- Live Site Status Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div class="gsap-reveal card-bg p-8 rounded-[3rem] shadow-premium relative overflow-hidden group">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-4">Active Members</p>
            <h4 class="text-4xl font-black text-slate-800" id="stats-members">0</h4>
            <p class="text-[10px] font-black text-primary uppercase mt-2 tracking-widest">KEREA Directory</p>
        </div>
        <div class="gsap-reveal card-bg p-8 rounded-[3rem] shadow-premium relative overflow-hidden group">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-4">Published News</p>
            <h4 class="text-4xl font-black text-slate-800" id="stats-news">0</h4>
            <p class="text-[10px] font-black text-blue-500 uppercase mt-2 tracking-widest">Media Articles</p>
        </div>
        <div class="gsap-reveal card-bg p-8 rounded-[3rem] shadow-premium relative overflow-hidden group">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-4">Publications</p>
            <h4 class="text-4xl font-black text-slate-800" id="stats-pubs">0</h4>
            <p class="text-[10px] font-black text-amber-500 uppercase mt-2 tracking-widest">PDF & Guides Library</p>
        </div>
        <div class="gsap-reveal card-bg p-8 rounded-[3rem] shadow-premium relative overflow-hidden group">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-4">Upcoming Events</p>
            <h4 class="text-4xl font-black text-slate-800" id="stats-events">0</h4>
            <p class="text-[10px] font-black text-indigo-500 uppercase mt-2 tracking-widest">Calendared Forums</p>
        </div>
    </div>

    <!-- Audit Logs Section -->
    <div class="gsap-reveal card-bg rounded-[3rem] shadow-premium overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex items-center justify-between">
            <div>
                <h3 class="text-xl font-black">Live Platform Audit Trail</h3>
                <p class="text-[10px] font-black text-slate-450 uppercase tracking-widest mt-0.5">Chronological record of admin and user modifications</p>
            </div>
            <div class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span> Systems Active
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left" id="audit-table">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Action Type</th>
                        <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Performed By</th>
                        <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Audit Description</th>
                        <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">IP Address</th>
                        <th class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Timestamp</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50" id="audit-tbody">
                    <!-- Loaded dynamically -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between" id="pagination-container">
            <!-- Loaded dynamically -->
        </div>
    </div>
</div>

<script>
let currentPage = 1;

document.addEventListener('DOMContentLoaded', () => {
    loadStats();
    loadAuditLogs();
});

async function loadStats() {
    const res = await UI.apiGet('/backend/api/content.php?action=stats');
    if (res.success && res.data) {
        document.getElementById('stats-members').innerText = res.data.members || 0;
        document.getElementById('stats-news').innerText = res.data.news || 0;
        document.getElementById('stats-pubs').innerText = res.data.publications || 0;
        document.getElementById('stats-events').innerText = res.data.events || 0;
    }
}

async function loadAuditLogs() {
    const url = `/backend/api/users.php?action=activity&page=${currentPage}`;
    const resp = await UI.apiGet(url);

    const tbody = document.getElementById('audit-tbody');
    const pagContainer = document.getElementById('pagination-container');
    tbody.innerHTML = '';

    if (!resp.success || !resp.data || resp.data.data.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" class="px-8 py-12 text-center text-slate-400">
                    <i data-lucide="shield-alert" class="w-10 h-10 mx-auto mb-3 opacity-30"></i>
                    <p class="text-xs font-black uppercase tracking-wider">No audit logs found in the database.</p>
                </td>
            </tr>
        `;
        pagContainer.innerHTML = '';
        lucide.createIcons();
        return;
    }

    resp.data.data.forEach(log => {
        let actionStyle = 'bg-slate-50 text-slate-600';
        let actionLabel = log.action;

        if (log.action.includes('login')) {
            actionStyle = 'bg-emerald-50 text-emerald-700';
        } else if (log.action.includes('create')) {
            actionStyle = 'bg-blue-50 text-blue-700';
        } else if (log.action.includes('update')) {
            actionStyle = 'bg-amber-50 text-amber-700';
        } else if (log.action.includes('delete')) {
            actionStyle = 'bg-red-50 text-red-700';
        }

        const operator = log.first_name 
            ? `${UI.escapeHtml(log.first_name)} ${UI.escapeHtml(log.last_name)} (${UI.escapeHtml(log.email)})` 
            : 'Anonymous / System';

        const tr = document.createElement('tr');
        tr.className = "hover:bg-slate-50/50 transition-all text-xs font-medium text-slate-600";
        tr.innerHTML = `
            <td class="px-8 py-4">
                <span class="px-2.5 py-1 ${actionStyle} rounded-lg text-[9px] font-black uppercase tracking-wider block text-center max-w-[150px] truncate">
                    ${UI.escapeHtml(actionLabel)}
                </span>
            </td>
            <td class="px-8 py-4 font-bold text-slate-800">${operator}</td>
            <td class="px-8 py-4 max-w-xs truncate">${UI.escapeHtml(log.description || 'No summary')}</td>
            <td class="px-8 py-4 font-mono text-[10px] text-slate-450">${UI.escapeHtml(log.ip_address)}</td>
            <td class="px-8 py-4 text-right text-slate-400 font-bold">${log.created_at}</td>
        `;
        tbody.appendChild(tr);
    });

    renderPagination(resp.data);
    lucide.createIcons();
}

function renderPagination(pageData) {
    const pagContainer = document.getElementById('pagination-container');
    pagContainer.innerHTML = '';

    const cur = pageData.current_page;
    const last = pageData.last_page;
    if (last <= 1) return;

    pagContainer.innerHTML = `
        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Page ${cur} of ${last} · Total ${pageData.total} logs</span>
        <div class="flex gap-2">
            <button onclick="changePage(${cur - 1})" ${cur === 1 ? 'disabled' : ''} class="px-4 py-2 bg-white border border-slate-100 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-500 hover:bg-primary hover:text-black disabled:opacity-50 disabled:pointer-events-none transition-all">Prev</button>
            <button onclick="changePage(${cur + 1})" ${cur === last ? 'disabled' : ''} class="px-4 py-2 bg-white border border-slate-100 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-500 hover:bg-primary hover:text-black disabled:opacity-50 disabled:pointer-events-none transition-all">Next</button>
        </div>
    `;
}

function changePage(page) {
    currentPage = page;
    loadAuditLogs();
}

function downloadReport() {
    UI.toast('Exporting system operational logs to CSV...', 'info');
    setTimeout(() => {
        window.location.href = '/backend/api/users.php?action=activity&page=1&per_page=1000';
    }, 1000);
}

UI.escapeHtml = function(text) {
    return (text || '')
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
};
</script>

<?php include 'includes/footer.php'; ?>
