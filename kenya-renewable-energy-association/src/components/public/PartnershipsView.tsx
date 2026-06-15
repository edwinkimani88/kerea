import React, { useState } from 'react';
import { Globe, Shield, Landmark, MapPin, Handshake } from 'lucide-react';

type SubView = 'collab' | 'strategic' | 'regional';

export default function PartnershipsView() {
  const [activeTab, setActiveTab] = useState<SubView>('collab');

  return (
    <div className="space-y-12 pb-16">
      {/* Page Header */}
      <section className="text-center max-w-3xl mx-auto px-4 pt-4">
        <span className="text-emerald-600 font-extrabold text-xs tracking-widest uppercase mb-3 block">
          EAST-AFRICAN & INTERNATIONAL NETWORKS
        </span>
        <h1 className="text-3xl sm:text-4xl font-black text-[#112a1d] tracking-tight">
          Africa–Global Partnerships Hub
        </h1>
        <p className="text-xs sm:text-sm text-gray-500 mt-2">
          Bridging local trade capacities with international technology associations, financial institutions, and global clean energy working groups.
        </p>
      </section>

      {/* Tabs Navigation */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap justify-start sm:justify-center gap-1 sm:gap-4 scrollbar-none">
          <button
            onClick={() => setActiveTab('collab')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'collab'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            International Collaborations
          </button>
          <button
            onClick={() => setActiveTab('strategic')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'strategic'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Strategic Partners
          </button>
          <button
            onClick={() => setActiveTab('regional')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'regional'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Regional Programs
          </button>
        </div>
      </section>

      {/* Main Context Grid */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {activeTab === 'collab' && (
          <div className="max-w-4xl mx-auto space-y-6">
            <div className="p-6 bg-[#112a1d] text-white rounded-2xl relative overflow-hidden">
              <h3 className="text-base font-bold flex items-center gap-2"><Globe className="w-5 h-5 text-amber-400" /> Connecting with European Solar Trade Federations</h3>
              <p className="text-xs text-emerald-100/90 mt-2.5 leading-relaxed">
                KEREA maintains a formal mutual support memorandum with several European trade groups (such as SolarPower Europe). This connection facilitates technology exchanges, inviting expert technical auditors to lead training sessions on grid-tie and battery storage safety specifications.
              </p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div className="p-5 bg-white border border-slate-100 rounded-xl space-y-2">
                <h4 className="text-xs font-black text-emerald-700 uppercase">German Development Cooperation (GIZ)</h4>
                <p className="text-xs text-gray-500 leading-relaxed">Sponsoring technical syllabus upgrades and providing top-grade laboratory measuring tools for KEREA technical hubs.</p>
              </div>
              <div className="p-5 bg-white border border-slate-100 rounded-xl space-y-2">
                <h4 className="text-xs font-black text-emerald-700 uppercase">Power Africa (USAID)</h4>
                <p className="text-xs text-gray-500 leading-relaxed">Enabling access to transaction advisory resources for developers seeking mini-grid license authorization files.</p>
              </div>
            </div>
          </div>
        )}

        {activeTab === 'strategic' && (
          <div className="max-w-4xl mx-auto space-y-6">
            <div className="bg-slate-50 border border-slate-150 p-6 rounded-2xl">
              <h3 className="text-sm font-extrabold text-[#112a1d] flex items-center gap-2">
                <Handshake className="w-5 h-5 text-emerald-700" /> Strategic Local Ministry Affiliations
              </h3>
              <p className="text-xs text-slate-500 mt-2 leading-relaxed">
                As the peak renewable trade body, KEREA sits as an active technical advisory panelist on the Ministry of Energy’s National Electrification Strategy meetings. We also collaborate with energy researchers at Strathmore University (SERC) and the Jomo Kenyatta University of Agriculture and Technology (JKUAT).
              </p>
            </div>
          </div>
        )}

        {activeTab === 'regional' && (
          <div className="max-w-4xl mx-auto space-y-6">
            <div className="p-6 bg-white border border-slate-100 rounded-2xl space-y-4">
              <h3 className="text-base font-extrabold text-[#112a1d]">The East African Renewable Energy Association Council</h3>
              <p className="text-xs text-slate-500 leading-relaxed">
                By uniting with sister renewable energy societies in Uganda (UNREEEA) and Tanzania (TAREA), KEREA helps form the East African Renewable Energy Association Council. This tripartite alliance works together to harmonize off-grid technical standards across the East African Community, ensuring smooth cross-border equipment trade.
              </p>
              <div className="flex gap-4 pt-3 border-t border-slate-50 text-[10px] text-gray-400">
                <span>Total Shared Population: 150 Million+</span> • <span>Regional Grid Goal: 95% Green</span>
              </div>
            </div>
          </div>
        )}
      </section>

    </div>
  );
}
