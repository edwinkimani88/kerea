<?php if(!isset($base_url)) $base_url = "/"; ?>
<footer class="bg-black text-white pt-24 pb-12 border-t border-white/5 relative overflow-hidden">
    <!-- Parallax Background Pattern -->
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none footer-bg-parallax" style="background-image: radial-gradient(#39DE4F 1px, transparent 1px); background-size: 40px 40px;"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 mb-20">
            <!-- Brand Column -->
            <div class="space-y-8">
                <a href="<?php echo $base_url; ?>" class="flex items-center gap-3">
                    <img src="<?php echo $base_url; ?>assets/kerea-logo-main.png" alt="KEREA" class="h-10 w-auto filter brightness-0 invert opacity-90">
                    <span class="text-xl font-black tracking-tight">KEREA</span>
                </a>
                <p class="text-sm text-slate-400 leading-relaxed max-w-xs font-medium">
                    The primary representative body for all sustainable energy practitioners and corporate stakeholders across East Africa.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-primary transition-all group">
                        <i data-lucide="facebook" class="w-4.5 h-4.5 text-slate-400 group-hover:text-black"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-primary transition-all group">
                        <i data-lucide="twitter" class="w-4.5 h-4.5 text-slate-400 group-hover:text-black"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-primary transition-all group">
                        <i data-lucide="linkedin" class="w-4.5 h-4.5 text-slate-400 group-hover:text-black"></i>
                    </a>
                </div>
            </div>

            <!-- Fast Links -->
            <div>
                <h4 class="text-[10px] font-black uppercase tracking-[0.3em] text-primary mb-8">Kerea Connect</h4>
                <ul class="space-y-4">
                    <li><a href="<?php echo $base_url; ?>about/" class="text-xs text-slate-400 hover:text-primary transition-all font-bold flex items-center gap-2 group"><i data-lucide="chevron-right" class="w-3 h-3 text-primary opacity-0 group-hover:opacity-100 transition-opacity"></i> Institutional Hub</a></li>
                    <li><a href="<?php echo $base_url; ?>marketplace/" class="text-xs text-slate-400 hover:text-primary transition-all font-bold flex items-center gap-2 group"><i data-lucide="chevron-right" class="w-3 h-3 text-primary opacity-0 group-hover:opacity-100 transition-opacity"></i> Marketplace</a></li>
                    <li><a href="<?php echo $base_url; ?>member-directory/" class="text-xs text-slate-400 hover:text-primary transition-all font-bold flex items-center gap-2 group"><i data-lucide="chevron-right" class="w-3 h-3 text-primary opacity-0 group-hover:opacity-100 transition-opacity"></i> Member Directory</a></li>
                    <li><a href="<?php echo $base_url; ?>news/" class="text-xs text-slate-400 hover:text-primary transition-all font-bold flex items-center gap-2 group"><i data-lucide="chevron-right" class="w-3 h-3 text-primary opacity-0 group-hover:opacity-100 transition-opacity"></i> Press Releases</a></li>
                </ul>
            </div>

            <!-- Operations -->
            <div>
                <h4 class="text-[10px] font-black uppercase tracking-[0.3em] text-primary mb-8">Sector Governance</h4>
                <ul class="space-y-4">
                    <li><a href="<?php echo $base_url; ?>policy-advocacy/" class="text-xs text-slate-400 hover:text-primary transition-all font-bold">Policy & Advocacy</a></li>
                    <li><a href="<?php echo $base_url; ?>standards/" class="text-xs text-slate-400 hover:text-primary transition-all font-bold">Technical Standards</a></li>
                    <li><a href="<?php echo $base_url; ?>publications/" class="text-xs text-slate-400 hover:text-primary transition-all font-bold">Reports & Research</a></li>
                    <li><a href="<?php echo $base_url; ?>knowledge-hub/" class="text-xs text-slate-400 hover:text-primary transition-all font-bold">Knowledge Hub</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-[10px] font-black uppercase tracking-[0.3em] text-primary mb-8">Secretariat</h4>
                <ul class="space-y-6">
                    <li class="flex items-start gap-4">
                        <i data-lucide="map-pin" class="w-4.5 h-4.5 text-primary mt-0.5"></i>
                        <span class="text-xs text-slate-400 leading-relaxed font-medium">Keri Road, Nairobi West,<br>Nairobi, KE</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <i data-lucide="mail" class="w-4.5 h-4.5 text-primary"></i>
                        <span class="text-xs text-slate-400 font-medium">info@kerea.org</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <i data-lucide="phone" class="w-4.5 h-4.5 text-primary"></i>
                        <span class="text-xs text-slate-400 font-medium">(+254) 740 541 896</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-10 border-t border-white/5 flex flex-col sm:flex-row justify-between items-center gap-6">
            <p class="text-[9px] text-slate-600 uppercase font-black tracking-[0.3em]">
                &copy; <?php echo date('Y'); ?> Kenya Renewable Energy Association. All rights reserved.
            </p>
            <div class="flex gap-8">
                <a href="#" class="text-[9px] text-slate-600 hover:text-primary font-black uppercase tracking-[0.2em] transition-colors">Privacy</a>
                <a href="#" class="text-[9px] text-slate-600 hover:text-primary font-black uppercase tracking-[0.2em] transition-colors">Terms</a>
            </div>
        </div>
    </div>
</footer>

<script>
    // Initialize Lucide Icons
    lucide.createIcons();

    // ─── Master Animation System ────────────────────────────────────────────────
    gsap.registerPlugin(ScrollTrigger);

    function isInViewport(el) {
        const rect = el.getBoundingClientRect();
        return rect.top < window.innerHeight && rect.bottom > 0;
    }

    function animateElement(el, delay) {
        delay = delay || 0;
        if (isInViewport(el)) {
            // Already visible — animate in immediately
            gsap.fromTo(el,
                { y: 24, autoAlpha: 0 },
                { y: 0, autoAlpha: 1, duration: 0.65, delay: delay, ease: 'power2.out' }
            );
        } else {
            // Off-screen — use ScrollTrigger
            gsap.fromTo(el,
                { y: 30, autoAlpha: 0 },
                {
                    y: 0,
                    autoAlpha: 1,
                    duration: 0.7,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 92%',
                        toggleActions: 'play none none none',
                    }
                }
            );
        }
    }

    // Individual .reveal-on-scroll elements
    document.querySelectorAll('.reveal-on-scroll').forEach((el, i) => {
        animateElement(el, i * 0.06);
    });

    // Staggered containers
    document.querySelectorAll('.stagger-reveal').forEach((container) => {
        const children = Array.from(container.children);
        if (isInViewport(container)) {
            gsap.fromTo(children,
                { y: 24, autoAlpha: 0 },
                { y: 0, autoAlpha: 1, duration: 0.6, stagger: 0.08, ease: 'power2.out', delay: 0.1 }
            );
        } else {
            gsap.fromTo(children,
                { y: 30, autoAlpha: 0 },
                {
                    y: 0,
                    autoAlpha: 1,
                    duration: 0.65,
                    stagger: 0.09,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: container,
                        start: 'top 88%',
                        toggleActions: 'play none none none',
                    }
                }
            );
        }
    });

    // Subtle Footer Parallax
    gsap.to('.footer-bg-parallax', {
        scrollTrigger: {
            trigger: 'footer',
            start: 'top bottom',
            end: 'bottom top',
            scrub: true
        },
        y: -80,
        ease: 'none'
    });

    // Counter animation (for homepage)
    document.querySelectorAll('.counter').forEach((counter) => {
        const animate = () => {
            const value = +counter.getAttribute('data-target');
            const data = +counter.innerText;
            const time = value / 150;
            if (data < value) {
                counter.innerText = Math.ceil(data + time);
                setTimeout(animate, 1);
            } else {
                counter.innerText = value;
            }
        };
        if (isInViewport(counter)) {
            animate();
        } else {
            ScrollTrigger.create({
                trigger: counter,
                start: 'top 95%',
                onEnter: animate,
                once: true
            });
        }
    });
</script>
