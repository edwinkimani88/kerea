import React, { useState } from 'react';
import { Search, Filter, Phone, Mail, Award, MapPin, CheckCircle, PlusCircle, Sparkles } from 'lucide-react';
import { useAppState } from '../../context/AppStateContext';

type Subtype = 'all' | 'suppliers' | 'installers' | 'financiers';

interface MemberCard {
  name: string;
  type: 'Supplier' | 'Installer' | 'Financier';
  location: string;
  phone: string;
  email: string;
  epraLicensed: boolean;
  specialty: string;
  verifiedYear: number;
}

export default function DirectoryView() {
  const { logUserAction } = useAppState();
  const [activeTab, setActiveTab] = useState<Subtype>('all');
  const [searchQuery, setSearchQuery] = useState('');
  const [filterCounty, setFilterCounty] = useState('All');
  const [registrationFormOpen, setRegistrationFormOpen] = useState(false);
  const [regData, setRegData] = useState({ company: '', email: '', phone: '', type: 'Installer', licenseNum: '' });
  const [regSuccess, setRegSuccess] = useState(false);

  const members: MemberCard[] = [
    { name: 'Safi Solar Solutions Ltd', type: 'Supplier', location: 'Nairobi (Westlands)', phone: '+254 711 002233', email: 'sales@safisolar.co.ke', epraLicensed: true, specialty: 'C&I Solar PV Projects & Backup Batteries', verifiedYear: 2024 },
    { name: 'EcoPower Bioenergy Systems', type: 'Supplier', location: 'Kisumu City', phone: '+254 722 334455', email: 'info@ecopower.or.ke', epraLicensed: false, specialty: 'PVC composite domestic biodigesters & biomass briquettes', verifiedYear: 2025 },
    { name: 'Eng. Caleb Wafula', type: 'Installer', location: 'Nairobi (Eastlands)', phone: '+254 700 889922', email: 'caleb@kerea.org', epraLicensed: true, specialty: 'Class T1 & T2 Residential solar microgrids advisor', verifiedYear: 2024 },
    { name: 'Stella Karimi energy consultancy', type: 'Installer', location: 'Nakuru (Town)', phone: '+254 712 345678', email: 'stella@strathmore.edu', epraLicensed: true, specialty: 'Class T3 Specialist grid-tie calculations', verifiedYear: 2021 },
    { name: 'Cooperative Bank of Kenya', type: 'Financier', location: 'Nairobi (CBD)', phone: '+254 711 049000', email: 'greencredit@co-opbank.co.ke', epraLicensed: false, specialty: 'Green Credit Lines & SME capital guarantees', verifiedYear: 2024 },
    { name: 'Acan Renewable Energy Fund', type: 'Financier', location: 'Mombasa (Town)', phone: '+254 733 112233', email: 'deals@acanfund.com', epraLicensed: false, specialty: 'Rural multi-grid project development venture equity', verifiedYear: 2025 }
  ];

  const filteredMembers = members.filter(m => {
    // Tab filter
    if (activeTab === 'suppliers' && m.type !== 'Supplier') return false;
    if (activeTab === 'installers' && m.type !== 'Installer') return false;
    if (activeTab === 'financiers' && m.type !== 'Financier') return false;

    // Search query filter
    if (searchQuery) {
      const query = searchQuery.toLowerCase();
      const matchName = m.name.toLowerCase().includes(query);
      const matchSpec = m.specialty.toLowerCase().includes(query);
      if (!matchName && !matchSpec) return false;
    }

    // County filter
    if (filterCounty !== 'All') {
      if (!m.location.includes(filterCounty)) return false;
    }

    return true;
  });

  const handleRegisterSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!regData.company || !regData.email) return;

    logUserAction('Directory Application', `Company ${regData.company} applied for member alignment as [${regData.type}]`);
    setRegSuccess(true);
    setTimeout(() => {
      setRegSuccess(false);
      setRegistrationFormOpen(false);
      setRegData({ company: '', email: '', phone: '', type: 'Installer', licenseNum: '' });
    }, 2500);
  };

  return (
    <div className="space-y-12 pb-16">
      {/* Editorial Header */}
      <section className="text-center max-w-3xl mx-auto px-4 pt-4">
        <span className="text-emerald-600 font-extrabold text-xs tracking-widest uppercase mb-3 block">
          VERIFIED DIRECTORY & REGISTRY AUDITS
        </span>
        <h1 className="text-3xl sm:text-4xl font-black text-[#112a1d] tracking-tight">
          KEREA Certified Member Directory
        </h1>
        <p className="text-xs sm:text-sm text-gray-500 mt-2">
          Find and verify legitimate solar suppliers, EPRA-licensed technical installers, or qualified development green financiers active across all 47 counties of Kenya.
        </p>
      </section>

      {/* Internal Navigation Subtabs */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap justify-start sm:justify-center gap-1 sm:gap-4 scrollbar-none">
          <button
            onClick={() => setActiveTab('all')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'all'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            All Members ({filteredMembers.length})
          </button>
          <button
            onClick={() => setActiveTab('suppliers')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'suppliers'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Suppliers / Vendors
          </button>
          <button
            onClick={() => setActiveTab('installers')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'installers'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Licensed Installers
          </button>
          <button
            onClick={() => setActiveTab('financiers')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'financiers'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Financiers (Green Credit)
          </button>
        </div>
      </section>

      {/* Controls: Search Bar and County Dropdown */}
      <section className="max-w-4xl mx-auto px-4 flex flex-col sm:flex-row gap-4">
        <div className="flex-1 relative">
          <Search className="absolute left-4 top-3.5 w-5 h-5 text-gray-300 pointer-events-none" />
          <input
            type="text"
            value={searchQuery}
            onChange={e => setSearchQuery(e.target.value)}
            placeholder="Search company or installer name, specialty..."
            className="w-full text-xs pl-12 pr-6 py-4 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none bg-white shadow-sm"
          />
        </div>

        <div className="sm:w-60 relative">
          <select
            value={filterCounty}
            onChange={e => setFilterCounty(e.target.value)}
            className="w-full text-xs p-4 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none bg-white appearance-none pr-10 shadow-sm font-bold text-slate-700"
          >
            <option value="All">All Counties</option>
            <option value="Nairobi">Nairobi</option>
            <option value="Kisumu">Kisumu</option>
            <option value="Mombasa">Mombasa</option>
            <option value="Nakuru">Nakuru</option>
          </select>
          <Filter className="absolute right-4 top-4.5 w-4 h-4 text-gray-400 pointer-events-none" />
        </div>
      </section>

      {/* Directory Cards list */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {filteredMembers.length > 0 ? (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {filteredMembers.map((member, i) => (
              <div 
                key={i} 
                className="bg-white rounded-2xl p-5 border border-slate-100 hover:border-emerald-500/20 shadow-sm transition-all flex flex-col justify-between"
              >
                <div>
                  <div className="flex items-center justify-between mb-4">
                    <span className="text-[9px] uppercase font-black px-2 py-0.5 rounded bg-slate-50 border border-slate-200 text-slate-700">
                      {member.type}
                    </span>
                    {member.epraLicensed && (
                      <span className="inline-flex items-center gap-1 text-[9px] font-black text-emerald-800 bg-emerald-50 px-2 py-0.5 border border-emerald-100 rounded">
                        <CheckCircle className="w-3 h-3 text-emerald-600" /> EPRA LICENSED
                      </span>
                    )}
                  </div>

                  <h3 className="text-sm font-black text-[#112a1d]">{member.name}</h3>
                  <p className="text-xs text-slate-500 mt-2 leading-relaxed">{member.specialty}</p>

                  <div className="pt-4 mt-4 border-t border-slate-50 space-y-2 text-[11px] text-gray-400">
                    <p className="flex items-center gap-2">
                      <MapPin className="w-4 h-4 text-slate-300 shrink-0" /> {member.location}
                    </p>
                    <p className="flex items-center gap-2">
                      <Phone className="w-4 h-4 text-slate-300 shrink-0" /> {member.phone}
                    </p>
                    <p className="flex items-center gap-2">
                      <Mail className="w-4 h-4 text-slate-300 shrink-0" /> {member.email}
                    </p>
                  </div>
                </div>

                <div className="mt-5 pt-3 border-t border-slate-50 flex items-center justify-between text-[10px] text-gray-400 font-mono">
                  <span>Registered: Sync {member.verifiedYear}</span>
                  <span className="text-emerald-700 font-bold">KEREA Audit Verified</span>
                </div>

              </div>
            ))}
          </div>
        ) : (
          <div className="text-center py-16 bg-white border border-slate-100 rounded-2xl max-w-sm mx-auto">
            <Search className="w-12 h-12 text-slate-300 mx-auto mb-2" />
            <h4 className="text-xs font-bold text-gray-500">No member accounts matched</h4>
            <p className="text-[11px] text-gray-400">Try relaxing query terms or selecting All Counties.</p>
          </div>
        )}
      </section>

      {/* Registry sign-up Call to Action banner */}
      <section className="max-w-4xl mx-auto px-4">
        <div className="bg-[#112a1d] text-white rounded-2xl p-6 sm:p-8 flex flex-col sm:flex-row justify-between items-center gap-6 relative overflow-hidden">
          <div className="absolute top-0 right-0 w-32 h-32 bg-amber-500/10 rounded-full blur-2xl"></div>
          <div className="space-y-1.5">
            <h3 className="text-base sm:text-lg font-bold flex items-center gap-2"><Sparkles className="w-5 h-5 text-amber-400" /> Are You an EPRA Licensed contractor?</h3>
            <p className="text-xs text-emerald-100/85 max-w-xl">
              Apply to join KEREAs official online public registry to unlock green credit guarantee guarantees, corporate RFPs, and verified buyer escrow matchmaking.
            </p>
          </div>
          <button
            onClick={() => setRegistrationFormOpen(true)}
            className="px-6 py-3 bg-amber-500 hover:bg-amber-600 active:scale-[0.98] text-white text-xs font-bold rounded-xl whitespace-nowrap transition-all cursor-pointer shadow shadow-amber-500/10 inline-flex items-center gap-1"
          >
            <PlusCircle className="w-4 h-4" /> Apply Now
          </button>
        </div>
      </section>

      {/* Directory Application Dialog form overlay */}
      {registrationFormOpen && (
        <div className="fixed inset-0 z-55 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
          <div className="bg-white rounded-2xl max-w-md w-full p-6 sm:p-8 relative border border-slate-100 shadow-2xl">
            <button 
              onClick={() => setRegistrationFormOpen(false)}
              className="absolute top-4 right-4 p-1 rounded hover:bg-slate-100 text-gray-400 cursor-pointer"
            >
              <PlusCircle className="w-5 h-5 rotate-45" />
            </button>

            {regSuccess ? (
              <div className="text-center py-6 space-y-4">
                <CheckCircle className="w-12 h-12 text-emerald-500 animate-bounce mx-auto" />
                <h3 className="text-base font-black text-[#112a1d]">Request Submitted!</h3>
                <p className="text-xs text-gray-400">The standards and verification sub-committee will review your submitted credentials and issue approval within 72 hours.</p>
              </div>
            ) : (
              <form onSubmit={handleRegisterSubmit} className="space-y-4">
                <div>
                  <span className="text-[9px] uppercase tracking-widest font-black text-amber-600 block">KEREA ADVISORY STANDARDS</span>
                  <h3 className="text-sm font-black text-[#112a1d] leading-snug mt-1">Directory Placement Request Form</h3>
                </div>

                <div className="space-y-3 pt-3">
                  <div>
                    <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Company / Professional Name</label>
                    <input 
                      type="text" 
                      required
                      value={regData.company}
                      onChange={e => setRegData({...regData, company: e.target.value})}
                      placeholder="e.g. Soko Solar Constructors" 
                      className="w-full text-xs p-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none"
                    />
                  </div>
                  <div>
                    <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Commercial Email Address</label>
                    <input 
                      type="email" 
                      required
                      value={regData.email}
                      onChange={e => setRegData({...regData, email: e.target.value})}
                      placeholder="e.g. registry@sokosolar.co.ke" 
                      className="w-full text-xs p-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none"
                    />
                  </div>
                  <div className="grid grid-cols-2 gap-3">
                    <div>
                      <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Phone Number</label>
                      <input 
                        type="tel" 
                        required
                        value={regData.phone}
                        onChange={e => setRegData({...regData, phone: e.target.value})}
                        placeholder="+254" 
                        className="w-full text-xs p-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none"
                      />
                    </div>
                    <div>
                      <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Member Category</label>
                      <select 
                        value={regData.type}
                        onChange={e => setRegData({...regData, type: e.target.value})}
                        className="w-full text-xs p-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none"
                      >
                        <option value="Supplier">Supplier / Merchant</option>
                        <option value="Installer">EPRA Installer</option>
                        <option value="Financier">Financier</option>
                      </select>
                    </div>
                  </div>
                  {regData.type === 'Installer' && (
                    <div>
                      <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">EPRA License Number</label>
                      <input 
                        type="text" 
                        value={regData.licenseNum}
                        onChange={e => setRegData({...regData, licenseNum: e.target.value})}
                        placeholder="e.g. EPRA/SPV/00452 Class T2" 
                        className="w-full text-xs p-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none"
                      />
                    </div>
                  )}
                </div>

                <p className="text-[10px] text-gray-400 leading-relaxed font-sans">
                  *By submitting this form, you represent that you observe KEREAs standard codes of ethics and do not install counterfeits. Sub-committee checks count.
                </p>

                <button
                  type="submit"
                  className="w-full py-3 bg-[#112a1d] hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition-all cursor-pointer"
                >
                  Submit Registry credentials
                </button>
              </form>
            )}

          </div>
        </div>
      )}

    </div>
  );
}
