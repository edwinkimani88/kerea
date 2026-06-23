const themes = {
    'kerea-green': {
        '--bg-main': '#f8fafc',
        '--sidebar-bg': '#ffffff',
        '--topbar-bg': '#ffffff',
        '--card-bg': '#ffffff',
        '--primary': '#39DE4F',
        '--accent': '#F59E0B',
        '--text-main': '#0f172a',
        '--text-muted': '#64748b',
        '--border': '#f1f5f9',
        '--sidebar-text': '#475569',
        '--sidebar-active-bg': 'rgba(57, 222, 79, 0.1)',
        '--sidebar-active-text': '#39DE4F'
    },
    'midnight-blue': {
        '--bg-main': '#0f172a',
        '--sidebar-bg': '#1e293b',
        '--topbar-bg': '#111827',
        '--card-bg': '#1e293b',
        '--primary': '#38bdf8',
        '--accent': '#22d3ee',
        '--text-main': '#f1f5f9',
        '--text-muted': '#94a3b8',
        '--border': '#334155',
        '--sidebar-text': '#94a3b8',
        '--sidebar-active-bg': 'rgba(56, 189, 248, 0.1)',
        '--sidebar-active-text': '#38bdf8'
    },
    'carbon-dark': {
        '--bg-main': '#000000',
        '--sidebar-bg': '#121212',
        '--topbar-bg': '#121212',
        '--card-bg': '#18181b',
        '--primary': '#2563eb',
        '--accent': '#3b82f6',
        '--text-main': '#e5e5e5',
        '--text-muted': '#a3a3a3',
        '--border': '#27272a',
        '--sidebar-text': '#a3a3a3',
        '--sidebar-active-bg': 'rgba(37, 99, 235, 0.1)',
        '--sidebar-active-text': '#2563eb'
    },
    'forest-premium': {
        '--bg-main': '#052c16',
        '--sidebar-bg': '#14532d',
        '--topbar-bg': '#14532d',
        '--card-bg': '#064e3b',
        '--primary': '#4ade80',
        '--accent': '#facc15',
        '--text-main': '#f0fdf4',
        '--text-muted': '#86efac',
        '--border': '#166534',
        '--sidebar-text': '#bbf7d0',
        '--sidebar-active-bg': 'rgba(255, 255, 255, 0.1)',
        '--sidebar-active-text': '#ffffff'
    },
    'earth-tone': {
        '--bg-main': '#1c1917',
        '--sidebar-bg': '#292524',
        '--topbar-bg': '#292524',
        '--card-bg': '#44403c',
        '--primary': '#bef264',
        '--accent': '#fbbf24',
        '--text-main': '#fafaf9',
        '--text-muted': '#d6d3d1',
        '--border': '#57534e',
        '--sidebar-text': '#a8a29e',
        '--sidebar-active-bg': 'rgba(255, 255, 255, 0.1)',
        '--sidebar-active-text': '#ffffff'
    },
    'modern-light': {
        '--bg-main': '#f1f5f9',
        '--sidebar-bg': '#ffffff',
        '--topbar-bg': '#ffffff',
        '--card-bg': '#ffffff',
        '--primary': '#10b981',
        '--accent': '#fbbf24',
        '--text-main': '#1e293b',
        '--text-muted': '#64748b',
        '--border': '#e2e8f0',
        '--sidebar-text': '#475569',
        '--sidebar-active-bg': '#f8fafc',
        '--sidebar-active-text': '#10b981'
    },
    'ocean-blue': {
        '--bg-main': '#0c4a6e',
        '--sidebar-bg': '#075985',
        '--topbar-bg': '#075985',
        '--card-bg': '#0369a1',
        '--primary': '#38bdf8',
        '--accent': '#7dd3fc',
        '--text-main': '#f0f9ff',
        '--text-muted': '#bae6fd',
        '--border': '#0ea5e9',
        '--sidebar-text': '#bae6fd',
        '--sidebar-active-bg': 'rgba(255, 255, 255, 0.1)',
        '--sidebar-active-text': '#ffffff'
    },
    'executive-dark': {
        '--bg-main': '#09090b',
        '--sidebar-bg': '#18181b',
        '--topbar-bg': '#18181b',
        '--card-bg': '#27272a',
        '--primary': '#10b981',
        '--accent': '#71717a',
        '--text-main': '#fafafa',
        '--text-muted': '#a1a1aa',
        '--border': '#3f3f46',
        '--sidebar-text': '#71717a',
        '--sidebar-active-bg': 'rgba(16, 185, 129, 0.1)',
        '--sidebar-active-text': '#10b981'
    },
    'warm-sunset': {
        '--bg-main': '#431407',
        '--sidebar-bg': '#7c2d12',
        '--topbar-bg': '#7c2d12',
        '--card-bg': '#9a3412',
        '--primary': '#fdba74',
        '--accent': '#fb923c',
        '--text-main': '#fff7ed',
        '--text-muted': '#ffedd5',
        '--border': '#ea580c',
        '--sidebar-text': '#fdba74',
        '--sidebar-active-bg': 'rgba(255, 255, 255, 0.1)',
        '--sidebar-active-text': '#ffffff'
    },
    'sapphire-pro': {
        '--bg-main': '#1e3a8a',
        '--sidebar-bg': '#1e40af',
        '--topbar-bg': '#1e40af',
        '--card-bg': '#1d4ed8',
        '--primary': '#60a5fa',
        '--accent': '#93c5fd',
        '--text-main': '#eff6ff',
        '--text-muted': '#bfdbfe',
        '--border': '#2563eb',
        '--sidebar-text': '#bfdbfe',
        '--sidebar-active-bg': 'rgba(255, 255, 255, 0.1)',
        '--sidebar-active-text': '#ffffff'
    }
};

function applyTheme(themeName) {
    const theme = themes[themeName];
    if (!theme) return;
    
    const root = document.documentElement;
    Object.keys(theme).forEach(key => {
        root.style.setProperty(key, theme[key]);
    });
    
    localStorage.setItem('kerea-dashboard-theme', themeName);
}

// Initialize theme
document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('kerea-dashboard-theme') || 'kerea-green';
    applyTheme(savedTheme);
});
