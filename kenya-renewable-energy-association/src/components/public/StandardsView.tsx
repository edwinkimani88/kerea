import React, { useState } from 'react';
import { ShieldCheck, HardDrive, Download, ArrowRight, HelpCircle, Server } from 'lucide-react';
import { useAppState } from '../../context/AppStateContext';

type SubTab = 'library' | 'resources' | 'compliance';

export default function StandardsView() {
  const [activeTab, setActiveTab] = useState<SubTab>('library');
  const { publications } = useAppState();

  const handleDownload = (pd: string) => {
    alert(`Access code request approved! Initializing safe PDF transfer and downloading: ${pd}.pdf`);
  };

  const techStandards = publications.filter(p => p.category === 'Technical Standard' || p.category === 'Guide');

  return (
    <div className="space-y-12 pb-16">
      {/* Page Header */}
      <section className="text-center max-w-3xl mx-auto px-4 pt-4">
        <span className="text-amber-600 font-extrabold text-xs tracking-widest uppercase mb-3 block">
          TECHNICAL INTEGRITY & QUALITY CODES
        </span>
        <h1 className="text-3xl sm:text-4xl font-black text-[#112a1d] tracking-tight">
          KEBS & EPRA Technical Standards
        </h1>
        <p className="text-xs sm:text-sm text-gray-400 mt-2">
          KEREA collaborates with the Kenya Bureau of Standards (KEBS) and the Energy & Petroleum Regulatory Authority to define installation codes for solar grids, wind mechanical pumps, and biogas digesters.
        </p>
      </section>

      {/* Tab Navigation */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap justify-start sm:justify-center gap-1 sm:gap-4 scrollbar-none">
          <button
            onClick={() => setActiveTab('library')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'library'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Standards Library ({techStandards.length})
          </button>
          <button
            onClick={() => setActiveTab('resources')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'resources'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Technical Resources
          </button>
          <button
            onClick={() => setActiveTab('compliance')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'compliance'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Compliance Documents
          </button>
        </div>
      </section>

      {/* Main Content Render area */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {activeTab === 'library' && (
          <div className="space-y-6">
            <div className="p-6 bg-slate-50 border border-slate-150 rounded-2xl max-w-4xl mx-auto">
              <h3 className="text-base font-extrabold text-[#112a1d]">The Official Kenya Solar PV Code of Practice</h3>
              <p className="text-xs text-slate-500 mt-2 leading-relaxed">
                Known officially as KS 1860, this document codifies requirements regarding grounding, DC surge protection, battery cell ventilation, and grid synchronization. Every registered installer represents that they adhere to this document during the execution of residential and corporate installations.
              </p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
              {techStandards.map(std => (
                <div key={std.id} className="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                  <div>
                    <span className="text-[9px] font-black uppercase text-[#112a1d] bg-emerald-50 text-emerald-900 border border-emerald-100/30 px-2 py-0.5 rounded">
                      {std.category}
                    </span>
                    <h4 className="text-sm font-black text-[#112a1d] mt-3 leading-snug">{std.title}</h4>
                    <p className="text-xs text-gray-400 mt-1">Compiled by: {std.author}</p>
                  </div>
                  <div className="flex justify-between items-center mt-5 pt-3 border-t border-slate-50 text-[10px] text-gray-400">
                    <span>Published: {std.publishedYear} • Size: {std.fileSize}</span>
                    <button 
                      onClick={() => handleDownload(std.id)}
                      className="text-emerald-700 font-bold flex items-center gap-1 hover:underline cursor-pointer text-xs"
                    >
                      <Download className="w-3.5 h-3.5" /> PDF
                    </button>
                  </div>
                </div>
              ))}
            </div>
          </div>
        )}

        {activeTab === 'resources' && (
          <div className="max-w-4xl mx-auto space-y-6">
            <div className="p-6 bg-[#112a1d] text-white rounded-2xl">
              <h3 className="text-base font-bold">Recommended CAD Diagrams & Cable Gauge Tables</h3>
              <p className="text-xs text-slate-200 mt-2 leading-relaxed">
                To simplify preparation of engineering designs for EPRA licensing submissions, KEREA has pre-engineered single-line schematic drawings (SLDs) for standard 5kW, 15kW, and 50kW solar systems. These PDFs are free to download for active members of the directory.
              </p>
            </div>

            <div className="bg-white border border-slate-150 rounded-2xl divide-y divide-slate-100">
              <div className="p-4.5 flex justify-between items-center">
                <div>
                  <h4 className="text-xs font-black text-[#112a1d]">V1.0 - Single-Line Diagram for 5kW Residential Hybrid Solar (CAD format)</h4>
                  <p className="text-[10px] text-gray-400">Includes auto-mating solar battery isolation breaker sizing.</p>
                </div>
                <button onClick={() => alert('CAD File download initiated. Size: 5.4MB')} className="px-3.5 py-1.5 bg-emerald-50 text-emerald-700 text-[11px] font-bold rounded-lg cursor-pointer">
                  Download DWG
                </button>
              </div>
              <div className="p-4.5 flex justify-between items-center">
                <div>
                  <h4 className="text-xs font-black text-[#112a1d]">DC Cable Sizing & Voltage Drop Computation Spreadsheet</h4>
                  <p className="text-[10px] text-gray-400">Excel tool for estimating wire thickness to prevent fire hazard.</p>
                </div>
                <button onClick={() => alert('Excel sheet download initiated. Safe file transfer approved.')} className="px-3.5 py-1.5 bg-emerald-50 text-emerald-700 text-[11px] font-bold rounded-lg cursor-pointer">
                  Download XLS
                </button>
              </div>
            </div>
          </div>
        )}

        {activeTab === 'compliance' && (
          <div className="max-w-4xl mx-auto space-y-6">
            <div className="bg-slate-50 border border-slate-150 p-6 rounded-2xl">
              <h3 className="text-sm font-extrabold text-[#112a1d]">EPRA Contractor Compliance Checklists</h3>
              <p className="text-xs text-slate-500 mt-2 leading-relaxed">
                Before handing over a solar hybrid storage system to a client, installers are required to run an insulation resistance test, ground loop impedance check, and emergency shut-off visual checks. Download the checklist below, complete it with your verified readings, and have the customer counter-sign to register the product warranty.
              </p>
              <div className="mt-4 pt-3 flex flex-wrap gap-4 text-[10px] text-slate-400">
                <span>Updated: April 2026</span> • <span>Version: 3.2</span>
              </div>
              <button onClick={() => alert('Compliance checklist form loaded.')} className="mt-4 px-4 py-2 bg-[#112a1d] hover:bg-emerald-700 text-white text-xs font-bold rounded-xl cursor-pointer">
                Download PDF Checklist (280 KB)
              </button>
            </div>
          </div>
        )}
      </section>
    </div>
  );
}
