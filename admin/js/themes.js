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
        '--topbar-bg': '#1e293b',
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
        '--bg-main': '#121212',
        '--sidebar-bg': '#1a1a1a',
        '--topbar-bg': '#1a1a1a',
        '--card-bg': '#1a1a1a',
        '--primary': '#2563eb',
        '--accent': '#3b82f6',
        '--text-main': '#e5e5e5',
        '--text-muted': '#a3a3a3',
        '--border': '#262626',
        '--sidebar-text': '#a3a3a3',
        '--sidebar-active-bg': 'rgba(37, 99, 235, 0.1)',
        '--sidebar-active-text': '#2563eb'
    },
    'forest-premium': {
        '--bg-main': '#fdfcf0',
        '--sidebar-bg': '#14532d',
        '--topbar-bg': '#ffffff',
        '--card-bg': '#ffffff',
        '--primary': '#16a34a',
        '--accent': '#ca8a04',
        '--text-main': '#064e3b',
        '--text-muted': '#065f46',
        '--border': '#f0fdf4',
        '--sidebar-text': '#bbf7d0',
        '--sidebar-active-bg': 'rgba(255, 255, 255, 0.1)',
        '--sidebar-active-text': '#ffffff'
    },
    'earth-tone': {
        '--bg-main': '#fafaf9',
        '--sidebar-bg': '#44403c',
        '--topbar-bg': '#ffffff',
        '--card-bg': '#ffffff',
        '--primary': '#84cc16',
        '--accent': '#a8a29e',
        '--text-main': '#292524',
        '--text-muted': '#78716c',
        '--border': '#f5f5f4',
        '--sidebar-text': '#d6d3d1',
        '--sidebar-active-bg': 'rgba(255, 255, 255, 0.1)',
        '--sidebar-active-text': '#ffffff'
    },
    'modern-light': {
        '--bg-main': '#ffffff',
        '--sidebar-bg': '#f8fafc',
        '--topbar-bg': '#ffffff',
        '--card-bg': '#ffffff',
        '--primary': '#10b981',
        '--accent': '#fbbf24',
        '--text-main': '#1e293b',
        '--text-muted': '#64748b',
        '--border': '#e2e8f0',
        '--sidebar-text': '#475569',
        '--sidebar-active-bg': '#ffffff',
        '--sidebar-active-text': '#10b981'
    },
    'ocean-blue': {
        '--bg-main': '#f0f9ff',
        '--sidebar-bg': '#0c4a6e',
        '--topbar-bg': '#ffffff',
        '--card-bg': '#ffffff',
        '--primary': '#0ea5e9',
        '--accent': '#075985',
        '--text-main': '#0c4a6e',
        '--text-muted': '#38bdf8',
        '--border': '#e0f2fe',
        '--sidebar-text': '#bae6fd',
        '--sidebar-active-bg': 'rgba(255, 255, 255, 0.1)',
        '--sidebar-active-text': '#ffffff'
    },
    'executive-dark': {
        '--bg-main': '#18181b',
        '--sidebar-bg': '#09090b',
        '--topbar-bg': '#09090b',
        '--card-bg': '#09090b',
        '--primary': '#10b981',
        '--accent': '#71717a',
        '--text-main': '#fafafa',
        '--text-muted': '#71717a',
        '--border': '#27272a',
        '--sidebar-text': '#71717a',
        '--sidebar-active-bg': 'rgba(16, 185, 129, 0.1)',
        '--sidebar-active-text': '#10b981'
    },
    'warm-sunset': {
        '--bg-main': '#fff7ed',
        '--sidebar-bg': '#7c2d12',
        '--topbar-bg': '#ffffff',
        '--card-bg': '#ffffff',
        '--primary': '#ea580c',
        '--accent': '#f97316',
        '--text-main': '#431407',
        '--text-muted': '#9a3412',
        '--border': '#ffedd5',
        '--sidebar-text': '#fdba74',
        '--sidebar-active-bg': 'rgba(255, 255, 255, 0.1)',
        '--sidebar-active-text': '#ffffff'
    },
    'sapphire-pro': {
        '--bg-main': '#f8fafc',
        '--sidebar-bg': '#1e3a8a',
        '--topbar-bg': '#ffffff',
        '--card-bg': '#ffffff',
        '--primary': '#2563eb',
        '--accent': '#1e40af',
        '--text-main': '#1e3a8a',
        '--text-muted': '#475569',
        '--border': '#e2e8f0',
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
