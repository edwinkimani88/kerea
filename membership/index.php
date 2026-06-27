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
            <img src="<?php echo $base_url; ?>assets/membership_hero.jpg" alt="KEREA Membership" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-black via-black/80 to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-3xl">
                <span class="inline-block px-4 py-1.5 bg-primary text-black text-[10px] font-black uppercase tracking-[0.2em] rounded-full mb-6 reveal-on-scroll">Memberships</span>
                <h1 class="text-5xl md:text-7xl font-black text-white leading-tight mb-6 reveal-on-scroll">
                    Join KEREA – Powering Kenya’s <span class="text-primary italic">Renewable Energy Future</span>
                </h1>
                <p class="text-xl text-slate-300 mb-10 leading-relaxed reveal-on-scroll">
                    Be part of a thriving community shaping the future of renewable energy in Kenya! Unlock business & career growth, and gain exclusive access to funding, training, and market intelligence.
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

    <!-- Membership Categories & Fees -->
    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-3xl md:text-5xl font-black text-black mb-6 reveal-on-scroll lowercase first-letter:uppercase">Membership Categories & Fees</h2>
                <p class="text-lg text-slate-600 reveal-on-scroll">Tailored support levels design for every stage of your organization's journey in the renewable energy sector.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Full Corporate -->
                <div class="bg-white p-10 rounded-4xl shadow-sm border border-slate-100 hover:shadow-xl transition-all duration-500 reveal-on-scroll group">
                    <div class="flex justify-between items-start mb-8">
                        <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i data-lucide="building-2" class="w-8 h-8 text-primary"></i>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Annual Sub</p>
                            <p class="text-xl font-black text-black">KES 30,000</p>
                        </div>
                    </div>
                    <h3 class="text-xl font-black text-black mb-2 uppercase tracking-tight">Full Corporate</h3>
                    <p class="text-xs font-black text-primary mb-6">Reg Fee: KES 5,000</p>
                    <p class="text-slate-500 text-sm mb-8 leading-relaxed">Designed for companies directly involved in renewable energy – manufacturers, distributors, EPC contractors, consultants, and financiers.</p>
                    <div class="space-y-3 mb-10">
                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-4">Key Benefits:</p>
                        <ul class="space-y-3 text-xs text-slate-600 font-bold">
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Voting Rights</li>
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Priority Directory Listing</li>
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Policy Advocacy</li>
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Access to Working Groups</li>
                        </ul>
                    </div>
                    <a href="register.php?tier=full-corporate" class="w-full inline-flex items-center justify-center gap-2 py-4 bg-slate-950 text-white font-black text-[10px] uppercase tracking-widest rounded-2xl hover:bg-primary hover:text-black transition-all">
                        Select Category <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

                <!-- Full Individual -->
                <div class="bg-white p-10 rounded-4xl shadow-sm border border-slate-100 hover:shadow-xl transition-all duration-500 reveal-on-scroll group" style="transition-delay: 100ms;">
                    <div class="flex justify-between items-start mb-8">
                        <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i data-lucide="user" class="w-8 h-8 text-primary"></i>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Annual Sub</p>
                            <p class="text-xl font-black text-black">KES 7,500</p>
                        </div>
                    </div>
                    <h3 class="text-xl font-black text-black mb-2 uppercase tracking-tight">Full Individual</h3>
                    <p class="text-xs font-black text-primary mb-6">Reg Fee: KES 2,500</p>
                    <p class="text-slate-500 text-sm mb-8 leading-relaxed">Ideal for individuals actively working in the renewable energy sector – engineers, consultants, researchers, and entrepreneurs.</p>
                    <div class="space-y-3 mb-10">
                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-4">Key Benefits:</p>
                        <ul class="space-y-3 text-xs text-slate-600 font-bold">
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Member Directory Listing</li>
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Access to Working Groups</li>
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Networking Events</li>
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Capacity Building</li>
                        </ul>
                    </div>
                    <a href="register.php?tier=full-individual" class="w-full inline-flex items-center justify-center gap-2 py-4 bg-slate-950 text-white font-black text-[10px] uppercase tracking-widest rounded-2xl hover:bg-primary hover:text-black transition-all">
                        Select Category <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

                <!-- Associate Corporate -->
                <div class="bg-white p-10 rounded-4xl shadow-sm border border-slate-100 hover:shadow-xl transition-all duration-500 reveal-on-scroll group" style="transition-delay: 200ms;">
                    <div class="flex justify-between items-start mb-8">
                        <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i data-lucide="briefcase" class="w-8 h-8 text-primary"></i>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Annual Sub</p>
                            <p class="text-xl font-black text-black">KES 4,500</p>
                        </div>
                    </div>
                    <h3 class="text-xl font-black text-black mb-2 uppercase tracking-tight">Associate Corporate</h3>
                    <p class="text-xs font-black text-primary mb-6">Reg Fee: KES 1,500</p>
                    <p class="text-slate-500 text-sm mb-8 leading-relaxed">For businesses and institutions that support renewable energy – law firms, banks, research institutions, and NGOs.</p>
                    <div class="space-y-3 mb-10">
                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-4">Key Benefits:</p>
                        <ul class="space-y-3 text-xs text-slate-600 font-bold">
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Networking & Growth</li>
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Priority Event Access</li>
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Legal Framework Training</li>
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Policy Discussions</li>
                        </ul>
                    </div>
                    <a href="register.php?tier=associate-corporate" class="w-full inline-flex items-center justify-center gap-2 py-4 bg-slate-950 text-white font-black text-[10px] uppercase tracking-widest rounded-2xl hover:bg-primary hover:text-black transition-all">
                        Select Category <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

                <!-- Financial Institution -->
                <div class="bg-white p-10 rounded-4xl shadow-sm border border-slate-100 hover:shadow-xl transition-all duration-500 reveal-on-scroll group">
                    <div class="flex justify-between items-start mb-8">
                        <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i data-lucide="landmark" class="w-8 h-8 text-primary"></i>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Annual Sub</p>
                            <p class="text-xl font-black text-black">KES 20,000</p>
                        </div>
                    </div>
                    <h3 class="text-xl font-black text-black mb-2 uppercase tracking-tight">Financial Institution</h3>
                    <p class="text-xs font-black text-primary mb-6">Reg Fee: KES 5,000</p>
                    <p class="text-slate-500 text-sm mb-8 leading-relaxed">Designed for banks, SACCOs, microfinance institutions, and investment firms supporting green finance.</p>
                    <div class="space-y-3 mb-10">
                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-4">Key Benefits:</p>
                        <ul class="space-y-3 text-xs text-slate-600 font-bold">
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Investment Opportunities</li>
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Market Intelligence</li>
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Visibility & Events</li>
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Regulatory Engagement</li>
                        </ul>
                    </div>
                    <a href="register.php?tier=financial-institution" class="w-full inline-flex items-center justify-center gap-2 py-4 bg-slate-950 text-white font-black text-[10px] uppercase tracking-widest rounded-2xl hover:bg-primary hover:text-black transition-all">
                        Select Category <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

                <!-- Partner Affiliate -->
                <div class="bg-white p-10 rounded-4xl shadow-sm border border-slate-100 hover:shadow-xl transition-all duration-500 reveal-on-scroll group" style="transition-delay: 100ms;">
                    <div class="flex justify-between items-start mb-8">
                        <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i data-lucide="handshake" class="w-8 h-8 text-primary"></i>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Annual Sub</p>
                            <p class="text-xl font-black text-black">KES 10,000</p>
                        </div>
                    </div>
                    <h3 class="text-xl font-black text-black mb-2 uppercase tracking-tight">Partner Affiliate</h3>
                    <p class="text-xs font-black text-primary mb-6">Reg Fee: KES 1,000</p>
                    <p class="text-slate-500 text-sm mb-8 leading-relaxed">Ideal for development partners, NGOs, academic institutions, and organizations supporting sector growth.</p>
                    <div class="space-y-3 mb-10">
                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-4">Key Benefits:</p>
                        <ul class="space-y-3 text-xs text-slate-600 font-bold">
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Strategic Partnerships</li>
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Stakeholder Forums</li>
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Research Collaboration</li>
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Visibility & Recognition</li>
                        </ul>
                    </div>
                    <a href="register.php?tier=partner-affiliate" class="w-full inline-flex items-center justify-center gap-2 py-4 bg-slate-950 text-white font-black text-[10px] uppercase tracking-widest rounded-2xl hover:bg-primary hover:text-black transition-all">
                        Select Category <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

                <!-- Associate Individual -->
                <div class="bg-white p-10 rounded-4xl shadow-sm border border-slate-100 hover:shadow-xl transition-all duration-500 reveal-on-scroll group" style="transition-delay: 200ms;">
                    <div class="flex justify-between items-start mb-8">
                        <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i data-lucide="users-round" class="w-8 h-8 text-primary"></i>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Annual Sub</p>
                            <p class="text-xl font-black text-black">KES 3,000</p>
                        </div>
                    </div>
                    <h3 class="text-xl font-black text-black mb-2 uppercase tracking-tight">Associate Individual</h3>
                    <p class="text-xs font-black text-primary mb-6">Reg Fee: KES 500</p>
                    <p class="text-slate-500 text-sm mb-8 leading-relaxed">For individuals passionate about renewable energy but not directly working in the sector—students, media, and supporters.</p>
                    <div class="space-y-3 mb-10">
                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-4">Key Benefits:</p>
                        <ul class="space-y-3 text-xs text-slate-600 font-bold">
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Industry Exposure</li>
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Sector Awareness</li>
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Knowledge Sessions</li>
                            <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Industry Updates</li>
                        </ul>
                    </div>
                    <a href="register.php?tier=associate-individual" class="w-full inline-flex items-center justify-center gap-2 py-4 bg-slate-950 text-white font-black text-[10px] uppercase tracking-widest rounded-2xl hover:bg-primary hover:text-black transition-all">
                        Select Category <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

                <!-- Student Membership (Full width on small, separate box) -->
                <div class="bg-slate-900 p-10 rounded-4xl shadow-2xl border border-white/5 reveal-on-scroll lg:col-span-3 mt-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                        <div>
                           <div class="flex items-center gap-4 mb-6">
                                <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center -rotate-3 group-hover:rotate-0 transition-transform">
                                    <i data-lucide="graduation-cap" class="w-6 h-6 text-black"></i>
                                </div>
                                <h3 class="text-2xl font-black text-white uppercase tracking-tight italic">Student Membership</h3>
                           </div>
                           <p class="text-slate-400 text-sm leading-relaxed mb-8">Designed for students interested in renewable energy, sustainability, climate action, and clean energy careers. Start your professional journey with the right foundation.</p>
                           <div class="grid grid-cols-2 gap-4 mb-10">
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-500">Reg Fee</p>
                                    <p class="text-lg font-black text-white">KES 500</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-500">Annual Sub</p>
                                    <p class="text-lg font-black text-primary">KES 1,500</p>
                                </div>
                           </div>
                        </div>
                        <div class="bg-white/5 p-8 rounded-3xl border border-white/10">
                            <p class="text-[10px] font-black uppercase text-primary tracking-widest mb-6">Student Benefits:</p>
                            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-slate-300 font-bold">
                                <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Internship Exposure</li>
                                <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Mentorship access</li>
                                <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Selected Webinars</li>
                                <li class="flex items-center gap-3"><i data-lucide="check" class="w-4 h-4 text-primary"></i> Industry Trends</li>
                            </ul>
                            <a href="register.php?tier=student" class="w-full mt-10 inline-flex items-center justify-center gap-2 py-4 bg-primary text-black font-black text-[10px] uppercase tracking-widest rounded-2xl hover:bg-white hover:text-black transition-all shadow-xl shadow-primary/20">
                                Join as Student <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Join KEREA? -->
    <section id="benefits" class="py-24 bg-white relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-3xl md:text-5xl font-black text-black mb-6 reveal-on-scroll">Why Join KEREA?</h2>
                <p class="text-lg text-slate-600 reveal-on-scroll">We provide the platform, authority, and resources needed for your organization to thrive in the shifting energy landscape.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="space-y-4 reveal-on-scroll">
                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-6">
                        <i data-lucide="trending-up" class="w-6 h-6 text-primary"></i>
                    </div>
                    <h4 class="font-black text-black uppercase text-sm tracking-tight">Part of Growth</h4>
                    <p class="text-slate-500 text-xs leading-relaxed">Shape Kenya’s renewable energy growth and contribute to policy influence.</p>
                </div>
                <div class="space-y-4 reveal-on-scroll" style="transition-delay: 100ms;">
                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-6">
                        <i data-lucide="globe" class="w-6 h-6 text-primary"></i>
                    </div>
                    <h4 class="font-black text-black uppercase text-sm tracking-tight">Expand Network</h4>
                    <p class="text-slate-500 text-xs leading-relaxed">Connect with global manufacturers, suppliers, and institutional investors.</p>
                </div>
                <div class="space-y-4 reveal-on-scroll" style="transition-delay: 200ms;">
                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-6">
                        <i data-lucide="zap" class="w-6 h-6 text-primary"></i>
                    </div>
                    <h4 class="font-black text-black uppercase text-sm tracking-tight">Unlock Growth</h4>
                    <p class="text-slate-500 text-xs leading-relaxed">Gain exclusive access to funding, training, and verified market intelligence.</p>
                </div>
                <div class="space-y-4 reveal-on-scroll" style="transition-delay: 300ms;">
                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-6">
                        <i data-lucide="shield-check" class="w-6 h-6 text-primary"></i>
                    </div>
                    <h4 class="font-black text-black uppercase text-sm tracking-tight">Industry Impact</h4>
                    <p class="text-slate-500 text-xs leading-relaxed">Strengthen your organization's footprint through advocacy and standards.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Join Steps -->
    <section class="py-24 bg-slate-950 text-white relative">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="reveal-on-scroll">
                    <span class="text-primary font-black text-[10px] uppercase tracking-[0.3em] mb-6 block">The Journey</span>
                    <h2 class="text-4xl md:text-6xl font-black mb-10 leading-tight">Fast-track Your <span class="italic text-primary">Industry Leader</span> Status</h2>
                    <div class="space-y-12">
                        <div class="flex gap-6">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center font-black text-primary text-xl shrink-0">1</div>
                            <div>
                                <h4 class="font-black uppercase tracking-tight mb-2">Apply Online</h4>
                                <p class="text-slate-400 text-sm font-medium">Complete the comprehensive online membership application form in under 5 minutes.</p>
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center font-black text-primary text-xl shrink-0">2</div>
                            <div>
                                <h4 class="font-black uppercase tracking-tight mb-2">Secure Payment</h4>
                                <p class="text-slate-400 text-sm font-medium">Settle your registration and subscription fees via Bank Transfer or M-PESA Paybill.</p>
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center font-black text-primary text-xl shrink-0">3</div>
                            <div>
                                <h4 class="font-black uppercase tracking-tight mb-2">Unlock Benefits</h4>
                                <p class="text-slate-400 text-sm font-medium">Receive your official confirmation and digital certificate to unlock all membership perks.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Visual / Form Link box -->
                <div class="reveal-on-scroll">
                    <div class="p-12 bg-white rounded-[4rem] text-slate-950 shadow-2xl relative overflow-hidden group">
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-primary/10 rounded-full blur-3xl transition-transform group-hover:scale-150"></div>
                        <h3 class="text-3xl font-black mb-8 italic">Become a Member</h3>
                        <p class="text-slate-500 font-bold mb-10 leading-relaxed text-sm">Join the apex body for renewable energy. Gain the authority and network your institution needs to dominate the green sector.</p>
                        <a href="register.php" class="w-full inline-flex items-center justify-center gap-3 py-6 bg-slate-950 text-white font-black uppercase text-xs tracking-[0.2em] rounded-3xl hover:bg-primary hover:text-black transition-all shadow-2xl">
                            Start Application <i data-lucide="plus-circle" class="w-5 h-5"></i>
                        </a>
                        <div class="mt-8 flex items-center gap-4 text-xs font-black text-slate-400 uppercase tracking-widest justify-center">
                            <span>Already a member?</span>
                            <a href="renewal.php" class="text-primary hover:underline">Renew Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-20 italic">
                <div class="flex justify-center gap-1 mb-6 text-amber-400">
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                    <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                </div>
                <h2 class="text-3xl md:text-5xl font-black text-black mb-6 reveal-on-scroll lowercase first-letter:uppercase">What Our Members Say</h2>
            </div>

            <!-- Testimonials Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- T1 -->
                <div class="bg-slate-50 p-10 rounded-4xl reveal-on-scroll">
                    <div class="flex gap-1 mb-6 text-primary">
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                    </div>
                    <p class="text-slate-600 text-sm leading-relaxed mb-8 font-medium italic">"Corporates can gain access to industry insights, networking opportunities, and policy advocacy by joining renewable energy associations like KEREA."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-slate-200 rounded-full"></div>
                        <div>
                            <p class="text-sm font-black text-black">Obed Pearson</p>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">VP Operations, Kengen</p>
                        </div>
                    </div>
                </div>

                <!-- T2 -->
                <div class="bg-slate-50 p-10 rounded-4xl reveal-on-scroll" style="transition-delay: 100ms;">
                    <div class="flex gap-1 mb-6 text-primary">
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                    </div>
                    <p class="text-slate-600 text-sm leading-relaxed mb-8 font-medium italic">"Joining KEREA is a positive step towards a sustainable future. It connects you with like-minded individuals committed to renewable energy solutions."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-slate-200 rounded-full"></div>
                        <div>
                            <p class="text-sm font-black text-black">Elisa Gill</p>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Manager, Barten Inc</p>
                        </div>
                    </div>
                </div>

                <!-- T3 -->
                <div class="bg-slate-50 p-10 rounded-4xl reveal-on-scroll" style="transition-delay: 200ms;">
                    <div class="flex gap-1 mb-6 text-primary">
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                    </div>
                    <p class="text-slate-600 text-sm leading-relaxed mb-8 font-medium italic">"Teaching our students about renewable energy has empowered them to make eco-conscious choices and contribute to a sustainable future."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-slate-200 rounded-full"></div>
                        <div>
                            <p class="text-sm font-black text-black">Nehad Khan</p>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Lecturer, Strathmore University</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php include_once '../includes/footer.php'; ?>
