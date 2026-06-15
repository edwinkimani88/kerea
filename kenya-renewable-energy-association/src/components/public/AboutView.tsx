import React from 'react';
import { Award, ShieldAlert, Heart, Zap, History, Milestone, CheckCircle } from 'lucide-react';
import { motion } from 'motion/react';

export default function AboutView() {
  const coreValues = [
    { title: 'Integrity & Quality', desc: 'Promoting EPRA-compliant installations and resisting counterfeit off-grid equipment throughout Eastern Africa.', icon: Award },
    { title: 'Inclusivity', desc: 'Upholding female energy solar development cohorts, student mentorship, and rural county representation.', icon: Heart },
    { title: 'Sustainability First', desc: 'Encouraging circular solar electronics recycling, bio-organic waste digestion, and zero-deforestation cooking.', icon: Zap },
  ];

  const executiveMilestones = [
    { year: '2004', title: 'Association Founded', desc: 'KEREA is established via an act of societies under peak wind & solar pioneers to lobby for basic component standards.' },
    { year: '2012', title: 'Solar Tax Exemptions', desc: 'Successfully lobbied the Parliament of Kenya to pass 100% Import duty and VAT exemptions for photovoltaic modules.' },
    { year: '2019', title: 'EPRA Training Endorsement', desc: 'Secured official designation as the premier preparation academy with training modules aligned with EPRA licensing syllabi.' },
    { year: '2026', title: 'Ecosystem Digitization', desc: 'Unifying the national licensing prep, escrow electronics marketplace, and verified member directory into a cohesive portal.' },
  ];

  return (
    <div className="space-y-16 pb-16">
      {/* Editorial Header */}
      <section className="text-center max-w-4xl mx-auto px-4 pt-4">
        <span className="text-emerald-600 font-extrabold text-xs tracking-widest uppercase mb-3 block">
          OUR MISSION & COGNIZANCE
        </span>
        <h1 className="text-4xl sm:text-5xl font-black text-[#112a1d] tracking-tight leading-tight">
          Pioneering Sustainable Decarbonization Over Two Decades
        </h1>
        <p className="text-sm sm:text-base text-gray-500 mt-4 leading-relaxed max-w-2xl mx-auto">
          We represent Kenya’s collective renewable energy stakeholders, advocating for policy reforms that enable rapid local adoption of reliable, certified off-grid and grid-connected systems.
        </p>
      </section>

      {/* Two Column Layout: Historical Context */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <div className="lg:col-span-5 relative">
          <div className="aspect-square bg-slate-150 rounded-2xl overflow-hidden shadow-lg border border-slate-200">
            <img 
              src="https://images.unsplash.com/photo-1548543604-a87a9989fd0f?auto=format&fit=crop&w=800&q=80" 
              alt="Technicians on field" 
              className="w-full h-full object-cover"
              referrerPolicy="no-referrer"
            />
          </div>
          <div className="absolute -bottom-6 -right-6 p-6 bg-gradient-to-br from-amber-500 to-orange-500 text-white rounded-2xl shadow-xl max-w-xs">
            <p className="text-3xl font-black">22+ Years</p>
            <p className="text-xs font-bold uppercase tracking-wider mt-1 text-amber-100">Lobby Leadership</p>
            <p className="text-[10px] text-white/90 mt-1 leading-relaxed">Formed under a non-partisan mandate to empower local green tech builders.</p>
          </div>
        </div>

        <div className="lg:col-span-7 space-y-6">
          <h2 className="text-3xl font-extrabold text-[#112a1d]">The Apex Body of Clean Energy in Kenya</h2>
          <p className="text-sm text-gray-500 leading-relaxed">
            The Kenya Renewable Energy Association (KEREA) is a non-governmental, non-profit organization registered in the Republic of Kenya as a member-driven trade society. KEREA represents the interest of national and international manufacturers, distributors, certified installers, and researchers dealing with solar PV, wind, small hydro, and biomass systems.
          </p>
          <p className="text-sm text-gray-500 leading-relaxed">
            Our strategic partnerships align directly with the Energy and Petroleum Regulatory Authority (EPRA), Kenya Bureau of Standards (KEBS), and the Ministry of Energy. We work as a unified front to facilitate public-private dialogue, eliminate low-grade counter-feit components, and upskill local youth.
          </p>

          <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
            <div className="flex gap-3 items-start">
              <CheckCircle className="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" />
              <div>
                <h4 className="text-xs font-bold text-[#112a1d]">EPRA Assessed Syllabus</h4>
                <p className="text-[11px] text-gray-400 mt-0.5">Assuring you of legitimate, recognized certification Prep.</p>
              </div>
            </div>
            <div className="flex gap-3 items-start">
              <CheckCircle className="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" />
              <div>
                <h4 className="text-xs font-bold text-[#112a1d]">KEBS-Approved Testing</h4>
                <p className="text-[11px] text-gray-400 mt-0.5">Assisting manufacturers in testing equipment lines.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Solid Grid Core Values Section */}
      <section className="bg-slate-100/60 py-16 rounded-3xl mx-4 sm:mx-6 lg:mx-8">
        <div className="max-w-7xl mx-auto px-6 sm:px-8">
          <div className="text-center max-w-2xl mx-auto mb-10">
            <h2 className="text-2xl sm:text-3xl font-extrabold text-[#112a1d]">Core Organizational Ideals</h2>
            <p className="text-xs text-gray-400 mt-1">Foundational tenets driving our staff, committees, and verified members.</p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {coreValues.map((val, idx) => {
              const Icon = val.icon;
              return (
                <div key={idx} className="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex gap-4">
                  <div className="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <Icon className="w-5 h-5" />
                  </div>
                  <div className="space-y-1">
                    <h3 className="text-sm font-bold text-[#112a1d]">{val.title}</h3>
                    <p className="text-xs text-gray-400 leading-relaxed">{val.desc}</p>
                  </div>
                </div>
              );
            })}
          </div>
        </div>
      </section>

      {/* Historical Milestones Vertical Timeline */}
      <section className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-12">
          <h2 className="text-2xl sm:text-3xl font-extrabold text-[#112a1d]">Our Operational Milestones</h2>
          <p className="text-xs text-gray-400 mt-1">Celebrating historic lobbies and industry-shifting wins</p>
        </div>

        <div className="relative border-l border-slate-200 ml-4 md:ml-32 space-y-8 pb-4">
          {executiveMilestones.map((ms, idx) => (
            <div key={idx} className="relative pl-8 group">
              {/* Bullet node on timeline */}
              <div className="absolute -left-3.5 top-0 w-7 h-7 bg-white rounded-full border-2 border-emerald-600 flex items-center justify-center text-emerald-600 scale-90 group-hover:scale-100 transition-transform">
                <Milestone className="w-3" />
              </div>

              {/* Float Year Indicator Left on desktop */}
              <span className="hidden md:block absolute -left-32 top-0.5 text-right w-24 text-sm font-black text-emerald-600 font-mono">
                {ms.year}
              </span>

              <div className="bg-white p-5 rounded-2xl border border-slate-150 shadow-sm">
                <span className="inline-block md:hidden text-xs font-black text-emerald-600 font-mono mb-1">
                  Year {ms.year}
                </span>
                <h3 className="text-sm font-bold text-[#112a1d]">{ms.title}</h3>
                <p className="text-xs text-gray-400 mt-1 leading-relaxed">{ms.desc}</p>
              </div>
            </div>
          ))}
        </div>
      </section>
    </div>
  );
}
