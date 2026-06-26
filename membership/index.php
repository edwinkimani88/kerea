<?php
$active_page = "membership";
$base_url = "../";
include_once '../includes/head.php';
?>
<title>Membership | KEREA - Industry Peak Body</title>

<?php include_once '../includes/header.php'; ?>

<main class="bg-white">
    <!-- Hero Section -->
    <section class="relative min-h-[70vh] flex items-center overflow-hidden pt-20">
        <div class="absolute inset-0 z-0">
            <img src="<?php echo $base_url; ?>membership_hero_1782477859272.png" alt="Kerea Membership" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-black via-black/80 to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-3xl">
                <span class="inline-block px-4 py-1.5 bg-primary text-black text-[10px] font-black uppercase tracking-[0.2em] rounded-full mb-6 reveal-on-scroll">Elevate Your Business</span>
                <h1 class="text-5xl md:text-7xl font-black text-white leading-tight mb-6 reveal-on-scroll">
                    Join the Elite Network of <span class="text-primary italic">Energy Leaders</span>
                </h1>
                <p class="text-xl text-slate-300 mb-10 leading-relaxed reveal-on-scroll">
                    KEREA empowers businesses with unmatched market intelligence, policy advocacy, 
                    and a robust network of industry stakeholders. Unlock your competitive edge today.
                </p>
                <div class="flex flex-wrap gap-4 reveal-on-scroll">
                    <a href="register.php" class="px-8 py-4 bg-primary text-black font-black uppercase text-xs tracking-widest rounded-2xl hover:scale-105 active:scale-95 transition-all shadow-xl shadow-primary/20">
                        Become a Member
                    </a>
                    <a href="#benefits" class="px-8 py-4 border border-white/20 text-white font-black uppercase text-xs tracking-widest rounded-2xl hover:bg-white/10 transition-all">
                        Explore Benefits
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Value Proposition -->
    <section id="benefits" class="py-24 bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-3xl md:text-5xl font-black text-black mb-6 reveal-on-scroll">Why Join KEREA?</h2>
                <p class="text-lg text-slate-600 reveal-on-scroll">We provide the platform, authority, and resources needed for your organization to thrive in the shifting energy landscape.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Benefit 1 -->
                <div class="bg-white p-10 rounded-4xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 reveal-on-scroll">
                    <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mb-8">
                        <i data-lucide="landmark" class="w-8 h-8 text-primary"></i>
                    </div>
                    <h3 class="text-xl font-black text-black mb-4 uppercase tracking-tight">Policy Advocacy</h3>
                    <p class="text-slate-600 leading-relaxed">Direct representation in key policy-making forums and government negotiations to protect your business interests.</p>
                </div>

                <!-- Benefit 2 -->
                <div class="bg-white p-10 rounded-4xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 reveal-on-scroll" style="transition-delay: 100ms;">
                    <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mb-8">
                        <i data-lucide="trending-up" class="w-8 h-8 text-primary"></i>
                    </div>
                    <h3 class="text-xl font-black text-black mb-4 uppercase tracking-tight">Market Intel</h3>
                    <p class="text-slate-600 leading-relaxed">Exclusive access to industry reports, newsletters, and early-stage market trends across East Africa.</p>
                </div>

                <!-- Benefit 3 -->
                <div class="bg-white p-10 rounded-4xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 reveal-on-scroll" style="transition-delay: 200ms;">
                    <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mb-8">
                        <i data-lucide="users" class="w-8 h-8 text-primary"></i>
                    </div>
                    <h3 class="text-xl font-black text-black mb-4 uppercase tracking-tight">Global Networking</h3>
                    <p class="text-slate-600 leading-relaxed">VIP access to KEREA organized events, international trade missions, and business matching sessions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Membership Categories -->
    <section class="py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-end justify-between mb-16 gap-8">
                <div class="max-w-2xl">
                    <h2 class="text-3xl md:text-5xl font-black text-black mb-6 reveal-on-scroll">Membership Categories</h2>
                    <p class="text-lg text-slate-600 reveal-on-scroll">Tailored support levels for every stage of your organization's journey.</p>
                </div>
                <a href="categories.php" class="px-8 py-4 bg-black text-white font-black text-[10px] uppercase tracking-widest rounded-2xl hover:bg-primary hover:text-black transition-all reveal-on-scroll">
                    View Full Fees Structure
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Corporate -->
                <div class="group relative p-8 bg-slate-900 rounded-4xl border border-white/5 transition-all duration-500 hover:bg-black reveal-on-scroll">
                    <div class="mb-8">
                        <span class="text-primary font-black text-xs uppercase tracking-widest">Premium</span>
                        <h3 class="text-2xl font-black text-white mt-2">Corporate</h3>
                    </div>
                    <ul class="space-y-4 mb-10 text-slate-400 text-sm">
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Full voting rights</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Board eligibility</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Brand features</li>
                    </ul>
                    <a href="register.php?tier=corporate" class="inline-flex items-center gap-2 text-primary font-black text-[10px] uppercase tracking-widest group-hover:gap-4 transition-all">
                        Apply Now <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

                <!-- Associate -->
                <div class="group relative p-8 bg-slate-50 rounded-4xl border border-slate-100 transition-all duration-500 hover:bg-white hover:shadow-xl reveal-on-scroll" style="transition-delay: 50ms;">
                    <div class="mb-8">
                        <span class="text-slate-500 font-black text-xs uppercase tracking-widest">Standard</span>
                        <h3 class="text-2xl font-black text-black mt-2">Associate</h3>
                    </div>
                    <ul class="space-y-4 mb-10 text-slate-600 text-sm">
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Policy updates</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Event discounts</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Directory listing</li>
                    </ul>
                    <a href="register.php?tier=associate" class="inline-flex items-center gap-2 text-black font-black text-[10px] uppercase tracking-widest group-hover:gap-4 transition-all">
                        Apply Now <i data-lucide="arrow-right" class="w-4 h-4 text-primary"></i>
                    </a>
                </div>

                <!-- Individual -->
                <div class="group relative p-8 bg-slate-50 rounded-4xl border border-slate-100 transition-all duration-500 hover:bg-white hover:shadow-xl reveal-on-scroll" style="transition-delay: 100ms;">
                    <div class="mb-8">
                        <span class="text-slate-500 font-black text-xs uppercase tracking-widest">Professional</span>
                        <h3 class="text-2xl font-black text-black mt-2">Individual</h3>
                    </div>
                    <ul class="space-y-4 mb-10 text-slate-600 text-sm">
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Professional CPDs</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Knowledge Hub</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Tech sessions</li>
                    </ul>
                    <a href="register.php?tier=individual" class="inline-flex items-center gap-2 text-black font-black text-[10px] uppercase tracking-widest group-hover:gap-4 transition-all">
                        Apply Now <i data-lucide="arrow-right" class="w-4 h-4 text-primary"></i>
                    </a>
                </div>

                <!-- Student -->
                <div class="group relative p-8 bg-slate-50 rounded-4xl border border-slate-100 transition-all duration-500 hover:bg-white hover:shadow-xl reveal-on-scroll" style="transition-delay: 150ms;">
                    <div class="mb-8">
                        <span class="text-slate-500 font-black text-xs uppercase tracking-widest">Academic</span>
                        <h3 class="text-2xl font-black text-black mt-2">Student</h3>
                    </div>
                    <ul class="space-y-4 mb-10 text-slate-600 text-sm">
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Mentorship access</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Internship links</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Digital resources</li>
                    </ul>
                    <a href="register.php?tier=student" class="inline-flex items-center gap-2 text-black font-black text-[10px] uppercase tracking-widest group-hover:gap-4 transition-all">
                        Apply Now <i data-lucide="arrow-right" class="w-4 h-4 text-primary"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-24 bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-black text-black uppercase tracking-widest reveal-on-scroll">Frequently Asked Questions</h2>
                </div>
                
                <div class="space-y-4">
                    <!-- Q1 -->
                    <div class="bg-white rounded-3xl overflow-hidden border border-slate-100 reveal-on-scroll">
                        <button onclick="toggleFaq(1)" class="w-full flex items-center justify-between p-6 text-left hover:bg-slate-50 transition-colors">
                            <span class="font-black text-black text-sm uppercase tracking-tight">How long does the approval process take?</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400 transition-transform duration-300" id="faq-icon-1"></i>
                        </button>
                        <div id="faq-content-1" class="hidden p-6 pt-0 text-slate-600 text-sm leading-relaxed border-t border-slate-50">
                            The standard vetting process takes approximately 5-10 business days after submission of all required documentation. Our secretariat hub will notify you via email at every stage.
                        </div>
                    </div>

                    <!-- Q2 -->
                    <div class="bg-white rounded-3xl overflow-hidden border border-slate-100 reveal-on-scroll">
                        <button onclick="toggleFaq(2)" class="w-full flex items-center justify-between p-6 text-left hover:bg-slate-50 transition-colors">
                            <span class="font-black text-black text-sm uppercase tracking-tight">Can I upgrade my membership category?</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400 transition-transform duration-300" id="faq-icon-2"></i>
                        </button>
                        <div id="faq-content-2" class="hidden p-6 pt-0 text-slate-600 text-sm leading-relaxed border-t border-slate-50">
                            Yes, members can apply for an upgrade at any point during their membership cycle. The fee difference will be calculated pro-rata for the remaining period.
                        </div>
                    </div>

                    <!-- Q3 -->
                    <div class="bg-white rounded-3xl overflow-hidden border border-slate-100 reveal-on-scroll">
                        <button onclick="toggleFaq(3)" class="w-full flex items-center justify-between p-6 text-left hover:bg-slate-50 transition-colors">
                            <span class="font-black text-black text-sm uppercase tracking-tight">What documents are required for Corporate membership?</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400 transition-transform duration-300" id="faq-icon-3"></i>
                        </button>
                        <div id="faq-content-3" class="hidden p-6 pt-0 text-slate-600 text-sm leading-relaxed border-t border-slate-50">
                            Typically: Certificate of Incorporation, CR12 form, Tax Compliance Certificate, KRA PIN, and a brief company profile. Detailed checklists are provided during the application wizard.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-24 bg-black relative overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-0 right-0 w-96 h-96 bg-primary rounded-full blur-[120px] -mr-48 -mt-48"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary rounded-full blur-[120px] -ml-48 -mb-48"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h2 class="text-4xl md:text-6xl font-black text-white mb-8 reveal-on-scroll">Ready to lead the <span class="text-primary italic">Energy Transition?</span></h2>
            <p class="text-xl text-slate-400 mb-12 max-w-2xl mx-auto reveal-on-scroll">Join hundreds of organizations already shaping the future of renewables in Kenya.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 reveal-on-scroll">
                <a href="register.php" class="w-full sm:w-auto px-10 py-5 bg-primary text-black font-black uppercase text-xs tracking-[0.2em] rounded-2xl hover:bg-white transition-all shadow-2xl shadow-primary/20">
                    Get Started Right Now
                </a>
                <a href="<?php echo $base_url; ?>contact" class="w-full sm:w-auto px-10 py-5 border border-white/20 text-white font-black uppercase text-xs tracking-[0.2em] rounded-2xl hover:bg-white/10 transition-all">
                    Talk to Membership Hub
                </a>
            </div>
        </div>
    </section>
</main>

<script>
    function toggleFaq(id) {
        const content = document.getElementById(`faq-content-${id}`);
        const icon = document.getElementById(`faq-icon-${id}`);
        
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
        } else {
            content.classList.add('hidden');
            icon.style.transform = 'rotate(0deg)';
        }
    }
</script>

<?php include_once '../includes/footer.php'; ?>
