// Portal Core Logic
document.addEventListener('DOMContentLoaded', () => {
    initPortal();
    applyTheme();
    initGSAP();
});

function initPortal() {
    // Inject Sidebar and Topbar if not already present
    const wrapper = document.querySelector('.portal-wrapper');
    if (!wrapper) return;

    if (!document.querySelector('.sidebar')) {
        const sidebar = createSidebar();
        wrapper.insertAdjacentHTML('afterbegin', sidebar);
    }

    const mainContent = document.querySelector('.main-content');
    if (mainContent && !document.querySelector('.topbar')) {
        const topbar = createTopbar();
        mainContent.insertAdjacentHTML('afterbegin', topbar);
    }

    // Set Active Menu State
    const currentPath = window.location.pathname.split('/').pop() || 'dashboard.html';
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
        if (item.getAttribute('href') === currentPath) {
            item.classList.add('active');
        }
    });

    // Populate Dynamic User Info
    updateUserInfo();
}

function createSidebar() {
    return `
    <aside class="sidebar">
        <div class="sidebar-logo">
            <img src="../assets/kerea-logo-main.png" alt="KEREA Logo" onerror="this.onerror=null; this.src='https://via.placeholder.com/150x50?text=KEREA'">
        </div>
        <nav class="nav-group">
            <a href="dashboard.html" class="nav-item"><i class="ri-dashboard-line"></i> <span>Dashboard</span></a>
            <a href="profile.html" class="nav-item"><i class="ri-user-settings-line"></i> <span>My Profile</span></a>
            <a href="organization.html" class="nav-item"><i class="ri-community-line"></i> <span>Organization</span></a>
            <a href="membership.html" class="nav-item"><i class="ri-medal-line"></i> <span>Membership Details</span></a>
            <a href="certificate.html" class="nav-item"><i class="ri-file-shield-2-line"></i> <span>Certificate</span></a>
        </nav>
        <div style="font-size: 0.7rem; text-transform: uppercase; color: var(--p-text-muted); padding: 0 1rem 0.5rem; font-weight: 800;">Knowledge & Resources</div>
        <nav class="nav-group">
            <a href="resources.html" class="nav-item"><i class="ri-folder-open-line"></i> <span>Resources</span></a>
            <a href="hub.html" class="nav-item"><i class="ri-lightbulb-line"></i> <span>Knowledge Hub</span></a>
            <a href="publications.html" class="nav-item"><i class="ri-book-read-line"></i> <span>Publications</span></a>
        </nav>
        <div style="font-size: 0.7rem; text-transform: uppercase; color: var(--p-text-muted); padding: 0 1rem 0.5rem; font-weight: 800;">Network</div>
        <nav class="nav-group">
            <a href="events.html" class="nav-item"><i class="ri-calendar-event-line"></i> <span>Events & Training</span></a>
            <a href="marketplace.html" class="nav-item"><i class="ri-shopping-cart-2-line"></i> <span>Marketplace</span></a>
            <a href="directory.html" class="nav-item"><i class="ri-team-line"></i> <span>Member Directory</span></a>
        </nav>
        <nav class="nav-group" style="margin-top: auto;">
            <a href="support.html" class="nav-item"><i class="ri-customer-service-2-line"></i> <span>Support</span></a>
            <a href="settings.html" class="nav-item"><i class="ri-settings-4-line"></i> <span>Settings</span></a>
            <a href="#" class="nav-item logout-link" style="color: #ef4444;"><i class="ri-logout-box-r-line"></i> <span>Logout</span></a>
        </nav>
    </aside>
    `;
}

function createTopbar() {
    return `
    <header class="topbar">
        <div class="search-bar">
            <i class="ri-search-line"></i>
            <input type="text" placeholder="Search resources, events, or members...">
        </div>
        <div class="topbar-right">
            <div class="notification-bell" onclick="toggleNotifications()">
                <i class="ri-notification-3-line" style="font-size: 1.4rem;"></i>
                <span class="notification-badge"></span>
            </div>
            <div class="user-profile" onclick="window.location.href='profile.html'">
                <img src="${PORTAL_DATA.user.avatar}" class="user-avatar" alt="Avatar">
                <div class="user-info">
                    <span class="name">${PORTAL_DATA.user.name}</span>
                    <span class="role">${PORTAL_DATA.user.role}</span>
                </div>
                <i class="ri-arrow-down-s-line"></i>
            </div>
        </div>
    </header>
    `;
}

function updateUserInfo() {
    const userNames = document.querySelectorAll('.js-user-name');
    const userRoles = document.querySelectorAll('.js-user-role');
    const userAvatars = document.querySelectorAll('.js-user-avatar');

    userNames.forEach(el => el.textContent = PORTAL_DATA.user.name);
    userRoles.forEach(el => el.textContent = PORTAL_DATA.user.role);
    userAvatars.forEach(el => el.src = PORTAL_DATA.user.avatar);
}

// Theme Engine
function applyTheme() {
    const savedTheme = localStorage.getItem('kerea-portal-theme') || 'kerea-green';
    document.documentElement.setAttribute('data-theme', savedTheme);
}

function setTheme(themeName) {
    document.documentElement.setAttribute('data-theme', themeName);
    localStorage.setItem('kerea-portal-theme', themeName);
    showToast(`Theme changed to ${themeName}`);
}

// UI Helpers
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
        <i class="ri-checkbox-circle-fill"></i>
        <span>${message}</span>
    `;
    document.body.appendChild(toast);
    
    gsap.fromTo(toast, { y: 50, opacity: 0 }, { y: 0, opacity: 1, duration: 0.4 });
    
    setTimeout(() => {
        gsap.to(toast, { y: 20, opacity: 0, duration: 0.3, onComplete: () => toast.remove() });
    }, 3000);
}

// GSAP Animations
function initGSAP() {
    if (typeof gsap === 'undefined') return;

    // Fade in content
    gsap.from('.stat-card', {
        y: 30,
        opacity: 0,
        stagger: 0.1,
        duration: 0.8,
        ease: "power2.out"
    });

    gsap.from('.card', {
        y: 20,
        opacity: 0,
        delay: 0.4,
        stagger: 0.1,
        duration: 0.8,
        ease: "power2.out"
    });

    // Count up stats
    const counters = document.querySelectorAll('.stat-value');
    counters.forEach(counter => {
        const val = parseInt(counter.getAttribute('data-value'));
        if (isNaN(val)) return;
        
        let obj = { value: 0 };
        gsap.to(obj, {
            value: val,
            duration: 2,
            ease: "power2.out",
            onUpdate: () => {
                counter.innerText = Math.ceil(obj.value);
            }
        });
    });

    // Fade in primary cards (only if they don't have specialist animations)
    gsap.from('.card:not(.member-card)', {
        y: 20,
        opacity: 0,
        delay: 0.4,
        stagger: 0.1,
        duration: 0.8,
        ease: "power2.out",
        clearProps: "all"
    });
}

function toggleNotifications() {
    // Basic UI feedback for notification click
    showToast("Opening Notification Center...", "info");
}
