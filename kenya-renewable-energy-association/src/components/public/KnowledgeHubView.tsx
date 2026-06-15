import React, { useState } from 'react';
import { useAppState } from '../../context/AppStateContext';
import { HelpCircle, ChevronRight, ChevronDown, GraduationCap, Server, HelpCircle as HelpIcon, BookOpen } from 'lucide-react';
import { motion, AnimatePresence } from 'motion/react';

type SelectorTab = 'learning' | 'technical' | 'faq';

export default function KnowledgeHubView() {
  const { faqItems } = useAppState();
  const [activeTab, setActiveTab] = useState<SelectorTab>('faq');
  const [openFAQIndex, setOpenFAQIndex] = useState<number | null>(0);

  const toggleFAQ = (idx: number) => {
    setOpenFAQIndex(prev => prev === idx ? null : idx);
  };

  return (
    <div className="space-y-12 pb-16">
      {/* Page Header */}
      <section className="text-center max-w-3xl mx-auto px-4 pt-4">
        <span className="text-emerald-600 font-extrabold text-xs tracking-widest uppercase mb-3 block">
          CENTRALIZED KNOWLEDGE BASE
        </span>
        <h1 className="text-3xl sm:text-4xl font-black text-[#112a1d] tracking-tight">
          Sector Knowledge Hub & Educational Library
        </h1>
        <p className="text-xs sm:text-sm text-gray-500 mt-2">
          An interactive, searchable database housing academic curriculum standards, off-grid safety regulations, and common compliance FAQs.
        </p>
      </section>

      {/* Internal Navigation Subtabs */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap justify-start sm:justify-center gap-1 sm:gap-4 scrollbar-none">
          <button
            onClick={() => setActiveTab('faq')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'faq'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Compliance FAQs Accrdrn
          </button>
          <button
            onClick={() => setActiveTab('learning')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'learning'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Learning Materials
          </button>
          <button
            onClick={() => setActiveTab('technical')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'technical'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Sector Resources
          </button>
        </div>
      </section>

      {/* Render Subtab Elements */}
      <section className="max-w-4xl mx-auto px-4">
        {activeTab === 'faq' && (
          <div className="space-y-4">
            {faqItems.map((faq, idx) => {
              const isOpen = openFAQIndex === idx;
              return (
                <div 
                  key={idx} 
                  className="bg-white rounded-2xl border border-slate-100/80 overflow-hidden shadow-sm"
                >
                  <button
                    onClick={() => toggleFAQ(idx)}
                    className="w-full p-5 flex justify-between items-center text-left hover:bg-slate-50 transition-colors select-none cursor-pointer"
                  >
                    <span className="text-xs sm:text-sm font-black text-[#112a1d] pr-4 flex items-center gap-2">
                      <HelpIcon className="w-4 h-4 text-emerald-600 shrink-0" />
                      {faq.question}
                    </span>
                    {isOpen ? <ChevronDown className="w-5 h-5 text-gray-400 shrink-0" /> : <ChevronRight className="w-5 h-5 text-gray-400 shrink-0" />}
                  </button>

                  <AnimatePresence initial={false}>
                    {isOpen && (
                      <motion.div
                        initial={{ height: 0, opacity: 0 }}
                        animate={{ height: 'auto', opacity: 1 }}
                        exit={{ height: 0, opacity: 0 }}
                        transition={{ duration: 0.25 }}
                        className="border-t border-slate-50 bg-slate-50 bg-opacity-40"
                      >
                        <p className="p-5 text-xs sm:text-sm text-slate-500 leading-relaxed font-sans">
                          {faq.answer}
                        </p>
                      </motion.div>
                    )}
                  </AnimatePresence>
                </div>
              );
            })}
          </div>
        )}

        {activeTab === 'learning' && (
          <div className="space-y-6">
            <div className="p-6 bg-[#112a1d] text-white rounded-2xl flex items-center gap-5">
              <GraduationCap className="w-12 h-12 text-amber-400 shrink-0" />
              <div>
                <h3 className="text-base font-bold">KEREA Video Tutorials & Laboratory Curriculums</h3>
                <p className="text-xs text-emerald-100/80 mt-1 leading-relaxed">
                  Through partner networks, we provide free access to introductory vocational guides covering photovoltaic grounding, solar charger controller diagnostics, and biogas moisture separator desulfurizers.
                </p>
              </div>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div className="p-4 rounded-xl border border-slate-100 bg-white">
                <span className="text-[9px] uppercase font-bold text-amber-600">Video Guide (14 Min)</span>
                <h4 className="text-xs font-black text-[#112a1d] mt-2">How to Calibrate MPPT charge controllers for Lithium Lifepo4 cells</h4>
                <p className="text-[11px] text-gray-400 mt-1">Presented by Strathmore technical assessors.</p>
                <button onClick={() => alert('Launching video buffer framework...')} className="text-emerald-700 font-bold text-xs mt-3 flex items-center gap-1 hover:underline cursor-pointer">
                  Start Video
                </button>
              </div>
              <div className="p-4 rounded-xl border border-slate-100 bg-white">
                <span className="text-[9px] uppercase font-bold text-amber-600">Curriculum Handout (12 pgs)</span>
                <h4 className="text-xs font-black text-[#112a1d] mt-2">Basics of Domestic Compost Anaerobic Brick biodigesters build cycles</h4>
                <p className="text-[11px] text-gray-400 mt-1 font-sans">Pre-engineered drawings booklet of masonry steps.</p>
                <button onClick={() => alert('Launching document packet...')} className="text-emerald-700 font-bold text-xs mt-3 flex items-center gap-1 hover:underline cursor-pointer">
                  View Booklet
                </button>
              </div>
            </div>
          </div>
        )}

        {activeTab === 'technical' && (
          <div className="p-6 bg-slate-50 border border-slate-150 rounded-2xl text-center space-y-3">
            <BookOpen className="w-10 h-10 text-emerald-600 mx-auto" />
            <h3 className="text-sm font-extrabold text-[#112a1d]">The East African Energy Thesaurus Database</h3>
            <p className="text-xs text-slate-500 max-w-xl mx-auto leading-relaxed">
              We are compiling a detailed thesaurus defining clean energy abbreviations, licensing grids, net metering structures, and EPRA policy definitions in English and Kiswahili. This glossary is useful for students and municipal policy managers alike.
            </p>
            <button onClick={() => alert('Thesaurus dictionary compiled context initialized! Loading index...')} className="px-5 py-2.5 bg-[#112a1d] hover:bg-emerald-700 text-white text-xs font-bold rounded-xl cursor-pointer">
              Open Dictionary Index
            </button>
          </div>
        )}
      </section>

    </div>
  );
}
