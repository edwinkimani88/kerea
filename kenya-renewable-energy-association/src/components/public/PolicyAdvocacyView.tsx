import React, { useState } from 'react';
import { Gavel, FileText, CheckCircle, HelpCircle, ArrowRight, ShieldCheck, Download, Calendar } from 'lucide-react';
import { useAppState } from '../../context/AppStateContext';

type SubView = 'briefs' | 'submissions' | 'updates' | 'initiatives';

export default function PolicyAdvocacyView() {
  const [activeSubTab, setActiveSubTab] = useState<SubView>('briefs');
  const { publications, navigateTo } = useAppState();

  const handleDownload = (pubId: string) => {
    alert(`Downloading briefing guidelines for: ${pubId}.pdf (Redirecting to official resources...)`);
  };

  const dynamicBriefs = publications.filter(p => p.category === 'Policy Brief' || p.category === 'Regulation');

  return (
    <div className="space-y-12 pb-16">
      {/* Editorial Header */}
      <section className="text-center max-w-3xl mx-auto px-4 pt-4">
        <span className="text-emerald-600 font-extrabold text-xs tracking-widest uppercase mb-3 block">
          LOBBYING & REGULATORY OUTCOMES
        </span>
        <h1 className="text-3xl sm:text-4xl font-black text-[#112a1d] tracking-tight">
          Policy Advocacy & Legal Frameworks
        </h1>
        <p className="text-xs sm:text-sm text-gray-400 mt-2">
          KEREA lobbies national policymakers, the Senate, and EPRA to protect fiscal benefits and eliminate tariffs on energy storage.
        </p>
      </section>

      {/* Internal Navigation Subtabs */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap scrollbar-none justify-start sm:justify-center gap-1 sm:gap-4">
          <button
            onClick={() => setActiveSubTab('briefs')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeSubTab === 'briefs'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Policy Briefs ({dynamicBriefs.length})
          </button>
          <button
            onClick={() => setActiveSubTab('submissions')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeSubTab === 'submissions'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Submissions & Memos
          </button>
          <button
            onClick={() => setActiveSubTab('updates')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeSubTab === 'updates'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Regulatory Updates 2026
          </button>
          <button
            onClick={() => setActiveSubTab('initiatives')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeSubTab === 'initiatives'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Advocacy Campaigns
          </button>
        </div>
      </section>

      {/* Content Rendering base on active tab */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {activeSubTab === 'briefs' && (
          <div className="space-y-6">
            <div className="p-6 bg-slate-50 rounded-2xl border border-slate-100/60 max-w-4xl mx-auto">
              <h3 className="text-base font-extrabold text-[#112a1d]">The Impact of Storage VAT Exoneration</h3>
              <p className="text-xs text-gray-500 mt-2 leading-relaxed">
                Solar backup batteries are the single highest cost driver in off-grid solar designs. Our policy briefing outlines how removing the 16% standard VAT on lithium and lead-acid batteries will directly accelerate micro-irrigation and post-harvest dairy cooling by 220% in counties like Garissa, Marsabit, and Narok.
              </p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
              {dynamicBriefs.map(brief => (
                <div key={brief.id} className="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                  <div>
                    <span className="text-[9px] font-black tracking-widest text-[#112a1d] bg-amber-100 text-amber-900 px-2 py-0.5 rounded">
                      {brief.category}
                    </span>
                    <h4 className="text-sm font-black text-[#112a1d] mt-3 leading-snug">{brief.title}</h4>
                    <p className="text-xs text-gray-400 mt-1">Publisher: {brief.author}</p>
                  </div>
                  <div className="flex justify-between items-center mt-5 pt-3 border-t border-slate-50 text-[10px] text-gray-400">
                    <span>Year: {brief.publishedYear} • Size: {brief.fileSize}</span>
                    <button 
                      onClick={() => handleDownload(brief.id)}
                      className="text-emerald-600 font-bold flex items-center gap-1 hover:underline cursor-pointer"
                    >
                      <Download className="w-3.5 h-3.5" /> PDF
                    </button>
                  </div>
                </div>
              ))}
            </div>
          </div>
        )}

        {activeSubTab === 'submissions' && (
          <div className="max-w-4xl mx-auto space-y-6">
            <div className="p-6 bg-emerald-950 text-white rounded-2xl relative overflow-hidden">
              <h3 className="text-lg font-bold">Lobbying the Senate Sector Committee on Energy 2026</h3>
              <p className="text-xs text-emerald-100/80 mt-2 leading-relaxed">
                KEREA submitted a detailed advisory memo to the Senate regarding municipal energy concessions and county licensing duplication. We advocated for a single nationwide EPRA installer certification system, preventing county governments from levying duplicate annual trading licenses on solar contractors.
              </p>
            </div>

            <div className="border border-slate-100 rounded-2xl overflow-hidden bg-white">
              <div className="p-4 bg-slate-50 border-b border-slate-100 font-bold text-xs text-slate-700">
                Official Submission Dossiers
              </div>
              <div className="divide-y divide-slate-100">
                <div className="p-4 flex items-center justify-between">
                  <div>
                    <h4 className="text-xs font-bold text-[#112a1d]">Submission on Proposed EPRA Net-Metering Surcharge (Feb 2026)</h4>
                    <p className="text-[10px] text-gray-400">Status: Under Senate Committee Review • Submitted by KEREA Chairman</p>
                  </div>
                  <button onClick={() => alert('Opening Submission Document PDF...')} className="px-3 py-1.5 bg-emerald-50 hover:bg-emerald-600 hover:text-white text-emerald-700 text-[11px] font-bold rounded-lg cursor-pointer">
                    View Memo
                  </button>
                </div>
                <div className="p-4 flex items-center justify-between">
                  <div>
                    <h4 className="text-xs font-bold text-[#112a1d]">Position Statement regarding County Single-Business Permit solar double levies</h4>
                    <p className="text-[10px] text-gray-400">Status: Fully Adopted into Intergovernmental Council Memo</p>
                  </div>
                  <button onClick={() => alert('Opening Submission Document PDF...')} className="px-3 py-1.5 bg-emerald-50 hover:bg-emerald-600 hover:text-white text-emerald-700 text-[11px] font-bold rounded-lg cursor-pointer">
                    View Memo
                  </button>
                </div>
              </div>
            </div>
          </div>
        )}

        {activeSubTab === 'updates' && (
          <div className="max-w-4xl mx-auto space-y-6">
            <div className="text-center max-w-xl mx-auto">
              <h3 className="text-base font-extrabold text-[#112a1d]">EPRA & KEBS Regulatory Matrix 2026</h3>
              <p className="text-xs text-gray-500 mt-1">Real-time tracker of active and upcoming energy bills in Kenya.</p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
              <div className="p-5 bg-white border border-slate-100 rounded-2xl shadow-sm text-center">
                <ShieldCheck className="w-8 h-8 text-emerald-600 mx-auto mb-3" />
                <h4 className="text-xs font-black text-[#112a1d]">Net-Metering Code</h4>
                <p className="text-[11px] text-gray-400 mt-2">Active. Commercial consumers with solar grid-connections up to 1MW receive billing offset credits.</p>
              </div>
              <div className="p-5 bg-white border border-slate-100 rounded-2xl shadow-sm text-center">
                <Gavel className="w-8 h-8 text-amber-600 mx-auto mb-3" />
                <h4 className="text-xs font-black text-[#112a1d]">Battery VAT Abolition</h4>
                <p className="text-[11px] text-gray-400 mt-2">Pending enactment. Lobbied heavily inside Finance Bill 2026 to include energy storage modules.</p>
              </div>
              <div className="p-5 bg-white border border-slate-150 rounded-2xl shadow-sm text-center">
                <FileText className="w-8 h-8 text-emerald-600 mx-auto mb-3" />
                <h4 className="text-xs font-black text-[#112a1d]">EPRA Installer Penalties</h4>
                <p className="text-[11px] text-gray-400 mt-2">Active. Unlicensed technicians operating PV installations over 1kW suffer penal oversight.</p>
              </div>
            </div>
          </div>
        )}

        {activeSubTab === 'initiatives' && (
          <div className="max-w-4xl mx-auto space-y-6">
            <div className="bg-slate-50 border border-slate-150 p-6 rounded-2xl">
              <h3 className="text-sm font-extrabold text-[#112a1d]">Campaign: "Eliminate Solar Waste, Keep Kenya Green"</h3>
              <p className="text-xs text-slate-500 mt-2 leading-relaxed">
                As the solar home systems market grows exponentially, the challenge of solar e-waste (degraded lithium clusters and toxic lead plates) looms large. KEREA, together with regional counties, has launched Kenya's first Solar Electronics Recycling Initiative, collaborating with local scrap handlers to set up buy-back points in Nairobi, Nakuru, and Kisumu.
              </p>
              <div className="flex gap-4 mt-4 pt-3 border-t border-slate-150 text-[11px] text-slate-400 font-mono">
                <span>Start Date: April 2026</span> • <span>Impact Goal: 15 Metric Tons collected by Dec 2026</span>
              </div>
            </div>
          </div>
        )}
      </section>

    </div>
  );
}
