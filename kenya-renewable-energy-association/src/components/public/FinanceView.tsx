import React, { useState } from 'react';
import { CircleDollarSign, Coins, TrendingUp, HandCoins, ExternalLink, HelpCircle, ArrowRight } from 'lucide-react';

type SubView = 'programs' | 'opportunities' | 'partners';

export default function FinanceView() {
  const [activeTab, setActiveTab] = useState<SubView>('programs');

  const financingPrograms = [
    { name: 'KEREA Green Credit Line (Co-op Bank)', rate: '11% p.a. Fixed', coverage: 'Up to KES 20M', bestFor: 'Installer solar panels capital inventories and warehouse imports.' },
    { name: 'SunRef East Africa Energy Facility', rate: '9.5% p.a. (Flexible Dev)', coverage: 'KES 10M - 150M', bestFor: 'Commercial & Industrial (C&I) solar plant and mini-grid setups.' },
    { name: 'Agri-Solar Dairy Grant Fund (GIZ co-sponsor)', rate: '0% interest (50% Subsidized)', coverage: 'Up to KES 3M', bestFor: 'Solar milk chillers, cold stores, and solar irrigation pumps.' }
  ];

  return (
    <div className="space-y-12 pb-16">
      {/* Editorial Header */}
      <section className="text-center max-w-3xl mx-auto px-4 pt-4">
        <span className="text-emerald-600 font-extrabold text-xs tracking-widest uppercase mb-3 block">
          FINANCIAL INCLUSION & GREEN CAPITAL
        </span>
        <h1 className="text-3xl sm:text-4xl font-black text-[#112a1d] tracking-tight">
          Access to Finance Directory
        </h1>
        <p className="text-xs sm:text-sm text-gray-400 mt-2">
          Expanding deployment of high-cost solar arrays by connecting local installers and smallholders directly with compliant green banking credit lines and multilateral development grants.
        </p>
      </section>

      {/* Internal Navigation Subtabs */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap justify-start sm:justify-center gap-1 sm:gap-4 scrollbar-none">
          <button
            onClick={() => setActiveTab('programs')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'programs'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Financing Programs
          </button>
          <button
            onClick={() => setActiveTab('opportunities')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'opportunities'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Investment Opportunities
          </button>
          <button
            onClick={() => setActiveTab('partners')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'partners'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Funding Partners
          </button>
        </div>
      </section>

      {/* View Rendering */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {activeTab === 'programs' && (
          <div className="space-y-6 max-w-4xl mx-auto">
            <div className="p-6 bg-slate-50 border border-slate-150 rounded-2xl">
              <h3 className="text-base font-extrabold text-[#112a1d]">The Green Funding Landscape in Kenya</h3>
              <p className="text-xs text-slate-500 mt-2 leading-relaxed">
                By grouping small installers under the KEREA Directory umbrella, we enable access to syndicated lines of credit that was previously impossible for smaller organizations. Below are commercial partners participating in our current loan guarantee scheme.
              </p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
              {financingPrograms.map((prog, idx) => (
                <div key={idx} className="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
                  <div>
                    <span className="text-[9px] font-black uppercase text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">
                      CREDIT FACILITY
                    </span>
                    <h4 className="text-sm font-black text-[#112a1d] mt-3 leading-snug">{prog.name}</h4>
                    <div className="mt-4 space-y-1 text-xs">
                      <p className="text-slate-500"><strong className="text-emerald-800">Interest:</strong> {prog.rate}</p>
                      <p className="text-slate-500"><strong className="text-emerald-800">Limit:</strong> {prog.coverage}</p>
                    </div>
                    <p className="text-xs text-gray-400 mt-3 leading-relaxed">{prog.bestFor}</p>
                  </div>
                  <button 
                    onClick={() => alert(`Redirecting safety coordinates to application dashboard for: ${prog.name}. (KEREA guarantee code matching applies)`)}
                    className="mt-6 w-full py-2 bg-emerald-50 hover:bg-[#112a1d] text-emerald-700 hover:text-white transition-all text-xs font-bold rounded-xl cursor-pointer text-center"
                  >
                    Apply Guarantee Code
                  </button>
                </div>
              ))}
            </div>
          </div>
        )}

        {activeTab === 'opportunities' && (
          <div className="max-w-4xl mx-auto space-y-6">
            <div className="p-6 bg-[#112a1d] text-white rounded-2xl">
              <h3 className="text-base font-bold">Lamu County Solar Microgrid Concession Tender 2026</h3>
              <p className="text-xs text-slate-200 mt-2 leading-relaxed">
                A consortium of development finance partners has allocated KES 240,000,000 for off-grid hybrid solar microgrid concessions in Lamu East subcounty islands. KEREA is coordinating supplier match-making. To participate as a primary engineering compliance contractor, you must hold a verified KEREA Directory membership and EPRA class T3.
              </p>
              <button 
                onClick={() => alert('Accessing secure concession packet documents...')}
                className="mt-4 px-4 py-2 bg-amber-500 text-white font-bold text-xs rounded-lg uppercase tracking-wider hover:opacity-95"
              >
                Download Concession RFP packet (3.1 MB)
              </button>
            </div>
          </div>
        )}

        {activeTab === 'partners' && (
          <div className="max-w-4xl mx-auto space-y-6">
            <div className="text-center max-w-xl mx-auto">
              <h3 className="text-base font-extrabold text-[#112a1d]">Global Multilateral & Local Private Backers</h3>
              <p className="text-xs text-gray-500 mt-1">Foundations and cooperative networks backing KEREA green credit guarantee programs.</p>
            </div>

            <div className="grid grid-cols-2 sm:grid-cols-4 gap-6">
              <div className="p-4 bg-slate-50 border border-slate-100 rounded-xl text-center">
                <p className="text-xs font-bold text-[#112a1d]">GIZ East Africa</p>
                <p className="text-[9px] text-gray-400">Technical Grants</p>
              </div>
              <div className="p-4 bg-slate-50 border border-slate-100 rounded-xl text-center">
                <p className="text-xs font-bold text-[#112a1d]">FSD Kenya</p>
                <p className="text-[9px] text-gray-400">Financing Inclusions</p>
              </div>
              <div className="p-4 bg-slate-50 border border-slate-100 rounded-xl text-center">
                <p className="text-xs font-bold text-[#112a1d]">Equity Group</p>
                <p className="text-[9px] text-gray-400">Commercial Credits</p>
              </div>
              <div className="p-4 bg-slate-50 border border-slate-100 rounded-xl text-center">
                <p className="text-xs font-bold text-[#112a1d]">Acan Energy Fund</p>
                <p className="text-[9px] text-gray-400">Venture Equity</p>
              </div>
            </div>
          </div>
        )}
      </section>

    </div>
  );
}
