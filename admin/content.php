<?php
include 'includes/header.php';
// Get initial type from URL
$initialType = Security::clean($_GET['type'] ?? 'news');
?>

<div class="space-y-12">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
        <div class="gsap-reveal">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Custom CMS Manager</h2>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Manage Website Content & Resources</p>
        </div>
        <button onclick="openCreateModal()" class="gsap-reveal px-8 py-4 bg-primary text-black rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-primary/20 flex items-center gap-3 hover:scale-105 transition-all">
            <i data-lucide="plus" class="w-4 h-4"></i> Create New Item
        </button>
    </div>

    <!-- Content Type Navigation Tabs -->
    <div class="gsap-reveal border-b border-slate-200">
        <nav class="flex flex-wrap -mb-px space-x-8" aria-label="Tabs">
            <?php
            $tabs = [
                'news'          => 'News & Press',
                'blog'          => 'Blog Articles',
                'publication'   => 'Publications',
                'knowledge_hub' => 'Knowledge Hub',
                'download'      => 'Downloads',
                'success_story' => 'Success Stories',
                'faq'           => 'FAQs',
                'testimonial'   => 'Testimonials',
            ];
            foreach ($tabs as $key => $label):
            ?>
            <button onclick="switchTab('<?php echo $key; ?>')" id="tab-<?php echo $key; ?>" 
                class="tab-btn pb-4 px-1 border-b-2 font-black text-xs uppercase tracking-wider transition-all
                       <?php echo $initialType === $key ? 'border-primary text-black' : 'border-transparent text-slate-400 hover:text-slate-600'; ?>">
                <?php echo $label; ?>
            </button>
            <?php endforeach; ?>
        </nav>
    </div>

    <!-- Search & Filter Controls -->
    <div class="gsap-reveal flex flex-col md:flex-row md:items-center justify-between gap-4 card-bg p-6 rounded-3xl shadow-sm">
        <div class="relative flex-1 max-w-md">
            <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
            <input type="text" id="search-input" oninput="debounceSearch()" placeholder="Search title or description..." 
                class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold focus:outline-none">
        </div>
        <div class="flex items-center gap-3">
            <select id="status-filter" onchange="loadContentList()" class="px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold outline-none cursor-pointer">
                <option value="">All Statuses</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
                <option value="archived">Archived</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
    </div>

    <!-- Content Table Container -->
    <div class="gsap-reveal card-bg rounded-[3rem] shadow-premium overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left" id="content-table">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Title / Info</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Details</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Status</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50" id="content-tbody">
                    <!-- Loaded dynamically via AJAX -->
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between" id="pagination-container">
            <!-- Loaded dynamically -->
        </div>
    </div>
</div>

<!-- Add/Edit Dynamic Content Modal -->
<div id="content-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-2xl bg-white rounded-[3rem] shadow-2xl p-10 space-y-8 relative overflow-y-auto max-h-[90vh]">
        <div class="absolute top-0 left-0 w-full h-2 bg-primary"></div>
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight" id="modal-title">Create Item</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" id="modal-subtitle">Content Editor</p>
            </div>
            <button onclick="UI.modal.close('content-modal')" class="p-2 bg-slate-50 text-slate-400 hover:text-red-500 rounded-xl transition-all">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        
        <form id="content-form" class="space-y-6" enctype="multipart/form-data">
            <input type="hidden" name="id" id="item-id">
            
            <!-- Form fields are rendered dynamically based on selected type -->
            <div id="dynamic-fields" class="space-y-6"></div>

            <div class="flex gap-4 pt-4 border-t border-slate-100">
                <button type="button" onclick="UI.modal.close('content-modal')" class="flex-1 py-4 border border-slate-100 text-[10px] font-black uppercase text-slate-400 rounded-2xl hover:bg-slate-50 transition-all">Cancel</button>
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
    loadContentList();
});

function switchTab(type) {
    currentType = type;
    currentPage = 1;
    
    // Update active tab styling
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.className = "tab-btn pb-4 px-1 border-b-2 font-black text-xs uppercase tracking-wider transition-all border-transparent text-slate-400 hover:text-slate-600";
    });
    const activeTab = document.getElementById('tab-' + type);
    if (activeTab) {
        activeTab.className = "tab-btn pb-4 px-1 border-b-2 font-black text-xs uppercase tracking-wider transition-all border-primary text-black";
    }

    // Update address bar history
    const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?type=' + type;
    window.history.pushState({path: newUrl}, '', newUrl);

    // Reset filters
    document.getElementById('search-input').value = '';
    document.getElementById('status-filter').value = '';

    loadContentList();
}

function debounceSearch() {
    clearTimeout(searchDebounceTimer);
    searchDebounceTimer = setTimeout(() => {
        currentPage = 1;
        loadContentList();
    }, 400);
}

async function loadContentList() {
    const search = encodeURIComponent(document.getElementById('search-input').value);
    const status = encodeURIComponent(document.getElementById('status-filter').value);
    
    const url = `/backend/api/content.php?action=list&type=${currentType}&page=${currentPage}&search=${search}&status=${status}`;
    const resp = await UI.apiGet(url);
    
    const tbody = document.getElementById('content-tbody');
    const pagContainer = document.getElementById('pagination-container');
    tbody.innerHTML = '';
    
    if (!resp.success || !resp.data || resp.data.data.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" class="px-8 py-12 text-center text-slate-400">
                    <i data-lucide="folder-open" class="w-10 h-10 mx-auto mb-3 opacity-30"></i>
                    <p class="text-xs font-black uppercase tracking-wider">No matching content records found.</p>
                </td>
            </tr>
        `;
        pagContainer.innerHTML = '';
        lucide.createIcons();
        return;
    }
    
    resp.data.data.forEach(item => {
        let titleLine = item.title || item.question || item.name || `Unnamed Item ID: ${item.id}`;
        let detailsLine = '';
        let statusBadge = '';

        if (currentType === 'news' || currentType === 'blog') {
            detailsLine = `Category: ${item.category || 'General'} · Excerpt: ${item.excerpt || 'None'}`;
            const s = item.status;
            statusBadge = s === 'published' ? '<span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[9px] font-black uppercase">Published</span>' 
                        : s === 'draft' ? '<span class="px-2.5 py-1 bg-amber-50 text-amber-600 rounded-lg text-[9px] font-black uppercase">Draft</span>'
                        : '<span class="px-2.5 py-1 bg-slate-100 text-slate-500 rounded-lg text-[9px] font-black uppercase">Archived</span>';
        } else if (currentType === 'publication') {
            detailsLine = `Category: ${item.category} · Year: ${item.year || 'N/A'} · Authors: ${item.authors || 'N/A'}`;
            statusBadge = item.status === 'published' ? '<span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[9px] font-black uppercase">Published</span>' : '<span class="px-2.5 py-1 bg-amber-50 text-amber-600 rounded-lg text-[9px] font-black uppercase">Draft</span>';
        } else if (currentType === 'knowledge_hub') {
            detailsLine = `Category: ${item.category} · Downloads: ${item.downloads}`;
            statusBadge = item.status === 'published' ? '<span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[9px] font-black uppercase">Published</span>' : '<span class="px-2.5 py-1 bg-amber-50 text-amber-600 rounded-lg text-[9px] font-black uppercase">Draft</span>';
        } else if (currentType === 'download') {
            detailsLine = `Category: ${item.category} · Downloads: ${item.downloads}`;
            statusBadge = item.status === 'active' ? '<span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[9px] font-black uppercase">Active</span>' : '<span class="px-2.5 py-1 bg-red-50 text-red-600 rounded-lg text-[9px] font-black uppercase">Inactive</span>';
        } else if (currentType === 'success_story') {
            detailsLine = `Org: ${item.organisation || 'N/A'} · Impact: ${item.impact || 'N/A'}`;
            statusBadge = item.status === 'published' ? '<span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[9px] font-black uppercase">Published</span>' : '<span class="px-2.5 py-1 bg-amber-50 text-amber-600 rounded-lg text-[9px] font-black uppercase">Draft</span>';
        } else if (currentType === 'faq') {
            titleLine = item.question;
            detailsLine = `Category: ${item.category} · Sort Order: ${item.sort_order}`;
            statusBadge = item.is_active ? '<span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[9px] font-black uppercase">Active</span>' : '<span class="px-2.5 py-1 bg-red-50 text-red-600 rounded-lg text-[9px] font-black uppercase">Inactive</span>';
        } else if (currentType === 'testimonial') {
            titleLine = `${item.name} (${item.title || 'N/A'})`;
            detailsLine = `Quote: "${item.quote.substring(0, 50)}..." · Rating: ${item.rating || 'N/A'}`;
            statusBadge = item.is_active ? '<span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[9px] font-black uppercase">Active</span>' : '<span class="px-2.5 py-1 bg-red-50 text-red-600 rounded-lg text-[9px] font-black uppercase">Inactive</span>';
        }

        const isFeatured = item.featured ? true : false;

        const tr = document.createElement('tr');
        tr.className = "hover:bg-slate-50/50 transition-all";
        tr.innerHTML = `
            <td class="px-8 py-5">
                <div>
                    <h4 class="text-sm font-black text-slate-800">${UI.escapeHtml(titleLine)}</h4>
                    <p class="text-[9px] font-bold text-slate-400 mt-1 uppercase">ID: ${item.id} · Created: ${item.created_at || 'N/A'}</p>
                </div>
            </td>
            <td class="px-8 py-5">
                <p class="text-xs font-bold text-slate-500">${UI.escapeHtml(detailsLine)}</p>
            </td>
            <td class="px-8 py-5">
                ${statusBadge}
                ${(item.featured !== undefined) ? (isFeatured ? '<span class="ml-2 px-2 py-0.5 bg-yellow-50 text-yellow-600 rounded-lg text-[8px] font-black uppercase">★ Featured</span>' : '') : ''}
            </td>
            <td class="px-8 py-5 text-right">
                <div class="flex items-center justify-end gap-2">
                    ${(item.featured !== undefined) ? `
                    <button onclick="toggleField(${item.id}, 'featured')" class="p-2 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-yellow-500 transition-all shadow-sm" title="Toggle Featured">
                        <i data-lucide="star" class="w-4 h-4 ${isFeatured ? 'fill-yellow-400 text-yellow-400' : ''}"></i>
                    </button>` : ''}
                    <button onclick="openEditModal(${item.id})" class="p-2 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-primary transition-all shadow-sm" title="Edit">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                    </button>
                    <button onclick="deleteItem(${item.id})" class="p-2 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-red-500 transition-all shadow-sm" title="Delete">
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
        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Page ${cur} of ${last} · Total ${pageData.total} items</span>
        <div class="flex gap-2">
            <button onclick="changePage(${cur - 1})" ${cur === 1 ? 'disabled' : ''} class="px-4 py-2 bg-white border border-slate-100 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-500 hover:bg-primary hover:text-black disabled:opacity-50 disabled:pointer-events-none transition-all">Prev</button>
            <button onclick="changePage(${cur + 1})" ${cur === last ? 'disabled' : ''} class="px-4 py-2 bg-white border border-slate-100 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-500 hover:bg-primary hover:text-black disabled:opacity-50 disabled:pointer-events-none transition-all">Next</button>
        </div>
    `;
}

function changePage(page) {
    currentPage = page;
    loadContentList();
}

function renderFields(item = null) {
    const fieldsDiv = document.getElementById('dynamic-fields');
    fieldsDiv.innerHTML = '';

    const getVal = (key, def = '') => item ? (item[key] !== null ? item[key] : def) : def;

    let html = '';

    // Render general fields based on active tab type
    if (currentType === 'news' || currentType === 'blog') {
        html += `
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Title</label>
                <input type="text" name="title" required value="${getVal('title')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Excerpt</label>
                <textarea name="excerpt" rows="2" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none resize-none">${getVal('excerpt')}</textarea>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Content (HTML Support)</label>
                <textarea name="content" rows="6" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">${getVal('content')}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Category</label>
                    <input type="text" name="category" value="${getVal('category', 'general')}" placeholder="e.g. Industry News" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Tags</label>
                    <input type="text" name="tags" value="${getVal('tags')}" placeholder="e.g. solar, policy" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Status</label>
                    <select name="status" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="draft" ${getVal('status') === 'draft' ? 'selected' : ''}>Draft</option>
                        <option value="published" ${getVal('status') === 'published' ? 'selected' : ''}>Published</option>
                        <option value="archived" ${getVal('status') === 'archived' ? 'selected' : ''}>Archived</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Visibility</label>
                    <select name="visibility" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="public" ${getVal('visibility') === 'public' ? 'selected' : ''}>Public</option>
                        <option value="members_only" ${getVal('visibility') === 'members_only' ? 'selected' : ''}>Members Only</option>
                    </select>
                </div>
                <div class="space-y-2 flex flex-col justify-center pl-4">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Featured</label>
                    <div class="flex items-center">
                        <input type="checkbox" name="featured" value="1" ${getVal('featured') ? 'checked' : ''} class="w-4 h-4 accent-primary">
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Cover Image (Optional)</label>
                <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-primary/10 file:text-black hover:file:bg-primary/20 cursor-pointer">
            </div>
        `;
    } else if (currentType === 'publication') {
        html += `
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Title</label>
                <input type="text" name="title" required value="${getVal('title')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Description</label>
                <textarea name="description" rows="3" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none resize-none">${getVal('description')}</textarea>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Category</label>
                    <select name="category" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="report" ${getVal('category') === 'report' ? 'selected' : ''}>Report</option>
                        <option value="standard" ${getVal('category') === 'standard' ? 'selected' : ''}>Standard</option>
                        <option value="brief" ${getVal('category') === 'brief' ? 'selected' : ''}>Brief</option>
                        <option value="guide" ${getVal('category') === 'guide' ? 'selected' : ''}>Guide</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Year</label>
                    <input type="number" name="year" value="${getVal('year', new Date().getFullYear())}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Authors</label>
                    <input type="text" name="authors" value="${getVal('authors')}" placeholder="e.g. KEREA Secretariat" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Status</label>
                    <select name="status" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="draft" ${getVal('status') === 'draft' ? 'selected' : ''}>Draft</option>
                        <option value="published" ${getVal('status') === 'published' ? 'selected' : ''}>Published</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Visibility</label>
                    <select name="visibility" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="public" ${getVal('visibility') === 'public' ? 'selected' : ''}>Public</option>
                        <option value="members_only" ${getVal('visibility') === 'members_only' ? 'selected' : ''}>Members Only</option>
                    </select>
                </div>
                <div class="space-y-2 flex flex-col justify-center pl-4">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Featured</label>
                    <div class="flex items-center">
                        <input type="checkbox" name="featured" value="1" ${getVal('featured') ? 'checked' : ''} class="w-4 h-4 accent-primary">
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">PDF Document File</label>
                    <input type="file" name="file" accept="application/pdf" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-primary/10 file:text-black hover:file:bg-primary/20 cursor-pointer">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Cover Image Thumbnail</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-primary/10 file:text-black hover:file:bg-primary/20 cursor-pointer">
                </div>
            </div>
        `;
    } else if (currentType === 'knowledge_hub') {
        html += `
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Title</label>
                <input type="text" name="title" required value="${getVal('title')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Description</label>
                <textarea name="description" rows="2" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none resize-none">${getVal('description')}</textarea>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Detailed Content (HTML Support)</label>
                <textarea name="content" rows="4" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">${getVal('content')}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Category</label>
                    <input type="text" name="category" value="${getVal('category', 'resource')}" placeholder="e.g. standard" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Tags</label>
                    <input type="text" name="tags" value="${getVal('tags')}" placeholder="e.g. standards, bio-ethanol" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Status</label>
                    <select name="status" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="draft" ${getVal('status') === 'draft' ? 'selected' : ''}>Draft</option>
                        <option value="published" ${getVal('status') === 'published' ? 'selected' : ''}>Published</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Visibility</label>
                    <select name="visibility" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="public" ${getVal('visibility') === 'public' ? 'selected' : ''}>Public</option>
                        <option value="members_only" ${getVal('visibility') === 'members_only' ? 'selected' : ''}>Members Only</option>
                    </select>
                </div>
                <div class="space-y-2 flex flex-col justify-center pl-4">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Featured</label>
                    <div class="flex items-center">
                        <input type="checkbox" name="featured" value="1" ${getVal('featured') ? 'checked' : ''} class="w-4 h-4 accent-primary">
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Downloadable Attachment</label>
                    <input type="file" name="file" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-primary/10 file:text-black hover:file:bg-primary/20 cursor-pointer">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Thumbnail Graphic</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-primary/10 file:text-black hover:file:bg-primary/20 cursor-pointer">
                </div>
            </div>
        `;
    } else if (currentType === 'download') {
        html += `
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Resource Title</label>
                <input type="text" name="title" required value="${getVal('title')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Short Description</label>
                <textarea name="description" rows="3" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none resize-none">${getVal('description')}</textarea>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Category</label>
                    <input type="text" name="category" value="${getVal('category', 'general')}" placeholder="e.g. Forms" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Visibility</label>
                    <select name="visibility" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="public" ${getVal('visibility') === 'public' ? 'selected' : ''}>Public</option>
                        <option value="members_only" ${getVal('visibility') === 'members_only' ? 'selected' : ''}>Members Only</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Status</label>
                    <select name="status" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="active" ${getVal('status') === 'active' ? 'selected' : ''}>Active</option>
                        <option value="inactive" ${getVal('status') === 'inactive' ? 'selected' : ''}>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">File Attachment</label>
                <input type="file" name="file" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-primary/10 file:text-black hover:file:bg-primary/20 cursor-pointer">
            </div>
        `;
    } else if (currentType === 'success_story') {
        html += `
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Title</label>
                <input type="text" name="title" required value="${getVal('title')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Excerpt</label>
                <textarea name="excerpt" rows="2" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none resize-none">${getVal('excerpt')}</textarea>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Content (HTML Support)</label>
                <textarea name="content" rows="5" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">${getVal('content')}</textarea>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Organisation</label>
                    <input type="text" name="organisation" value="${getVal('organisation')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Location</label>
                    <input type="text" name="location" value="${getVal('location')}" placeholder="e.g. Nakuru, Kenya" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Short Impact Quote</label>
                    <input type="text" name="impact" value="${getVal('impact')}" placeholder="e.g. 500 households solarized" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Status</label>
                    <select name="status" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="draft" ${getVal('status') === 'draft' ? 'selected' : ''}>Draft</option>
                        <option value="published" ${getVal('status') === 'published' ? 'selected' : ''}>Published</option>
                    </select>
                </div>
                <div class="space-y-2 flex flex-col justify-center pl-4 col-span-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Featured Story</label>
                    <div class="flex items-center">
                        <input type="checkbox" name="featured" value="1" ${getVal('featured') ? 'checked' : ''} class="w-4 h-4 accent-primary">
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Story Photo</label>
                <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-primary/10 file:text-black hover:file:bg-primary/20 cursor-pointer">
            </div>
        `;
    } else if (currentType === 'faq') {
        html += `
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Question</label>
                <input type="text" name="question" required value="${getVal('question')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Answer (HTML Support)</label>
                <textarea name="answer" rows="4" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">${getVal('answer')}</textarea>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Category</label>
                    <input type="text" name="category" value="${getVal('category', 'general')}" placeholder="e.g. general" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Sort Order</label>
                    <input type="number" name="sort_order" value="${getVal('sort_order', '0')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2 flex flex-col justify-center pl-4">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Active</label>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" ${getVal('is_active', 1) ? 'checked' : ''} class="w-4 h-4 accent-primary">
                    </div>
                </div>
            </div>
        `;
    } else if (currentType === 'testimonial') {
        html += `
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Person Name</label>
                <input type="text" name="name" required value="${getVal('name')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Job Title</label>
                    <input type="text" name="title" value="${getVal('title')}" placeholder="e.g. Managing Director" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Organisation</label>
                    <input type="text" name="organisation" value="${getVal('organisation')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Quote Text</label>
                <textarea name="quote" rows="3" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none resize-none">${getVal('quote')}</textarea>
            </div>
            <div class="grid grid-cols-4 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Rating (1-5)</label>
                    <input type="number" min="1" max="5" name="rating" value="${getVal('rating', '5')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Sort Order</label>
                    <input type="number" name="sort_order" value="${getVal('sort_order', '0')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2 flex flex-col justify-center pl-4">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Featured</label>
                    <div class="flex items-center">
                        <input type="checkbox" name="featured" value="1" ${getVal('featured') ? 'checked' : ''} class="w-4 h-4 accent-primary">
                    </div>
                </div>
                <div class="space-y-2 flex flex-col justify-center pl-4">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Active</label>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" ${getVal('is_active', 1) ? 'checked' : ''} class="w-4 h-4 accent-primary">
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Avatar Photo</label>
                <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-primary/10 file:text-black hover:file:bg-primary/20 cursor-pointer">
            </div>
        `;
    }

    fieldsDiv.innerHTML = html;
}

function openCreateModal() {
    document.getElementById('content-form').reset();
    document.getElementById('item-id').value = '';
    
    document.getElementById('modal-title').innerText = `Create ${document.getElementById('tab-' + currentType).innerText}`;
    document.getElementById('modal-subtitle').innerText = 'Insert new entry into database';
    
    renderFields();
    UI.modal.open('content-modal');
}

async function openEditModal(id) {
    const resp = await UI.apiGet(`/backend/api/content.php?action=get&type=${currentType}&id=${id}`);
    if (!resp.success) {
        UI.toast('Failed to load item data.', 'error');
        return;
    }

    document.getElementById('modal-title').innerText = `Edit ${document.getElementById('tab-' + currentType).innerText}`;
    document.getElementById('modal-subtitle').innerText = `Update record ID: ${id}`;
    
    document.getElementById('item-id').value = id;
    renderFields(resp.data);
    UI.modal.open('content-modal');
}

document.getElementById('content-form').addEventListener('submit', async function(e) {
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

    // If checkbox values are unchecked, they don't submit. Force-add them.
    const checkboxFields = ['featured', 'is_active', 'is_board'];
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
            UI.modal.close('content-modal');
            loadContentList();
        } else {
            UI.toast(data.message || 'Error occurred during save.', 'error');
        }
    } catch (err) {
        console.error(err);
        UI.toast('Network communications error.', 'error');
    } finally {
        btn.disabled = false;
        btn.innerHTML = originalContent;
    }
});

async function toggleField(id, field) {
    const fd = makeFormData({ id, field });
    const res = await UI.apiPost(`/backend/api/content.php?action=toggle&type=${currentType}`, fd);
    if (res.success) {
        UI.toast('Status updated successfully.', 'success');
        loadContentList();
    } else {
        UI.toast(res.message || 'Toggle failed.', 'error');
    }
}

async function deleteItem(id) {
    if (!UI.confirm('Are you absolutely sure you want to permanently delete this item?')) return;
    
    const fd = makeFormData({ id });
    const res = await UI.apiPost(`/backend/api/content.php?action=delete&type=${currentType}`, fd);
    if (res.success) {
        UI.toast('Item successfully deleted.', 'success');
        loadContentList();
    } else {
        UI.toast(res.message || 'Deletion failed.', 'error');
    }
}

// Global UI escapes
UI.escapeHtml = function(text) {
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
};
</script>

<?php include 'includes/footer.php'; ?>
