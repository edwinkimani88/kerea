<?php
$active_page = "membership";
$base_url = "../";
include_once '../includes/head.php';
?>
<title>KEREA Registration Form | Join the Association</title>

<?php include_once '../includes/header.php'; ?>

<main class="bg-slate-50 min-h-screen py-20">
    <div class="container mx-auto px-6">
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 bg-primary/10 text-primary text-[10px] font-black uppercase tracking-[0.2em] rounded-full mb-6 italic">Registration Hub</span>
                <h1 class="text-4xl md:text-6xl font-black text-black mb-6">KEREA Registration <span class="italic text-primary">Form</span></h1>
                <p class="text-slate-500 max-w-2xl mx-auto">The Kenya Renewable Energy Association is proud to be associated with you and would like to invite you to become a member.</p>
            </div>

            <!-- Progress Indicator -->
            <div class="mb-16 relative px-10">
                <div class="flex justify-between relative z-10">
                    <?php 
                    $steps = ["Profile", "Membership", "Technical", "Payment", "Needs", "Review"];
                    foreach($steps as $i => $step): 
                        $num = $i + 1;
                    ?>
                    <div class="step-indicator flex flex-col items-center gap-4 transition-all duration-500" data-step="<?php echo $num; ?>">
                        <div class="step-circle w-14 h-14 rounded-3xl flex items-center justify-center font-black transition-all duration-500 bg-white text-slate-300 border-2 border-slate-100 shadow-sm relative overflow-hidden group">
                           <div class="absolute inset-0 bg-primary translate-y-full group-[.active]:translate-y-0 transition-transform duration-500"></div>
                           <span class="relative z-10"><?php echo $num; ?></span>
                        </div>
                        <span class="text-[9px] font-black uppercase tracking-[0.2em] hidden md:block text-slate-400 group-[.active]:text-black"><?php echo $step; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
                <!-- Progress Line -->
                <div class="absolute top-7 left-10 right-10 h-1 bg-slate-100 -z-0 rounded-full">
                    <div id="progress-bar" class="h-full bg-primary transition-all duration-700 rounded-full" style="width: 0%"></div>
                </div>
            </div>

            <!-- Form Wizard Wrapper -->
            <form id="membership-form" action="success.php" method="POST">
                <div class="bg-white rounded-[3rem] shadow-2xl shadow-slate-200/40 border border-slate-100 overflow-hidden relative">
                    <div id="form-steps-container" class="p-10 md:p-16 transition-all duration-500 min-h-[500px]">
                        
                        <!-- Step 1: Profile Information -->
                        <div class="step-content block space-y-10" data-step="1">
                            <div>
                                <h2 class="text-3xl font-black text-black mb-2 uppercase tracking-tight italic">Basic Profile</h2>
                                <p class="text-slate-400 text-sm font-medium">Primary identification details for individual or corporate applicants.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Name of Applicant (Individual)</label>
                                    <div class="grid grid-cols-2 gap-4">
                                        <input type="text" name="first_name" placeholder="First Name" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none font-bold text-sm">
                                        <input type="text" name="last_name" placeholder="Last Name" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none font-bold text-sm">
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Contact Person (Corporate)</label>
                                    <div class="grid grid-cols-2 gap-4">
                                        <input type="text" name="contact_first_name" placeholder="First Name" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none font-bold text-sm">
                                        <input type="text" name="contact_last_name" placeholder="Last Name" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none font-bold text-sm">
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Phone Number</label>
                                    <input type="tel" name="phone" placeholder="+254 700 000 000" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none font-bold text-sm">
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Email Address</label>
                                    <input type="email" name="email" placeholder="hello@organization.com" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none font-bold text-sm">
                                </div>
                                <div class="space-y-3 md:col-span-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Physical Address or Location</label>
                                    <input type="text" name="address" placeholder="Nairobi Hub, Suite 4B, Westlands" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none font-bold text-sm">
                                    <p class="text-[9px] font-black text-primary uppercase tracking-widest mt-2 ml-2 italic">Notice: We will be conducting member visits in 2026.</p>
                                </div>
                                <div class="space-y-3 md:col-span-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Website/URL</label>
                                    <input type="url" name="website" placeholder="https://www.yoursite.com" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-primary/10 focus:border-primary focus:bg-white transition-all outline-none font-bold text-sm">
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Membership Type -->
                        <div class="step-content hidden space-y-10" data-step="2">
                            <div>
                                <h2 class="text-3xl font-black text-black mb-2 uppercase tracking-tight italic">Category Selection</h2>
                                <p class="text-slate-400 text-sm font-medium">Select the type of membership best suited to you or your institution. Reg & Sub fees are paid together for the first year.</p>
                            </div>
                            
                            <div class="space-y-4">
                                <?php 
                                $categories = [
                                    "full-corporate" => ["Full Corporate", "5,000", "30,000", "Designed for RE manufacturers, EPC contractors, and financiers."],
                                    "full-individual" => ["Full Individual", "2,500", "7,500", "Ideal for engineers, consultants, and entrepreneurs."],
                                    "associate-corporate" => ["Associate Corporate", "1,500", "4,500", "For support businesses like banks, NGOs, and law firms."],
                                    "associate-individual" => ["Associate Individual", "500", "3,000", "For students, media, and general supporters."],
                                    "financial-institution" => ["Financial Institution", "5,000", "20,000", "For banks, SACCOs, and investment firms."],
                                    "partner-affiliate" => ["Partner Affiliate", "1,000", "10,000", "For development partners and academic institutions."],
                                    "student" => ["Student Membership", "500", "1,500", "For students interested in clean energy careers."]
                                ];
                                foreach($categories as $id => $info):
                                ?>
                                <label class="flex items-center gap-6 p-6 bg-slate-50 rounded-3xl border border-slate-100 cursor-pointer hover:bg-white hover:border-primary hover:shadow-xl transition-all group">
                                    <input type="radio" name="membership_tier" value="<?php echo $id; ?>" class="w-6 h-6 accent-primary shrink-0">
                                    <div class="flex-1">
                                        <div class="flex justify-between items-center mb-1">
                                            <h4 class="text-sm font-black text-black uppercase tracking-tight"><?php echo $info[0]; ?></h4>
                                            <span class="text-[10px] font-black text-primary bg-primary/10 px-3 py-1 rounded-full italic">KES <?php echo $info[2]; ?> / year</span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 font-medium"><?php echo $info[3]; ?> <span class="text-slate-300 ml-2">Registration: KES <?php echo $info[1]; ?></span></p>
                                    </div>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Step 3: Technical Focus -->
                        <div class="step-content hidden space-y-10" data-step="3">
                            <div>
                                <h2 class="text-3xl font-black text-black mb-2 uppercase tracking-tight italic">Technical Focus</h2>
                                <p class="text-slate-400 text-sm font-medium">Help us categorize your expertise and interest areas.</p>
                            </div>

                            <div class="space-y-10">
                                <div class="space-y-6">
                                    <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Nature of Activities (Select all that apply)</p>
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                        <?php 
                                        $activities = ["Businesses", "Research Organizations", "Students", "Development Partners", "Investors", "Learning Institutions", "Individuals", "Associations"];
                                        foreach($activities as $act):
                                        ?>
                                        <label class="flex items-center gap-4 p-5 bg-slate-50 rounded-2xl cursor-pointer hover:bg-white hover:border-primary border border-transparent transition-all">
                                            <input type="checkbox" name="activities[]" value="<?php echo $act; ?>" class="w-5 h-5 accent-primary">
                                            <span class="text-xs font-bold text-slate-700"><?php echo $act; ?></span>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="space-y-6">
                                    <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Technologies Portfolio</p>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                        <?php 
                                        $techs = ["Solar", "Wind", "Geothermal", "Hydro", "Biogas", "Green Hydrogen", "Biomass", "Energy Storage"];
                                        foreach($techs as $t):
                                        ?>
                                        <label class="flex flex-col gap-3 p-6 bg-slate-100 rounded-3xl cursor-pointer hover:bg-white hover:ring-2 hover:ring-primary transition-all items-center text-center group">
                                            <input type="checkbox" name="techs[]" value="<?php echo $t; ?>" class="w-5 h-5 accent-primary">
                                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-600 group-hover:text-black"><?php echo $t; ?></span>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="space-y-6">
                                    <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Working Groups Interest</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <?php 
                                        $groups = ["Solar Productive Use", "Advocacy & Policy", "Wind & Hydropower", "BioEnergy Hub", "Green Hydrogen Taskforce", "Consumer Protection"];
                                        foreach($groups as $g):
                                        ?>
                                        <label class="flex items-center gap-4 p-5 bg-slate-50 border border-slate-100 rounded-2xl cursor-pointer">
                                            <input type="checkbox" name="groups[]" value="<?php echo $g; ?>" class="w-5 h-5 accent-primary">
                                            <span class="text-xs font-bold text-slate-700 italic"><?php echo $g; ?></span>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Payment Details -->
                        <div class="step-content hidden space-y-10" data-step="4">
                            <div>
                                <h2 class="text-3xl font-black text-black mb-2 uppercase tracking-tight italic">Sub Fee Settlement</h2>
                                <p class="text-slate-400 text-sm font-medium">Select your preferred payment channel for subscription processing.</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-4">
                                    <?php 
                                    $payments = [
                                        ["cheque", "Cheque Payment", "Send by post to P.O. Box 42040 – 00100 GPO"],
                                        ["mpesa", "M-PESA Paybill", "Pay Bill ABSA bank 303030, A/C 0821340101"],
                                        ["rtgs", "RTGS / EFT", "ABSA bank account 0821340101"]
                                    ];
                                    foreach($payments as $p):
                                    ?>
                                    <label class="flex items-center gap-4 p-6 bg-slate-50 rounded-3xl border border-slate-100 cursor-pointer hover:bg-white hover:border-primary transition-all group">
                                        <input type="radio" name="payment_mode" value="<?php echo $p[0]; ?>" class="w-5 h-5 accent-primary">
                                        <div>
                                            <p class="text-xs font-black text-black uppercase tracking-tight"><?php echo $p[1]; ?></p>
                                            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest"><?php echo $p[2]; ?></p>
                                        </div>
                                    </label>
                                    <?php endforeach; ?>
                                </div>

                                <div class="bg-primary/5 p-10 rounded-[3rem] space-y-6 border border-primary/10">
                                    <div class="text-center">
                                         <i data-lucide="smartphone" class="w-10 h-10 text-primary mx-auto mb-4"></i>
                                         <p class="text-[10px] font-black uppercase tracking-widest text-primary italic">Verification Step</p>
                                    </div>
                                    <div class="space-y-4">
                                        <label class="text-[9px] font-black uppercase text-slate-500 tracking-widest block ml-2">Enter Payment Confirmation Message</label>
                                        <textarea name="payment_confirmation" placeholder="Paste your M-PESA message or Transaction Ref here..." class="w-full px-6 py-5 bg-white border border-slate-200 rounded-2xl focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all outline-none text-xs font-medium h-40"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 5: Member Needs Assessment -->
                        <div class="step-content hidden space-y-10" data-step="5">
                            <div>
                                <h2 class="text-3xl font-black text-black mb-2 uppercase tracking-tight italic">Needs Assessment 2025</h2>
                                <p class="text-slate-400 text-sm font-medium">To help us provide optimal value, please indicate your primary organizational needs.</p>
                            </div>

                            <div class="space-y-10">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                    <!-- Need Group 1 -->
                                    <div class="space-y-4">
                                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] mb-4">💰 Funding & Partnerships</p>
                                        <div class="space-y-2">
                                            <?php foreach(["Grants", "Loans", "Investment Partners"] as $n): ?>
                                            <label class="flex items-center gap-3 p-3 hover:bg-slate-50 rounded-xl cursor-pointer">
                                                <input type="checkbox" name="needs[]" value="<?php echo $n; ?>" class="w-4 h-4 accent-primary">
                                                <span class="text-xs font-bold text-slate-600"><?php echo $n; ?></span>
                                            </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <!-- Need Group 2 -->
                                    <div class="space-y-4">
                                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] mb-4">🚀 Capacity & Training</p>
                                        <div class="space-y-2">
                                            <?php foreach(["Training Programs", "Workshops", "Skills Development"] as $n): ?>
                                            <label class="flex items-center gap-3 p-3 hover:bg-slate-50 rounded-xl cursor-pointer">
                                                <input type="checkbox" name="needs[]" value="<?php echo $n; ?>" class="w-4 h-4 accent-primary">
                                                <span class="text-xs font-bold text-slate-600"><?php echo $n; ?></span>
                                            </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <!-- Need Group 3 -->
                                    <div class="space-y-4">
                                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] mb-4">🤝 Networking & B2B</p>
                                        <div class="space-y-2">
                                            <?php foreach(["B2B Linkages", "Industry Events", "Career Advancement"] as $n): ?>
                                            <label class="flex items-center gap-3 p-3 hover:bg-slate-50 rounded-xl cursor-pointer">
                                                <input type="checkbox" name="needs[]" value="<?php echo $n; ?>" class="w-4 h-4 accent-primary">
                                                <span class="text-xs font-bold text-slate-600"><?php echo $n; ?></span>
                                            </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <!-- Need Group 4 -->
                                    <div class="space-y-4">
                                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] mb-4">🧪 Technical & market</p>
                                        <div class="space-y-2">
                                            <?php foreach(["Consultancy Services", "Market Reports", "Policy Updates"] as $n): ?>
                                            <label class="flex items-center gap-3 p-3 hover:bg-slate-50 rounded-xl cursor-pointer">
                                                <input type="checkbox" name="needs[]" value="<?php echo $n; ?>" class="w-4 h-4 accent-primary">
                                                <span class="text-xs font-bold text-slate-600"><?php echo $n; ?></span>
                                            </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-6 border-t border-slate-100">
                                    <label class="text-[10px] font-black uppercase text-slate-500 tracking-widest block mb-4 ml-2">Additional details on your requirements</label>
                                    <textarea name="needs_details" placeholder="Tell us more about how KEREA can support your growth..." class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-[2rem] focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none text-xs font-medium h-32"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Step 6: Review -->
                        <div class="step-content hidden space-y-10" data-step="6">
                            <div>
                                <h2 class="text-3xl font-black text-black mb-2 uppercase tracking-tight italic">Review & Attest</h2>
                                <p class="text-slate-400 text-sm font-medium">Please verify your details before final hub submission.</p>
                            </div>
                            
                            <div class="bg-slate-900 rounded-[3rem] p-10 text-white space-y-8">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                    <div class="space-y-4">
                                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-500">Selected Tier</p>
                                        <p id="review-tier" class="text-xl font-black italic text-primary">Full Corporate</p>
                                    </div>
                                    <div class="space-y-4">
                                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-500">Settlement Code</p>
                                        <p id="review-payment" class="text-xl font-black italic">M-PESA / RTGS</p>
                                    </div>
                                </div>
                                <div class="pt-10 border-t border-white/10 flex items-start gap-6">
                                     <input type="checkbox" required class="mt-2 w-6 h-6 accent-primary shrink-0">
                                     <p class="text-xs font-medium text-slate-400 leading-relaxed italic">
                                        I hereby declare that the information provided is true and accurate to the best of my knowledge. I agree to abide by the KEREA Code of Conduct and Membership Bylaws. An official receipt will be issued once payment is verified.
                                     </p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Wizard Navigation -->
                    <div id="wizard-footer" class="p-10 bg-slate-50 border-t border-slate-100 flex justify-between items-center">
                        <button type="button" id="prev-btn" class="px-10 py-5 text-black font-black uppercase text-xs tracking-widest rounded-3xl hover:bg-slate-200 transition-all invisible">
                            Previous Step
                        </button>
                        <button type="button" id="next-btn" class="px-12 py-5 bg-primary text-black font-black uppercase text-xs tracking-[0.2em] rounded-3xl hover:bg-slate-950 hover:text-white hover:scale-105 active:scale-95 transition-all shadow-2xl shadow-primary/20">
                            Continue <i data-lucide="arrow-right" class="w-4 h-4 inline ml-2"></i>
                        </button>
                        <button type="submit" id="submit-btn" class="hidden px-12 py-5 bg-slate-950 text-white font-black uppercase text-xs tracking-[0.2em] rounded-3xl hover:bg-primary hover:text-black hover:scale-105 active:scale-95 transition-all shadow-2xl">
                            Submit to HUB <i data-lucide="check-circle" class="w-5 h-5 inline ml-2"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    let currentStep = 1;
    const totalSteps = 6;

    const nextBtn = document.getElementById('next-btn');
    const prevBtn = document.getElementById('prev-btn');
    const submitBtn = document.getElementById('submit-btn');
    const progressBar = document.getElementById('progress-bar');

    function updateWizard() {
        // Steps visibility
        document.querySelectorAll('.step-content').forEach(step => {
            step.classList.add('hidden');
            if (parseInt(step.dataset.step) === currentStep) step.classList.remove('hidden');
        });

        // Indicators
        document.querySelectorAll('.step-indicator').forEach(ind => {
            const stepNum = parseInt(ind.dataset.step);
            if (stepNum <= currentStep) {
                ind.classList.add('active');
            } else {
                ind.classList.remove('active');
            }
        });

        // Progress line
        const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
        progressBar.style.width = `${progress}%`;

        // Buttons
        prevBtn.classList.toggle('invisible', currentStep === 1);
        if (currentStep === totalSteps) {
            nextBtn.classList.add('hidden');
            submitBtn.classList.remove('hidden');
        } else {
            nextBtn.classList.remove('hidden');
            submitBtn.classList.add('hidden');
        }

        lucide.createIcons();
    }

    nextBtn.addEventListener('click', () => {
        if (currentStep < totalSteps) {
            currentStep++;
            updateWizard();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentStep > 1) {
            currentStep--;
            updateWizard();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });

    // Auto-select tier from URL
    const urlParams = new URLSearchParams(window.location.search);
    const tier = urlParams.get('tier');
    if (tier) {
        const radio = document.querySelector(`input[name="membership_tier"][value="${tier}"]`);
        if (radio) radio.checked = true;
    }

    updateWizard();
</script>

<?php include_once '../includes/footer.php'; ?>
