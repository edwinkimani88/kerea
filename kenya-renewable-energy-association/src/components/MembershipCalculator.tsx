import React, { useState } from 'react';
import { CreditCard, CircleDollarSign, CheckSquare, Sparkles, FileText, Send, CheckCircle } from 'lucide-react';
import { motion } from 'motion/react';
import { membershipCategoriesData } from '../data';
import { MembershipCategory } from '../types';

export default function MembershipCalculator() {
  const [selectedCatId, setSelectedCatId] = useState<string>('individual');
  const [isSubmitApplicationSuccess, setIsSubmitApplicationSuccess] = useState(false);
  const [currency, setCurrency] = useState<'KES' | 'USD'>('KES');
  const [applyForm, setApplyForm] = useState({
    companyName: '',
    contactPerson: '',
    emailAddress: '',
    phoneNumber: '',
    agreeLicense: false
  });

  const selectedCategory = membershipCategoriesData.find(c => c.id === selectedCatId) || membershipCategoriesData[0];

  const handleApplySubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (applyForm.companyName && applyForm.contactPerson && applyForm.emailAddress && applyForm.phoneNumber && applyForm.agreeLicense) {
      setIsSubmitApplicationSuccess(true);
      setTimeout(() => {
        setIsSubmitApplicationSuccess(false);
        setApplyForm({
          companyName: '',
          contactPerson: '',
          emailAddress: '',
          phoneNumber: '',
          agreeLicense: false
        });
      }, 4000);
    }
  };

  const exchangeRate = 130; // KES to USD approx
  
  const registrationFee = currency === 'KES' ? selectedCategory.registrationFeeKES : Math.round(selectedCategory.registrationFeeKES / exchangeRate);
  const annualFee = currency === 'KES' ? selectedCategory.annualFeeKES : selectedCategory.annualFeeUSD;
  const totalDue = registrationFee + annualFee;

  return (
    <section id="membership-section" className="py-24 bg-white relative">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* Section Header */}
        <div className="text-center max-w-2xl mx-auto mb-16">
          <div className="inline-flex items-center gap-1.5 text-emerald-600 font-extrabold text-xs tracking-widest uppercase mb-3">
            <CreditCard className="w-3.5 h-3.5 text-amber-500" />
            MEMBERSHIP PORTAL & DUES
          </div>
          <h2 className="text-3xl sm:text-4xl font-extrabold text-[#112a1d] tracking-tight leading-tight">
            Calculate Registration <span className="text-emerald-600">& Annual Dues</span>
          </h2>
          <p className="text-xs sm:text-sm text-gray-500 leading-relaxed mt-4">
            Select your membership category to instantly calculate annual dues, review certified benefits, and prepare required compliance documents for verification.
          </p>

          {/* Currency Switcher */}
          <div className="inline-flex items-center gap-2 mt-6 p-1 bg-slate-100 rounded-lg border border-slate-200">
            <button
              onClick={() => setCurrency('KES')}
              className={`px-3 py-1 rounded-md text-xs font-bold transition-all cursor-pointer ${currency === 'KES' ? 'bg-white text-emerald-700 shadow-sm' : 'text-gray-500 hover:text-emerald-950'}`}
            >
              KES (Shilling)
            </button>
            <button
              onClick={() => setCurrency('USD')}
              className={`px-3 py-1 rounded-md text-xs font-bold transition-all cursor-pointer ${currency === 'USD' ? 'bg-white text-emerald-700 shadow-sm' : 'text-gray-500 hover:text-emerald-950'}`}
            >
              USD (Dollars)
            </button>
          </div>
        </div>

        {/* Portals Split Layout: Interactive Calculator Card on the left, Request Form on the right */}
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-10 items-stretch">
          
          {/* Left Column: Calculator Card */}
          <motion.div 
            initial={{ opacity: 0, x: -40 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true, margin: "-100px" }}
            transition={{ duration: 0.6 }}
            className="lg:col-span-7 flex flex-col justify-between bg-slate-50 border border-slate-100 p-6 sm:p-8 rounded-2xl shadow-sm"
          >
            <div>
              <div className="flex justify-between items-center mb-6">
                <span className="text-xs font-heavy tracking-wider uppercase text-gray-400 font-bold">
                  CHOOSE REGISTRATION GRADES:
                </span>
                <span className="text-[10px] font-bold text-amber-600 bg-amber-50 border border-amber-100 px-2.5 py-1 rounded-full">
                  Tax Deductible
                </span>
              </div>

              {/* Selector Tabs for tiers */}
              <div className="grid grid-cols-3 gap-3.5 mb-8">
                {membershipCategoriesData.map((cat) => (
                  <button
                    key={cat.id}
                    onClick={() => setSelectedCatId(cat.id)}
                    className={`p-3.5 rounded-xl border flex flex-col items-center justify-center text-center transition-all cursor-pointer ${
                      selectedCatId === cat.id
                        ? 'border-emerald-600 bg-white shadow-md text-emerald-950 font-black'
                        : 'border-slate-200 bg-white/60 hover:bg-white text-gray-600'
                    }`}
                  >
                    <CircleDollarSign className={`w-5 h-5 mb-1.5 ${selectedCatId === cat.id ? 'text-emerald-600' : 'text-gray-400'}`} />
                    <span className="text-[11px] font-bold tracking-tight leading-none truncate w-full">
                      {cat.name.split(' ')[0]}
                    </span>
                    <span className="text-[9px] text-gray-400 mt-1 uppercase font-semibold">
                      {cat.id === 'individual' ? 'Practitioner' : 'Corporate'}
                    </span>
                  </button>
                ))}
              </div>

              {/* Display Calculated Fees */}
              <div className="bg-emerald-950 text-white rounded-2xl p-6 mb-8 relative overflow-hidden shadow-lg shadow-emerald-950/20">
                <div className="absolute top-0 right-0 transform translate-x-4 -translate-y-4 w-28 h-28 bg-emerald-500 opacity-5 rounded-full"></div>
                
                <h3 className="text-xs font-bold text-emerald-400 tracking-widest uppercase mb-4 mb-2 border-b border-emerald-900/40 pb-2">
                  ANNUAL FEES BREAKDOWN:
                </h3>

                <div className="space-y-3.5 text-xs">
                  <div className="flex justify-between">
                    <span className="text-emerald-200">Registration/Setup Fee (One-Time)</span>
                    <span className="font-mono text-emerald-50 font-bold">
                      {currency === 'KES' ? 'KES' : '$'} {registrationFee.toLocaleString()}
                    </span>
                  </div>
                  <div className="flex justify-between">
                    <span className="text-emerald-200">Annual Subscription (Renewable)</span>
                    <span className="font-mono text-emerald-50 font-bold">
                      {currency === 'KES' ? 'KES' : '$'} {annualFee.toLocaleString()}
                    </span>
                  </div>
                  
                  {/* Total line */}
                  <div className="h-px bg-emerald-900 my-2"></div>
                  
                  <div className="flex justify-between items-center text-sm">
                    <span className="font-black text-white">Estimated Total Payable</span>
                    <span className="font-mono text-amber-400 text-lg font-black bg-emerald-900/50 px-3 py-1.5 rounded-xl border border-emerald-900">
                      {currency === 'KES' ? 'KES' : '$'} {totalDue.toLocaleString()}
                    </span>
                  </div>
                </div>
              </div>

              {/* Benefits Section */}
              <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                {/* Benefits Bullet points */}
                <div>
                  <h4 className="text-xs font-black text-[#112a1d] uppercase tracking-wider mb-2.5 flex items-center gap-1">
                    <Sparkles className="w-3.5 h-3.5 text-amber-500 animate-spin" />
                    Tier Benefits Includes:
                  </h4>
                  <ul className="space-y-1.5">
                    {selectedCategory.benefits.map((benefit, i) => (
                      <li key={i} className="text-[11px] text-gray-500 flex items-start gap-1.5 leading-tight">
                        <CheckSquare className="w-3.5 h-3.5 text-emerald-600 shrink-0 mt-0.5" />
                        <span>{benefit}</span>
                      </li>
                    ))}
                  </ul>
                </div>

                {/* Compliance/Docs list */}
                <div>
                  <h4 className="text-xs font-black text-[#112a1d] uppercase tracking-wider mb-2.5 flex items-center gap-1">
                    <FileText className="w-3.5 h-3.5 text-emerald-600" />
                    Required Documents:
                  </h4>
                  <ul className="space-y-1.5">
                    {selectedCategory.requirements.map((req, i) => (
                      <li key={i} className="text-[11px] text-gray-400 flex items-start gap-1.5 leading-tight italic">
                        <span className="text-amber-500 font-bold">•</span>
                        <span>{req}</span>
                      </li>
                    ))}
                  </ul>
                </div>
              </div>

            </div>
          </motion.div>

          {/* Right Column: Mini Application Forms */}
          <motion.div 
            initial={{ opacity: 0, x: 40 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true, margin: "-100px" }}
            transition={{ duration: 0.6, delay: 0.1 }}
            className="lg:col-span-4 flex flex-col justify-between bg-[#112a1d] text-white p-6 sm:p-8 rounded-2xl shadow-xl relative"
          >
            {isSubmitApplicationSuccess ? (
              <div className="flex-1 flex flex-col items-center justify-center text-center py-12">
                <CheckCircle className="w-14 h-14 text-emerald-400 mb-4 animate-bounce" />
                <h3 className="text-lg font-black text-white">Application Dispatched!</h3>
                <p className="text-xs text-emerald-200/70 mt-3 leading-relaxed">
                  Congratulations! Your request for membership has been submitted to the KEREA Technical Certification Registrar. We will email instructions to upload your PIN and Incorporation Certs within 24 hours.
                </p>
              </div>
            ) : (
              <form onSubmit={handleApplySubmit} className="flex-1 flex flex-col justify-between">
                <div>
                  <span className="text-[10px] uppercase font-bold tracking-widest text-amber-400 block mb-1">
                    SUBMIT APPLICATION
                  </span>
                  <h3 className="text-base font-black tracking-tight text-white mb-1">
                    Start Your Affiliation
                  </h3>
                  <p className="text-[11px] text-emerald-200/60 leading-relaxed mb-6">
                    Enter your name and details. A technical registrar will contact you to review PIN certification requirements to complete your listing.
                  </p>

                  <div className="space-y-4">
                    {/* Organization Input */}
                    <div>
                      <label className="block text-[10px] font-bold uppercase tracking-wider text-emerald-300 mb-1">
                        {selectedCatId === 'individual' ? 'Professional / Student Name' : 'Company Name'}
                      </label>
                      <input
                        required
                        type="text"
                        placeholder={selectedCatId === 'individual' ? 'e.g. Kelvin Kimutai' : 'e.g. Solar Tech Solutions Ltd'}
                        value={applyForm.companyName}
                        onChange={(e) => setApplyForm({ ...applyForm, companyName: e.target.value })}
                        className="w-full bg-emerald-950 border border-emerald-900 focus:border-emerald-500 rounded-xl px-3.5 py-2 text-xs text-white placeholder-emerald-800 focus:outline-none"
                      />
                    </div>

                    {/* Contact Person Input */}
                    <div>
                      <label className="block text-[10px] font-bold uppercase tracking-wider text-emerald-300 mb-1">
                        Contact Person
                      </label>
                      <input
                        required
                        type="text"
                        placeholder="e.g. Lillian Omwamba"
                        value={applyForm.contactPerson}
                        onChange={(e) => setApplyForm({ ...applyForm, contactPerson: e.target.value })}
                        className="w-full bg-emerald-950 border border-emerald-900 focus:border-emerald-500 rounded-xl px-3.5 py-2 text-xs text-white placeholder-emerald-800 focus:outline-none"
                      />
                    </div>

                    {/* Email Input */}
                    <div>
                      <label className="block text-[10px] font-bold uppercase tracking-wider text-emerald-300 mb-1">
                        Official Email address
                      </label>
                      <input
                        required
                        type="email"
                        placeholder="e.g. corporate@company.com"
                        value={applyForm.emailAddress}
                        onChange={(e) => setApplyForm({ ...applyForm, emailAddress: e.target.value })}
                        className="w-full bg-emerald-950 border border-emerald-900 focus:border-emerald-500 rounded-xl px-3.5 py-2 text-xs text-white placeholder-emerald-800 focus:outline-none"
                      />
                    </div>

                    {/* Phone Input */}
                    <div>
                      <label className="block text-[10px] font-bold uppercase tracking-wider text-emerald-300 mb-1">
                        Mobile Phone Contact
                      </label>
                      <input
                        required
                        type="tel"
                        placeholder="e.g. +254 712 345678"
                        value={applyForm.phoneNumber}
                        onChange={(e) => setApplyForm({ ...applyForm, phoneNumber: e.target.value })}
                        className="w-full bg-emerald-950 border border-emerald-900 focus:border-emerald-500 rounded-xl px-3.5 py-2 text-xs text-white placeholder-emerald-800 focus:outline-none"
                      />
                    </div>

                    {/* Checkbox Agreement */}
                    <div className="flex items-start gap-2 pt-2.5">
                      <input
                        required
                        type="checkbox"
                        checked={applyForm.agreeLicense}
                        onChange={(e) => setApplyForm({ ...applyForm, agreeLicense: e.target.checked })}
                        className="mt-0.5 rounded border-emerald-900 text-emerald-600 bg-emerald-950 focus:ring-emerald-500 cursor-pointer"
                        id="agree"
                      />
                      <label htmlFor="agree" className="text-[10px] text-emerald-100/70 select-none cursor-pointer leading-relaxed">
                        I declare that our products & services will align with KEBS engineering codes and standard fair trade practices.
                      </label>
                    </div>
                  </div>
                </div>

                {/* Submit button layout */}
                <div className="pt-8">
                  <button
                    type="submit"
                    className="w-full inline-flex items-center justify-center gap-2 py-3 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold rounded-xl text-xs sm:text-sm hover:from-amber-600 hover:to-orange-600 active:scale-95 transition-all shadow-md shadow-orange-500/20 cursor-pointer"
                  >
                    <span>SUBMIT REGISTRY APPLICATION</span> <Send className="w-3.5 h-3.5" />
                  </button>
                </div>
              </form>
            )}
          </motion.div>

        </div>

      </div>
    </section>
  );
}
