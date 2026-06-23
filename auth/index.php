<?php 
$base_url = "../";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/head.php'; ?>
    <title>KEREA | Digital Gateway Authentication</title>
    <style>
        .auth-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(40px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .bg-mesh {
            background-color: #0c0c0c;
            background-image: 
                radial-gradient(at 0% 0%, hsla(128,68%,48%,0.15) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(210,100%,50%,0.15) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(128,68%,48%,0.1) 0, transparent 50%);
        }
    </style>
</head>
<body class="bg-mesh min-h-screen flex items-center justify-center p-6">
    
    <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <!-- Brand Side -->
        <div class="hidden lg:block space-y-12 pr-12">
            <a href="../" class="inline-block group">
                <img src="../assets/logo.png" class="h-16 w-auto group-hover:scale-105 transition-transform" alt="KEREA">
            </a>
            
            <div class="space-y-8">
                <h1 class="text-7xl font-black text-white tracking-tighter leading-none italic">
                    Digital<br><span class="text-primary not-italic">Gateway.</span>
                </h1>
                <p class="text-xl text-slate-400 font-bold leading-relaxed max-w-md">Access your KEREA verified merchant portal, manage compliance, and drive sector growth.</p>
            </div>

            <div class="grid grid-cols-2 gap-8 pt-10">
                <div class="space-y-3">
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                        <i data-lucide="shield-check" class="w-5 h-5"></i>
                    </div>
                    <p class="text-[10px] font-black uppercase text-slate-500 tracking-widest leading-tight">Biometric<br>Encryption</p>
                </div>
                <div class="space-y-3">
                    <div class="w-10 h-10 bg-blue-500/10 rounded-xl flex items-center justify-center text-blue-400">
                        <i data-lucide="refresh-cw" class="w-5 h-5"></i>
                    </div>
                    <p class="text-[10px] font-black uppercase text-slate-500 tracking-widest leading-tight">Merchant<br>Sync v4</p>
                </div>
            </div>
        </div>

        <!-- Auth Card -->
        <div class="auth-card rounded-[4rem] p-12 sm:p-20 shadow-4xl space-y-10 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-2 bg-primary"></div>
            
            <div class="lg:hidden mb-12">
                <img src="../assets/logo.png" class="h-12 w-auto mx-auto" alt="KEREA">
            </div>

            <div class="space-y-4 text-center lg:text-left">
                <h2 class="text-4xl font-black text-slate-900 tracking-tight italic uppercase">Welcome Back</h2>
                <p class="text-slate-400 text-sm font-bold uppercase tracking-widest">Authenticate to access the peak body hub</p>
            </div>

            <form onsubmit="event.preventDefault(); AuthUI.login();" class="space-y-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-4">Merchant ID / Email</label>
                    <input type="email" required placeholder="admin@kerea.org" class="w-full px-8 py-6 bg-slate-100/50 border border-slate-200 rounded-3xl text-sm font-bold focus:outline-none focus:ring-4 focus:ring-primary/20 focus:bg-white transition-all">
                </div>
                <div class="space-y-2 relative">
                    <div class="flex justify-between px-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Secret Keyword</label>
                        <a href="#" class="text-[9px] font-black text-primary uppercase tracking-widest hover:underline">Reset</a>
                    </div>
                    <input type="password" required placeholder="••••••••" class="w-full px-8 py-6 bg-slate-100/50 border border-slate-200 rounded-3xl text-sm font-bold focus:outline-none focus:ring-4 focus:ring-primary/20 focus:bg-white transition-all">
                </div>

                <div class="flex items-center gap-4 px-4 py-2">
                    <input type="checkbox" id="remember" class="w-4 h-4 rounded-md border-slate-300 text-primary focus:ring-primary">
                    <label for="remember" class="text-[10px] font-black text-slate-500 uppercase tracking-widest cursor-pointer">Stay Authenticated</label>
                </div>

                <button type="submit" id="submit-btn" class="w-full py-6 bg-slate-900 text-white rounded-3xl font-black text-xs uppercase tracking-[0.3em] shadow-2xl hover:bg-primary hover:text-black transition-all hover:scale-[1.02] active:scale-95 group flex items-center justify-center gap-4">
                    Initialize Access <i data-lucide="zap" class="w-5 h-5 group-hover:rotate-12 transition-transform"></i>
                </button>
            </form>

            <div class="text-center pt-8 border-t border-slate-100">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Not a certified member?</p>
                <a href="../member-directory/" class="text-[10px] font-black text-primary uppercase tracking-widest hover:underline mt-2 inline-block">Submit Membership KYC</a>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/lucide@latest/dist/umd/lucide.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        lucide.createIcons();

        const AuthUI = {
            login: () => {
                const btn = document.getElementById('submit-btn');
                const originalText = btn.innerHTML;
                
                btn.disabled = true;
                btn.innerHTML = '<div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div> Validating...';
                
                // Simulate network latency
                setTimeout(() => {
                    btn.innerHTML = '<i data-lucide="check" class="w-6 h-6"></i> Access Granted';
                    btn.classList.replace('bg-slate-900', 'bg-emerald-500');
                    lucide.createIcons();
                    
                    gsap.to('body', { opacity: 0, duration: 0.8, delay: 0.5, onComplete: () => {
                        window.location.href = '../admin/';
                    }});
                }, 2000);
            }
        };

        // Entrance animation
        gsap.from('.auth-card', { opacity: 0, x: 100, duration: 1.5, ease: "power4.out" });
        gsap.from('h1', { opacity: 0, y: 50, duration: 1.2, delay: 0.3, ease: "power4.out" });
    </script>
</body>
</html>
