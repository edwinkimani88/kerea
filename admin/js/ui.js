/**
 * KEREA UI Interactive Logic
 * Handles modals, drawers, toasts, and mock interactions
 */

const UI = {
    // Toast Notification
    toast: (message, type = 'success') => {
        const toast = document.createElement('div');
        toast.className = `fixed bottom-10 right-10 z-[100] px-8 py-5 rounded-2xl shadow-2xl flex items-center gap-4 border gsap-reveal`;
        
        let icon = 'check-circle';
        let bg = 'bg-white';
        let text = 'text-slate-800';
        let border = 'border-slate-100';
        let iconColor = 'text-primary';

        if (type === 'error') {
            icon = 'alert-circle';
            iconColor = 'text-red-500';
        } else if (type === 'warning') {
            icon = 'alert-triangle';
            iconColor = 'text-amber-500';
        }

        toast.innerHTML = `
            <div class="w-10 h-10 ${iconColor} bg-opacity-10 rounded-xl flex items-center justify-center">
                <i data-lucide="${icon}" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">System Notification</p>
                <p class="text-sm font-black ${text}">${message}</p>
            </div>
        `;

        document.body.appendChild(toast);
        lucide.createIcons();

        gsap.fromTo(toast, 
            { x: 100, opacity: 0, scale: 0.9 }, 
            { x: 0, opacity: 1, scale: 1, duration: 0.8, ease: "expo.out" }
        );

        setTimeout(() => {
            gsap.to(toast, { 
                x: 100, 
                opacity: 0, 
                duration: 0.5, 
                onComplete: () => toast.remove() 
            });
        }, 3000);
    },

    // Modal System
    modal: {
        open: (id) => {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            const content = modal.querySelector('.modal-content');
            gsap.fromTo(modal, { opacity: 0 }, { opacity: 1, duration: 0.3 });
            gsap.fromTo(content, { y: 50, scale: 0.95, opacity: 0 }, { y: 0, scale: 1, opacity: 1, duration: 0.6, ease: "expo.out" });
        },
        close: (id) => {
            const modal = document.getElementById(id);
            if (!modal) return;
            const content = modal.querySelector('.modal-content');
            
            gsap.to(content, { y: 50, scale: 0.95, opacity: 0, duration: 0.4 });
            gsap.to(modal, { opacity: 0, duration: 0.3, onComplete: () => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }});
        }
    },

    // Dropdowns
    toggleDropdown: (id) => {
        const dd = document.getElementById(id);
        if (!dd) return;
        const isHidden = dd.classList.contains('hidden');
        
        if (isHidden) {
            dd.classList.remove('hidden');
            gsap.fromTo(dd, { y: 10, opacity: 0, scale: 0.95 }, { y: 0, opacity: 1, scale: 1, duration: 0.4, ease: "expo.out" });
        } else {
            gsap.to(dd, { y: 10, opacity: 0, scale: 0.95, duration: 0.3, onComplete: () => dd.classList.add('hidden') });
        }
    }
};

// Global Listeners
document.addEventListener('DOMContentLoaded', () => {
    // Close modals on overlay click
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) UI.modal.close(overlay.id);
        });
    });
});
