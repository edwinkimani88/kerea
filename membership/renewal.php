<?php
$active_page = "membership";
$base_url = "../";
include_once '../includes/head.php';
?>
<title>KEREA Renewal Form | Renew Your Membership</title>

<?php include_once '../includes/header.php'; ?>

<main class="bg-slate-50 min-h-screen py-20">
    <div class="container mx-auto px-6">
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 bg-primary/10 text-primary text-[10px] font-black uppercase tracking-[0.2em] rounded-full mb-6 italic">Member Services</span>
                <h1 class="text-4xl md:text-6xl font-black text-black mb-6">KEREA Registration <span class="italic text-primary">Renewal Form</span></h1>
                <p class="text-slate-500 max-w-2xl mx-auto">To renew your membership, kindly fill the form below. We greatly appreciate your continued support and commitment to the renewable energy sector.</p>
            </div>

            <!-- Progress Indicator -->
            <div class="mb-16 relative px-10">
                <div class="flex justify-between relative z-10">
                    <?php 
                    $steps = ["Profile", "Renewal Tier", "Technical", "Payment", "Needs", "Confirm"];
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
                <div class="absolute top-7 left-10 right-10 h-1 bg-slate-100 -z-0 rounded-full">
                    <div id="progress-bar" class="h-full bg-primary transition-all duration-700 rounded-full" style="width: 0%"></div>
                </div>
            </div>

            <form id="renewal-form" action="renewal-success.php" method="POST">
                <div class="bg-white rounded-[3rem] shadow-2xl shadow-slate-200/40 border border-slate-100 overflow-hidden relative">
                    <div id="form-steps-container" class="p-10 md:p-16 transition-all duration-500 min-h-[500px]">
                        
                        <!-- Step 1: Member Profile -->
                        <div class="step-content block space-y-10" data-step="1">
                            <div>
                                <h2 class="text-3xl font-black text-black mb-2 uppercase tracking-tight italic">Member Information</h2>
                                <p class="text-slate-400 text-sm font-medium">Please update your contact details if anything has changed since your last renewal.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Name of Applicant (Individual)</label>
                                    <div class="grid grid-cols-2 gap-4">
                                        <input type="text" name="first_name" placeholder="First Name" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none font-bold text-sm">
                                        <input type="text" name="last_name" placeholder="Last Name" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none font-bold text-sm">
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Contact Person (Corporate)</label>
                                    <div class="grid grid-cols-2 gap-4">
                                        <input type="text" name="contact_first_name" placeholder="First Name" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none font-bold text-sm">
                                        <input type="text" name="contact_last_name" placeholder="Last Name" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none font-bold text-sm">
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Phone</label>
                                    <input type="tel" name="phone" placeholder="+254 700 000 000" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none font-bold text-sm">
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Email</label>
                                    <input type="email" name="email" placeholder="member@hub.org" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none font-bold text-sm">
                                </div>
                                <div class="space-y-3 md:col-span-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Physical Address or Location</label>
                                    <input type="text" name="address" placeholder="Current HQ Location" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none font-bold text-sm">
                                </div>
                                <div class="space-y-3 md:col-span-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Website/URL</label>
                                    <input type="url" name="website" placeholder="https://www.company.co.ke" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none font-bold text-sm">
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Renewal Tier -->
                        <div class="step-content hidden space-y-10" data-step="2">
                            <div>
                                <h2 class="text-3xl font-black text-black mb-2 uppercase tracking-tight italic">Category Renewal</h2>
                                <p class="text-slate-400 text-sm font-medium">Select your current membership category for yearly subscription renewal.</p>
                            </div>
                            
                            <div class="space-y-4">
                                <?php 
                                $categories = [
                                    "full-corporate" => ["Full Corporate", "30,000 Ksh"],
                                    "full-individual" => ["Full Individual", "7,500 Ksh"],
                                    "associate-corporate" => ["Associate Corporate", "4,500 Ksh"],
                                    "associate-individual" => ["Associate Individual", "1,500 Ksh"],
                                    "financial-institution" => ["Financial Institution", "20,000 Ksh", "Registration: 5,000 Ksh"],
                                    "partner-affiliate" => ["Partner Affiliate", "10,000 Ksh", "Registration: 1,000 Ksh"],
                                    "student" => ["Student Membership", "1,500 Ksh", "Registration: 500 Ksh"]
                                ];
                                foreach($categories as $id => $info):
                                ?>
                                <label class="flex items-center gap-6 p-6 bg-slate-50 rounded-3xl border border-slate-100 cursor-pointer hover:bg-white hover:border-primary hover:shadow-xl transition-all group">
                                    <input type="radio" name="membership_tier" value="<?php echo $id; ?>" class="w-6 h-6 accent-primary shrink-0">
                                    <div class="flex-1">
                                        <div class="flex justify-between items-center">
                                            <h4 class="text-sm font-black text-black uppercase tracking-tight"><?php echo $info[0]; ?></h4>
                                            <span class="text-[10px] font-black text-primary italic">ANNUAL: <?php echo $info[1]; ?></span>
                                        </div>
                                        <?php if(isset($info[2])): ?>
                                        <p class="text-[9px] text-slate-400 font-bold uppercase mt-1"><?php echo $info[2]; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Step 3: Technical Progress -->
                        <div class="step-content hidden space-y-10" data-step="3">
                            <div>
                                <h2 class="text-3xl font-black text-black mb-2 uppercase tracking-tight italic">Technical Updates</h2>
                                <p class="text-slate-400 text-sm font-medium">Update your involvement in technologies and working groups.</p>
                            </div>
                            <!-- Reusing the technical selection blocks from register but adapted for renewal -->
                            <div class="space-y-10">
                                <div class="space-y-6">
                                    <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Renewable Energy Activities</p>
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                        <?php 
                                        $activities = ["Businesses", "Research Organizations", "Students", "Development Partners", "Investors", "Learning Institutions", "Individuals", "Associations"];
                                        foreach($activities as $act):
                                        ?>
                                        <label class="flex items-center gap-4 p-5 bg-slate-50 rounded-2xl cursor-pointer">
                                            <input type="checkbox" name="activities[]" value="<?php echo $act; ?>" class="w-4 h-4 accent-primary">
                                            <span class="text-xs font-bold text-slate-700"><?php echo $act; ?></span>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="space-y-6">
                                    <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Technology Technologies</p>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                        <?php 
                                        $techs = ["Solar", "Wind", "Geothermal", "Hydro", "Biogas", "Green Hydrogen", "Biomass", "Energy Storage"];
                                        foreach($techs as $t):
                                        ?>
                                        <label class="flex flex-col gap-3 p-6 bg-slate-100 rounded-2xl cursor-pointer hover:bg-white hover:ring-1 hover:ring-primary transition-all items-center">
                                            <input type="checkbox" name="techs[]" value="<?php echo $t; ?>" class="w-4 h-4 accent-primary">
                                            <span class="text-[10px] font-black uppercase text-slate-600"><?php echo $t; ?></span>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Payment Confirmation -->
                        <div class="step-content hidden space-y-10" data-step="4">
                            <div>
                                <h2 class="text-3xl font-black text-black mb-2 uppercase tracking-tight italic">Renewal Settlement</h2>
                                <p class="text-slate-400 text-sm font-medium">Verify your payment for renewal certificate issuance.</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-4">
                                    <?php 
                                    $payments = [
                                        ["cheque", "Cheque Transfer"],
                                        ["mpesa", "M-PESA (ABSA 303030 / 0821340101)"],
                                        ["collection", "Cheque Collection from Org"],
                                        ["rtgs", "RTGS / EFT Transfer"]
                                    ];
                                    foreach($payments as $p):
                                    ?>
                                    <label class="flex items-center gap-4 p-6 bg-slate-50 rounded-3xl border border-slate-100 cursor-pointer hover:bg-white hover:border-primary transition-all">
                                        <input type="radio" name="payment_mode" value="<?php echo $p[0]; ?>" class="w-5 h-5 accent-primary">
                                        <span class="text-xs font-black text-black uppercase tracking-tight"><?php echo $p[1]; ?></span>
                                    </label>
                                    <?php endforeach; ?>
                                </div>
                                <div class="space-y-4">
                                    <label class="text-[10px] font-black uppercase text-slate-500 tracking-widest block ml-2">Payment Confirmation Message</label>
                                    <textarea name="payment_confirmation" placeholder="Paste your renewal payment confirmation here..." class="w-full px-6 py-5 bg-white border border-slate-200 rounded-3xl focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none text-xs font-medium h-48"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Step 5: Service Needs -->
                        <div class="step-content hidden space-y-10" data-step="5">
                           <!-- Similar to register but for 2025 planning -->
                           <div>
                                <h2 class="text-3xl font-black text-black mb-2 uppercase tracking-tight italic">2025 Member Needs</h2>
                                <p class="text-slate-400 text-sm font-medium">Help us understand how to provide more value to you in 2025.</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                <?php 
                                $needCats = [
                                    "Funding" => ["Grants", "Loans", "Investment Partners"],
                                    "Capacity" => ["Training programs", "Workshops", "Skills development"],
                                    "Networking" => ["B2B linkages", "Partnerships", "Industry events", "Career Advancement"],
                                    "Technical" => ["Access to expertise", "Consultancy services", "R&D assistance"],
                                    "Market" => ["Market reports", "Tech trends", "Policy updates"]
                                ];
                                foreach($needCats as $cat => $options):
                                ?>
                                <div class="space-y-4">
                                    <p class="text-[10px] font-black uppercase text-primary tracking-widest"><?php echo $cat; ?></p>
                                    <div class="space-y-2">
                                        <?php foreach($options as $opt): ?>
                                        <label class="flex items-center gap-3 p-3 hover:bg-slate-50 rounded-xl cursor-pointer">
                                            <input type="checkbox" name="needs[]" value="<?php echo $opt; ?>" class="w-4 h-4 accent-primary">
                                            <span class="text-xs font-bold text-slate-600"><?php echo $opt; ?></span>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Step 6: Confirmation -->
                        <div class="step-content hidden space-y-10" data-step="6">
                            <div>
                                <h2 class="text-3xl font-black text-black mb-2 uppercase tracking-tight italic">We Value Your Membership</h2>
                                <p class="text-slate-400 text-sm font-medium">Your continued association drives Kenya's green transition.</p>
                            </div>
                            <div class="bg-primary/5 rounded-[3rem] p-12 text-center space-y-8 border border-primary/10">
                                <i data-lucide="award" class="w-16 h-16 text-primary mx-auto"></i>
                                <h3 class="text-2xl font-black uppercase italic">Renew for another year of impact</h3>
                                <p class="text-slate-500 text-xs italic font-medium">An official renewal receipt will be issued once your payment is verified and a membership renewal certificate provided to you.</p>
                                <div class="flex items-center justify-center gap-4 pt-6">
                                     <input type="checkbox" required class="w-6 h-6 accent-primary shrink-0">
                                     <p class="text-[10px] font-black uppercase text-slate-900 tracking-widest text-left">Confirm renewal and attest to current member bylaws</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Wizard Navigation -->
                    <div id="wizard-footer" class="p-10 bg-slate-50 border-t border-slate-100 flex justify-between items-center">
                        <button type="button" id="prev-btn" class="px-10 py-5 text-black font-black uppercase text-xs tracking-widest rounded-3xl hover:bg-slate-200 transition-all invisible">
                            Previous Step
                        </button>
                        <button type="button" id="next-btn" class="px-12 py-5 bg-primary text-black font-black uppercase text-xs tracking-[0.2em] rounded-3xl hover:bg-slate-950 hover:text-white hover:scale-105 active:scale-95 transition-all shadow-2xl">
                            Continue <i data-lucide="arrow-right" class="w-4 h-4 inline ml-2"></i>
                        </button>
                        <button type="submit" id="submit-btn" class="hidden px-12 py-5 bg-slate-950 text-white font-black uppercase text-xs tracking-[0.2em] rounded-3xl hover:bg-primary hover:text-black hover:scale-105 active:scale-95 transition-all shadow-2xl">
                            Renew Membership <i data-lucide="refresh-cw" class="w-5 h-5 inline ml-2"></i>
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
        document.querySelectorAll('.step-content').forEach(step => {
            step.classList.add('hidden');
            if (parseInt(step.dataset.step) === currentStep) step.classList.remove('hidden');
        });

        document.querySelectorAll('.step-indicator').forEach(ind => {
            if (parseInt(ind.dataset.step) <= currentStep) {
                ind.classList.add('active');
            } else {
                ind.classList.remove('active');
            }
        });

        progressBar.style.width = `${((currentStep - 1) / (totalSteps - 1)) * 100}%`;

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

    updateWizard();
</script>

<?php include_once '../includes/footer.php'; ?>
