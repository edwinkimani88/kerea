<?php
$active_page = "membership";
$base_url = "../";
include_once '../includes/head.php';
?>
<title>Register | KEREA Membership</title>

<?php include_once '../includes/header.php'; ?>

<main class="bg-slate-50 min-h-screen py-20">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-black text-black mb-4">Membership Application</h1>
                <p class="text-slate-500">Complete the steps below to join the KEREA network.</p>
            </div>

            <!-- Progress Indicator -->
            <div class="mb-12 relative">
                <div class="flex justify-between relative z-10">
                    <?php 
                    $steps = ["Personal", "Organization", "Business", "Documents", "Review"];
                    foreach($steps as $i => $step): 
                        $num = $i + 1;
                    ?>
                    <div class="step-indicator flex flex-col items-center gap-3 transition-all duration-500" data-step="<?php echo $num; ?>">
                        <div class="step-circle w-12 h-12 rounded-2xl flex items-center justify-center font-black transition-all duration-500 bg-white text-slate-400 border-2 border-slate-200">
                            <?php echo $num; ?>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-widest hidden md:block"><?php echo $step; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
                <!-- Progress Line -->
                <div class="absolute top-6 left-0 w-full h-[2px] bg-slate-200 -z-0"></div>
                <div id="progress-bar" class="absolute top-6 left-0 h-[2px] bg-primary transition-all duration-700 -z-0" style="width: 0%"></div>
            </div>

            <!-- Form Wizard -->
            <div class="bg-white rounded-4xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden relative">
                <div id="form-steps-container" class="p-8 md:p-12 transition-all duration-500">
                    
                    <!-- Step 1: Personal Information -->
                    <div class="step-content block" data-step="1">
                        <div class="mb-8">
                            <h2 class="text-2xl font-black text-black mb-2">Personal Information</h2>
                            <p class="text-slate-400 text-sm">Tell us about the primary contact person.</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-500">Full Name</label>
                                <input type="text" placeholder="John Doe" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-primary focus:bg-white transition-all outline-none">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-500">Email Address</label>
                                <input type="email" placeholder="john@example.com" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-primary focus:bg-white transition-all outline-none">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-500">Phone Number</label>
                                <input type="tel" placeholder="+254 700 000 000" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-primary focus:bg-white transition-all outline-none">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-500">Position / Job Title</label>
                                <input type="text" placeholder="Managing Director" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-primary focus:bg-white transition-all outline-none">
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Organization Details -->
                    <div class="step-content hidden" data-step="2">
                        <div class="mb-8">
                            <h2 class="text-2xl font-black text-black mb-2">Organization Details</h2>
                            <p class="text-slate-400 text-sm">Details about your company or entity.</p>
                        </div>
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-500">Organization Name</label>
                                <input type="text" placeholder="Energy Solutions Ltd" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-primary focus:bg-white transition-all outline-none">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500">Organization Type</label>
                                    <select class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-primary focus:bg-white transition-all outline-none appearance-none">
                                        <option>Private Limited Company</option>
                                        <option>NGO / Foundation</option>
                                        <option>Academic Institution</option>
                                        <option>Government Agency</option>
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-500">Year of Registration</label>
                                    <input type="number" placeholder="2020" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-primary focus:bg-white transition-all outline-none">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-500">Physical Address</label>
                                <textarea placeholder="Building, Street, City" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-primary focus:bg-white transition-all outline-none h-32"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Business Information -->
                    <div class="step-content hidden" data-step="3">
                        <div class="mb-8">
                            <h2 class="text-2xl font-black text-black mb-2">Business Information</h2>
                            <p class="text-slate-400 text-sm">Focus areas and technical expertise.</p>
                        </div>
                        <div class="space-y-6">
                            <div class="space-y-4">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-500">Energy Sub-Sectors (Select all that apply)</label>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                    <?php 
                                    $sectors = ["Solar PV", "Wind", "Geothermal", "Hydropower", "Biomass", "Energy Storage", "E-Mobility", "Green Hydrogen"];
                                    foreach($sectors as $sec):
                                    ?>
                                    <label class="flex items-center gap-3 p-4 bg-slate-50 rounded-2xl cursor-pointer hover:bg-slate-100 transition-colors">
                                        <input type="checkbox" class="w-5 h-5 accent-primary">
                                        <span class="text-xs font-bold text-slate-700"><?php echo $sec; ?></span>
                                    </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-500">Number of Employees</label>
                                <input type="number" placeholder="15" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-primary focus:bg-white transition-all outline-none">
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Required Documents -->
                    <div class="step-content hidden" data-step="4">
                        <div class="mb-8">
                            <h2 class="text-2xl font-black text-black mb-2">Required Documents</h2>
                            <p class="text-slate-400 text-sm">Upload verifiable legal documents.</p>
                        </div>
                        <div class="space-y-4">
                            <?php 
                            $docs = ["Certificate of Incorporation", "KRA PIN Certificate", "Tax Compliance Certificate", "CR12 Form"];
                            foreach($docs as $doc):
                            ?>
                            <div class="flex items-center justify-between p-6 bg-slate-50 border border-dashed border-slate-300 rounded-3xl">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center">
                                        <i data-lucide="file-text" class="w-6 h-6 text-slate-400"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-black"><?php echo $doc; ?></p>
                                        <p class="text-[10px] text-slate-400 uppercase tracking-widest">PDF, JPG (Max 5MB)</p>
                                    </div>
                                </div>
                                <button class="px-5 py-2.5 bg-white border border-slate-200 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-primary transition-all">Upload</button>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Step 5: Review & Submit -->
                    <div class="step-content hidden" data-step="5">
                        <div class="mb-8">
                            <h2 class="text-2xl font-black text-black mb-2">Review & Submit</h2>
                            <p class="text-slate-400 text-sm">Please verify your details before final submission.</p>
                        </div>
                        
                        <div class="space-y-6">
                            <div class="p-6 bg-slate-50 rounded-3xl space-y-4">
                                <div class="flex justify-between border-b border-slate-200 pb-4">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Application Tier</span>
                                    <span class="text-sm font-black text-black">Corporate Member</span>
                                </div>
                                <div class="flex justify-between border-b border-slate-200 pb-4">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Contact Person</span>
                                    <span class="text-sm font-black text-black" id="review-name">John Doe</span>
                                </div>
                                <div class="flex justify-between border-b border-slate-200 pb-4">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Organization</span>
                                    <span class="text-sm font-black text-black" id="review-org">Energy Solutions Ltd</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 p-6 bg-primary/10 rounded-3xl border border-primary/20">
                                <input type="checkbox" class="mt-1 w-5 h-5 accent-primary">
                                <p class="text-xs text-slate-700 leading-relaxed font-medium">
                                    I hereby declare that the information provided is true and accurate to the best of my knowledge. I agree to abide by the KEREA Code of Conduct and Membership Bylaws.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Final Success Screen (Hidden by default) -->
                    <div id="success-screen" class="hidden py-20 text-center animate-in fade-in zoom-in duration-700">
                        <div class="w-24 h-24 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-8 shadow-2xl shadow-green-500/30">
                            <i data-lucide="check" class="w-12 h-12 text-white"></i>
                        </div>
                        <h2 class="text-4xl font-black text-black mb-4">Application Submitted!</h2>
                        <p class="text-slate-500 mb-10 max-w-md mx-auto">Membership Application Successfully Submitted. Our team will review your documents and get back to you within 5-10 business days.</p>
                        <a href="dashboard/status.php" class="inline-flex items-center gap-3 px-8 py-4 bg-black text-white font-black uppercase text-xs tracking-widest rounded-2xl hover:bg-primary hover:text-black transition-all">
                            View Application Status <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>

                </div>

                <!-- Footer Navigation -->
                <div id="wizard-footer" class="p-8 bg-slate-50 border-t border-slate-100 flex justify-between items-center">
                    <button id="prev-btn" class="px-8 py-4 text-black font-black uppercase text-xs tracking-widest rounded-2xl hover:bg-slate-200 transition-all invisible">
                        Previous
                    </button>
                    <button id="next-btn" class="px-10 py-4 bg-primary text-black font-black uppercase text-xs tracking-widest rounded-2xl hover:bg-black hover:text-white transition-all shadow-xl shadow-primary/20">
                        Continue
                    </button>
                    <button id="submit-btn" class="hidden px-10 py-4 bg-black text-white font-black uppercase text-xs tracking-widest rounded-2xl hover:bg-primary hover:text-black transition-all">
                        Submit Application
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    let currentStep = 1;
    const totalSteps = 5;

    const nextBtn = document.getElementById('next-btn');
    const prevBtn = document.getElementById('prev-btn');
    const submitBtn = document.getElementById('submit-btn');
    const footer = document.getElementById('wizard-footer');
    const container = document.getElementById('form-steps-container');
    const successScreen = document.getElementById('success-screen');
    const progressBar = document.getElementById('progress-bar');

    function updateWizard() {
        // Update Steps visibility
        document.querySelectorAll('.step-content').forEach(step => {
            step.classList.add('hidden');
            if (step.dataset.step == currentStep) step.classList.remove('hidden');
        });

        // Update indicators
        document.querySelectorAll('.step-indicator').forEach(ind => {
            const stepNum = parseInt(ind.dataset.step);
            const circle = ind.querySelector('.step-circle');
            
            if (stepNum < currentStep) {
                circle.classList.add('bg-green-500', 'text-white', 'border-green-500');
                circle.classList.remove('bg-white', 'text-slate-400', 'border-slate-200', 'bg-primary', 'text-black', 'border-primary');
                circle.innerHTML = '<i data-lucide="check" class="w-6 h-6"></i>';
            } else if (stepNum === currentStep) {
                circle.classList.add('bg-primary', 'text-black', 'border-primary');
                circle.classList.remove('bg-white', 'text-slate-400', 'border-slate-200', 'bg-green-500', 'text-white', 'border-green-500');
                circle.innerHTML = stepNum;
            } else {
                circle.classList.add('bg-white', 'text-slate-400', 'border-slate-200');
                circle.classList.remove('bg-primary', 'text-black', 'border-primary', 'bg-green-500', 'text-white', 'border-green-500');
                circle.innerHTML = stepNum;
            }
        });
        
        lucide.createIcons();

        // Update progress bar
        const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
        progressBar.style.width = `${progress}%`;

        // Update Buttons
        prevBtn.classList.toggle('invisible', currentStep === 1);
        
        if (currentStep === totalSteps) {
            nextBtn.classList.add('hidden');
            submitBtn.classList.remove('hidden');
        } else {
            nextBtn.classList.remove('hidden');
            submitBtn.classList.add('hidden');
        }
    }

    nextBtn.addEventListener('click', () => {
        if (currentStep < totalSteps) {
            currentStep++;
            updateWizard();
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentStep > 1) {
            currentStep--;
            updateWizard();
        }
    });

    submitBtn.addEventListener('click', () => {
        // Mock Submission
        container.querySelectorAll('.step-content').forEach(s => s.classList.add('hidden'));
        successScreen.classList.remove('hidden');
        footer.classList.add('hidden');
        
        // Final Progress Bar complete
        progressBar.style.width = '100%';
        
        // Update final circle to success
        const lastCircle = document.querySelector('.step-indicator[data-step="5"] .step-circle');
        lastCircle.classList.add('bg-green-500', 'text-white', 'border-green-500');
        lastCircle.innerHTML = '<i data-lucide="check" class="w-6 h-6"></i>';
        lucide.createIcons();
    });

    // Initial state
    updateWizard();
</script>

<?php include_once '../includes/footer.php'; ?>
