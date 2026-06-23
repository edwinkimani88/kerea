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
        '--sidebar-active-text': '#39DE4F',
        '--btn-text': '#000000'
    },
    'midnight-blue': {
        '--bg-main': '#020617',
        '--sidebar-bg': '#1e293b',
        '--topbar-bg': '#0f172a',
        '--card-bg': '#1e293b',
        '--primary': '#38bdf8',
        '--accent': '#f472b6',
        '--text-main': '#f8fafc',
        '--text-muted': '#94a3b8',
        '--border': '#334155',
        '--sidebar-text': '#94a3b8',
        '--sidebar-active-bg': 'rgba(56, 189, 248, 0.1)',
        '--sidebar-active-text': '#38bdf8',
        '--btn-text': '#020617'
    },
    'carbon-dark': {
        '--bg-main': '#000000',
        '--sidebar-bg': '#121212',
        '--topbar-bg': '#121212',
        '--card-bg': '#18181b',
        '--primary': '#4f46e5',
        '--accent': '#06b6d4',
        '--text-main': '#ffffff',
        '--text-muted': '#a1a1aa',
        '--border': '#27272a',
        '--sidebar-text': '#a1a1aa',
        '--sidebar-active-bg': 'rgba(79, 70, 229, 0.1)',
        '--sidebar-active-text': '#818cf8',
        '--btn-text': '#ffffff'
    },
    'forest-premium': {
        '--bg-main': '#022c22',
        '--sidebar-bg': '#064e44',
        '--topbar-bg': '#064e44',
        '--card-bg': '#022c22',
        '--primary': '#10b981',
        '--accent': '#fbbf24',
        '--text-main': '#ecfdf5',
        '--text-muted': '#6ee7b7',
        '--border': '#065f46',
        '--sidebar-text': '#d1fae5',
        '--sidebar-active-bg': 'rgba(16, 185, 129, 0.1)',
        '--sidebar-active-text': '#34d399',
        '--btn-text': '#022c22'
    },
    'earth-tone': {
        '--bg-main': '#1c1917',
        '--sidebar-bg': '#292524',
        '--topbar-bg': '#292524',
        '--card-bg': '#44403c',
        '--primary': '#a3e635',
        '--accent': '#ea580c',
        '--text-main': '#f5f5f4',
        '--text-muted': '#a8a29e',
        '--border': '#57534e',
        '--sidebar-text': '#d6d3d1',
        '--sidebar-active-bg': 'rgba(163, 230, 53, 0.1)',
        '--sidebar-active-text': '#bef264',
        '--btn-text': '#1c1917'
    },
    'modern-light': {
        '--bg-main': '#f8fafc',
        '--sidebar-bg': '#ffffff',
        '--topbar-bg': '#ffffff',
        '--card-bg': '#ffffff',
        '--primary': '#6366f1',
        '--accent': '#f43f5e',
        '--text-main': '#1e293b',
        '--text-muted': '#64748b',
        '--border': '#e2e8f0',
        '--sidebar-text': '#475569',
        '--sidebar-active-bg': '#f5f3ff',
        '--sidebar-active-text': '#6366f1',
        '--btn-text': '#ffffff'
    },
    'ocean-blue': {
        '--bg-main': '#083344',
        '--sidebar-bg': '#164e63',
        '--topbar-bg': '#155e75',
        '--card-bg': '#083344',
        '--primary': '#22d3ee',
        '--accent': '#fbbf24',
        '--text-main': '#ecfeff',
        '--text-muted': '#67e8f9',
        '--border': '#0e7490',
        '--sidebar-text': '#cffafe',
        '--sidebar-active-bg': 'rgba(34, 211, 238, 0.1)',
        '--sidebar-active-text': '#22d3ee',
        '--btn-text': '#083344'
    },
    'executive-dark': {
        '--bg-main': '#09090b',
        '--sidebar-bg': '#18181b',
        '--topbar-bg': '#18181b',
        '--card-bg': '#27272a',
        '--primary': '#2dd4bf',
        '--accent': '#a21caf',
        '--text-main': '#fafafa',
        '--text-muted': '#a1a1aa',
        '--border': '#3f3f46',
        '--sidebar-text': '#71717a',
        '--sidebar-active-bg': 'rgba(45, 212, 191, 0.1)',
        '--sidebar-active-text': '#2dd4bf',
        '--btn-text': '#09090b'
    },
    'warm-sunset': {
        '--bg-main': '#450a0a',
        '--sidebar-bg': '#7f1d1d',
        '--topbar-bg': '#7f1d1d',
        '--card-bg': '#991b1b',
        '--primary': '#fbbf24',
        '--accent': '#f97316',
        '--text-main': '#fef2f2',
        '--text-muted': '#fecaca',
        '--border': '#b91c1c',
        '--sidebar-text': '#fca5a5',
        '--sidebar-active-bg': 'rgba(251, 191, 36, 0.1)',
        '--sidebar-active-text': '#fbbf24',
        '--btn-text': '#450a0a'
    },
    'sapphire-pro': {
        '--bg-main': '#172554',
        '--sidebar-bg': '#1e3a8a',
        '--topbar-bg': '#1e3a8a',
        '--card-bg': '#1e40af',
        '--primary': '#60a5fa',
        '--accent': '#f472b6',
        '--text-main': '#eff6ff',
        '--text-muted': '#93c5fd',
        '--border': '#2563eb',
        '--sidebar-text': '#bfdbfe',
        '--sidebar-active-bg': 'rgba(96, 165, 250, 0.1)',
        '--sidebar-active-text': '#60a5fa',
        '--btn-text': '#172554'
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
