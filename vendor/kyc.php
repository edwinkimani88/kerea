<?php
$active_page = "vendor_kyc";
$base_url = "../";
include_once '../includes/head.php';
?>
<title>KYC Verification | KEREA Vendor</title>

<?php include_once '../includes/header.php'; ?>

<main class="bg-slate-50 min-h-screen py-20">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            
            <div id="kyc-upload-section">
                <!-- Header -->
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-black text-black mb-4">Vendor Verification (KYC)</h1>
                    <p class="text-slate-500">To unlock marketplace publishing, please verify your business identity.</p>
                </div>

                <div class="bg-white rounded-4xl shadow-xl border border-slate-100 overflow-hidden">
                    <div class="p-8 md:p-12">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                            <div class="space-y-8">
                                <div class="space-y-4">
                                    <h3 class="text-lg font-black text-black uppercase tracking-tight">Compliance Checklist</h3>
                                    <p class="text-xs text-slate-500 leading-relaxed">KEREA ensures that all vendors are legitimate business entities to protect consumers in the renewable energy market.</p>
                                </div>
                                
                                <div class="space-y-4">
                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center shrink-0">
                                            <i data-lucide="check" class="w-5 h-5 text-primary"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-black">Business Registration</p>
                                            <p class="text-[10px] text-slate-400 uppercase tracking-widest">Certificate of Incorporation</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center shrink-0">
                                            <i data-lucide="check" class="w-5 h-5 text-primary"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-black">Tax Compliance</p>
                                            <p class="text-[10px] text-slate-400 uppercase tracking-widest">Current KRA Compliance Cert</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center shrink-0">
                                            <i data-lucide="check" class="w-5 h-5 text-primary"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-black">Director Identification</p>
                                            <p class="text-[10px] text-slate-400 uppercase tracking-widest">ID/Passport of Principal Director</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div class="p-8 border-2 border-dashed border-slate-200 rounded-3xl text-center hover:border-primary transition-colors cursor-pointer group">
                                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-primary/20 transition-colors">
                                        <i data-lucide="upload-cloud" class="w-8 h-8 text-slate-400 group-hover:text-black"></i>
                                    </div>
                                    <p class="text-sm font-black text-black uppercase tracking-tight">Drop files here</p>
                                    <p class="text-[10px] text-slate-400 uppercase tracking-widest mt-1">or click to browse from device</p>
                                    <p class="text-[9px] text-slate-400 mt-4 italic">Supports PDF, ZIP, JPG (Combined max 20MB)</p>
                                </div>

                                <button onclick="submitKYC()" class="w-full py-5 bg-black text-white font-black uppercase text-xs tracking-[0.2em] rounded-2xl hover:bg-primary hover:text-black transition-all shadow-xl shadow-black/10">
                                    Submit for Verification
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success / Pending Review State -->
            <div id="kyc-pending-section" class="hidden space-y-10 animate-in fade-in slide-in-from-bottom-10 duration-700">
                <div class="bg-white rounded-4xl p-12 shadow-xl border border-slate-100 text-center relative overflow-hidden">
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-1 bg-orange-400"></div>
                    <div class="w-24 h-24 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-8 animate-pulse text-orange-500">
                        <i data-lucide="clock" class="w-12 h-12"></i>
                    </div>
                    <h2 class="text-4xl font-black text-black mb-4">KYC Successfully Submitted</h2>
                    <p class="text-slate-500 max-w-lg mx-auto mb-10 leading-relaxed italic">
                        "Your KYC documents are currently under review. Once approved by an administrator, product management and marketplace publishing will become available."
                    </p>
                    
                    <div class="flex flex-wrap items-center justify-center gap-4">
                        <span class="px-6 py-2 bg-orange-50 text-orange-600 text-[10px] font-black uppercase tracking-[0.2em] rounded-full border border-orange-100 flex items-center gap-2">
                             Status: Pending Verification
                        </span>
                    </div>

                    <div class="mt-12 pt-12 border-t border-slate-50 max-w-2xl mx-auto">
                        <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-8">Verification Timeline</h4>
                        <div class="flex justify-between items-start">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center text-[10px] font-black">1</div>
                                <span class="text-[9px] font-black text-green-500 uppercase">Submitted</span>
                            </div>
                            <div class="h-0.5 w-full bg-slate-100 mt-4 relative overflow-hidden">
                                <div class="absolute inset-0 bg-primary w-1/2 animate-shimmer"></div>
                            </div>
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-orange-400 text-white flex items-center justify-center text-[10px] font-black">2</div>
                                <span class="text-[9px] font-black text-orange-400 uppercase">In Review</span>
                            </div>
                            <div class="h-0.5 w-full bg-slate-100 mt-4"></div>
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-200 text-slate-400 flex items-center justify-center text-[10px] font-black">3</div>
                                <span class="text-[9px] font-black text-slate-400 uppercase">Approved</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 flex justify-center gap-6">
                        <a href="dashboard.php?view=pending" class="px-10 py-5 bg-black text-white font-black uppercase text-xs tracking-widest rounded-2xl hover:bg-primary hover:text-black transition-all">
                            Go to Restricted Dashboard
                        </a>
                    </div>
                </div>
                
                <!-- Information Note -->
                <div class="bg-blue-50 p-8 rounded-4xl border border-blue-100 flex items-start gap-6">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-blue-500 shrink-0">
                        <i data-lucide="info" class="w-6 h-6"></i>
                    </div>
                    <div class="space-y-1">
                        <h4 class="font-black text-black uppercase tracking-tight text-sm text-blue-700">What happens next?</h4>
                        <p class="text-xs text-blue-800/70 leading-relaxed">Our compliance team will review your CR12 and KRA documents. We may contact you via your merchant email if additional information is required. Estimated review time: <strong class="text-blue-900">48-72 hours</strong>.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<style>
    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(200%); }
    }
    .animate-shimmer {
        animation: shimmer 2s infinite ease-in-out;
    }
</style>

<script>
    function submitKYC() {
        const upload = document.getElementById('kyc-upload-section');
        const pending = document.getElementById('kyc-pending-section');
        
        upload.classList.add('hidden');
        pending.classList.remove('hidden');
        lucide.createIcons();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    lucide.createIcons();
</script>

<?php include_once '../includes/footer.php'; ?>
