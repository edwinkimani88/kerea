<?php
include 'includes/header.php';
$initialType = Security::clean($_GET['type'] ?? 'event');
?>

<div class="space-y-12">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
        <div class="gsap-reveal">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Events & Training</h2>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Manage Public Events, Workshops & Training Courses</p>
        </div>
        <button onclick="openCreateModal()" class="gsap-reveal px-8 py-4 bg-primary text-black rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-primary/20 flex items-center gap-3 hover:scale-105 transition-all">
            <i data-lucide="plus" class="w-4 h-4"></i> Create Entry
        </button>
    </div>

    <!-- Navigation Tabs -->
    <div class="gsap-reveal border-b border-slate-200">
        <nav class="flex space-x-8" aria-label="Tabs">
            <button onclick="switchTab('event')" id="tab-event" 
                class="tab-btn pb-4 px-1 border-b-2 font-black text-xs uppercase tracking-wider transition-all
                       <?php echo $initialType === 'event' ? 'border-primary text-black' : 'border-transparent text-slate-400 hover:text-slate-600'; ?>">
                Events & Expos
            </button>
            <button onclick="switchTab('workshop')" id="tab-workshop" 
                class="tab-btn pb-4 px-1 border-b-2 font-black text-xs uppercase tracking-wider transition-all
                       <?php echo $initialType === 'workshop' ? 'border-primary text-black' : 'border-transparent text-slate-400 hover:text-slate-600'; ?>">
                Workshops
            </button>
            <button onclick="switchTab('training_programme')" id="tab-training_programme" 
                class="tab-btn pb-4 px-1 border-b-2 font-black text-xs uppercase tracking-wider transition-all
                       <?php echo $initialType === 'training_programme' ? 'border-primary text-black' : 'border-transparent text-slate-400 hover:text-slate-600'; ?>">
                Training Programmes
            </button>
        </nav>
    </div>

    <!-- Search Controls -->
    <div class="gsap-reveal flex flex-col md:flex-row md:items-center justify-between gap-4 card-bg p-6 rounded-3xl shadow-sm">
        <div class="relative flex-1 max-w-md">
            <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
            <input type="text" id="search-input" oninput="debounceSearch()" placeholder="Search title or location..." 
                class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold focus:outline-none">
        </div>
        <select id="status-filter" onchange="loadList()" class="px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold outline-none cursor-pointer">
            <option value="">All Statuses</option>
            <option value="upcoming">Upcoming</option>
            <option value="ongoing">Ongoing</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
            <option value="active">Active</option>
            <option value="draft">Draft</option>
            <option value="archived">Archived</option>
        </select>
    </div>

    <!-- Events List Table -->
    <div class="gsap-reveal card-bg rounded-[3rem] shadow-premium overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left" id="events-table">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Details</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Dates / Duration</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Pricing / Cap</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Status</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50" id="events-tbody">
                    <!-- Loaded dynamically -->
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
                <h3 class="text-2xl font-black text-slate-800 tracking-tight" id="modal-title">Create Item</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" id="modal-subtitle">Configure Schedule Details</p>
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

    const tbody = document.getElementById('events-tbody');
    const pagContainer = document.getElementById('pagination-container');
    tbody.innerHTML = '';

    if (!resp.success || !resp.data || resp.data.data.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" class="px-8 py-12 text-center text-slate-400">
                    <i data-lucide="calendar" class="w-10 h-10 mx-auto mb-3 opacity-30"></i>
                    <p class="text-xs font-black uppercase tracking-wider">No events, workshops, or training courses found.</p>
                </td>
            </tr>
        `;
        pagContainer.innerHTML = '';
        lucide.createIcons();
        return;
    }

    resp.data.data.forEach(item => {
        let datesLine = item.start_date || 'N/A';
        if (item.end_date) datesLine += ` to ${item.end_date}`;
        if (item.duration) datesLine = `Duration: ${item.duration}`;

        let detailsLine = '';
        let pricingLine = 'Free';
        if (item.fee > 0) pricingLine = `KSh ${parseFloat(item.fee).toLocaleString()}`;
        if (item.capacity) pricingLine += ` · Cap: ${item.capacity}`;

        if (currentType === 'event') {
            detailsLine = `Type: ${item.event_type} · Venue: ${item.venue || 'N/A'}`;
        } else if (currentType === 'workshop') {
            detailsLine = `Facilitator: ${item.facilitator || 'N/A'} · Venue: ${item.venue || 'N/A'}`;
        } else if (currentType === 'training_programme') {
            detailsLine = `Level: ${item.level} · Delivery: ${item.delivery_mode}`;
            pricingLine = item.fee > 0 ? `KSh ${parseFloat(item.fee).toLocaleString()}` : 'Free';
        }

        const isFeatured = item.featured ? true : false;
        const s = item.status;
        let statusBadge = '';
        if (s === 'upcoming' || s === 'active') statusBadge = '<span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[9px] font-black uppercase">Upcoming/Active</span>';
        else if (s === 'ongoing') statusBadge = '<span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-lg text-[9px] font-black uppercase">Ongoing</span>';
        else if (s === 'completed') statusBadge = '<span class="px-2.5 py-1 bg-slate-100 text-slate-500 rounded-lg text-[9px] font-black uppercase">Completed</span>';
        else if (s === 'cancelled' || s === 'archived') statusBadge = '<span class="px-2.5 py-1 bg-red-50 text-red-600 rounded-lg text-[9px] font-black uppercase">Cancelled/Draft</span>';
        else statusBadge = `<span class="px-2.5 py-1 bg-amber-50 text-amber-600 rounded-lg text-[9px] font-black uppercase">${s}</span>`;

        const tr = document.createElement('tr');
        tr.className = "hover:bg-slate-50/50 transition-all";
        tr.innerHTML = `
            <td class="px-8 py-5">
                <div>
                    <h4 class="text-sm font-black text-slate-800">${UI.escapeHtml(item.title)}</h4>
                    <p class="text-[9px] font-bold text-slate-400 mt-1 uppercase">${UI.escapeHtml(detailsLine)}</p>
                </div>
            </td>
            <td class="px-8 py-5 text-xs font-bold text-slate-500">${UI.escapeHtml(datesLine)}</td>
            <td class="px-8 py-5 text-xs font-bold text-slate-500">${pricingLine}</td>
            <td class="px-8 py-5">
                ${statusBadge}
                ${(item.featured !== undefined && isFeatured) ? '<span class="ml-2 px-2 py-0.5 bg-yellow-50 text-yellow-600 rounded-lg text-[8px] font-black uppercase">Featured</span>' : ''}
            </td>
            <td class="px-8 py-5 text-right">
                <div class="flex items-center justify-end gap-2">
                    ${(item.featured !== undefined) ? `
                    <button onclick="toggleField(${item.id}, 'featured')" class="p-2 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-yellow-500 transition-all shadow-sm" title="Toggle Featured">
                        <i data-lucide="star" class="w-4 h-4 ${isFeatured ? 'fill-yellow-400 text-yellow-400' : ''}"></i>
                    </button>` : ''}
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

    let html = `
        <div class="space-y-2">
            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Title</label>
            <input type="text" name="title" required value="${getVal('title')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
        </div>
        <div class="space-y-2">
            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Description</label>
            <textarea name="description" rows="2" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none resize-none">${getVal('description')}</textarea>
        </div>
        <div class="space-y-2">
            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Main Content details</label>
            <textarea name="content" rows="4" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">${getVal('content')}</textarea>
        </div>
    `;

    if (currentType === 'event') {
        html += `
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Event Type</label>
                    <select name="event_type" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="conference" ${getVal('event_type') === 'conference' ? 'selected' : ''}>Conference</option>
                        <option value="workshop" ${getVal('event_type') === 'workshop' ? 'selected' : ''}>Workshop</option>
                        <option value="summit" ${getVal('event_type') === 'summit' ? 'selected' : ''}>Summit</option>
                        <option value="expo" ${getVal('event_type') === 'expo' ? 'selected' : ''}>Expo</option>
                        <option value="webinar" ${getVal('event_type') === 'webinar' ? 'selected' : ''}>Webinar</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Venue</label>
                    <input type="text" name="venue" value="${getVal('venue')}" placeholder="e.g. KICC, Nairobi" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Start Date</label>
                    <input type="date" name="start_date" required value="${getVal('start_date')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">End Date</label>
                    <input type="date" name="end_date" value="${getVal('end_date')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Registration URL</label>
                    <input type="text" name="registration_url" value="${getVal('registration_url')}" placeholder="External registration link" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Seat Capacity</label>
                    <input type="number" name="capacity" value="${getVal('capacity')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Status</label>
                    <select name="status" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="upcoming" ${getVal('status') === 'upcoming' ? 'selected' : ''}>Upcoming</option>
                        <option value="ongoing" ${getVal('status') === 'ongoing' ? 'selected' : ''}>Ongoing</option>
                        <option value="completed" ${getVal('status') === 'completed' ? 'selected' : ''}>Completed</option>
                        <option value="cancelled" ${getVal('status') === 'cancelled' ? 'selected' : ''}>Cancelled</option>
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
        `;
    } else if (currentType === 'workshop') {
        html += `
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Facilitator</label>
                    <input type="text" name="facilitator" value="${getVal('facilitator')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Venue</label>
                    <input type="text" name="venue" value="${getVal('venue')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Start Date</label>
                    <input type="date" name="start_date" required value="${getVal('start_date')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">End Date</label>
                    <input type="date" name="end_date" value="${getVal('end_date')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Fee (KSh)</label>
                    <input type="number" name="fee" value="${getVal('fee')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Capacity</label>
                    <input type="number" name="capacity" value="${getVal('capacity')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Status</label>
                    <select name="status" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="upcoming" ${getVal('status') === 'upcoming' ? 'selected' : ''}>Upcoming</option>
                        <option value="ongoing" ${getVal('status') === 'ongoing' ? 'selected' : ''}>Ongoing</option>
                        <option value="completed" ${getVal('status') === 'completed' ? 'selected' : ''}>Completed</option>
                        <option value="cancelled" ${getVal('status') === 'cancelled' ? 'selected' : ''}>Cancelled</option>
                    </select>
                </div>
            </div>
        `;
    } else if (currentType === 'training_programme') {
        html += `
            <div class="grid grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Duration</label>
                    <input type="text" name="duration" value="${getVal('duration')}" placeholder="e.g. 3 Days" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Delivery Mode</label>
                    <select name="delivery_mode" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="in-person" ${getVal('delivery_mode') === 'in-person' ? 'selected' : ''}>In-Person</option>
                        <option value="online" ${getVal('delivery_mode') === 'online' ? 'selected' : ''}>Online</option>
                        <option value="hybrid" ${getVal('delivery_mode') === 'hybrid' ? 'selected' : ''}>Hybrid</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Skill Level</label>
                    <select name="level" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="beginner" ${getVal('level') === 'beginner' ? 'selected' : ''}>Beginner</option>
                        <option value="intermediate" ${getVal('level') === 'intermediate' ? 'selected' : ''}>Intermediate</option>
                        <option value="advanced" ${getVal('level') === 'advanced' ? 'selected' : ''}>Advanced</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Fee (KSh)</label>
                    <input type="number" name="fee" value="${getVal('fee')}" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Status</label>
                    <select name="status" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="draft" ${getVal('status') === 'draft' ? 'selected' : ''}>Draft</option>
                        <option value="active" ${getVal('status') === 'active' ? 'selected' : ''}>Active</option>
                        <option value="archived" ${getVal('status') === 'archived' ? 'selected' : ''}>Archived</option>
                    </select>
                </div>
                <div class="space-y-2 flex flex-col justify-center pl-4">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Featured</label>
                    <div class="flex items-center">
                        <input type="checkbox" name="featured" value="1" ${getVal('featured') ? 'checked' : ''} class="w-4 h-4 accent-primary">
                    </div>
                </div>
            </div>
        `;
    }

    html += `
        <div class="space-y-2">
            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Promo Image Graphic</label>
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

    const checkboxFields = ['featured'];
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
