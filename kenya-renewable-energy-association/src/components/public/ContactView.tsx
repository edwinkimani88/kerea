import React, { useState } from 'react';
import { useAppState } from '../../context/AppStateContext';
import { Phone, Mail, MapPin, Clock, Send, CheckCircle, Users, HelpCircle } from 'lucide-react';

export default function ContactView() {
  const { logUserAction } = useAppState();
  const [formData, setFormData] = useState({ name: '', email: '', phone: '', subject: 'Membership', message: '' });
  const [isSent, setIsSent] = useState(false);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!formData.name || !formData.email || !formData.message) return;

    logUserAction('Contact Inquired', `Enquiry titled: "${formData.subject}" submitted by customer: ${formData.email}`);
    setIsSent(true);
    
    setTimeout(() => {
      setIsSent(false);
      setFormData({ name: '', email: '', phone: '', subject: 'Membership', message: '' });
    }, 2800);
  };

  return (
    <div className="space-y-12 pb-16">
      {/* Editorial Header */}
      <section className="text-center max-w-3xl mx-auto px-4 pt-4">
        <span className="text-emerald-600 font-extrabold text-xs tracking-widest uppercase mb-3 block">
          CENTRALIZED SECRETARIAT & PRESS ACCESS
        </span>
        <h1 className="text-3xl sm:text-4xl font-black text-[#112a1d] tracking-tight">
          Contact KEREA Secretariat
        </h1>
        <p className="text-xs sm:text-sm text-gray-500 mt-2">
          Need support with membership renewals, corporate standard approvals, or licensing preparation events? Get in touch with our administrative officers.
        </p>
      </section>

      {/* Two Column Layout: Info vs Form */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 max-w-5xl mx-auto">
        
        {/* Left Column: Office Details */}
        <div className="lg:col-span-5 space-y-8">
          <div className="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm space-y-6">
            <h3 className="text-base font-black text-[#112a1d]">The Head Office Secretariat</h3>

            <div className="space-y-4 text-xs sm:text-sm text-slate-500">
              <div className="flex gap-3 items-start">
                <MapPin className="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" />
                <div>
                  <h4 className="text-xs font-bold text-[#112a1d] uppercase">Secretariat Office coordinates</h4>
                  <p className="text-xs text-gray-400 mt-0.5">Suite 4B, Westlands Wood Avenue Plaza, Wood Avenue road, Westlands, Nairobi, Kenya.</p>
                </div>
              </div>

              <div className="flex gap-3 items-start">
                <Phone className="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" />
                <div>
                  <h4 className="text-xs font-bold text-[#112a1d] uppercase">Telephone Hotline</h4>
                  <p className="text-xs text-gray-400 mt-0.5">+254 (0) 20 2345678 / +254 711 998877</p>
                </div>
              </div>

              <div className="flex gap-3 items-start">
                <Mail className="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" />
                <div>
                  <h4 className="text-xs font-bold text-[#112a1d] uppercase">General Inquiries</h4>
                  <p className="text-xs text-gray-400 mt-0.5">info@kerea.org / membership@kerea.org</p>
                </div>
              </div>

              <div className="flex gap-3 items-start">
                <Clock className="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" />
                <div>
                  <h4 className="text-xs font-bold text-[#112a1d] uppercase">Office Working Hours</h4>
                  <p className="text-xs text-gray-400 mt-0.5">Monday to Friday: 8:00 AM to 5:00 PM (EAT). Closed during public holidays.</p>
                </div>
              </div>
            </div>
          </div>

          <div className="p-5 bg-slate-50 border border-slate-150 rounded-xl space-y-1">
            <h4 className="text-xs font-bold text-[#112a1d]">Technical Licensing Questions?</h4>
            <p className="text-[11px] text-slate-400 leading-relaxed font-sans">
              For rapid response regarding EPRA technical examination syllabi, please see our dedicated <span className="text-emerald-700 underline cursor-pointer">Compliance FAQ accordion</span> inside the Knowledge Hub module.
            </p>
          </div>
        </div>

        {/* Right Column: Interaction enquiry form */}
        <div className="lg:col-span-7 bg-white rounded-2xl border border-slate-100 p-6 sm:p-8 shadow-sm">
          {isSent ? (
            <div className="text-center py-16 space-y-4">
              <CheckCircle className="w-14 h-14 text-emerald-500 animate-bounce mx-auto" />
              <h3 className="text-base font-black text-[#112a1d]">Message Dispatched!</h3>
              <p className="text-xs text-gray-400 max-w-xs mx-auto">
                Thank you for contacting the secretariat. Your ticket reference has successfully logged into KEREAs reactive queues.
              </p>
            </div>
          ) : (
            <form onSubmit={handleSubmit} className="space-y-4">
              <h3 className="text-base font-black text-[#112a1d]">Submit Corporate Inquiry</h3>
              <p className="text-xs text-gray-500">Filings are answered within 2 working days by authorized program leads.</p>

              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label className="block text-[10px] font-bold text-gray-450 uppercase mb-1">Your Full Name</label>
                  <input 
                    type="text" 
                    required
                    value={formData.name}
                    onChange={e => setFormData({...formData, name: e.target.value})}
                    placeholder="e.g. Caleb Wafula" 
                    className="w-full text-xs p-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-60"
                  />
                </div>
                <div>
                  <label className="block text-[10px] font-bold text-gray-450 uppercase mb-1">Your Email Address</label>
                  <input 
                    type="email" 
                    required
                    value={formData.email}
                    onChange={e => setFormData({...formData, email: e.target.value})}
                    placeholder="e.g. contact@domain.co.ke" 
                    className="w-full text-xs p-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-60"
                  />
                </div>
              </div>

              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label className="block text-[10px] font-bold text-gray-450 uppercase mb-1">Phone Number (*Optional)</label>
                  <input 
                    type="tel" 
                    value={formData.phone}
                    onChange={e => setFormData({...formData, phone: e.target.value})}
                    placeholder="e.g. +254 711 000222" 
                    className="w-full text-xs p-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none"
                  />
                </div>
                <div>
                  <label className="block text-[10px] font-bold text-gray-450 uppercase mb-1">Inquiry Topic</label>
                  <select 
                    value={formData.subject}
                    onChange={e => setFormData({...formData, subject: e.target.value})}
                    className="w-full text-xs p-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-60 font-bold text-slate-700 bg-white"
                  >
                    <option value="Membership">Membership Tiers & Renewal</option>
                    <option value="EPRA Trainings">EPRA T1/T2/T3 Trainings</option>
                    <option value="Standards KEBS">Standard-setting & KEBS Compliance</option>
                    <option value="Escrow Shop">Marketplace & Escrow Payments</option>
                  </select>
                </div>
              </div>

              <div>
                <label className="block text-[10px] font-bold text-gray-450 uppercase mb-1">Enquiry Details</label>
                <textarea 
                  required
                  rows={4}
                  value={formData.message}
                  onChange={e => setFormData({...formData, message: e.target.value})}
                  placeholder="Clearly describe your advisory request, compliance questions, or licensing program application details..."
                  className="w-full text-xs p-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none"
                ></textarea>
              </div>

              <button
                type="submit"
                className="w-full py-3 bg-[#112a1d] hover:bg-emerald-700 text-white font-bold text-xs rounded-xl transition-all cursor-pointer shadow-md inline-flex items-center justify-center gap-2 select-none"
              >
                <Send className="w-3.5 h-3.5" /> Dispatch Inquiry File
              </button>
            </form>
          )}
        </div>
      </section>

    </div>
  );
}
