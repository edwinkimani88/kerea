import React, { useState } from 'react';
import { UserCheck, Linkedin, Briefcase, Award, X, Mail } from 'lucide-react';
import { motion, AnimatePresence } from 'motion/react';

interface Director {
  id: string;
  name: string;
  role: string;
  companyName: string;
  bio: string;
  imageUrl: string;
  linkedin: string;
  expertise: string[];
}

export default function LeadershipView() {
  const [selectedDirector, setSelectedDirector] = useState<Director | null>(null);

  const directors: Director[] = [
    {
      id: 'dir-1',
      name: 'Eng. Leonard Kimotho, PhD',
      role: 'National Chairman',
      companyName: 'Kenya Grid Advisors',
      bio: 'Eng. Leonard is an energy systems analyst with 25+ years of strategic leadership. He has served as a key consultant to the Ministry of Energy, advising on the feed-in tariffs restructuring and microgrids regulatory frameworks. He holds a PhD in electrical engineering from the University of Nairobi.',
      imageUrl: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=300&q=80',
      linkedin: 'https://linkedin.com',
      expertise: ['Policy Formulation', 'Grid Integration', 'Solar Pv Sizing']
    },
    {
      id: 'dir-2',
      name: 'Dr. Stella Karimi',
      role: 'Vice Chairperson & Policy Advisor',
      companyName: 'Strathmore Energy Centre',
      bio: 'Dr. Stella is an expert on decentralized micro-credit schemes in Eastern Africa. She leads numerous international bioenergy initiatives funded by GIZ and USAID. Stella coordinates KEREA’s public sector lobbying on Value Added Tax (VAT) and duty exoneratons on backup components.',
      imageUrl: 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=300&q=80',
      linkedin: 'https://linkedin.com',
      expertise: ['Green Finance Lobbying', 'Biomass Standards', 'NEMA Liaison']
    },
    {
      id: 'dir-3',
      name: 'Caleb Kiprono',
      role: 'Treasurer & Compliance Director',
      companyName: 'Apex Clean Energy Ltd',
      bio: 'Caleb possesses extensive venture finance expertise. He monitors budgets for donor-funded projects while verifying that KEREA member companies adhere to anti-dumping standards and maintain local technician worker protections.',
      imageUrl: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=300&q=80',
      linkedin: 'https://linkedin.com',
      expertise: ['Ecosystem Audits', 'Capital Sourcing', 'ESGs Metrics']
    },
    {
      id: 'dir-4',
      name: 'Eng. Beatrice Mwende',
      role: 'Technical & Standards Sub-Committee Lead',
      companyName: 'Equator Offgrids',
      bio: 'Eng. Beatrice Mwende leads KEREA’s collaboration with the Kenya Bureau of Standards (KEBS). She is an expert on photovoltaic safety codes and previously spent a decade managing hybrid power stations in northern counties (Marsabit, Turkana).',
      imageUrl: 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=300&q=80',
      linkedin: 'https://linkedin.com',
      expertise: ['KEBS Alignment', 'EPRA Technical Accreditations', 'Wind Microgrids']
    }
  ];

  return (
    <div className="space-y-12 pb-16">
      {/* Page Header */}
      <section className="text-center max-w-3xl mx-auto px-4 pt-4">
        <span className="text-amber-600 font-extrabold text-xs tracking-widest uppercase mb-3 block">
          GOVERNANCE & STEWARDSHIP
        </span>
        <h1 className="text-3xl sm:text-4xl font-black text-[#112a1d] tracking-tight">
          Board of Directors & Executive Committee
        </h1>
        <p className="text-xs sm:text-sm text-gray-500 mt-2">
          KEREA operates under a transparent, constitutionally governed board elected by corporate and premium members during our Annual General Meeting.
        </p>
      </section>

      {/* Directors Grid */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
          {directors.map((dir) => (
            <div 
              key={dir.id}
              className="bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-lg transition-all flex flex-col justify-between group"
            >
              <div>
                {/* Standardized Headshot Frame */}
                <div className="h-64 w-full overflow-hidden relative bg-slate-100">
                  <img 
                    src={dir.imageUrl} 
                    alt={dir.name}
                    className="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-300"
                    referrerPolicy="no-referrer"
                  />
                  <div className="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                  <div className="absolute bottom-3 left-3 text-white">
                    <p className="text-[10px] font-bold tracking-widest text-amber-300 uppercase">{dir.role}</p>
                    <p className="text-[#112a1d] font-semibold invisible">Placeholder</p>
                  </div>
                </div>

                {/* Director Summary Info */}
                <div className="p-5">
                  <h3 className="text-sm font-black text-[#112a1d] tracking-tight">{dir.name}</h3>
                  <p className="text-[11px] text-gray-400 font-medium mt-1 uppercase flex items-center gap-1">
                    <Briefcase className="w-3 h-3 text-emerald-600" /> {dir.companyName}
                  </p>
                  
                  {/* Expertise mini badges */}
                  <div className="flex flex-wrap gap-1 mt-4">
                    {dir.expertise.slice(0, 2).map((exp, i) => (
                      <span key={i} className="text-[9px] font-bold bg-slate-50 text-emerald-800 border border-emerald-100/40 px-2 py-0.5 rounded">
                        {exp}
                      </span>
                    ))}
                  </div>
                </div>
              </div>

              {/* Interaction Details Trigger Button */}
              <div className="p-5 pt-0">
                <button
                  onClick={() => setSelectedDirector(dir)}
                  className="w-full py-2 bg-emerald-50 hover:bg-emerald-600 active:scale-[0.98] text-emerald-700 hover:text-white transition-all text-xs font-bold rounded-xl cursor-pointer block text-center"
                >
                  View Executive Bio
                </button>
              </div>
            </div>
          ))}
        </div>
      </section>

      {/* Advisory Commitment Quote Card */}
      <section className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="bg-slate-50 border border-slate-150 rounded-2xl p-6 sm:p-8 flex flex-col md:flex-row gap-6 items-center">
          <div className="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-700">
            <UserCheck className="w-8 h-8" />
          </div>
          <div className="space-y-1 text-center md:text-left">
            <h4 className="text-sm font-extrabold text-[#112a1d]">The KEREA Advisory Code</h4>
            <p className="text-xs text-slate-500 leading-relaxed max-w-3xl">
              "We pledge absolute conflict-of-interest disclosures across all standard-setting sessions with government representatives, advocating for decentralized microgrid expansion based on technological merit and public impact, never private gains."
            </p>
          </div>
        </div>
      </section>

      {/* Bio Popup Overlay Dialog Frame (AnimatePresence) */}
      <AnimatePresence>
        {selectedDirector && (
          <motion.div 
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="fixed inset-0 z-55 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4"
          >
            <motion.div 
              initial={{ scale: 0.95 }}
              animate={{ scale: 1 }}
              exit={{ scale: 0.95 }}
              className="bg-white rounded-2xl max-w-lg w-full overflow-hidden shadow-2xl border border-slate-100 flex flex-col md:flex-row relative"
            >
              {/* Image Column */}
              <div className="w-full md:w-1/3 h-48 md:h-auto bg-slate-100 relative">
                <img 
                  src={selectedDirector.imageUrl} 
                  alt={selectedDirector.name}
                  className="w-full h-full object-cover object-top"
                  referrerPolicy="no-referrer"
                />
              </div>

              {/* Core bio contents */}
              <div className="p-6 md:w-2/3 space-y-4">
                <button 
                  onClick={() => setSelectedDirector(null)}
                  className="absolute top-4 right-4 p-1 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-500 cursor-pointer"
                >
                  <X className="w-4 h-4" />
                </button>

                <div>
                  <span className="text-[10px] font-bold text-amber-600 block uppercase tracking-widest">
                    {selectedDirector.role}
                  </span>
                  <h3 className="text-base font-black text-[#112a1d] tracking-tight">{selectedDirector.name}</h3>
                  <p className="text-xs text-gray-400 font-medium">{selectedDirector.companyName}</p>
                </div>

                <p className="text-xs text-gray-500 leading-relaxed font-sans mt-2">
                  {selectedDirector.bio}
                </p>

                <div className="space-y-2 pt-2 border-t border-slate-50">
                  <p className="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Technical Focus</p>
                  <div className="flex flex-wrap gap-1.5">
                    {selectedDirector.expertise.map((exp, i) => (
                      <span key={i} className="text-[9px] font-bold bg-[#112a1d] text-white px-2 py-0.5 rounded">
                        {exp}
                      </span>
                    ))}
                  </div>
                </div>

                <div className="pt-2 flex gap-4 text-xs font-bold text-slate-500">
                  <a href={selectedDirector.linkedin} target="_blank" rel="noreferrer" className="flex items-center gap-1 text-blue-600 hover:underline">
                    <Linkedin className="w-3.5 h-3.5" /> LinkedIn Profiler
                  </a>
                  <a href="mailto:info@kerea.org" className="flex items-center gap-1 hover:text-emerald-700">
                    <Mail className="w-3.5 h-3.5" /> Email Contact
                  </a>
                </div>

              </div>
            </motion.div>
          </motion.div>
        )}
      </AnimatePresence>
    </div>
  );
}
