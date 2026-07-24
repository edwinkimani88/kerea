<?php
include 'includes/header.php';
?>

<div class="space-y-12">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
        <div class="gsap-reveal">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">User Directory</h2>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Manage Member & Administrator Accounts</p>
        </div>
        <button onclick="openCreateModal()" class="gsap-reveal px-8 py-4 bg-primary text-black rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-primary/20 flex items-center gap-3 hover:scale-105 transition-all">
            <i data-lucide="user-plus" class="w-4 h-4"></i> Create Account
        </button>
    </div>

    <!-- Search Controls -->
    <div class="gsap-reveal flex flex-col md:flex-row md:items-center justify-between gap-4 card-bg p-6 rounded-3xl shadow-sm">
        <div class="relative flex-1 max-w-md">
            <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
            <input type="text" id="search-input" oninput="debounceSearch()" placeholder="Search name, email, or company..." 
                class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold focus:outline-none">
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <select id="role-filter" onchange="loadUsers()" class="px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold outline-none cursor-pointer">
                <option value="">All Roles</option>
                <!-- Loaded dynamically -->
            </select>
            <select id="status-filter" onchange="loadUsers()" class="px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold outline-none cursor-pointer">
                <option value="">All Statuses</option>
                <option value="active">Active</option>
                <option value="pending">Pending</option>
                <option value="suspended">Suspended</option>
            </select>
        </div>
    </div>

    <!-- Users Table -->
    <div class="gsap-reveal card-bg rounded-[3rem] shadow-premium overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left" id="users-table">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">User Profile</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Company & Contact</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Role</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Status</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Logins</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50" id="users-tbody">
                    <!-- Loaded dynamically -->
                </tbody>
            </table>
        </div>
        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between" id="pagination-container">
            <!-- Paginated -->
        </div>
    </div>
</div>

<!-- Create / Edit User Modal -->
<div id="user-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-xl bg-white rounded-[3rem] shadow-2xl p-10 space-y-8 relative">
        <div class="absolute top-0 left-0 w-full h-2 bg-primary"></div>
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight" id="modal-title">Create Account</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Account Configuration Editor</p>
            </div>
            <button onclick="UI.modal.close('user-modal')" class="p-2 bg-slate-50 text-slate-400 hover:text-red-500 rounded-xl transition-all">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form id="user-form" class="space-y-6">
            <input type="hidden" name="id" id="user-id">

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">First Name</label>
                    <input type="text" name="first_name" id="user-first-name" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Last Name</label>
                    <input type="text" name="last_name" id="user-last-name" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2 col-span-2" id="email-field-container">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Email Address</label>
                    <input type="email" name="email" id="user-email" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2" id="password-field-container">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Password</label>
                    <input type="password" name="password" id="user-password" placeholder="Min 8 chars, 1 Cap, 1 Number" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2" id="confirm-password-field-container">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Confirm Password</label>
                    <input type="password" name="confirm_password" id="user-confirm-password" placeholder="Confirm password" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Phone</label>
                    <input type="text" name="phone" id="user-phone" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Role Assignment</label>
                    <select name="role_id" id="user-role-select" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                        <!-- Loaded dynamically -->
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Organisation</label>
                    <input type="text" name="organisation" id="user-organisation" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Job Title</label>
                    <input type="text" name="job_title" id="user-job-title" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>

            <div class="flex gap-4 pt-2">
                <button type="button" onclick="UI.modal.close('user-modal')" class="flex-1 py-4 border border-slate-100 text-[10px] font-black uppercase text-slate-400 rounded-2xl hover:bg-slate-50 transition-all">Cancel</button>
                <button type="submit" id="submit-btn" class="flex-1 py-4 bg-primary text-black text-[10px] font-black uppercase rounded-2xl shadow-xl shadow-primary/20 hover:scale-105 transition-all">Save Account</button>
            </div>
        </form>
    </div>
</div>

<!-- Password Reset Modal -->
<div id="reset-password-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-md bg-white rounded-[3rem] shadow-2xl p-10 space-y-8 relative">
        <div class="absolute top-0 left-0 w-full h-2 bg-amber-500"></div>
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Reset Password</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" id="reset-modal-username">User Name</p>
            </div>
            <button onclick="UI.modal.close('reset-password-modal')" class="p-2 bg-slate-50 text-slate-400 hover:text-red-500 rounded-xl transition-all">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form id="reset-password-form" class="space-y-6">
            <input type="hidden" id="reset-user-id">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">New Password</label>
                <input type="password" id="reset-pwd" required placeholder="Min 8 chars, 1 Cap, 1 Number" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
            </div>
            <div class="flex gap-4">
                <button type="button" onclick="UI.modal.close('reset-password-modal')" class="flex-1 py-4 border border-slate-100 text-[10px] font-black uppercase text-slate-400 rounded-xl hover:bg-slate-50 transition-all">Cancel</button>
                <button type="submit" id="reset-pwd-btn" class="flex-1 py-4 bg-amber-500 text-white text-[10px] font-black uppercase rounded-xl hover:bg-amber-600 transition-all">Reset Password</button>
            </div>
        </form>
    </div>
</div>

<!-- User Activity Audit Modal -->
<div id="activity-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-2xl bg-white rounded-[3rem] shadow-2xl p-10 space-y-8 relative overflow-y-auto max-h-[85vh]">
        <div class="absolute top-0 left-0 w-full h-2 bg-blue-500"></div>
        <div class="flex justify-between items-center border-b border-slate-50 pb-5">
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Audit Trail</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" id="activity-modal-username">User Logs</p>
            </div>
            <button onclick="UI.modal.close('activity-modal')" class="p-2 bg-slate-50 text-slate-400 hover:text-red-500 rounded-xl transition-all">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <div class="space-y-4" id="activity-log-feed">
            <!-- Loaded dynamically -->
        </div>
    </div>
</div>

<script>
let currentPage = 1;
let searchDebounceTimer = null;
let rolesList = [];

document.addEventListener('DOMContentLoaded', () => {
    loadRoles();
    loadUsers();
});

function debounceSearch() {
    clearTimeout(searchDebounceTimer);
    searchDebounceTimer = setTimeout(() => {
        currentPage = 1;
        loadUsers();
    }, 400);
}

async function loadRoles() {
    const res = await UI.apiGet('/backend/api/users.php?action=roles');
    if (res.success && res.data) {
        rolesList = res.data;
        
        // Populate filter dropdown
        const filter = document.getElementById('role-filter');
        filter.innerHTML = '<option value="">All Roles</option>';
        
        // Populate modal role dropdown
        const select = document.getElementById('user-role-select');
        select.innerHTML = '';
        
        res.data.forEach(r => {
            filter.innerHTML += `<option value="${r.name}">${UI.escapeHtml(r.label)}</option>`;
            select.innerHTML += `<option value="${r.id}">${UI.escapeHtml(r.label)}</option>`;
        });
    }
}

async function loadUsers() {
    const search = encodeURIComponent(document.getElementById('search-input').value);
    const role = encodeURIComponent(document.getElementById('role-filter').value);
    const status = encodeURIComponent(document.getElementById('status-filter').value);
    
    const url = `/backend/api/users.php?action=list&page=${currentPage}&search=${search}&role=${role}&status=${status}`;
    const resp = await UI.apiGet(url);

    const tbody = document.getElementById('users-tbody');
    const pagContainer = document.getElementById('pagination-container');
    tbody.innerHTML = '';

    if (!resp.success || !resp.data || resp.data.data.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="6" class="px-8 py-12 text-center text-slate-400">
                    <i data-lucide="users" class="w-10 h-10 mx-auto mb-3 opacity-30"></i>
                    <p class="text-xs font-black uppercase tracking-wider">No matching users found in registry.</p>
                </td>
            </tr>
        `;
        pagContainer.innerHTML = '';
        lucide.createIcons();
        return;
    }

    resp.data.data.forEach(user => {
        const s = user.status;
        const statusBadge = s === 'active' ? '<span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[9px] font-black uppercase">Active</span>' 
                        : s === 'pending' ? '<span class="px-2.5 py-1 bg-amber-50 text-amber-600 rounded-lg text-[9px] font-black uppercase">Pending</span>'
                        : '<span class="px-2.5 py-1 bg-red-50 text-red-600 rounded-lg text-[9px] font-black uppercase">Suspended</span>';

        const lastLogin = user.last_login ? user.last_login : 'Never logged in';

        const tr = document.createElement('tr');
        tr.className = "hover:bg-slate-50/50 transition-all";
        tr.innerHTML = `
            <td class="px-8 py-5">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-primary rounded-xl flex items-center justify-center text-black font-black text-xs select-none">
                        ${user.first_name.substring(0,1).toUpperCase()}
                    </div>
                    <div>
                        <h4 class="text-sm font-black text-slate-800">${UI.escapeHtml(user.first_name + ' ' + user.last_name)}</h4>
                        <p class="text-[9px] font-bold text-slate-400 mt-1 uppercase">Email: ${UI.escapeHtml(user.email)}</p>
                    </div>
                </div>
            </td>
            <td class="px-8 py-5">
                <p class="text-xs font-bold text-slate-800">${UI.escapeHtml(user.organisation || 'Individual')}</p>
                <p class="text-[9px] font-bold text-slate-400 uppercase">${UI.escapeHtml(user.phone || 'No phone')}</p>
            </td>
            <td class="px-8 py-5 text-xs font-bold text-slate-500">${UI.escapeHtml(user.role_label)}</td>
            <td class="px-8 py-5">${statusBadge}</td>
            <td class="px-8 py-5">
                <p class="text-xs font-bold text-slate-500">${user.login_count} sessions</p>
                <p class="text-[9px] font-bold text-slate-400 uppercase">${lastLogin}</p>
            </td>
            <td class="px-8 py-5 text-right">
                <div class="flex items-center justify-end gap-2">
                    <button onclick="toggleUserStatus(${user.id}, '${s}')" class="p-2 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-emerald-500 transition-all shadow-sm" title="${s === 'active' ? 'Suspend User' : 'Activate User'}">
                        <i data-lucide="power" class="w-4 h-4 ${s === 'active' ? 'text-emerald-500' : ''}"></i>
                    </button>
                    <button onclick="openActivityLog(${user.id}, '${UI.escapeHtml(user.first_name + ' ' + user.last_name)}')" class="p-2 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-blue-500 transition-all shadow-sm" title="User Audit Log">
                        <i data-lucide="activity" class="w-4 h-4"></i>
                    </button>
                    <button onclick="openResetPasswordModal(${user.id}, '${UI.escapeHtml(user.first_name + ' ' + user.last_name)}')" class="p-2 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-amber-500 transition-all shadow-sm" title="Reset Password">
                        <i data-lucide="key" class="w-4 h-4"></i>
                    </button>
                    <button onclick="openEditModal(${user.id})" class="p-2 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-primary transition-all shadow-sm" title="Edit Profile">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                    </button>
                    <button onclick="deleteUser(${user.id})" class="p-2 bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-red-500 transition-all shadow-sm" title="Delete User">
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
        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Page ${cur} of ${last} · Total ${pageData.total} users</span>
        <div class="flex gap-2">
            <button onclick="changePage(${cur - 1})" ${cur === 1 ? 'disabled' : ''} class="px-4 py-2 bg-white border border-slate-100 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-500 hover:bg-primary hover:text-black disabled:opacity-50 disabled:pointer-events-none transition-all">Prev</button>
            <button onclick="changePage(${cur + 1})" ${cur === last ? 'disabled' : ''} class="px-4 py-2 bg-white border border-slate-100 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-500 hover:bg-primary hover:text-black disabled:opacity-50 disabled:pointer-events-none transition-all">Next</button>
        </div>
    `;
}

function changePage(page) {
    currentPage = page;
    loadUsers();
}

function openCreateModal() {
    document.getElementById('user-form').reset();
    document.getElementById('user-id').value = '';
    
    // Show email/password fields (required for registration)
    document.getElementById('email-field-container').classList.remove('hidden');
    document.getElementById('password-field-container').classList.remove('hidden');
    document.getElementById('confirm-password-field-container').classList.remove('hidden');
    
    document.getElementById('user-email').required = true;
    document.getElementById('user-password').required = true;
    document.getElementById('user-confirm-password').required = true;

    document.getElementById('modal-title').innerText = "Create User Account";
    UI.modal.open('user-modal');
}

async function openEditModal(id) {
    const resp = await UI.apiGet(`/backend/api/users.php?action=get&id=${id}`);
    if (!resp.success) {
        UI.toast('Failed to load user profile.', 'error');
        return;
    }

    document.getElementById('user-id').value = id;
    document.getElementById('user-first-name').value = resp.data.first_name;
    document.getElementById('user-last-name').value = resp.data.last_name;
    document.getElementById('user-phone').value = resp.data.phone || '';
    document.getElementById('user-role-select').value = resp.data.role_id;
    document.getElementById('user-organisation').value = resp.data.organisation || '';
    document.getElementById('user-job-title').value = resp.data.job_title || '';

    // Hide password fields & email for existing profile edits in this quick modal
    document.getElementById('email-field-container').classList.add('hidden');
    document.getElementById('password-field-container').classList.add('hidden');
    document.getElementById('confirm-password-field-container').classList.add('hidden');
    
    document.getElementById('user-email').required = false;
    document.getElementById('user-password').required = false;
    document.getElementById('user-confirm-password').required = false;

    document.getElementById('modal-title').innerText = "Edit Account Details";
    UI.modal.open('user-modal');
}

document.getElementById('user-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('submit-btn');
    const original = btn.innerHTML;

    btn.disabled = true;
    btn.innerHTML = '<svg class="animate-spin w-4 h-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>';

    const id = document.getElementById('user-id').value;
    const action = id ? 'update' : 'create';
    
    const fd = new FormData(this);
    fd.append('csrf_token', window.CSRF_TOKEN);
    fd.append('action', action);

    try {
        const res = await fetch(`/backend/api/users.php?action=${action}`, {
            method: 'POST',
            body: fd
        });
        const data = await res.json();

        if (data.success) {
            UI.toast(data.message || 'Saved successfully ✓', 'success');
            UI.modal.close('user-modal');
            loadUsers();
            
            // Assign role if updating existing user and role changed
            if (id) {
                const roleId = document.getElementById('user-role-select').value;
                const fdRole = makeFormData({ user_id: id, role_id: roleId });
                await UI.apiPost('/backend/api/users.php?action=assign_role', fdRole);
            }
        } else {
            UI.toast(data.message || 'Operation failed.', 'error');
        }
    } catch (err) {
        console.error(err);
        UI.toast('Network connection failed.', 'error');
    } finally {
        btn.disabled = false;
        btn.innerHTML = original;
    }
});

async function toggleUserStatus(id, currentStatus) {
    const nextStatus = currentStatus === 'active' ? 'suspended' : 'active';
    const fd = makeFormData({ id, status: nextStatus });
    
    const res = await UI.apiPost('/backend/api/users.php?action=set_status', fd);
    if (res.success) {
        UI.toast(`User account successfully ${nextStatus}d.`, 'success');
        loadUsers();
    } else {
        UI.toast(res.message || 'Status change failed.', 'error');
    }
}

function openResetPasswordModal(id, name) {
    document.getElementById('reset-user-id').value = id;
    document.getElementById('reset-modal-username').innerText = name;
    document.getElementById('reset-pwd').value = '';
    UI.modal.open('reset-password-modal');
}

document.getElementById('reset-password-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('reset-pwd-btn');
    const original = btn.innerText;

    btn.disabled = true;
    btn.innerText = 'Resetting...';

    const id = document.getElementById('reset-user-id').value;
    const password = document.getElementById('reset-pwd').value;
    const fd = makeFormData({ id, new_password: password });

    try {
        const res = await UI.apiPost('/backend/api/users.php?action=reset_password', fd);
        if (res.success) {
            UI.toast('Password reset successfully ✓', 'success');
            UI.modal.close('reset-password-modal');
        } else {
            UI.toast(res.message || 'Reset failed.', 'error');
        }
    } catch (err) {
        UI.toast('Network failure.', 'error');
    } finally {
        btn.disabled = false;
        btn.innerText = original;
    }
});

async function openActivityLog(userId, name) {
    document.getElementById('activity-modal-username').innerText = `Audit logs: ${name}`;
    const feed = document.getElementById('activity-log-feed');
    feed.innerHTML = '<div class="text-center py-6 text-slate-400 font-bold uppercase tracking-widest text-xs">Loading logs...</div>';
    
    UI.modal.open('activity-modal');

    const res = await UI.apiGet(`/backend/api/users.php?action=activity&user_id=${userId}`);
    feed.innerHTML = '';

    if (!res.success || !res.data || res.data.data.length === 0) {
        feed.innerHTML = '<p class="text-slate-400 text-center py-8 font-bold text-xs uppercase">No activity logs recorded for this user.</p>';
        return;
    }

    res.data.data.forEach(log => {
        const div = document.createElement('div');
        div.className = "flex gap-4 p-4 rounded-xl border border-slate-50 hover:bg-slate-50 transition-all text-xs";
        
        let icon = 'activity';
        let color = 'slate';
        if (log.action.includes('login')) { icon = 'check-circle'; color = 'emerald'; }
        else if (log.action.includes('create')) { icon = 'plus-circle'; color = 'blue'; }
        else if (log.action.includes('update')) { icon = 'edit-3'; color = 'amber'; }
        else if (log.action.includes('delete')) { icon = 'trash-2'; color = 'red'; }
        
        div.innerHTML = `
            <div class="w-8 h-8 bg-${color}-50 rounded-lg flex items-center justify-center text-${color}-600 shrink-0">
                <i data-lucide="${icon}" class="w-4 h-4"></i>
            </div>
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <p class="font-black text-slate-800 uppercase tracking-tight">${UI.escapeHtml(log.action)}</p>
                    <span class="text-[9px] font-bold text-slate-400">${log.created_at}</span>
                </div>
                <p class="text-slate-550 mt-1 font-bold">${UI.escapeHtml(log.description || 'No description')}</p>
                <p class="text-[9px] text-slate-400 mt-1">IP: ${log.ip_address}</p>
            </div>
        `;
        feed.appendChild(div);
    });
    lucide.createIcons();
}

async function deleteUser(id) {
    if (!UI.confirm('DANGER: Are you sure you want to permanently delete this user? This will erase their login history and dashboard data.')) return;

    const fd = makeFormData({ id });
    const res = await UI.apiPost('/backend/api/users.php?action=delete', fd);
    if (res.success) {
        UI.toast('User permanently removed.', 'success');
        loadUsers();
    } else {
        UI.toast(res.message || 'Deletion failed. Super Administrator permissions required.', 'error');
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
