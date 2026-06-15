import React from 'react';
import { useAppState } from '../../context/AppStateContext';
import { AppView } from '../../types';
import { 
  ArrowRight, 
  ShieldCheck, 
  GraduationCap, 
  Gavel, 
  FileText, 
  TrendingUp, 
  Users, 
  Zap, 
  CreditCard, 
  Building 
} from 'lucide-react';
import { motion } from 'motion/react';

export default function HomeView() {
  const { navigateTo, publications, events, products } = useAppState();

  const heroPortalPortals = [
    { title: 'Policy Lobby & Advocacy', desc: 'Influencing tax exemptions, net-metering laws, and county grid expansion policies.', icon: Gavel, target: 'policy-advocacy', color: 'bg-emerald-50 text-emerald-700' },
    { title: 'EPRA & KEBS Standards', desc: 'Official compliance libraries, technical certification guidelines, and safety codes.', icon: ShieldCheck, target: 'standards', color: 'bg-amber-50 text-amber-700' },
    { title: 'Training & Licensing', desc: 'EPRA T1/T2/T3 cohort preparation courses, exams, and bioenergy design workshops.', icon: GraduationCap, target: 'events', color: 'bg-blue-50 text-blue-700' },
    { title: 'Sustainable Finance Hub', desc: 'Connecting renewable developers with green lines of credit and international funding.', icon: CreditCard, target: 'access-to-finance', color: 'bg-purple-50 text-purple-700' },
  ];

  return (
    <div className="space-y-16 pb-16">
      {/* 1. Immersive Hero Banner */}
      <section className="relative bg-[#0b1f15] py-24 sm:py-32 overflow-hidden text-white rounded-3xl mx-4 sm:mx-6 lg:mx-8 shadow-2xl">
        <div className="absolute inset-0 z-0 opacity-15">
          <img 
            src="https://images.unsplash.com/photo-1466611653911-95081537e5b7?auto=format&fit=crop&w=1600&q=80" 
            alt="Wind Turbines" 
            className="w-full h-full object-cover"
            referrerPolicy="no-referrer"
          />
        </div>
        
        {/* Glowing Ambient Spotlights */}
        <div className="absolute -top-40 -left-40 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div className="absolute -bottom-40 right-20 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div className="relative z-10 max-w-5xl mx-auto px-6 sm:px-8 text-center">
          <motion.div 
            initial={{ opacity: 0, scale: 0.95 }}
            animate={{ opacity: 1, scale: 1 }}
            className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-semibold tracking-wider uppercase mb-6"
          >
            <span className="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            Kenya Renewable Energy Association Digital Portal
          </motion.div>

          <h1 className="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight mb-6 leading-[1.1]">
            Start Your <span className="bg-gradient-to-r from-amber-400 to-orange-400 bg-clip-text text-transparent">Bright Future</span> <br /> 
            with Cohesive Clean Energy
          </h1>

          <p className="text-base sm:text-lg text-emerald-100/80 mb-10 max-w-3xl mx-auto leading-relaxed">
            As the peak lobby body representing the Kenyan green technology ecosystem since 2004, KEREA bridges policy planners, professional certified installers, and project financiers to achieve 100% sustainable electrification.
          </p>

          <div className="flex flex-wrap items-center justify-center gap-4">
            <button
              onClick={() => navigateTo('member-directory')}
              className="px-8 py-4 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold rounded-xl text-sm shadow-xl shadow-orange-500/20 hover:scale-[1.02] active:scale-[0.98] transition-all cursor-pointer inline-flex items-center gap-2"
            >
              JOIN THE DIRECTORY <ArrowRight className="w-4 h-4" />
            </button>
            <button
              onClick={() => navigateTo('marketplace')}
              className="px-8 py-4 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold rounded-xl text-sm transition-all cursor-pointer shrink-0"
            >
              BROWSE MARKETPLACE
            </button>
          </div>
        </div>
      </section>

      {/* 2. Interactive Quick Nav Pathways */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center max-w-3xl mx-auto mb-12">
          <h2 className="text-3xl font-extrabold text-[#112a1d] tracking-tight">Ecosystem Portals</h2>
          <p className="text-sm text-gray-500 mt-2">Highly specialized resources for trade developers, technicians, and clean energy patrons in Kenya.</p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          {heroPortalPortals.map((portal, idx) => {
            const Icon = portal.icon;
            return (
              <motion.div
                key={idx}
                whileHover={{ y: -4 }}
                transition={{ type: 'spring', stiffness: 300 }}
                onClick={() => navigateTo(portal.target as AppView)}
                className="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md cursor-pointer flex flex-col justify-between group"
              >
                <div>
                  <div className={`w-12 h-12 rounded-xl flex items-center justify-center mb-5 ${portal.color}`}>
                    <Icon className="w-6 h-6" />
                  </div>
                  <h3 className="text-base font-bold text-[#112a1d] leading-snug group-hover:text-emerald-700 transition-colors">
                    {portal.title}
                  </h3>
                  <p className="text-xs text-slate-500 mt-2.5 leading-relaxed">
                    {portal.desc}
                  </p>
                </div>
                <div className="mt-5 pt-4 border-t border-slate-50 flex items-center text-xs font-bold text-emerald-600 gap-1 group-hover:gap-2 transition-all">
                  Open Subsections <ArrowRight className="w-3.5 h-3.5" />
                </div>
              </motion.div>
            );
          })}
        </div>
      </section>

      {/* 3. Real-Time Dynamic News Highlight, Event Calendar, and Recommended Equipment */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-10">
        
        {/* Left Col: Latest News & Calendar Highlights (8 cols grid) */}
        <div className="lg:col-span-8 space-y-10">
          
          {/* Upcoming Dynamic Educational Cohorts */}
          <div className="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
            <div className="flex justify-between items-center mb-6">
              <div>
                <h3 className="text-lg font-black text-[#112a1d]">Upcoming Cohorts & Seminars</h3>
                <p className="text-xs text-gray-400 mt-1">Directly managed and updated from the Administrator CMS</p>
              </div>
              <button 
                onClick={() => navigateTo('events')}
                className="text-xs font-bold text-emerald-600 hover:text-emerald-800 flex items-center gap-1"
              >
                View Calendar <ArrowRight className="w-3 h-3" />
              </button>
            </div>

            <div className="space-y-4">
              {events.slice(0, 2).map(evt => (
                <div 
                  key={evt.id}
                  className="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between p-4 bg-slate-50 hover:bg-emerald-50/30 rounded-xl border border-slate-100 transition-colors"
                >
                  <div className="space-y-1">
                    <span className="text-[10px] uppercase font-black px-2 py-0.5 rounded bg-amber-100 text-amber-800">
                      {evt.type}
                    </span>
                    <h4 className="text-sm font-bold text-[#112a1d]">{evt.title}</h4>
                    <p className="text-xs text-gray-500 flex items-center gap-2">
                      <span>Date: {evt.date}</span> • <span>Loc: {evt.location}</span>
                    </p>
                  </div>
                  <button
                    onClick={() => navigateTo('events')}
                    className="px-4 py-2 bg-[#112a1d] hover:bg-emerald-700 text-white text-xs font-bold rounded-lg cursor-pointer transition-colors shrink-0"
                  >
                    Details & Apply
                  </button>
                </div>
              ))}
            </div>
          </div>

          {/* Featured Publications Alert */}
          <div className="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
            <div className="flex justify-between items-center mb-6">
              <div>
                <h3 className="text-lg font-black text-[#112a1d]">Recently Released Guidelines</h3>
                <p className="text-xs text-gray-400 mt-1">Officially published sector research, bills, and KEBS criteria uploads</p>
              </div>
              <button 
                onClick={() => navigateTo('publications')}
                className="text-xs font-bold text-emerald-600 hover:text-emerald-800 flex items-center gap-1"
              >
                Open Download Library <ArrowRight className="w-3 h-3" />
              </button>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              {publications.slice(0, 2).map(pub => (
                <div 
                  key={pub.id}
                  className="p-4 rounded-xl border border-slate-100 hover:border-emerald-500/20 transition-all flex flex-col justify-between"
                >
                  <div>
                    <span className="text-[9px] font-black uppercase text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">
                      {pub.category}
                    </span>
                    <h4 className="text-xs font-bold text-[#112a1d] mt-2 leading-relaxed">{pub.title}</h4>
                  </div>
                  <div className="flex justify-between items-center mt-4 pt-3 border-t border-slate-50 text-[10px] text-gray-400">
                    <span>{pub.fileSize} • Year {pub.publishedYear}</span>
                    <button 
                      onClick={() => navigateTo('publications')}
                      className="text-emerald-600 font-bold hover:underline"
                    >
                      Download
                    </button>
                  </div>
                </div>
              ))}
            </div>
          </div>

        </div>

        {/* Right Col: Spotlighting Certified Marketplace Products (4 cols grid) */}
        <div className="lg:col-span-4 space-y-6">
          <div className="bg-gradient-to-br from-[#112a1d] to-[#0a1b12] text-white rounded-2xl p-6 shadow-lg relative overflow-hidden">
            <div className="absolute top-0 right-0 w-32 h-32 bg-amber-500/10 rounded-full blur-2xl"></div>
            
            <div className="relative z-10 space-y-6">
              <div>
                <span className="text-[10px] font-bold text-amber-400 tracking-wider font-mono">CERTIFIED ESCROW SHOP</span>
                <h3 className="text-lg font-extrabold mt-1">Escrow Marketplace</h3>
                <p className="text-xs text-slate-300 mt-1.5 leading-relaxed">
                  Avoid deceptive transactions. Buy certified solar components through KEREA escrow, where payouts are held safely till dynamic validation.
                </p>
              </div>

              <div className="space-y-4">
                {products.slice(0, 2).map(prod => (
                  <div key={prod.id} className="p-3.5 bg-white/5 rounded-xl border border-white/10 flex items-center gap-3">
                    <img 
                      src={prod.imageUrl} 
                      alt={prod.title} 
                      className="w-12 h-12 object-cover rounded-lg shrink-0"
                      referrerPolicy="no-referrer"
                    />
                    <div className="min-w-0">
                      <h4 className="text-xs font-bold truncate">{prod.title}</h4>
                      <p className="text-xs text-amber-400 font-extrabold mt-0.5">KES {prod.priceKES.toLocaleString()}</p>
                    </div>
                  </div>
                ))}
              </div>

              <button
                onClick={() => navigateTo('marketplace')}
                className="w-full py-3 bg-amber-500 hover:bg-amber-600 active:scale-[0.98] text-white font-bold text-xs rounded-xl transition-all cursor-pointer block text-center uppercase tracking-wide shadow-md shadow-amber-500/10"
              >
                Browse All 15+ Products
              </button>
            </div>
          </div>

          {/* Quick Support / Ticketing CTA Box */}
          <div className="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
            <h4 className="text-sm font-extrabold text-[#112a1d]">Need Professional Help?</h4>
            <p className="text-xs text-gray-500 mt-2 leading-relaxed">
              Open a technical support inquiry, ask about energy auditing licensing grids, or file complaints directly with our committee.
            </p>
            <button
              onClick={() => navigateTo('auth')}
              className="mt-4 w-full py-2.5 bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white text-xs font-bold rounded-xl transition-all block text-center cursor-pointer"
            >
              Sign In to File Support Ticket
            </button>
          </div>
        </div>

      </section>

      {/* 4. Professional Stats Bar (Deep Forest Theme) */}
      <section className="bg-[#112a1d] py-16 text-white rounded-3xl mx-4 sm:mx-6 lg:mx-8 relative overflow-hidden">
        <div className="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,_var(--tw-gradient-stops))] from-emerald-950/40 via-transparent to-transparent"></div>
        <div className="relative z-10 max-w-6xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8 text-center sm:gap-12">
          <div>
            <p className="text-4xl sm:text-5xl font-black text-amber-400">450+</p>
            <p className="text-xs font-bold text-emerald-200 mt-2 uppercase tracking-wide">Corporate Members</p>
            <p className="text-[10px] text-emerald-300/60 mt-1 max-w-[160px] mx-auto">Solar suppliers, microgrid operators, and financial backers.</p>
          </div>
          <div>
            <p className="text-4xl sm:text-5xl font-black text-amber-400">1,200+</p>
            <p className="text-xs font-bold text-emerald-200 mt-2 uppercase tracking-wide">Certified Installers</p>
            <p className="text-[10px] text-emerald-300/60 mt-1 max-w-[160px] mx-auto">EPRA T1/T2/T3 verified technicians representing safety quality.</p>
          </div>
          <div>
            <p className="text-4xl sm:text-5xl font-black text-amber-400">85%</p>
            <p className="text-xs font-bold text-emerald-200 mt-2 uppercase tracking-wide">Rural Access Grid</p>
            <p className="text-[10px] text-emerald-300/60 mt-1 max-w-[160px] mx-auto">Attributed to microgrid and solar solar home kit advocacy.</p>
          </div>
          <div>
            <p className="text-4xl sm:text-5xl font-black text-amber-400">22+</p>
            <p className="text-xs font-bold text-emerald-200 mt-2 uppercase tracking-wide">Years of Lobby Service</p>
            <p className="text-[10px] text-emerald-300/60 mt-1 max-w-[160px] mx-auto">Incorporated in 2004 as Kenya’s premier renewable energy champion.</p>
          </div>
        </div>
      </section>
    </div>
  );
}
