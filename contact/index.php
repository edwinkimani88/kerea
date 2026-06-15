<?php 
$base_url = "../";
$active_page = "contact";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/head.php'; ?>
    <title>Contact Secretariat | KEREA Kenya</title>
    <meta name="description" content="Get in touch with KEREA's Nairobi secretariat for membership, marketplace, or policy advocacy inquiries.">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <!-- Hero - Green primary -->
        <section class="relative bg-primary pt-32 pb-48 overflow-hidden">
            <div class="absolute inset-0 opacity-[0.08] pointer-events-none" style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 32px 32px;"></div>
            <div class="absolute right-0 top-0 w-1/3 h-full bg-black/10 skew-x-12 transform translate-x-20 pointer-events-none"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="max-w-3xl space-y-10">
                    <span class="reveal-on-scroll text-black/60 font-black text-[10px] uppercase tracking-[0.4em] block">Secretariat</span>
                    <h1 class="reveal-on-scroll text-6xl sm:text-7xl lg:text-8xl font-black text-black leading-tight tracking-tighter">
                        Connect With <span class="text-slate-800">KEREA</span>
                    </h1>
                    <p class="reveal-on-scroll text-black/70 text-xl sm:text-2xl leading-relaxed font-medium">
                        Our Nairobi secretariat team is available for membership, marketplace, and policy advocacy inquiries.
                    </p>
                </div>
            </div>
        </section>

        <!-- Contact Content -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-20 pb-32">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                <!-- Info Column -->
                <div class="lg:col-span-4 space-y-6">
                    <!-- Contact Info Card -->
                    <div class="reveal-on-scroll bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl p-10 space-y-10">
                        <div>
                            <span class="text-primary font-black text-[10px] uppercase tracking-[0.4em] block mb-3">Connect With Us</span>
                            <h2 class="text-3xl font-black text-black tracking-tight">How can we<br>help you?</h2>
                        </div>
                        <div class="space-y-8">
                            <div class="flex items-start gap-6">
                                <div class="w-12 h-12 bg-black rounded-2xl flex items-center justify-center shrink-0 shadow-lg">
                                    <i data-lucide="map-pin" class="w-5 h-5 text-primary"></i>
                                </div>
                                <div class="space-y-1">
                                    <h4 class="font-black text-black text-sm uppercase tracking-tight">Main Secretariat Hub</h4>
                                    <p class="text-slate-500 text-xs leading-relaxed">Westlands Plaza, 2nd Floor,<br>Wood Avenue, Nairobi, Kenya</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-6">
                                <div class="w-12 h-12 bg-black rounded-2xl flex items-center justify-center shrink-0 shadow-lg">
                                    <i data-lucide="mail" class="w-5 h-5 text-primary"></i>
                                </div>
                                <div class="space-y-1">
                                    <h4 class="font-black text-black text-sm uppercase tracking-tight">Official Email</h4>
                                    <p class="text-slate-500 text-xs leading-relaxed">membership@kerea.org<br>info@kerea.org</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-6">
                                <div class="w-12 h-12 bg-black rounded-2xl flex items-center justify-center shrink-0 shadow-lg">
                                    <i data-lucide="phone" class="w-5 h-5 text-primary"></i>
                                </div>
                                <div class="space-y-1">
                                    <h4 class="font-black text-black text-sm uppercase tracking-tight">Direct Hotline</h4>
                                    <p class="text-slate-500 text-xs leading-relaxed">+254 (0) 20 2345678<br>+254 (0) 720 000000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Office Hours Card -->
                    <div class="reveal-on-scroll bg-primary rounded-[2.5rem] p-10 space-y-6 shadow-xl shadow-primary/20">
                        <h3 class="font-black text-black text-xl tracking-tight">Office Hours</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between text-sm font-bold text-black/70">
                                <span>Monday – Friday</span>
                                <span class="font-black text-black">8:00 – 17:00</span>
                            </div>
                            <div class="flex justify-between text-sm font-bold text-black/70">
                                <span>Saturday</span>
                                <span class="font-black text-black">9:00 – 13:00</span>
                            </div>
                            <div class="flex justify-between text-sm font-bold text-black/50">
                                <span>Sunday / Public Holidays</span>
                                <span class="font-black text-black/40">Closed</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Column -->
                <div class="lg:col-span-8">
                    <div class="reveal-on-scroll bg-white rounded-[2.5rem] p-10 sm:p-16 border border-slate-100 shadow-2xl relative overflow-hidden">
                        <div class="absolute -right-32 -top-32 w-96 h-96 bg-primary/5 rounded-full blur-3xl pointer-events-none"></div>
                        <div class="relative z-10 space-y-10">
                            <div class="border-b border-slate-100 pb-8">
                                <span class="text-primary font-black text-[10px] uppercase tracking-[0.4em] block mb-3">Secure Portal</span>
                                <h2 class="text-3xl font-black text-black tracking-tight">Send A Message</h2>
                            </div>
                            <form action="#" class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest px-1">Full Name</label>
                                    <input type="text" placeholder="e.g. Jane Mwangi" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold text-black focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/40 transition-all placeholder-slate-300">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest px-1">Corporate Email</label>
                                    <input type="email" placeholder="name@company.co.ke" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold text-black focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/40 transition-all placeholder-slate-300">
                                </div>
                                <div class="col-span-full space-y-2">
                                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest px-1">Subject Matter</label>
                                    <select class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-bold text-black focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/40 transition-all appearance-none">
                                        <option>Membership Application</option>
                                        <option>Marketplace Support</option>
                                        <option>Policy Advocacy Inquiry</option>
                                        <option>Standards Certification</option>
                                        <option>Media & Press</option>
                                        <option>General Inquiry</option>
                                    </select>
                                </div>
                                <div class="col-span-full space-y-2">
                                    <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest px-1">Your Message</label>
                                    <textarea rows="6" placeholder="Describe your inquiry in detail..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-5 text-sm font-bold text-black focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/40 transition-all resize-none placeholder-slate-300"></textarea>
                                </div>
                                <div class="col-span-full pt-4">
                                    <button type="submit" class="w-full py-5 bg-black text-white font-black rounded-2xl text-sm uppercase tracking-widest hover:bg-primary hover:text-black transition-all shadow-xl flex items-center justify-center gap-3 duration-300">
                                        Send Secure Message <i data-lucide="send" class="w-5 h-5"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
