<?php
include 'includes/header.php';
?>

<div class="space-y-12">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
        <div class="gsap-reveal">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Navigation Menus</h2>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Manage Website Navigation Bars & Footer Links</p>
        </div>
        <div class="flex gap-3 gsap-reveal">
            <button onclick="saveSortOrders()" class="px-6 py-4 bg-white border border-slate-200 hover:border-slate-300 text-slate-500 rounded-2xl text-xs font-black uppercase tracking-widest shadow-sm transition-all">
                Save Link Orders
            </button>
            <button onclick="openCreateModal()" class="px-8 py-4 bg-primary text-black rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-primary/20 flex items-center gap-3 hover:scale-105 transition-all">
                <i data-lucide="plus" class="w-4 h-4"></i> Add Navigation Link
            </button>
        </div>
    </div>

    <!-- Menu Selector & Controls -->
    <div class="gsap-reveal flex flex-col md:flex-row md:items-center justify-between gap-4 card-bg p-6 rounded-3xl shadow-sm">
        <div class="flex items-center gap-3">
            <label class="text-[10px] font-black uppercase tracking-widest text-slate-450 px-2">Selected Navigation Area</label>
            <select id="menu-select" onchange="loadMenuItems()" class="px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold outline-none cursor-pointer">
                <!-- Loaded dynamically -->
            </select>
        </div>
        <div class="text-[10px] font-black text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-full uppercase tracking-wider">
            Drag/Sort or assign child items to build dropdown arrays
        </div>
    </div>

    <!-- Menu Tree/Table -->
    <div class="gsap-reveal card-bg rounded-[3rem] shadow-premium overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left" id="links-table">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Navigation Label</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Destination URL</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Target</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Sort Order</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Status</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50" id="links-tbody">
                    <!-- Loaded dynamically -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add/Edit Link Modal -->
<div id="link-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-lg bg-white rounded-[3rem] shadow-2xl p-10 space-y-8 relative">
        <div class="absolute top-0 left-0 w-full h-2 bg-primary"></div>
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight" id="modal-title">Add Navigation Link</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Menu Configuration Editor</p>
            </div>
            <button onclick="UI.modal.close('link-modal')" class="p-2 bg-slate-50 text-slate-400 hover:text-red-500 rounded-xl transition-all">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form id="link-form" class="space-y-6">
            <input type="hidden" name="id" id="link-id">
            <input type="hidden" name="menu_id" id="form-menu-id">

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Link Label</label>
                    <input type="text" name="label" id="link-label" required placeholder="e.g. Policies" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Destination URL / Route</label>
                    <input type="text" name="url" id="link-url" required placeholder="e.g. /policy-advocacy/" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Target Behavior</label>
                    <select name="target" id="link-target" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="_self">Same Window (_self)</option>
                        <option value="_blank">New Tab (_blank)</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Parent Link (For Dropdowns)</label>
                    <select name="parent_id" id="link-parent" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <option value="">None (Top Level)</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Lucide Icon (Optional)</label>
                    <input type="text" name="icon" id="link-icon" placeholder="e.g. home" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Sort Position</label>
                    <input type="number" name="sort_order" id="link-sort" value="0" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2 flex flex-col justify-center pl-4">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Is Active Link</label>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="link-active" value="1" checked class="w-4 h-4 accent-primary">
                    </div>
                </div>
            </div>

            <div class="flex gap-4 pt-2">
                <button type="button" onclick="UI.modal.close('link-modal')" class="flex-1 py-4 border border-slate-100 text-[10px] font-black uppercase text-slate-400 rounded-2xl hover:bg-slate-50 transition-all">Cancel</button>
                <button type="submit" id="submit-btn" class="flex-1 py-4 bg-primary text-black text-[10px] font-black uppercase rounded-2xl shadow-xl shadow-primary/20 hover:scale-105 transition-all">Save Link</button>
            </div>
        </form>
    </div>
</div>

<script>
let currentMenuId = null;
let allItems = [];

document.addEventListener('DOMContentLoaded', () => {
    loadMenus();
});

async function loadMenus() {
    const res = await UI.apiGet('/backend/api/menus.php?action=list');
    if (res.success && res.data.length > 0) {
        const select = document.getElementById('menu-select');
        select.innerHTML = '';
        res.data.forEach(m => {
            select.innerHTML += `<option value="${m.id}">${UI.escapeHtml(m.name)} (Location: ${UI.escapeHtml(m.location)})</option>`;
        });
        currentMenuId = res.data[0].id;
        loadMenuItems();
    }
}

async function loadMenuItems() {
    const select = document.getElementById('menu-select');
    currentMenuId = select.value;
    
    const res = await UI.apiGet(`/backend/api/menus.php?action=get_items&menu_id=${currentMenuId}`);
    const tbody = document.getElementById('links-tbody');
    tbody.innerHTML = '';
    allItems = [];

    if (!res.success || res.data.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="6" class="px-8 py-12 text-center text-slate-400">
                    <i data-lucide="menu" class="w-10 h-10 mx-auto mb-3 opacity-30"></i>
                    <p class="text-xs font-black uppercase tracking-wider">No navigation links added yet.</p>
                </td>
            </tr>
        `;
        lucide.createIcons();
        updateParentDropdown();
        return;
    }

    allItems = res.data;
    updateParentDropdown();

    // Render tree structure (Top level first, then nested children)
    const topLevel = allItems.filter(item => !item.parent_id);
    topLevel.forEach(parent => {
        renderRow(parent, false);
        const children = allItems.filter(item => item.parent_id === parent.id);
        children.forEach(child => {
            renderRow(child, true);
        });
    });

    lucide.createIcons();
}

function renderRow(item, isChild = false) {
    const tbody = document.getElementById('links-tbody');
    const tr = document.createElement('tr');
    tr.className = "hover:bg-slate-50/50 transition-all";
    
    const labelPrefix = isChild ? '<span class="text-slate-400 font-mono mr-2">└──</span>' : '';
    const labelStyle = isChild ? 'pl-10 font-bold text-slate-600' : 'font-black text-slate-800';

    tr.innerHTML = `
        <td class="px-8 py-5 ${labelStyle}">
            <div class="flex items-center">
                ${labelPrefix}
                ${item.icon ? `<i data-lucide="${item.icon}" class="w-3.5 h-3.5 mr-2 text-slate-400"></i>` : ''}
                <span>${UI.escapeHtml(item.label)}</span>
            </div>
        </td>
        <td class="px-8 py-5 font-mono text-xs text-slate-500">${UI.escapeHtml(item.url)}</td>
        <td class="px-8 py-5 text-xs text-slate-500">${item.target}</td>
        <td class="px-8 py-5">
            <input type="number" value="${item.sort_order}" data-id="${item.id}" class="sort-order-input w-16 px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-xs font-bold focus:outline-none">
        </td>
        <td class="px-8 py-5">
            ${item.is_active 
                ? '<span class="px-2 py-0.5 bg-emerald-50 text-emerald-600 rounded text-[9px] font-black uppercase">Active</span>' 
                : '<span class="px-2 py-0.5 bg-red-50 text-red-600 rounded text-[9px] font-black uppercase">Inactive</span>'}
        </td>
        <td class="px-8 py-5 text-right">
            <div class="flex items-center justify-end gap-2">
                <button onclick="openEditModal(${item.id})" class="p-2 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-primary transition-all shadow-sm">
                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                </button>
                <button onclick="deleteLink(${item.id})" class="p-2 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-red-500 transition-all shadow-sm">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                </button>
            </div>
        </td>
    `;
    tbody.appendChild(tr);
}

function updateParentDropdown(excludeId = null) {
    const parentSelect = document.getElementById('link-parent');
    parentSelect.innerHTML = '<option value="">None (Top Level)</option>';
    
    // Parent items must be top level (parent_id is null) and not the item itself
    const topLevel = allItems.filter(item => !item.parent_id && item.id !== excludeId);
    topLevel.forEach(item => {
        parentSelect.innerHTML += `<option value="${item.id}">${UI.escapeHtml(item.label)}</option>`;
    });
}

function openCreateModal() {
    document.getElementById('link-form').reset();
    document.getElementById('link-id').value = '';
    document.getElementById('form-menu-id').value = currentMenuId;
    document.getElementById('modal-title').innerText = "Add Navigation Link";
    updateParentDropdown();
    UI.modal.open('link-modal');
}

async function openEditModal(id) {
    const item = allItems.find(i => i.id === id);
    if (!item) return;

    document.getElementById('link-id').value = item.id;
    document.getElementById('form-menu-id').value = item.menu_id;
    document.getElementById('link-label').value = item.label;
    document.getElementById('link-url').value = item.url;
    document.getElementById('link-target').value = item.target;
    document.getElementById('link-icon').value = item.icon || '';
    document.getElementById('link-sort').value = item.sort_order;
    document.getElementById('link-active').checked = item.is_active ? true : false;
    
    updateParentDropdown(id);
    document.getElementById('link-parent').value = item.parent_id || '';
    document.getElementById('modal-title').innerText = "Edit Navigation Link";
    UI.modal.open('link-modal');
}

document.getElementById('link-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('submit-btn');
    const original = btn.innerHTML;

    btn.disabled = true;
    btn.innerHTML = '<svg class="animate-spin w-4 h-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>';

    const fd = new FormData(this);
    fd.append('csrf_token', window.CSRF_TOKEN);
    fd.set('is_active', document.getElementById('link-active').checked ? '1' : '0');

    try {
        const resp = await fetch('/backend/api/menus.php?action=save_item', {
            method: 'POST',
            body: fd
        });
        const data = await resp.json();

        if (data.success) {
            UI.toast('Link saved successfully ✓', 'success');
            UI.modal.close('link-modal');
            loadMenuItems();
        } else {
            UI.toast(data.message || 'Error saving link.', 'error');
        }
    } catch (err) {
        console.error(err);
        UI.toast('Network communications failed.', 'error');
    } finally {
        btn.disabled = false;
        btn.innerHTML = original;
    }
});

async function deleteLink(id) {
    if (!UI.confirm('Are you sure you want to delete this link? Children dropdown options (if any) will become top level.')) return;

    const fd = makeFormData({ id });
    const res = await UI.apiPost('/backend/api/menus.php?action=delete_item', fd);
    if (res.success) {
        UI.toast('Link removed.', 'success');
        loadMenuItems();
    } else {
        UI.toast(res.message || 'Failed to delete link.', 'error');
    }
}

async function saveSortOrders() {
    const orders = [];
    document.querySelectorAll('.sort-order-input').forEach(input => {
        orders.push({
            id: parseInt(input.dataset.id),
            sort_order: parseInt(input.value)
        });
    });

    const fd = makeFormData({ orders: JSON.stringify(orders) });
    const res = await UI.apiPost('/backend/api/menus.php?action=reorder', fd);
    if (res.success) {
        UI.toast('Branding link hierarchy re-ordered ✓', 'success');
        loadMenuItems();
    } else {
        UI.toast(res.message || 'Failed to update orders.', 'error');
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
