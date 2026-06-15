import React, { useState, useEffect } from 'react';
import { Phone, Mail, MapPin, Menu, X, Globe, Sun, HelpCircle, FileText, Briefcase, ChevronDown, User, ShieldAlert, Sparkles, ShoppingCart, Key } from 'lucide-react';
import { motion, AnimatePresence } from 'motion/react';
import { useAppState } from '../context/AppStateContext';
import { AppView } from '../types';

export default function Header() {
  const { currentView, navigateTo, currentUser, logoutCurrentUser } = useAppState();
  const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
  const [isScrolled, setIsScrolled] = useState(false);

  // Dropdown states for Desktop
  const [activeDropdown, setActiveDropdown] = useState<string | null>(null);

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 40);
    };
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  const handleNavClick = (view: AppView) => {
    navigateTo(view);
    setIsMobileMenuOpen(false);
    setActiveDropdown(null);
  };

  const getDashboardView = (): AppView => {
    if (!currentUser) return 'auth';
    if (currentUser.role === 'administrator') return 'dashboard-admin';
    if (currentUser.role === 'vendor') return 'dashboard-vendor';
    return 'dashboard-customer';
  };

  const menuGroups = [
    {
      label: 'Institutional Portal',
      items: [
        { label: 'About Us', view: 'about' as AppView },
        { label: 'Leadership', view: 'leadership' as AppView },
        { label: 'Africa-Global Partnerships', view: 'partnerships' as AppView }
      ]
    },
    {
      label: 'Advocacy & Standards',
      items: [
        { label: 'Policy & Advocacy', view: 'policy-advocacy' as AppView },
        { label: 'Standards & Compliance', view: 'standards' as AppView },
        { label: 'Knowledge Hub', view: 'knowledge-hub' as AppView },
        { label: 'Publications & Reports', view: 'publications' as AppView }
      ]
    },
    {
      label: 'Trade & Capacity',
      items: [
        { label: 'Access to Finance', view: 'access-to-finance' as AppView },
        { label: 'Market Development & PURE', view: 'market-dev' as AppView },
        { label: 'Events Calendar', view: 'events' as AppView },
        { label: 'Member Directory', view: 'member-directory' as AppView }
      ]
    }
  ];

  return (
    <>
      {/* Top Utility Bar */}
      <div id="top-bar" className="bg-[#112a1d] text-emerald-100 py-2.5 px-4 sm:px-6 lg:px-8 border-b border-emerald-950/40 text-[10px] sm:text-xs transition-all select-none">
        <div className="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
          {/* Slogan */}
          <div className="flex items-center gap-4">
            <span className="hidden leading-normal md:inline font-black tracking-widest text-[#caa250]">KEREA GUARANTEED COMPLIANCE</span>
            <div className="flex items-center gap-2 text-emerald-300">
              <span>Nairobi Secretariat Hub</span>
            </div>
          </div>
          {/* Contact Details */}
          <div className="flex flex-wrap justify-center items-center gap-y-1 gap-x-5 text-emerald-200">
            <div className="flex items-center gap-1 hover:text-[#caa250]" onClick={() => handleNavClick('contact')}>
              <MapPin className="w-3 h-3 text-[#caa250]" />
              <span>Westlands Plaza, Wood Avenue, Nairobi</span>
            </div>
            <div className="flex items-center gap-1">
              <Mail className="w-3 h-3 text-[#caa250]" />
              <a href="mailto:membership@kerea.org">membership@kerea.org</a>
            </div>
          </div>
        </div>
      </div>

      {/* Main Header / Navigation */}
      <header
        id="main-nav"
        className={`sticky top-0 z-50 w-full transition-all duration-300 ${
          isScrolled 
            ? 'bg-white shadow border-b border-emerald-50 py-2.5' 
            : 'bg-white/95 backdrop-blur-sm py-3.5 border-b border-emerald-50'
        }`}
      >
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center">
            {/* Logo */}
            <div 
              className="flex items-center gap-2.5 cursor-pointer group select-none"
              onClick={() => handleNavClick('home')}
            >
              <div className="w-10 h-10 bg-[#112a1d] rounded-xl flex items-center justify-center text-[#caa250] shadow-sm transform group-hover:rotate-6 transition-all duration-300">
                <Sun className="w-5.5 h-5.5 animate-pulse" />
              </div>
              <div className="flex flex-col">
                <span className="text-lg font-black tracking-tight text-[#112a1d] flex items-center gap-1.5 leading-none">
                  KEREA <span className="text-emerald-700 bg-emerald-50 border border-emerald-100/60 rounded px-1.5 py-0.5 text-[9px] tracking-wider font-extrabold uppercase leading-none">PEAK BODY</span>
                </span>
                <span className="text-[10px] font-bold text-gray-400 tracking-wide uppercase leading-tight mt-0.5">
                  Kenya Renewable Energy Association
                </span>
              </div>
            </div>

            {/* Desktop Navigation Links */}
            <nav className="hidden xl:flex items-center gap-5">
              <button 
                onClick={() => handleNavClick('home')}
                className={`text-xs font-black uppercase tracking-wide cursor-pointer transition-colors ${
                  currentView === 'home' ? 'text-emerald-700 font-black' : 'text-[#112a1d] hover:text-emerald-600'
                }`}
              >
                Home
              </button>

              {menuGroups.map((group, idx) => (
                <div 
                  key={idx}
                  className="relative group/down"
                  onMouseEnter={() => setActiveDropdown(group.label)}
                  onMouseLeave={() => setActiveDropdown(null)}
                >
                  <button className="text-xs font-black uppercase tracking-wide text-[#112a1d] hover:text-emerald-650 flex items-center gap-1 cursor-pointer py-1">
                    {group.label}
                    <ChevronDown className="w-3.5 h-3.5 text-gray-400 group-hover/down:rotate-180 transition-transform" />
                  </button>

                  <div className="absolute top-full left-0 mt-1.5 w-60 bg-white border border-slate-100 rounded-xl shadow-lg p-2.5 space-y-1 opacity-0 pointer-events-none group-hover/down:opacity-100 group-hover/down:pointer-events-auto transition-all duration-250 transform translate-y-1 group-hover/down:translate-y-0">
                    {group.items.map((it, subI) => (
                      <button
                        key={subI}
                        onClick={() => handleNavClick(it.view)}
                        className={`w-full text-left font-black text-[11px] uppercase tracking-wide p-2.5 rounded-lg cursor-pointer transition-all hover:bg-emerald-50 hover:text-emerald-800 ${
                          currentView === it.view ? 'bg-emerald-50/70 text-emerald-800' : 'text-slate-600'
                        }`}
                      >
                        {it.label}
                      </button>
                    ))}
                  </div>
                </div>
              ))}

              <button 
                onClick={() => handleNavClick('publications')}
                className={`text-xs font-black uppercase tracking-wide cursor-pointer hover:text-emerald-600 ${
                  currentView === 'publications' ? 'text-emerald-700' : 'text-[#112a1d]'
                }`}
              >
                Bulletins
              </button>

              <button 
                onClick={() => handleNavClick('marketplace')}
                className={`text-xs font-black uppercase tracking-widest bg-emerald-700 text-white hover:bg-emerald-850 px-3.5 py-1.5 rounded-lg cursor-pointer shadow transition-all ${
                  currentView === 'marketplace' ? 'ring-2 ring-emerald-600/35' : ''
                }`}
              >
                Marketplace Escrow
              </button>

              <button 
                onClick={() => handleNavClick('blog')}
                className={`text-xs font-black uppercase tracking-wide cursor-pointer hover:text-emerald-600 ${
                  currentView === 'blog' ? 'text-emerald-700 font-extrabold' : 'text-[#112a1d]'
                }`}
              >
                News
              </button>

              <button 
                onClick={() => handleNavClick('contact')}
                className={`text-xs font-black uppercase tracking-wide cursor-pointer hover:text-emerald-600 ${
                  currentView === 'contact' ? 'text-emerald-700' : 'text-[#112a1d]'
                }`}
              >
                Contact Us
              </button>
            </nav>

            {/* User Security Actions or Quick login button */}
            <div className="flex items-center gap-3">
              {currentUser ? (
                <div className="hidden sm:flex items-center gap-2">
                  <button
                    onClick={() => handleNavClick(getDashboardView())}
                    className="px-3.5 py-1.5 bg-[#112a1d] hover:bg-[#caa250] hover:text-[#112a1d] text-white font-bold text-[10px] uppercase tracking-wider rounded-lg cursor-pointer transition-all inline-flex items-center gap-1 shadow-sm"
                  >
                    <User className="w-3.5 h-3.5 shrink-0" />
                    <span>My Account ({currentUser.role === 'administrator' ? 'Admin' : currentUser.role === 'vendor' ? 'Vendor' : 'Client'})</span>
                  </button>
                  <button
                    onClick={logoutCurrentUser}
                    className="p-1.5 rounded-lg border border-slate-150 text-slate-400 hover:text-red-700 cursor-pointer"
                    title="Log Out"
                  >
                    <X className="w-4 h-4" />
                  </button>
                </div>
              ) : (
                <button
                  onClick={() => handleNavClick('auth')}
                  className="hidden sm:inline-flex items-center justify-center gap-1 px-4 py-1.5 rounded-lg text-[10px] tracking-wider font-extrabold uppercase text-slate-700 hover:bg-emerald-50 border border-slate-200 cursor-pointer transition-colors"
                >
                  <Key className="w-3.5 h-3.5 text-emerald-700 shrink-0" /> SECURITY SIGN IN
                </button>
              )}

              {/* Mobile Drawer trigger icon */}
              <button
                onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}
                className="xl:hidden p-2 rounded-xl bg-slate-50 hover:bg-slate-100 text-[#112a1d] border border-slate-200 focus:outline-none transition-colors"
                aria-label="Toggle Menu"
              >
                {isMobileMenuOpen ? <X className="w-5 h-5 animate-spin" /> : <Menu className="w-5 h-5" />}
              </button>
            </div>
          </div>
        </div>
      </header>

      {/* Mobile Drawer menu overlay */}
      <AnimatePresence>
        {isMobileMenuOpen && (
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="fixed inset-0 z-55 bg-[#112a1d]/60 backdrop-blur-sm xl:hidden pointer-events-auto"
            onClick={() => setIsMobileMenuOpen(false)}
          >
            <motion.div 
              initial={{ x: '100%' }}
              animate={{ x: 0 }}
              exit={{ x: '100%' }}
              transition={{ type: 'spring', damping: 25, stiffness: 180 }}
              className="fixed top-0 right-0 w-80 max-w-[90vw] h-full bg-white shadow-2xl p-6 flex flex-col justify-between pointer-events-auto overflow-y-auto"
              onClick={(e) => e.stopPropagation()}
            >
              <div>
                <div className="flex justify-between items-center mb-6">
                  <div className="flex items-center gap-2">
                    <Sun className="w-5 h-5 text-amber-500 animate-pulse" />
                    <span className="text-xs font-bold uppercase tracking-wider text-[#112a1d]">KEREA NAV DESK</span>
                  </div>
                  <button 
                    onClick={() => setIsMobileMenuOpen(false)}
                    className="p-1.5 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-500 cursor-pointer"
                  >
                    <X className="w-4 h-4" />
                  </button>
                </div>

                {/* Vertical menu navigation */}
                <nav className="flex flex-col gap-1 text-xs">
                  <button 
                    onClick={() => handleNavClick('home')}
                    className="w-full text-left py-2 px-3 rounded-lg text-emerald-950 font-bold uppercase hover:bg-emerald-50 cursor-pointer"
                  >
                    Home
                  </button>

                  {/* Menu items flattened for effortless responsive selections */}
                  <div className="my-2 border-t border-slate-100 pt-2 space-y-1">
                    <p className="text-[9px] uppercase font-bold text-gray-400 px-3 tracking-widest mb-1.5">Secretariat Core</p>
                    <button onClick={() => handleNavClick('about')} className="w-full text-left py-1.5 px-3 rounded-lg text-slate-600 hover:bg-slate-50 cursor-pointer">About Us</button>
                    <button onClick={() => handleNavClick('leadership')} className="w-full text-left py-1.5 px-3 rounded-lg text-slate-600 hover:bg-slate-50 cursor-pointer">Leadership</button>
                    <button onClick={() => handleNavClick('partnerships')} className="w-full text-left py-1.5 px-3 rounded-lg text-slate-600 hover:bg-slate-50 cursor-pointer"> Partnerships</button>
                  </div>

                  <div className="my-2 border-t border-slate-100 pt-2 space-y-1">
                    <p className="text-[9px] uppercase font-bold text-gray-400 px-3 tracking-widest mb-1.5">Advocacy & Standards</p>
                    <button onClick={() => handleNavClick('policy-advocacy')} className="w-full text-left py-1.5 px-3 rounded-lg text-slate-600 hover:bg-slate-50 cursor-pointer">Policy Briefs</button>
                    <button onClick={() => handleNavClick('standards')} className="w-full text-left py-1.5 px-3 rounded-lg text-slate-600 hover:bg-slate-50 cursor-pointer">Compliance</button>
                    <button onClick={() => handleNavClick('knowledge-hub')} className="w-full text-left py-1.5 px-3 rounded-lg text-slate-600 hover:bg-slate-50 cursor-pointer">Knowledge Hub FAQs</button>
                    <button onClick={() => handleNavClick('publications')} className="w-full text-left py-1.5 px-3 rounded-lg text-slate-600 hover:bg-slate-50 cursor-pointer">Bulletins & Reports</button>
                  </div>

                  <div className="my-2 border-t border-slate-100 pt-2 space-y-1">
                    <p className="text-[9px] uppercase font-bold text-gray-400 px-3 tracking-widest mb-1.5">Trade & Directory</p>
                    <button onClick={() => handleNavClick('access-to-finance')} className="w-full text-left py-1.5 px-3 rounded-lg text-slate-600 hover:bg-slate-50 cursor-pointer">Access to Finance</button>
                    <button onClick={() => handleNavClick('market-dev')} className="w-full text-left py-1.5 px-3 rounded-lg text-slate-600 hover:bg-slate-50 cursor-pointer">Market PURE</button>
                    <button onClick={() => handleNavClick('events')} className="w-full text-left py-1.5 px-3 rounded-lg text-slate-600 hover:bg-slate-50 cursor-pointer">Trainings & Events</button>
                    <button onClick={() => handleNavClick('member-directory')} className="w-full text-left py-1.5 px-3 rounded-lg text-slate-600 hover:bg-slate-50 cursor-pointer">Certified Members</button>
                    <button onClick={() => handleNavClick('marketplace')} className="w-full text-left py-1.5 px-3 rounded-lg text-white bg-emerald-700 hover:opacity-90 font-bold uppercase cursor-pointer">Escrow Marketplace</button>
                  </div>
                </nav>
              </div>

              {/* Drawer Contacts */}
              <div className="border-t border-gray-100 pt-6">
                {currentUser ? (
                  <button
                    onClick={() => handleNavClick(getDashboardView())}
                    className="w-full py-3 mb-2 rounded-xl text-center text-xs font-bold text-white bg-[#112a1d] cursor-pointer"
                  >
                    GO TO MY DASHBOARD
                  </button>
                ) : (
                  <button
                    onClick={() => handleNavClick('auth')}
                    className="w-full py-3 mb-2 rounded-xl text-center text-xs font-bold text-slate-800 bg-emerald-50 border border-emerald-100 cursor-pointer"
                  >
                    SECURITY SIGN IN
                  </button>
                )}
                <div className="space-y-1 text-center py-2 text-[10px] text-gray-400 font-mono">
                  <p>Secretariat Hotline: +254 (0) 20 2345678</p>
                </div>
              </div>
            </motion.div>
          </motion.div>
        )}
      </AnimatePresence>
    </>
  );
}
