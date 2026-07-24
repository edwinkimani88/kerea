<?php
include 'includes/header.php';
?>

<div class="space-y-12">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
        <div class="gsap-reveal">
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Media Library</h2>
            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1">Manage Graphic Assets & PDF Documents</p>
        </div>
        <button onclick="UI.modal.open('upload-modal')" class="gsap-reveal px-8 py-4 bg-primary text-black rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-primary/20 flex items-center gap-3 hover:scale-105 transition-all">
            <i data-lucide="upload-cloud" class="w-4 h-4"></i> Upload File
        </button>
    </div>

    <!-- Stats & Filters Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 gsap-reveal">
        <div class="card-bg p-6 rounded-2xl flex flex-col justify-center">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Assets</p>
            <h4 class="text-2xl font-black" id="stat-total">0</h4>
        </div>
        <div class="card-bg p-6 rounded-2xl flex flex-col justify-center">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Images</p>
            <h4 class="text-2xl font-black text-emerald-600" id="stat-images">0</h4>
        </div>
        <div class="card-bg p-6 rounded-2xl flex flex-col justify-center">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Documents / PDFs</p>
            <h4 class="text-2xl font-black text-blue-600" id="stat-docs">0</h4>
        </div>
        <div class="card-bg p-6 rounded-2xl flex flex-col justify-center">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Size</p>
            <h4 class="text-2xl font-black" id="stat-size">0 KB</h4>
        </div>
    </div>

    <!-- Filters -->
    <div class="gsap-reveal flex flex-col md:flex-row md:items-center justify-between gap-4 card-bg p-6 rounded-3xl shadow-sm">
        <div class="relative flex-1 max-w-md">
            <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
            <input type="text" id="search-input" oninput="debounceSearch()" placeholder="Search by name or alt text..." 
                class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold focus:outline-none">
        </div>
        <select id="type-filter" onchange="loadMedia()" class="px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold outline-none cursor-pointer">
            <option value="">All Types</option>
            <option value="image">Images Only</option>
            <option value="document">Documents / PDFs Only</option>
        </select>
    </div>

    <!-- Media Library Grid -->
    <div class="gsap-reveal grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-6" id="media-grid">
        <!-- Loaded dynamically -->
    </div>

    <!-- Pagination -->
    <div class="gsap-reveal p-6 bg-white border border-slate-100 rounded-3xl flex items-center justify-between" id="pagination-container">
        <!-- Loaded dynamically -->
    </div>
</div>

<!-- Upload Modal -->
<div id="upload-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-xl bg-white rounded-[3rem] shadow-2xl p-10 space-y-8 relative">
        <div class="absolute top-0 left-0 w-full h-2 bg-primary"></div>
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Upload Asset</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Async File Uploader</p>
            </div>
            <button onclick="UI.modal.close('upload-modal')" class="p-2 bg-slate-50 text-slate-400 hover:text-red-500 rounded-xl transition-all">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form id="upload-form" class="space-y-6" enctype="multipart/form-data">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Media Folder Type</label>
                <select name="media_type" id="media_type" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold outline-none">
                    <option value="general">General</option>
                    <option value="image">Images Directory</option>
                    <option value="document">Documents Directory</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Alt Text (Images)</label>
                    <input type="text" name="alt_text" placeholder="Short description of image" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Caption (General)</label>
                    <input type="text" name="caption" placeholder="Asset explanation caption" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold focus:outline-none">
                </div>
            </div>

            <div class="p-8 bg-slate-50 rounded-3xl border border-dashed border-slate-200 text-center space-y-3 group cursor-pointer hover:border-primary transition-all relative">
                <input type="file" name="file" required class="absolute inset-0 opacity-0 cursor-pointer w-full h-full" id="file-input" onchange="updateFileNameLabel(this)">
                <i data-lucide="upload-cloud" class="w-10 h-10 text-slate-350 mx-auto group-hover:text-primary transition-colors"></i>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" id="file-label">Drop file here or click to browse</p>
                <p class="text-[8px] text-slate-300 font-bold uppercase tracking-[0.2em]">Images, PDFs, documents up to 20MB</p>
            </div>

            <div class="flex gap-4 pt-2">
                <button type="button" onclick="UI.modal.close('upload-modal')" class="flex-1 py-4 border border-slate-100 text-[10px] font-black uppercase text-slate-400 rounded-2xl hover:bg-slate-50 transition-all">Cancel</button>
                <button type="submit" id="upload-btn" class="flex-1 py-4 bg-primary text-black text-[10px] font-black uppercase rounded-2xl shadow-xl shadow-primary/20 hover:scale-105 transition-all">Upload File</button>
            </div>
        </form>
    </div>
</div>

<!-- Details Modal -->
<div id="details-modal" class="modal-overlay hidden items-center justify-center p-6">
    <div class="modal-content w-full max-w-lg bg-white rounded-[3rem] shadow-2xl p-10 space-y-8 relative">
        <div class="absolute top-0 left-0 w-full h-2 bg-indigo-500"></div>
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Asset Details</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" id="details-filename">filename.jpg</p>
            </div>
            <button onclick="UI.modal.close('details-modal')" class="p-2 bg-slate-50 text-slate-400 hover:text-red-500 rounded-xl transition-all">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <div class="flex flex-col gap-6">
            <!-- Thumbnail / File Type Logo -->
            <div class="w-full h-48 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center p-4 overflow-hidden" id="details-preview-container">
                <!-- Preview image or doc icon goes here -->
            </div>

            <!-- Metadata info form -->
            <form id="metadata-form" class="space-y-4">
                <input type="hidden" name="id" id="details-id">
                <div class="grid grid-cols-2 gap-4 text-[10px] font-bold text-slate-500 border-b border-slate-100 pb-4">
                    <p>Mime Type: <span class="font-mono text-slate-700" id="details-mime"></span></p>
                    <p>Size: <span class="font-mono text-slate-700" id="details-size"></span></p>
                    <p class="col-span-full">Public URL: <span class="font-mono text-primary select-all cursor-pointer underline" onclick="copyUrlToClipboard()" id="details-url"></span></p>
                </div>
                
                <div class="space-y-2">
                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest px-1">Alt Text (SEO)</label>
                    <input type="text" name="alt_text" id="details-alt-text" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold focus:outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest px-1">Caption</label>
                    <input type="text" name="caption" id="details-caption" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold focus:outline-none">
                </div>

                <div class="flex gap-4 pt-2">
                    <button type="button" onclick="deleteMediaFromDetails()" class="py-4 px-6 border border-red-200 text-red-500 hover:bg-red-50 text-[10px] font-black uppercase rounded-xl transition-all">Delete File</button>
                    <button type="submit" id="save-metadata-btn" class="flex-1 py-4 bg-slate-900 text-white hover:bg-black text-[10px] font-black uppercase rounded-xl transition-all">Save Meta</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentPage = 1;
let searchDebounceTimer = null;

document.addEventListener('DOMContentLoaded', () => {
    loadMedia();
    loadStats();
});

function debounceSearch() {
    clearTimeout(searchDebounceTimer);
    searchDebounceTimer = setTimeout(() => {
        currentPage = 1;
        loadMedia();
    }, 400);
}

function updateFileNameLabel(input) {
    const label = document.getElementById('file-label');
    if (input.files && input.files[0]) {
        label.innerText = `Selected: ${input.files[0].name} (${(input.files[0].size/1024/1024).toFixed(2)} MB)`;
        label.className = "text-[10px] font-black text-primary uppercase tracking-widest";
    } else {
        label.innerText = "Drop file here or click to browse";
        label.className = "text-[10px] font-black text-slate-400 uppercase tracking-widest";
    }
}

async function loadStats() {
    const res = await UI.apiGet('/backend/api/media.php?action=stats');
    if (res.success) {
        document.getElementById('stat-total').innerText = res.data.total;
        document.getElementById('stat-images').innerText = res.data.images;
        document.getElementById('stat-docs').innerText = res.data.documents;
        document.getElementById('stat-size').innerText = formatSize(res.data.total_size || 0);
    }
}

function formatSize(bytes) {
    const k = 1024;
    const dm = 2;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    if (bytes === 0) return '0 Bytes';
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

async function loadMedia() {
    const search = encodeURIComponent(document.getElementById('search-input').value);
    const type = encodeURIComponent(document.getElementById('type-filter').value);
    const url = `/backend/api/media.php?action=list&page=${currentPage}&search=${search}&media_type=${type}`;
    
    const resp = await UI.apiGet(url);
    const grid = document.getElementById('media-grid');
    grid.innerHTML = '';

    if (!resp.success || !resp.data || resp.data.data.length === 0) {
        grid.innerHTML = `
            <div class="col-span-full py-12 text-center text-slate-400">
                <i data-lucide="image" class="w-10 h-10 mx-auto mb-3 opacity-30"></i>
                <p class="text-xs font-black uppercase tracking-wider">No files found in the media library.</p>
            </div>
        `;
        document.getElementById('pagination-container').innerHTML = '';
        lucide.createIcons();
        return;
    }

    resp.data.data.forEach(item => {
        const div = document.createElement('div');
        div.className = "card-bg p-3 rounded-2xl cursor-pointer hover:border-primary transition-all flex flex-col justify-between group overflow-hidden relative aspect-square";
        div.onclick = () => openDetails(item);

        let previewHtml = '';
        if (item.mime_type.startsWith('image/')) {
            previewHtml = `<img src="${item.file_url}" class="w-full h-full object-cover rounded-xl select-none pointer-events-none">`;
        } else {
            previewHtml = `
                <div class="w-full h-full bg-slate-50 border border-slate-100 rounded-xl flex flex-col items-center justify-center p-2 text-center text-blue-500">
                    <i data-lucide="file-text" class="w-8 h-8 opacity-70 mb-1"></i>
                    <span class="text-[8px] font-black uppercase tracking-widest text-slate-500 block truncate max-w-full">${UI.escapeHtml(item.filename)}</span>
                </div>
            `;
        }

        div.innerHTML = `
            <div class="w-full h-full relative overflow-hidden flex items-center justify-center rounded-xl bg-slate-100 mb-2">
                ${previewHtml}
            </div>
            <div class="text-[9px] font-black text-slate-500 truncate text-center select-none block w-full px-1">
                ${UI.escapeHtml(item.original_name)}
            </div>
        `;
        grid.appendChild(div);
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
        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Page ${cur} of ${last} · Total ${pageData.total} files</span>
        <div class="flex gap-2">
            <button onclick="changePage(${cur - 1})" ${cur === 1 ? 'disabled' : ''} class="px-4 py-2 bg-white border border-slate-100 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-500 hover:bg-primary hover:text-black disabled:opacity-50 disabled:pointer-events-none transition-all">Prev</button>
            <button onclick="changePage(${cur + 1})" ${cur === last ? 'disabled' : ''} class="px-4 py-2 bg-white border border-slate-100 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-500 hover:bg-primary hover:text-black disabled:opacity-50 disabled:pointer-events-none transition-all">Next</button>
        </div>
    `;
}

function changePage(page) {
    currentPage = page;
    loadMedia();
}

function openDetails(item) {
    document.getElementById('details-id').value = item.id;
    document.getElementById('details-filename').innerText = item.filename;
    document.getElementById('details-mime').innerText = item.mime_type;
    document.getElementById('details-size').innerText = formatSize(item.file_size);
    document.getElementById('details-alt-text').value = item.alt_text || '';
    document.getElementById('details-caption').value = item.caption || '';
    
    // Set URL
    const urlSpan = document.getElementById('details-url');
    urlSpan.innerText = item.file_url;
    
    // Preview container
    const prevCont = document.getElementById('details-preview-container');
    prevCont.innerHTML = '';
    if (item.mime_type.startsWith('image/')) {
        prevCont.innerHTML = `<img src="${item.file_url}" class="max-h-full max-w-full object-contain">`;
    } else {
        prevCont.innerHTML = `
            <div class="text-center text-blue-500">
                <i data-lucide="file-text" class="w-16 h-16 mx-auto mb-2 opacity-50"></i>
                <p class="text-xs font-black uppercase tracking-widest text-slate-600">Attachment / Doc File</p>
                <a href="${item.file_url}" target="_blank" class="mt-2 inline-block px-4 py-2 bg-slate-100 hover:bg-primary hover:text-black rounded-lg text-[9px] font-black uppercase tracking-widest text-slate-500">Download Link</a>
            </div>
        `;
        lucide.createIcons();
    }

    UI.modal.open('details-modal');
}

function copyUrlToClipboard() {
    const url = document.getElementById('details-url').innerText;
    navigator.clipboard.writeText(url);
    UI.toast('Asset public URL copied to clipboard ✓', 'success');
}

document.getElementById('upload-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('upload-btn');
    const originalContent = btn.innerHTML;

    btn.disabled = true;
    btn.innerHTML = '<svg class="animate-spin w-4 h-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>';

    const fd = new FormData(this);
    fd.append('csrf_token', window.CSRF_TOKEN);

    try {
        const resp = await fetch('/backend/api/media.php?action=upload', {
            method: 'POST',
            body: fd
        });
        const data = await resp.json();

        if (data.success) {
            UI.toast('File uploaded successfully ✓', 'success');
            UI.modal.close('upload-modal');
            document.getElementById('upload-form').reset();
            document.getElementById('file-label').innerText = "Drop file here or click to browse";
            loadMedia();
            loadStats();
        } else {
            UI.toast(data.message || 'File upload failed.', 'error');
        }
    } catch (err) {
        console.error(err);
        UI.toast('Upload connection failed.', 'error');
    } finally {
        btn.disabled = false;
        btn.innerHTML = originalContent;
    }
});

document.getElementById('metadata-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('save-metadata-btn');
    const original = btn.innerText;

    btn.disabled = true;
    btn.innerText = 'Saving...';

    const fd = new FormData(this);
    fd.append('csrf_token', window.CSRF_TOKEN);

    try {
        const resp = await fetch('/backend/api/media.php?action=update', {
            method: 'POST',
            body: fd
        });
        const data = await resp.json();

        if (data.success) {
            UI.toast('Metadata updated.', 'success');
            UI.modal.close('details-modal');
            loadMedia();
        } else {
            UI.toast(data.message || 'Failed to save metadata.', 'error');
        }
    } catch (err) {
        console.error(err);
        UI.toast('Metadata save failed.', 'error');
    } finally {
        btn.disabled = false;
        btn.innerText = original;
    }
});

async function deleteMediaFromDetails() {
    if (!UI.confirm('Are you absolutely sure you want to permanently delete this file? This will remove the file from the disk and any content referencing it will show broken links.')) return;

    const id = document.getElementById('details-id').value;
    const fd = makeFormData({ id });

    const resp = await UI.apiPost('/backend/api/media.php?action=delete', fd);
    if (resp.success) {
        UI.toast('Asset permanently deleted.', 'success');
        UI.modal.close('details-modal');
        loadMedia();
        loadStats();
    } else {
        UI.toast(resp.message || 'Deletion failed.', 'error');
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
