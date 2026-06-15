import React, { useState } from 'react';
import { useAppState } from '../../context/AppStateContext';
import { ShieldCheck, Mail, Lock, User, PlusCircle, ArrowRight, UserCheck, ShieldAlert, Sparkles, AlertCircle } from 'lucide-react';
import { motion } from 'motion/react';

export default function AuthView() {
  const { loginAsUser, registerUser, currentUser, logoutCurrentUser } = useAppState();

  const [activeTab, setActiveTab] = useState<'login' | 'register'>('login');
  const [selectedRole, setSelectedRole] = useState<'administrator' | 'vendor' | 'customer'>('administrator');
  const [emailInput, setEmailInput] = useState('caleb@kerea.org'); // Prefilled with Admin for fast preview
  const [passwordInput, setPasswordInput] = useState('password123'); // Standard dummy
  const [errorMessage, setErrorMessage] = useState('');

  // Register state
  const [regName, setRegName] = useState('');
  const [regEmail, setRegEmail] = useState('');
  const [regRole, setRegRole] = useState<'vendor' | 'customer'>('customer');
  const [regCompany, setRegCompany] = useState('');
  const [regPhone, setRegPhone] = useState('');

  // Handle auto prefill coordinates for easy testing
  const handleRolePrefill = (role: 'administrator' | 'vendor' | 'customer') => {
    setSelectedRole(role);
    if (role === 'administrator') {
      setEmailInput('caleb@kerea.org');
    } else if (role === 'vendor') {
      setEmailInput('sales@safisolar.co.ke');
    } else {
      setEmailInput('george@gmail.com');
    }
    setErrorMessage('');
  };

  const handleLoginSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setErrorMessage('');
    
    if (!emailInput) {
      setErrorMessage('Please provide a legitimate login identifier email.');
      return;
    }

    const matched = loginAsUser(emailInput, selectedRole);
    if (!matched) {
      setErrorMessage(`Credentials lookup failed. Account does not match a verified ${selectedRole}. Please select the prefilled indicators below for quick navigation testing.`);
    }
  };

  const handleRegisterSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setErrorMessage('');

    if (!regName || !regEmail) {
      setErrorMessage('Please complete all mandatory field parameters.');
      return;
    }

    const regged = registerUser(regName, regEmail, regRole, regCompany, regPhone);
    if (regged) {
      alert(`Account registration initiated! Account role: [${regRole}]. Signed in automatically.`);
    }
  };

  return (
    <div className="max-w-md mx-auto py-12 px-4 shadow-none">
      
      {/* Visual Header */}
      <div className="text-center space-y-2 mb-8">
        <div className="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center mx-auto shadow-sm">
          <ShieldCheck className="w-6 h-6 animate-pulse" />
        </div>
        <h2 className="text-2xl font-black text-[#112a1d] tracking-tight">KEREA Security Sign In</h2>
        <p className="text-xs text-gray-450 leading-relaxed">
          Access your administrative CMS, vendor inventory pipelines, or coordinate custom e-commerce escrow tickets.
        </p>
      </div>

      {/* Tabs list: Login vs Register */}
      <div className="flex border-b border-slate-200 mb-6 font-bold text-xs uppercase tracking-wider">
        <button
          onClick={() => {
            setActiveTab('login');
            setErrorMessage('');
          }}
          className={`flex-1 py-2.5 text-center cursor-pointer border-b-2 transition-colors ${
            activeTab === 'login' ? 'border-emerald-600 text-emerald-700' : 'border-transparent text-gray-400 hover:text-emerald-600'
          }`}
        >
          Access Portal
        </button>
        <button
          onClick={() => {
            setActiveTab('register');
            setErrorMessage('');
          }}
          className={`flex-1 py-2.5 text-center cursor-pointer border-b-2 transition-colors ${
            activeTab === 'register' ? 'border-emerald-600 text-emerald-700' : 'border-transparent text-gray-400 hover:text-emerald-600'
          }`}
        >
          Create Profile
        </button>
      </div>

      {/* Rendering Forms */}
      {activeTab === 'login' ? (
        <div className="space-y-6">
          {/* Quick Role Selection Radios */}
          <div className="grid grid-cols-3 gap-2 p-1.5 bg-slate-100/60 rounded-xl">
            {(['administrator', 'vendor', 'customer'] as const).map(role => (
              <button
                key={role}
                type="button"
                onClick={() => handleRolePrefill(role)}
                className={`py-2 text-[10px] font-black tracking-wide uppercase text-center rounded-lg cursor-pointer transition-all ${
                  selectedRole === role 
                    ? 'bg-[#112a1d] text-white shadow-sm' 
                    : 'text-gray-400 hover:text-slate-700'
                }`}
              >
                {role === 'administrator' ? 'Admin' : role === 'vendor' ? 'Vendor' : 'Client'}
              </button>
            ))}
          </div>

          <form onSubmit={handleLoginSubmit} className="space-y-4">
            
            {errorMessage && (
              <div className="p-3 bg-red-550/10 text-red-750 text-xs border border-red-500/20 rounded-xl flex items-start gap-2">
                <AlertCircle className="w-4 h-4 text-red-600 shrink-0 mt-0.5" />
                <span className="leading-normal">{errorMessage}</span>
              </div>
            )}

            <div>
              <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Authorized Email Identifier ({selectedRole})</label>
              <div className="relative">
                <input 
                  type="email" 
                  required
                  value={emailInput}
                  onChange={e => setEmailInput(e.target.value)}
                  placeholder="name@organization.or.ke" 
                  className="w-full text-xs pl-10 pr-4 py-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none bg-white shadow-sm font-sans"
                />
                <Mail className="absolute left-3.5 top-3.5 w-4 h-4 text-gray-300" />
              </div>
            </div>

            <div>
              <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Security Password</label>
              <div className="relative">
                <input 
                  type="password" 
                  required
                  value={passwordInput}
                  onChange={e => setPasswordInput(e.target.value)}
                  placeholder="••••••••••••••" 
                  className="w-full text-xs pl-10 pr-4 py-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none bg-white shadow-sm font-sans"
                />
                <Lock className="absolute left-3.5 top-3.5 w-4 h-4 text-gray-300" />
              </div>
            </div>

            <button
              type="submit"
              className="w-full py-3 bg-[#112a1d] hover:bg-emerald-600 text-white font-bold text-xs rounded-xl hover:scale-[1.01] transition-all cursor-pointer inline-flex items-center justify-center gap-1.5 select-none"
            >
              Sign In to My Dashboard <ArrowRight className="w-4 h-4" />
            </button>
          </form>

          {/* Prefilled Testing Guides Box */}
          <div className="p-4 bg-slate-50 border border-slate-150 rounded-xl text-center">
            <h4 className="text-[10px] font-bold text-slate-400 uppercase tracking-widest flex items-center justify-center gap-1 mb-2">
              <Sparkles className="w-3.5 h-3.5 text-amber-500" /> Easy Demo Testing accounts
            </h4>
            <div className="space-y-1.5 text-left text-[11px] text-gray-500 font-mono">
              <p>• <strong className="text-[#112a1d]">Admin:</strong> caleb@kerea.org</p>
              <p>• <strong className="text-[#112a1d]">Vendor (Verified):</strong> sales@safisolar.co.ke</p>
              <p>• <strong className="text-[#112a1d]">Customer:</strong> george@gmail.com</p>
            </div>
            <p className="text-[9px] text-[#112a1d] mt-2.5 font-bold">Select any Admin, Vendor, or Client button above to prefill instantly!</p>
          </div>

        </div>
      ) : (
        <form onSubmit={handleRegisterSubmit} className="space-y-4">
          
          <div className="p-3 bg-amber-50 border border-amber-150 text-[10px] text-amber-900 leading-relaxed rounded-xl font-sans">
            *Vendors must go through Administrator verification before inventory products and payment escrow dashboards are fully unlocked. Customer portfolios activate instantly.
          </div>

          <div>
            <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Profile Account Type</label>
            <div className="grid grid-cols-2 gap-2">
              <button
                type="button"
                onClick={() => setRegRole('customer')}
                className={`py-2 text-xs font-bold text-center border rounded-xl cursor-pointer ${
                  regRole === 'customer' ? 'bg-[#112a1d] text-white border-[#112a1d]' : 'bg-white border-slate-205 text-slate-500'
                }`}
              >
                Client Portals
              </button>
              <button
                type="button"
                onClick={() => setRegRole('vendor')}
                className={`py-2 text-xs font-bold text-center border rounded-xl cursor-pointer ${
                  regRole === 'vendor' ? 'bg-[#112a1d] text-white border-[#112a1d]' : 'bg-white border-slate-205 text-slate-500'
                }`}
              >
                Commercial Vendor
              </button>
            </div>
          </div>

          <div>
            <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Full Legal Name</label>
            <input 
              type="text" 
              required
              value={regName}
              onChange={e => setRegName(e.target.value)}
              placeholder="e.g. Dr. Jane Koech" 
              className="w-full text-xs p-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none"
            />
          </div>

          <div>
            <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Email Address</label>
            <input 
              type="email" 
              required
              value={regEmail}
              onChange={e => setRegEmail(e.target.value)}
              placeholder="e.g. jane.koech@email.co.ke" 
              className="w-full text-xs p-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none"
            />
          </div>

          <div className="grid grid-cols-2 gap-3">
            <div>
              <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Primary Phone Number</label>
              <input 
                type="tel" 
                value={regPhone}
                onChange={e => setRegPhone(e.target.value)}
                placeholder="+254" 
                className="w-full text-xs p-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none"
              />
            </div>
            {regRole === 'vendor' && (
              <div>
                <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Registered Firm Name</label>
                <input 
                  type="text" 
                  required
                  value={regCompany}
                  onChange={e => setRegCompany(e.target.value)}
                  placeholder="e.g. Koech Solar Solutions" 
                  className="w-full text-xs p-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none"
                />
              </div>
            )}
          </div>

          {regRole === 'vendor' && (
            <div className="space-y-1.5">
              <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Onboarding Documents Upload slot (*Dummy Link)</label>
              <div className="p-4 border-2 border-dashed border-slate-200 rounded-xl text-center text-xs text-gray-400 bg-slate-50 select-none cursor-pointer">
                Drag-and-drop Company Incorporation or CR12 file (PDF/PNG format)
              </div>
            </div>
          )}

          <button
            type="submit"
            className="w-full py-3 bg-[#112a1d] hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow transition-all cursor-pointer"
          >
            Submit Application Profile
          </button>
        </form>
      )}

    </div>
  );
}
