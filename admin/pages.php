<?php
include 'includes/header.php';
?>

<div class="space-y-12">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
        <div class="gsap-reveal">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Website Pages</h2>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Manage Static Pages & SEO Metadata</p>
        </div>
        <button onclick="openCreateModal()" class="gsap-reveal px-8 py-4 bg-primary text-black rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-primary/20 flex items-center gap-3 hover:scale-105 transition-all">
            <i data-lucide="plus" class="w-4 h-4"></i> Create Page
        </button>
    </div>

    <!-- Search / Filter -->
    <div class="gsap-reveal flex flex-col md:flex-row md:items-center justify-between gap-4 card-bg p-6 rounded-3xl shadow-sm">
        <div class="relative flex-1 max-w-md">
            <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
            <input type="text" id="search-input" oninput="debounceSearch()" placeholder="Search by title or slug..." 
                class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold focus:outline-none">
        </div>
        <select id="status-filter" onchange="loadPages()" class="px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold outline-none cursor-pointer">
            <option value="">All Statuses</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
            <option value="archived">Archived</option>
        </select>
    </div>

    <!-- Pages List Table -->
    <div class="gsap-reveal card-bg rounded-[3rem] shadow-premium overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left" id="pages-table">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Page Title</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Slug / Route</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Status</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50" id="pages-tbody">
                    <!-- Dynamically populated -->
                </tbody>
            </table>
        </div>
        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between" id="pagination-container">
            <!-- Paginated -->
        </div>
    </div>
</div>

<!-- Page Edit Modal -->
<div id="page-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-3xl bg-white rounded-[3rem] shadow-2xl p-10 space-y-8 relative overflow-y-auto max-h-[90vh]">
        <div class="absolute top-0 left-0 w-full h-2 bg-primary"></div>
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight" id="modal-title">Create Page</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Static Page & SEO Configuration</p>
            </div>
            <button onclick="UI.modal.close('page-modal')" class="p-2 bg-slate-50 text-slate-400 hover:text-red-500 rounded-xl transition-all">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form id="page-form" class="space-y-6" enctype="multipart/form-data">
            <input type="hidden" name="id" id="page-id">

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Page Title</label>
                    <input type="text" name="title" id="page-title-input" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Slug (Custom Route URL)</label>
                    <input type="text" name="slug" id="page-slug-input" placeholder="e.g. about-our-standards" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Page Body Content (HTML Support)</label>
                <textarea name="content" id="page-content-input" rows="8" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">SEO Meta Description</label>
                    <textarea name="meta_desc" id="page-meta-desc" rows="2" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none resize-none"></textarea>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">SEO Keywords</label>
                    <input type="text" name="meta_keywords" id="page-meta-keywords" placeholder="e.g. standard, compliance, clean energy" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Status</label>
                    <select name="status" id="page-status" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Hero Image Banner (Optional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-primary/10 file:text-black hover:file:bg-primary/20 cursor-pointer">
                </div>
            </div>

            <div class="flex gap-4 pt-4 border-t border-slate-100">
                <button type="button" onclick="UI.modal.close('page-modal')" class="flex-1 py-4 border border-slate-100 text-[10px] font-black uppercase text-slate-400 rounded-2xl hover:bg-slate-50 transition-all">Cancel</button>
                <button type="submit" id="submit-btn" class="flex-1 py-4 bg-primary text-black text-[10px] font-black uppercase rounded-2xl shadow-xl shadow-primary/20 hover:scale-105 transition-all">Save Page</button>
            </div>
        </form>
    </div>
</div>

<script>
let currentPage = 1;
let searchDebounceTimer = null;

document.addEventListener('DOMContentLoaded', () => {
    loadPages();
});

function debounceSearch() {
    clearTimeout(searchDebounceTimer);
    searchDebounceTimer = setTimeout(() => {
        currentPage = 1;
        loadPages();
    }, 400);
}

async function loadPages() {
    const search = encodeURIComponent(document.getElementById('search-input').value);
    const status = encodeURIComponent(document.getElementById('status-filter').value);
    const url = `/backend/api/content.php?action=list&type=page&page=${currentPage}&search=${search}&status=${status}`;
    const resp = await UI.apiGet(url);

    const tbody = document.getElementById('pages-tbody');
    const pagContainer = document.getElementById('pagination-container');
    tbody.innerHTML = '';

    if (!resp.success || !resp.data || resp.data.data.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" class="px-8 py-12 text-center text-slate-400">
                    <i data-lucide="layout" class="w-10 h-10 mx-auto mb-3 opacity-30"></i>
                    <p class="text-xs font-black uppercase tracking-wider">No matching website pages found.</p>
                </td>
            </tr>
        `;
        pagContainer.innerHTML = '';
        lucide.createIcons();
        return;
    }

    resp.data.data.forEach(page => {
        const s = page.status;
        const statusBadge = s === 'published' ? '<span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[9px] font-black uppercase">Published</span>' 
                        : s === 'draft' ? '<span class="px-2.5 py-1 bg-amber-50 text-amber-600 rounded-lg text-[9px] font-black uppercase">Draft</span>'
                        : '<span class="px-2.5 py-1 bg-slate-100 text-slate-500 rounded-lg text-[9px] font-black uppercase">Archived</span>';

        const tr = document.createElement('tr');
        tr.className = "hover:bg-slate-50/50 transition-all";
        tr.innerHTML = `
            <td class="px-8 py-6">
                <div>
                    <h4 class="text-sm font-black text-slate-800">${UI.escapeHtml(page.title)}</h4>
                    <p class="text-[9px] font-bold text-slate-400 mt-1 uppercase">ID: ${page.id} · Description: ${UI.escapeHtml(page.meta_desc || 'No SEO summary')}</p>
                </div>
            </td>
            <td class="px-8 py-6">
                <span class="font-mono text-xs text-slate-500">/${UI.escapeHtml(page.slug)}</span>
            </td>
            <td class="px-8 py-6">
                ${statusBadge}
            </td>
            <td class="px-8 py-6 text-right">
                <div class="flex items-center justify-end gap-2">
                    <a href="/${page.slug}" target="_blank" class="p-2.5 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-primary transition-all shadow-sm" title="View Page">
                        <i data-lucide="external-link" class="w-4 h-4"></i>
                    </a>
                    <button onclick="openEditModal(${page.id})" class="p-2.5 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-primary transition-all shadow-sm" title="Edit">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                    </button>
                    <button onclick="deletePage(${page.id})" class="p-2.5 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-red-500 transition-all shadow-sm" title="Delete">
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
        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Page ${cur} of ${last} · Total ${pageData.total} pages</span>
        <div class="flex gap-2">
            <button onclick="changePage(${cur - 1})" ${cur === 1 ? 'disabled' : ''} class="px-4 py-2 bg-white border border-slate-100 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-500 hover:bg-primary hover:text-black disabled:opacity-50 disabled:pointer-events-none transition-all">Prev</button>
            <button onclick="changePage(${cur + 1})" ${cur === last ? 'disabled' : ''} class="px-4 py-2 bg-white border border-slate-100 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-500 hover:bg-primary hover:text-black disabled:opacity-50 disabled:pointer-events-none transition-all">Next</button>
        </div>
    `;
}

function changePage(page) {
    currentPage = page;
    loadPages();
}

function openCreateModal() {
    document.getElementById('page-form').reset();
    document.getElementById('page-id').value = '';
    document.getElementById('modal-title').innerText = 'Create Page';
    UI.modal.open('page-modal');
}

async function openEditModal(id) {
    const resp = await UI.apiGet(`/backend/api/content.php?action=get&type=page&id=${id}`);
    if (!resp.success) {
        UI.toast('Failed to load page content.', 'error');
        return;
    }

    document.getElementById('modal-title').innerText = 'Edit Page';
    document.getElementById('page-id').value = id;
    document.getElementById('page-title-input').value = resp.data.title;
    document.getElementById('page-slug-input').value = resp.data.slug;
    document.getElementById('page-content-input').value = resp.data.content || '';
    document.getElementById('page-meta-desc').value = resp.data.meta_desc || '';
    document.getElementById('page-meta-keywords').value = resp.data.meta_keywords || '';
    document.getElementById('page-status').value = resp.data.status;

    UI.modal.open('page-modal');
}

document.getElementById('page-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('submit-btn');
    const originalContent = btn.innerHTML;

    btn.disabled = true;
    btn.innerHTML = '<svg class="animate-spin w-4 h-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>';

    const id = document.getElementById('page-id').value;
    const action = id ? 'update' : 'create';
    const fd = new FormData(this);
    fd.append('csrf_token', window.CSRF_TOKEN);
    fd.append('action', action);
    fd.append('type', 'page');

    try {
        const res = await fetch(`/backend/api/content.php?action=${action}&type=page`, {
            method: 'POST',
            body: fd
        });
        const data = await res.json();

        if (data.success) {
            UI.toast('Page saved successfully ✓', 'success');
            UI.modal.close('page-modal');
            loadPages();
        } else {
            UI.toast(data.message || 'Error occurred during save.', 'error');
        }
    } catch (err) {
        console.error(err);
        UI.toast('Communications failure.', 'error');
    } finally {
        btn.disabled = false;
        btn.innerHTML = originalContent;
    }
});

async function deletePage(id) {
    if (!UI.confirm('Are you sure you want to permanently delete this page? Any navigation links using its slug will break.')) return;

    const fd = makeFormData({ id });
    const res = await UI.apiPost('/backend/api/content.php?action=delete&type=page', fd);
    if (res.success) {
        UI.toast('Page deleted.', 'success');
        loadPages();
    } else {
        UI.toast(res.message || 'Failed to delete page.', 'error');
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
