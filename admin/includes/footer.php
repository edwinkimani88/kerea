    </main><!-- /main -->
</div><!-- /ml-64 -->

<script>
// ── Global UI utilities ──────────────────────────────────────────────────────
const UI = {
    toast(msg, type = 'success', duration = 3500) {
        const icons = {
            success: 'check-circle',
            error:   'x-circle',
            warning: 'alert-triangle',
            info:    'info',
        };
        const t = document.createElement('div');
        t.className = `toast toast-${type}`;
        t.innerHTML = `<i data-lucide="${icons[type] || 'info'}" class="w-4 h-4 shrink-0"></i><span>${msg}</span>`;
        document.getElementById('toast-container').appendChild(t);
        lucide.createIcons();
        gsap.fromTo(t, {x: 60, opacity: 0}, {x: 0, opacity: 1, duration: 0.3, ease: 'power2.out'});
        setTimeout(() => {
            gsap.to(t, {x: 60, opacity: 0, duration: 0.3, ease: 'power2.in', onComplete: () => t.remove()});
        }, duration);
    },

    modal: {
        open(id)  { const m = document.getElementById(id); if(m) { m.classList.remove('hidden'); document.body.style.overflow = 'hidden'; } },
        close(id) { const m = document.getElementById(id); if(m) { m.classList.add('hidden');    document.body.style.overflow = ''; } },
    },

    confirm(msg) { return window.confirm(msg); },

    async apiPost(url, formData) {
        if (url.startsWith('/')) {
            url = '<?php echo get_base_url(); ?>' + url.replace(/^\//, '');
        }
        try {
            const res  = await fetch(url, { method: 'POST', body: formData });
            return await res.json();
        } catch(e) {
            console.error(e);
            return { success: false, message: 'Network error. Please try again.' };
        }
    },

    async apiGet(url) {
        if (url.startsWith('/')) {
            url = '<?php echo get_base_url(); ?>' + url.replace(/^\//, '');
        }
        try {
            const res = await fetch(url);
            return await res.json();
        } catch(e) {
            return { success: false, message: 'Network error.' };
        }
    },
};

// ── Logout ────────────────────────────────────────────────────────────────────
async function handleLogout() {
    const fd = new FormData();
    fd.append('csrf_token', '<?php echo Security::esc($csrfToken); ?>');
    const data = await UI.apiPost('/backend/api/auth.php?action=logout', fd);
    if (data.success) window.location.href = '<?php echo get_base_url(); ?>auth/';
    else UI.toast('Logout failed.', 'error');
}

// ── Sidebar toggle (mobile) ────────────────────────────────────────────────
function toggleSidebar() {
    const sb = document.getElementById('sidebar');
    const bd = document.getElementById('sidebar-backdrop');
    sb.classList.toggle('-translate-x-full');
    bd.classList.toggle('hidden');
}

// ── GSAP animations ───────────────────────────────────────────────────────
window.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();
    gsap.to('.gsap-reveal', {
        y: 0, opacity: 1, duration: 0.5, stagger: 0.07, ease: 'power2.out'
    });
});

// ── Global CSRF helper for fetch calls ────────────────────────────────────
window.CSRF_TOKEN = '<?php echo Security::esc($csrfToken); ?>';

function makeFormData(obj) {
    const fd = new FormData();
    fd.append('csrf_token', window.CSRF_TOKEN);
    for (const [k, v] of Object.entries(obj)) fd.append(k, v);
    return fd;
}
</script>
</body>
</html>
