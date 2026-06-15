import React, { useState } from 'react';
import { Mail, Phone, MapPin, Send, Sun, Sparkles, HelpCircle, ShieldAlert } from 'lucide-react';
import { useAppState } from '../context/AppStateContext';
import { AppView } from '../types';

export default function Footer() {
  const { navigateTo } = useAppState();
  const [email, setEmail] = useState('');
  const [isSuccess, setIsSuccess] = useState(false);

  const handleSubscribe = (e: React.FormEvent) => {
    e.preventDefault();
    if (email) {
      setIsSuccess(true);
      setTimeout(() => {
        setIsSuccess(false);
        setEmail('');
      }, 5000);
    }
  };

  const handleNavClick = (view: AppView) => {
    navigateTo(view);
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  return (
    <footer className="bg-[#0e2116] text-white pt-20 pb-8 border-t-8 border-[#caa250] relative overflow-hidden">
      {/* Dynamic light glows in background */}
      <div className="absolute top-0 right-0 transform translate-x-12 -translate-y-12 w-96 h-96 bg-emerald-500/5 rounded-full filter blur-3xl"></div>
      
      <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* Top Segment: Brand logo & Newsletter Form */}
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 pb-12 border-b border-emerald-950">
          
          {/* Logo card block */}
          <div className="lg:col-span-5 flex flex-col justify-between">
            <div>
              <div className="flex items-center gap-2.5 mb-5 cursor-pointer" onClick={() => handleNavClick('home')}>
                <div className="w-10 h-10 bg-gradient-to-tr from-emerald-500 to-amber-400 rounded-xl flex items-center justify-center text-white shadow-md">
                  <Sun className="w-5.5 h-5.5" />
                </div>
                <div>
                  <h3 className="text-lg font-black tracking-tight text-white leading-none">
                    KEREA <span className="text-emerald-400 font-medium text-[9px] tracking-widest bg-emerald-950 border border-emerald-900 rounded px-1 ml-1">EAST AFRICA</span>
                  </h3>
                  <span className="text-[9px] font-bold text-gray-400 tracking-wider uppercase">
                    Kenya Renewable Energy Association
                  </span>
                </div>
              </div>
              <p className="text-xs text-emerald-100/60 leading-relaxed max-w-sm mb-6 font-sans">
                Representing the voice of private renewable markets in Kenya. Actively advocating to establish fair VAT exemptions, off-grid micro-grids regulations, and technical capacity building courses since 2004.
              </p>
            </div>
          </div>

          {/* Newsletter Segment */}
          <div className="lg:col-span-7 bg-white/5 border border-white/5 p-6 rounded-2xl flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div className="max-w-md">
              <span className="text-[10px] font-extrabold uppercase tracking-widest text-[#caa250] flex items-center gap-1.5 mb-1 bg-white/5 px-2.5 py-1 rounded w-max">
                <Sparkles className="w-3.5 h-3.5" /> NEWSLETTER & STANDARDS ALERTS
              </span>
              <p className="text-xs text-emerald-100/60 leading-relaxed">
                Stay updated on new EPRA licensing exams, VAT tax changes, standard codes revisions, and local networking dinners.
              </p>
            </div>

            {/* Subscriptions feedback */}
            {isSuccess ? (
              <div className="bg-emerald-950/80 border border-emerald-500/30 p-3.5 rounded-xl flex items-center gap-2.5 text-xs text-emerald-300">
                <span className="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                <span>Success! You have been queued to KEREA alerts lists.</span>
              </div>
            ) : (
              <form onSubmit={handleSubscribe} className="flex gap-2 w-full md:max-w-xs">
                <input
                  required
                  type="email"
                  placeholder="name@kerea-member.org"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  className="bg-emerald-950 border border-emerald-900 focus:border-emerald-500 rounded-xl px-4 py-2.5 text-xs text-white placeholder-emerald-800 focus:outline-none w-full"
                />
                <button
                  type="submit"
                  className="p-3.5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 rounded-xl text-white transition-all shadow-md active:scale-95 cursor-pointer shrink-0"
                  aria-label="Subscribe"
                >
                  <Send className="w-4 h-4" />
                </button>
              </form>
            )}
          </div>

        </div>

        {/* Middle Segment: Grids Directories */}
        <div className="grid grid-cols-2 md:grid-cols-4 gap-8 py-12 text-xs">
          
          {/* Col 1: Associations */}
          <div className="space-y-4">
            <h4 className="text-sm font-extrabold tracking-wider text-white uppercase border-b border-white/5 pb-2">
              Technology Hubs
            </h4>
            <ul className="space-y-2.5 text-emerald-100/70">
              <li>
                <button onClick={() => handleNavClick('market-dev')} className="hover:text-amber-400 transition-colors cursor-pointer text-left">
                  Solar PV & Water Heating
                </button>
              </li>
              <li>
                <button onClick={() => handleNavClick('market-dev')} className="hover:text-amber-400 transition-colors cursor-pointer text-left">
                  Wind Generation Systems
                </button>
              </li>
              <li>
                <button onClick={() => handleNavClick('market-dev')} className="hover:text-amber-400 transition-colors cursor-pointer text-left">
                  Biomass Briquettes & Biogas
                </button>
              </li>
              <li>
                <button onClick={() => handleNavClick('market-dev')} className="hover:text-[#caa250] transition-colors cursor-pointer text-left">
                  Geothermal rift and Mini-hydro
                </button>
              </li>
            </ul>
          </div>

          {/* Col 2: KEREA Academy */}
          <div className="space-y-4">
            <h4 className="text-sm font-extrabold tracking-wider text-white uppercase border-b border-white/5 pb-2">
              KEREA Academy
            </h4>
            <ul className="space-y-2.5 text-emerald-100/70">
              <li>
                <button onClick={() => handleNavClick('events')} className="hover:text-[#caa250] transition-colors cursor-pointer text-left">
                  EPRA Solar T1/T2 Courses
                </button>
              </li>
              <li>
                <button onClick={() => handleNavClick('events')} className="hover:text-[#caa250] transition-colors cursor-pointer text-left">
                  Advanced T3 Hybrid Solar Grid
                </button>
              </li>
              <li>
                <button onClick={() => handleNavClick('events')} className="hover:text-[#caa250] transition-colors cursor-pointer text-left">
                  Biogas Plant Masonry Building
                </button>
              </li>
              <li>
                <button onClick={() => handleNavClick('publications')} className="hover:text-[#caa250] transition-colors cursor-pointer text-left font-semibold">
                  Syllabi & Codes of Standards
                </button>
              </li>
            </ul>
          </div>

          {/* Col 3: Quick Navigation */}
          <div className="space-y-4">
            <h4 className="text-sm font-extrabold tracking-wider text-white uppercase border-b border-white/5 pb-2">
              Affiliations Dues
            </h4>
            <ul className="space-y-2.5 text-emerald-100/70">
              <li>
                <button onClick={() => handleNavClick('member-directory')} className="hover:text-[#caa250] transition-colors cursor-pointer text-left">
                  Individual Practitioner
                </button>
              </li>
              <li>
                <button onClick={() => handleNavClick('member-directory')} className="hover:text-[#caa250] transition-colors cursor-pointer text-left">
                  SME Renewable Vendor
                </button>
              </li>
              <li>
                <button onClick={() => handleNavClick('member-directory')} className="hover:text-[#caa250] transition-colors cursor-pointer text-left">
                  Large Scale Dev Partners
                </button>
              </li>
              <li>
                <button onClick={() => handleNavClick('about')} className="hover:text-[#caa250] transition-colors cursor-pointer text-left">
                  Strategic Plan 2024-2028
                </button>
              </li>
            </ul>
          </div>

          {/* Col 4: Reach Out Offices */}
          <div className="space-y-4 text-emerald-100/70">
            <h4 className="text-sm font-extrabold tracking-wider text-white uppercase border-b border-white/5 pb-2">
              Registered Head Office
            </h4>
            <ul className="space-y-3">
              <li className="flex gap-2 items-start cursor-pointer" onClick={() => handleNavClick('contact')}>
                <MapPin className="w-4 h-4 text-amber-500 shrink-0 mt-0.5" />
                <span>
                  Westlands Wood Avenue Plaza, Suite 4B <br />
                  Westlands, Nairobi, Kenya
                </span>
              </li>
              <li className="flex gap-2 items-center">
                <Phone className="w-4 h-4 text-amber-500 shrink-0" />
                <a href="tel:+254202345678" className="hover:text-white transition-colors">
                  +254 (0) 20 2345678
                </a>
              </li>
              <li className="flex gap-2 items-center">
                <Mail className="w-4 h-4 text-amber-500 shrink-0" />
                <a href="mailto:info@kerea.org" className="hover:text-white transition-colors">
                  info@kerea.org
                </a>
              </li>
            </ul>
          </div>

        </div>

        {/* Lower copyright row */}
        <div className="border-t border-emerald-950 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-[11px] text-emerald-200/50 text-center md:text-left font-sans">
          <p>© {new Date().getFullYear()} Kenya Renewable Energy Association (KEREA). Registered Non-Profit NGO. All Rights Reserved.</p>
          <div className="flex gap-4 items-center">
            <button onClick={() => handleNavClick('policy-advocacy')} className="hover:text-white transition-colors flex items-center gap-1">
              <ShieldAlert className="w-3.5 h-3.5" /> Environmental Policy Statement
            </button>
            <span className="text-emerald-950">|</span>
            <button onClick={() => handleNavClick('standards')} className="hover:text-white transition-colors">
              EPRA Regulator Links
            </button>
          </div>
        </div>

      </div>
    </footer>
  );
}
