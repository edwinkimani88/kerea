<?php
include 'includes/header.php';
$initialType = Security::clean($_GET['type'] ?? 'partner');
?>

<div class="space-y-12">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
        <div class="gsap-reveal">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Identity & Hero Sections</h2>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Manage Partners, Team Bios, and Hero Sliders</p>
        </div>
        <button onclick="openCreateModal()" class="gsap-reveal px-8 py-4 bg-primary text-black rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-primary/20 flex items-center gap-3 hover:scale-105 transition-all">
            <i data-lucide="plus" class="w-4 h-4"></i> Create Entry
        </button>
    </div>

    <!-- Navigation Tabs -->
    <div class="gsap-reveal border-b border-slate-200">
        <nav class="flex space-x-8" aria-label="Tabs">
            <button onclick="switchTab('partner')" id="tab-partner" 
                class="tab-btn pb-4 px-1 border-b-2 font-black text-xs uppercase tracking-wider transition-all
                       <?php echo $initialType === 'partner' ? 'border-primary text-black' : 'border-transparent text-slate-400 hover:text-slate-600'; ?>">
                Partners
            </button>
            <button onclick="switchTab('team')" id="tab-team" 
                class="tab-btn pb-4 px-1 border-b-2 font-black text-xs uppercase tracking-wider transition-all
                       <?php echo $initialType === 'team' ? 'border-primary text-black' : 'border-transparent text-slate-400 hover:text-slate-600'; ?>">
                Team Members
            </button>
            <button onclick="switchTab('hero_slide')" id="tab-hero_slide" 
                class="tab-btn pb-4 px-1 border-b-2 font-black text-xs uppercase tracking-wider transition-all
                       <?php echo $initialType === 'hero_slide' ? 'border-primary text-black' : 'border-transparent text-slate-400 hover:text-slate-600'; ?>">
                Hero Sliders
            </button>
        </nav>
    </div>

    <!-- Search Controls -->
    <div class="gsap-reveal flex flex-col md:flex-row md:items-center justify-between gap-4 card-bg p-6 rounded-3xl shadow-sm">
        <div class="relative flex-1 max-w-md">
            <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
            <input type="text" id="search-input" oninput="debounceSearch()" placeholder="Search names, titles or types..." 
                class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold focus:outline-none">
        </div>
        <select id="status-filter" onchange="loadList()" class="px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold outline-none cursor-pointer">
            <option value="">All Statuses</option>
            <option value="1">Active / Enabled</option>
            <option value="0">Inactive / Disabled</option>
        </select>
    </div>

    <!-- Items List Table -->
    <div class="gsap-reveal card-bg rounded-[3rem] shadow-premium overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left" id="partners-table">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Identity Details</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Metadata</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Sort Order</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Status</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50" id="partners-tbody">
                    <!-- Dynamically populated -->
                </tbody>
            </table>
        </div>
        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between" id="pagination-container">
            <!-- Paginated -->
        </div>
    </div>
</div>

<!-- Add/Edit Modal -->
<div id="editor-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-2xl bg-white rounded-[3rem] shadow-2xl p-10 space-y-8 relative overflow-y-auto max-h-[90vh]">
        <div class="absolute top-0 left-0 w-full h-2 bg-primary"></div>
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight" id="modal-title">Create Entry</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" id="modal-subtitle">Branding & Hero Slides Configuration</p>
            </div>
            <button onclick="UI.modal.close('editor-modal')" class="p-2 bg-slate-50 text-slate-400 hover:text-red-500 rounded-xl transition-all">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form id="editor-form" class="space-y-6" enctype="multipart/form-data">
            <input type="hidden" name="id" id="item-id">
            
            <div id="dynamic-fields" class="space-y-6"></div>

            <div class="flex gap-4 pt-4 border-t border-slate-100">
                <button type="button" onclick="UI.modal.close('editor-modal')" class="flex-1 py-4 border border-slate-100 text-[10px] font-black uppercase text-slate-400 rounded-2xl hover:bg-slate-50 transition-all">Cancel</button>
                <button type="submit" id="submit-btn" class="flex-1 py-4 bg-primary text-black text-[10px] font-black uppercase rounded-2xl shadow-xl shadow-primary/20 hover:scale-105 transition-all">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
let currentType = '<?php echo $initialType; ?>';
let currentPage = 1;
let searchDebounceTimer = null;

document.addEventListener('DOMContentLoaded', () => {
    loadList();
});

function switchTab(type) {
    currentType = type;
    currentPage = 1;

    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.className = "tab-btn pb-4 px-1 border-b-2 font-black text-xs uppercase tracking-wider transition-all border-transparent text-slate-400 hover:text-slate-600";
    });
    const activeTab = document.getElementById('tab-' + type);
    if (activeTab) {
        activeTab.className = "tab-btn pb-4 px-1 border-b-2 font-black text-xs uppercase tracking-wider transition-all border-primary text-black";
    }

    const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?type=' + type;
    window.history.pushState({path: newUrl}, '', newUrl);

    document.getElementById('search-input').value = '';
    document.getElementById('status-filter').value = '';

    loadList();
}

function debounceSearch() {
    clearTimeout(searchDebounceTimer);
    searchDebounceTimer = setTimeout(() => {
        currentPage = 1;
        loadList();
    }, 400);
}

async function loadList() {
    const search = encodeURIComponent(document.getElementById('search-input').value);
    const status = encodeURIComponent(document.getElementById('status-filter').value);
    const url = `/backend/api/content.php?action=list&type=${currentType}&page=${currentPage}&search=${search}&status=${status}`;
    const resp = await UI.apiGet(url);

    const tbody = document.getElementById('partners-tbody');
    const pagContainer = document.getElementById('pagination-container');
    tbody.innerHTML = '';

    if (!resp.success || !resp.data || resp.data.data.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" class="px-8 py-12 text-center text-slate-400">
                    <i data-lucide="handshake" class="w-10 h-10 mx-auto mb-3 opacity-30"></i>
                    <p class="text-xs font-black uppercase tracking-wider">No matching profiles, partners or sliders found.</p>
                </td>
            </tr>
        `;
        pagContainer.innerHTML = '';
        lucide.createIcons();
        return;
    }

    resp.data.data.forEach(item => {
        let titleLine = item.name || item.title || `Entry ID: ${item.id}`;
        let detailsLine = '';
        let isActive = item.is_active ? true : false;
        
        let statusBadge = isActive 
            ? '<span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[9px] font-black uppercase">Active</span>' 
            : '<span class="px-2.5 py-1 bg-red-50 text-red-600 rounded-lg text-[9px] font-black uppercase">Inactive</span>';

        if (currentType === 'partner') {
            detailsLine = `Type: ${item.partner_type || 'N/A'} · Site: ${item.website_url || 'N/A'}`;
        } else if (currentType === 'team') {
            detailsLine = `Role: ${item.title || 'N/A'} · Dept: ${item.department || 'N/A'}`;
            if (item.is_board) statusBadge += '<span class="ml-2 px-2 py-0.5 bg-indigo-50 text-indigo-600 rounded-lg text-[8px] font-black uppercase">Board</span>';
        } else if (currentType === 'hero_slide') {
            detailsLine = `Subtitle: ${item.subtitle || 'N/A'}`;
        }

        const isFeatured = item.featured ? true : false;

        const tr = document.createElement('tr');
        tr.className = "hover:bg-slate-50/50 transition-all";
        tr.innerHTML = `
            <td class="px-8 py-5">
                <div>
                    <h4 class="text-sm font-black text-slate-800">${UI.escapeHtml(titleLine)}</h4>
                    <p class="text-[9px] font-bold text-slate-400 mt-1 uppercase">${UI.escapeHtml(detailsLine)}</p>
                </div>
            </td>
            <td class="px-8 py-5 text-xs font-bold text-slate-500">
                ${currentType === 'partner' ? item.country : (currentType === 'team' ? item.email : (item.cta_text || 'No CTA'))}
            </td>
            <td class="px-8 py-5 text-xs font-bold text-slate-550">${item.sort_order}</td>
            <td class="px-8 py-5">
                ${statusBadge}
                ${(item.featured !== undefined && isFeatured) ? '<span class="ml-2 px-2 py-0.5 bg-yellow-50 text-yellow-600 rounded-lg text-[8px] font-black uppercase">Featured</span>' : ''}
            </td>
            <td class="px-8 py-5 text-right">
                <div class="flex items-center justify-end gap-2">
                    <button onclick="toggleField(${item.id}, 'is_active')" class="p-2 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-emerald-500 transition-all shadow-sm" title="Toggle Active">
                        <i data-lucide="power" class="w-4 h-4 ${isActive ? 'text-emerald-500' : ''}"></i>
                    </button>
                    <button onclick="openEditModal(${item.id})" class="p-2 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-primary transition-all shadow-sm">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                    </button>
                    <button onclick="deleteItem(${item.id})" class="p-2 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-red-500 transition-all shadow-sm">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                </div>
            </td>
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
        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Page ${cur} of ${last} · Total ${pageData.total} entries</span>
        <div class="flex gap-2">
            <button onclick="changePage(${cur - 1})" ${cur === 1 ? 'disabled' : ''} class="px-4 py-2 bg-white border border-slate-100 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-500 hover:bg-primary hover:text-black disabled:opacity-50 disabled:pointer-events-none transition-all">Prev</button>
            <button onclick="changePage(${cur + 1})" ${cur === last ? 'disabled' : ''} class="px-4 py-2 bg-white border border-slate-100 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-500 hover:bg-primary hover:text-black disabled:opacity-50 disabled:pointer-events-none transition-all">Next</button>
        </div>
    `;
}

function changePage(page) {
    currentPage = page;
    loadList();
}

function renderFields(item = null) {
    const fieldsDiv = document.getElementById('dynamic-fields');
    fieldsDiv.innerHTML = '';

    const getVal = (key, def = '') => item ? (item[key] !== null ? item[key] : def) : def;

    let html = '';

    if (currentType === 'partner') {
        html += `
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Partner Name</label>
                <input type="text" name="name" required value="${getVal('name')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Partner Description</label>
                <textarea name="description" rows="3" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none resize-none">${getVal('description')}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Website URL</label>
                    <input type="text" name="website_url" value="${getVal('website_url')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Partner Type</label>
                    <select name="partner_type" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="strategic" ${getVal('partner_type') === 'strategic' ? 'selected' : ''}>Strategic</option>
                        <option value="implementing" ${getVal('partner_type') === 'implementing' ? 'selected' : ''}>Implementing</option>
                        <option value="donor" ${getVal('partner_type') === 'donor' ? 'selected' : ''}>Donor / Development</option>
                        <option value="technical" ${getVal('partner_type') === 'technical' ? 'selected' : ''}>Technical</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Country</label>
                    <input type="text" name="country" value="${getVal('country', 'Kenya')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Sort Order</label>
                    <input type="number" name="sort_order" value="${getVal('sort_order', '0')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2 flex flex-col justify-center pl-4">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Featured Partner</label>
                    <div class="flex items-center">
                        <input type="checkbox" name="featured" value="1" ${getVal('featured') ? 'checked' : ''} class="w-4 h-4 accent-primary">
                    </div>
                </div>
            </div>
        `;
    } else if (currentType === 'team') {
        html += `
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Full Name</label>
                <input type="text" name="name" required value="${getVal('name')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Official Job Title</label>
                    <input type="text" name="title" value="${getVal('title')}" placeholder="e.g. Executive Secretary" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Department</label>
                    <select name="department" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="Secretariat" ${getVal('department') === 'Secretariat' ? 'selected' : ''}>Secretariat Office</option>
                        <option value="Board" ${getVal('department') === 'Board' ? 'selected' : ''}>Board of Directors</option>
                        <option value="Technical" ${getVal('department') === 'Technical' ? 'selected' : ''}>Technical Committee</option>
                    </select>
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Bio / Narrative Description</label>
                <textarea name="bio" rows="3" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none resize-none">${getVal('bio')}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Email</label>
                    <input type="email" name="email" value="${getVal('email')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Phone</label>
                    <input type="text" name="phone" value="${getVal('phone')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">LinkedIn URL</label>
                    <input type="text" name="linkedin_url" value="${getVal('linkedin_url')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Sort Order</label>
                    <input type="number" name="sort_order" value="${getVal('sort_order', '0')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2 flex flex-col justify-center pl-4">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Is Board Member?</label>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_board" value="1" ${getVal('is_board') ? 'checked' : ''} class="w-4 h-4 accent-primary">
                    </div>
                </div>
            </div>
        `;
    } else if (currentType === 'hero_slide') {
        html += `
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Hero Header Title</label>
                <input type="text" name="title" required value="${getVal('title')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Sub-header Narrative</label>
                <textarea name="subtitle" rows="3" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none resize-none">${getVal('subtitle')}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">CTA Action Button Text</label>
                    <input type="text" name="cta_text" value="${getVal('cta_text')}" placeholder="e.g. Join KEREA Today" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">CTA Redirect URL</label>
                    <input type="text" name="cta_url" value="${getVal('cta_url')}" placeholder="e.g. /membership/" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Background Hex Color (Fallback)</label>
                    <input type="text" name="bg_color" value="${getVal('bg_color', '#000000')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Display Sort Order</label>
                    <input type="number" name="sort_order" value="${getVal('sort_order', '0')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>
        `;
    }

    html += `
        <div class="space-y-2">
            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Upload Branding Image / Slide photo</label>
            <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-primary/10 file:text-black hover:file:bg-primary/20 cursor-pointer">
        </div>
    `;

    fieldsDiv.innerHTML = html;
}

function openCreateModal() {
    document.getElementById('editor-form').reset();
    document.getElementById('item-id').value = '';
    document.getElementById('modal-title').innerText = `Create ${document.getElementById('tab-' + currentType).innerText}`;
    renderFields();
    UI.modal.open('editor-modal');
}

async function openEditModal(id) {
    const resp = await UI.apiGet(`/backend/api/content.php?action=get&type=${currentType}&id=${id}`);
    if (!resp.success) {
        UI.toast('Failed to load item contents.', 'error');
        return;
    }

    document.getElementById('modal-title').innerText = `Edit ${document.getElementById('tab-' + currentType).innerText}`;
    document.getElementById('item-id').value = id;
    renderFields(resp.data);
    UI.modal.open('editor-modal');
}

document.getElementById('editor-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('submit-btn');
    const originalContent = btn.innerHTML;

    btn.disabled = true;
    btn.innerHTML = '<svg class="animate-spin w-4 h-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>';

    const id = document.getElementById('item-id').value;
    const action = id ? 'update' : 'create';
    const fd = new FormData(this);
    fd.append('csrf_token', window.CSRF_TOKEN);
    fd.append('action', action);
    fd.append('type', currentType);

    const checkboxFields = ['featured', 'is_board'];
    checkboxFields.forEach(f => {
        const el = this.querySelector(`input[name="${f}"]`);
        if (el) {
            fd.set(f, el.checked ? '1' : '0');
        }
    });

    try {
        const res = await fetch(`/backend/api/content.php?action=${action}&type=${currentType}`, {
            method: 'POST',
            body: fd
        });
        const data = await res.json();

        if (data.success) {
            UI.toast(data.message || 'Operation successful ✓', 'success');
            UI.modal.close('editor-modal');
            loadList();
        } else {
            UI.toast(data.message || 'Error occurred during save.', 'error');
        }
    } catch (err) {
        console.error(err);
        UI.toast('Network connection failed.', 'error');
    } finally {
        btn.disabled = false;
        btn.innerHTML = originalContent;
    }
});

async function toggleField(id, field) {
    // Treat is_active toggle (which exists on these tables)
    const fd = makeFormData({ id, field });
    const res = await UI.apiPost(`/backend/api/content.php?action=toggle&type=${currentType}`, fd);
    if (res.success) {
        UI.toast('Status toggled successfully.', 'success');
        loadList();
    } else {
        UI.toast(res.message || 'Toggle failed.', 'error');
    }
}

async function deleteItem(id) {
    if (!UI.confirm('Are you absolutely sure you want to permanently delete this item?')) return;

    const fd = makeFormData({ id });
    const res = await UI.apiPost(`/backend/api/content.php?action=delete&type=${currentType}`, fd);
    if (res.success) {
        UI.toast('Item deleted.', 'success');
        loadList();
    } else {
        UI.toast(res.message || 'Failed to delete item.', 'error');
    }
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
