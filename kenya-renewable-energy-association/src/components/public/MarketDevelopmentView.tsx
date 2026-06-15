import React, { useState } from 'react';
import { TrendingUp, Award, Compass, Heart, ArrowRight, HelpCircle } from 'lucide-react';

type SubView = 'intelligence' | 'pure' | 'initiatives';

export default function MarketDevelopmentView() {
  const [activeTab, setActiveTab] = useState<SubView>('intelligence');

  return (
    <div className="space-y-12 pb-16">
      {/* Page Header */}
      <section className="text-center max-w-3xl mx-auto px-4 pt-4">
        <span className="text-amber-600 font-extrabold text-xs tracking-widest uppercase mb-3 block">
          ECOSYSTEM INTELLIGENCE & PRODUCTIVE TOOLS
        </span>
        <h1 className="text-3xl sm:text-4xl font-black text-[#112a1d] tracking-tight">
          Market Development & PURE Info Desk
        </h1>
        <p className="text-xs sm:text-sm text-gray-500 mt-2">
          Coordinating offgrid market research while developing standards for active Productive Use of Renewable Energy (PURE) equipment inside remote countys.
        </p>
      </section>

      {/* Internal Navigation Tabs */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap justify-start sm:justify-center gap-1 sm:gap-4 scrollbar-none">
          <button
            onClick={() => setActiveTab('intelligence')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'intelligence'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Market Intelligence
          </button>
          <button
            onClick={() => setActiveTab('pure')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'pure'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Productive Use of Energy (PURE)
          </button>
          <button
            onClick={() => setActiveTab('initiatives')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'initiatives'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Sector Initiatives
          </button>
        </div>
      </section>

      {/* View Selector Contents */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {activeTab === 'intelligence' && (
          <div className="max-w-4xl mx-auto space-y-6">
            <div className="p-6 bg-slate-50 border border-slate-150 rounded-2xl">
              <h3 className="text-base font-extrabold text-[#112a1d]">The 2026 Decentralized Solar import Volumes</h3>
              <p className="text-xs text-slate-500 mt-2 leading-relaxed">
                Our latest market intelligence compilation (collated together with GOGLA) shows import volumes of offgrid lighting systems in Kenya expanded by 14% year-on-year in 2025. This was led by solar home systems (SHS) with integrated multi-channel television screens. However, high currency depreciation continues to stress pricing matrices.
              </p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div className="p-5 bg-white border border-slate-100 rounded-xl">
                <h4 className="text-xs font-black text-emerald-700">Import Volume Metrics</h4>
                <p className="text-2xl font-black text-[#112a1d] mt-2">1.2 Million Units</p>
                <p className="text-xs text-gray-400 mt-1">Verified solar home kits distributed under our standards.</p>
              </div>
              <div className="p-5 bg-white border border-slate-100 rounded-xl">
                <h4 className="text-xs font-black text-amber-500">Fastest-Growing Sub-sector</h4>
                <p className="text-2xl font-black text-[#112a1d] mt-2">Agri-Solar (PURE)</p>
                <p className="text-xs text-gray-400 mt-1">Led by solar solar pumps, milk chillers, and corn shellers.</p>
              </div>
            </div>
          </div>
        )}

        {activeTab === 'pure' && (
          <div className="max-w-4xl mx-auto space-y-6">
            <div className="p-6 bg-[#112a1d] text-white rounded-2xl relative">
              <h3 className="text-lg font-bold">Unpacking Productive Use of Renewable Energy (PURE)</h3>
              <p className="text-xs text-emerald-100/80 mt-2 leading-relaxed">
                PURE refers to agricultural and small-business appliances powered by renewable solar systems that directly generate household income. By moving beyond simple home lighting towards cooling systems, solar water pumps, and electric grain milling, we are enabling agrarian families to add tangible value to cash crop harvests.
              </p>
            </div>

            <div className="bg-slate-50 border border-slate-150 p-6 rounded-2xl space-y-3">
              <h4 className="text-xs font-black text-[#112a1d]">The PURE Certification Stamp</h4>
              <p className="text-xs text-slate-500 leading-relaxed">
                To prevent rural buyers from buying low-powered DC motors that stall in heavy soil, KEREA works with researchers to rate and verify solar water pumps before they enter county trade fairs. Look for the "KEREA Verified PURE Sticker" upon purchase.
              </p>
            </div>
          </div>
        )}

        {activeTab === 'initiatives' && (
          <div className="max-w-4xl mx-auto space-y-6">
            <div className="p-6 bg-white border border-slate-100 rounded-2xl">
              <h3 className="text-sm font-extrabold text-[#112a1d]">The KEREA Solar Agri-concession Initiative</h3>
              <p className="text-xs text-slate-500 mt-2 leading-relaxed">
                Launched in partner counties (Meru, Embu, and Kirinyaga), this initiative subsidizes the initial deposit fees for verified farmers installing 1HP solar-powered water irrigation pumps. Participating solar distributors on our Marketplace directory can claim back subsidy amounts through local county treasury channels.
              </p>
              <div className="mt-4 pt-3 border-t border-slate-50 text-[11px] text-[#112a1d] font-bold">
                Concession funding pool: KES 45,000,000 available.
              </div>
            </div>
          </div>
        )}
      </section>

    </div>
  );
}
